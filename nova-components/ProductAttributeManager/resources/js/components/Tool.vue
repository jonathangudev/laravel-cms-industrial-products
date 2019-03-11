<template>
  <div>
    <div v-if="isAddingNew">
      <div class="flex items-center border-b border-40">
        <div class="w-1/4 py-8 pr-3">
          <span class="text-80">Name</span>
        </div>
        <div class="w-1/2 pr-3">
          <input
            v-model="newName"
            type="text"
            placeholder="Name"
            class="w-full form-control form-input form-input-bordered"
            @keyup.enter="handleSaveAttribute"
          >
        </div>
      </div>
      <div class="flex items-center">
        <div class="w-1/4 py-8 pr-3">
          <span class="text-80">Value</span>
        </div>
        <div class="w-1/2 pr-3">
          <input
            v-model="newValue"
            type="text"
            placeholder="Value"
            class="w-full form-control form-input form-input-bordered"
            @keyup.enter="handleSaveAttribute"
          >
        </div>
      </div>
      <div class="bg-30 flex -mx-6 -mb-3 px-8 py-4 justify-end">
        <button
          type="button"
          class="btn btn-default btn-danger mr-3"
          @click="handleCancelAttribute"
        >Cancel</button>
        <button
          type="button"
          class="btn btn-default btn-primary"
          @click="handleSaveAttribute"
        >Save Attribute</button>
      </div>
    </div>

    <div v-else>
      <div class="flex mb-6">
        <div class="w-1/4">
          <label for="company-select" class="inline-block mb-1 text-80">Select a company to edit:</label>
          <select
            id="company-select"
            class="w-full form-control form-select"
            v-model="selectedCompanyId"
          >
            <option :value="null">Default</option>
            <option
              v-for="company in companies"
              :key="company.id"
              :value="company.id"
            >{{company.name}}</option>
          </select>
        </div>
        <div class="w-3/4 text-right">
          <button
            type="button"
            class="btn btn-default btn-primary"
            @click="handleAddAttribute"
          >Add New Attribute</button>
        </div>
      </div>

      <div class="flex pb-3 border-b border-40">
        <div class="w-1/4">
          <strong class="text-xs text-80">NAME</strong>
        </div>
        <div class="flex w-3/4">
          <div class="w-2/3">
            <strong class="text-xs text-80 uppercase">{{companyName}} VALUE</strong>
          </div>
          <div class="w-1/6">
            <strong v-if="!isDefaultCompany" class="text-xs text-80">HIDDEN</strong>
          </div>
          <div class="w-1/6 text-right">
            <strong class="text-xs text-80">ACTIONS</strong>
          </div>
        </div>
      </div>

      <attribute
        v-for="attribute in attributes"
        :key="attribute.id"
        :attribute="attribute"
        :attributeValues="attributeValues"
        :selectedCompanyId="selectedCompanyId"
        :isDefaultCompany="isDefaultCompany"
        @attribute-update="updateAttribute"
        @attribute-delete="handleDeleteAttributeValue"
      ></attribute>
    </div>

    <delete-resource-modal
      v-if="isModalOpen"
      @close="handleCloseModal"
      @confirm="handleConfirmDeleteAttributeValue"
    >
      <div class="p-8">
        <heading :level="2" class="mb-6">Delete Attribute</heading>
        <p class="text-80 leading-normal">
          Are you sure you want to delete this attribute?
          <span v-if="isDefaultCompany"></span>
        </p>
        <p class="text-80 leading-normal text-xs mt-4" v-show="isDefaultCompany">
          <span class="font-bold">Note:</span>
          Removing a default attribute
          <strong>will</strong> remove it from all companies that do not have a customized value
        </p>
        <p class="text-80 leading-normal text-xs mt-4" v-show="!isDefaultCompany">
          <span class="font-bold">Note:</span>
          Removing an attribute that has been customized for a specific company will
          <strong>not</strong> remove it from any other company
        </p>
      </div>
    </delete-resource-modal>
  </div>
</template>

<script>
import Attribute from "./Attribute";

export default {
  props: ["resourceName", "resourceId", "field"],
  data() {
    return {
      isModalOpen: false,
      attributeValueToBeDeletedId: null,
      isAddingNew: false,
      newName: "",
      newValue: "",
      selectedCompanyId: null,
      companies: [],
      _attributes: [],
      attributeValues: []
    };
  },

  computed: {
    isDefaultCompany: function() {
      return this.selectedCompanyId === null;
    },

    companyName: function () {
      const company = this.companies.find(item => this.selectedCompanyId === item.id);
      return (company) ? company.name : 'Default';
    },

    companyAttributeIds() {
      return _.map(this.companyAttributeValues, value => {
        return value.attribute_id;
      });
    },

    companyAttributeValues() {
      return _.filter(this.attributeValues, value => {
        if (this.selectedCompanyId !== null) {
          return (
            value.company_id === this.selectedCompanyId ||
            value.company_id === null
          );
        } else {
          return value.company_id === null;
        }
      });
    },

    attributes() {
      return _.filter(this.$data._attributes, attribute => {
        return _.includes(this.companyAttributeIds, attribute.id);
      });
    }
  },

  methods: {
    getValuesForAttribute(id) {
      return this.attributeValues.filter(element => {
        return id === element.attribute_id;
      });
    },

    handleAddAttribute() {
      this.isAddingNew = true;
    },

    handleSaveAttribute() {
      this.isAddingNew = false;
      this.addAttribute();
    },

    handleCancelAttribute() {
      this.isAddingNew = false;
      this.newName = "";
      this.newValue = "";
    },

    handleDeleteAttributeValue(id) {
      this.isModalOpen = true;
      this.attributeValueToBeDeletedId = id;
    },

    handleCloseModal() {
      this.isModalOpen = false;
      this.attributeValueToBeDeletedId = null;
    },

    handleConfirmDeleteAttributeValue() {
      this.isModalOpen = false;
      this.deleteAttributeValue();
    },

    addAttribute() {
      axios
        .post(
          `/nova-vendor/product-attribute-manager/${this.resourceId}/attribute`,
          {
            company_id: this.selectedCompanyId,
            name: this.newName,
            value: this.newValue
          }
        )
        .then(response => {
          this.fetchData().then(() => {
            this.$toasted.show("Successfully added attribute.", {
              type: "success"
            });
          });
        })
        .catch(error => {
          this.$toasted.show(error.response.data.message, { type: "error" });
        })
        .then(() => {
          this.newName = "";
          this.newValue = "";
        });
    },

    updateAttribute(attribute) {
      axios
        .put(`/nova-vendor/product-attribute-manager/attribute`, attribute)
        .then(response => {
          this.fetchData().then(() => {
            this.$toasted.show("Successfully updated attribute.", {
              type: "success"
            });
          });
        })
        .catch(error => {
          this.$toasted.show(error.response.data.message, { type: "error" });
        });
    },

    deleteAttributeValue() {
      axios
        .delete(
          `/nova-vendor/product-attribute-manager/attribute-value/${
            this.attributeValueToBeDeletedId
          }`
        )
        .then(response => {
          this.fetchData().then(() => {
            this.$toasted.show("Successfully deleted attribute.", {
              type: "success"
            });
          });
        })
        .catch(error => {
          this.$toasted.show(error.response.data.message, { type: "error" });
        });
    },

    fetchData() {
      return axios
        .get(
          `/nova-vendor/product-attribute-manager/${
            this.resourceId
          }/attribute-data`
        )
        .then(response => {
          this.companies = response.data.companies;
          this.$data._attributes = response.data.attributes;
          this.attributeValues = response.data.attributeValues;
          this.$emit("reset-attributes");
        })
        .catch(error => {
          this.$toasted.show("There was an error fetching the data", {
            type: "error"
          });
        });
    }
  },

  components: {
    Attribute
  },

  mounted() {
    this.fetchData();
  }
};
</script>

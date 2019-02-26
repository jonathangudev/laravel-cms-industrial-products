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
            class="w-full form-control form-input form-input-bordered">
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
            class="w-full form-control form-input form-input-bordered">
        </div>
      </div>
      <div class="bg-30 flex -mx-6 -mb-3 px-8 py-4 justify-end">
        <button type="button" class="btn btn-default btn-primary" @click="handleSaveAttributeClick">
          Save Attribute
        </button>
      </div>
    </div>

    <div v-else>
      <div class="flex mb-6">
        <div class="w-1/4">
          <label for="company-select" class="inline-block mb-1 text-80">Select a company to edit:</label>
          <select id="company-select" class="w-full form-control form-select" v-model="selectedCompanyId">
            <option value="default">Default</option>
            <option
              v-for="company in companies"
              :key="company.id"
              :value="company.id"
            >
              {{company.name}}
            </option>
          </select>
        </div>
        <div class="w-3/4 text-right">
          <button type="button" class="btn btn-default btn-primary" @click="handleAddAttributeClick">
            Add New Attribute
          </button>
        </div>
      </div>

      <div class="flex pb-3 border-b border-40">
        <div class="w-1/4">
          <strong class="text-xs text-80">NAME</strong>
        </div>
        <div class="flex w-3/4">
          <div class="w-2/3">
            <strong class="text-xs text-80">VALUE</strong>
          </div>
          <div class="w-1/6">
            <strong v-if="!isDefault" class="text-xs text-80">HIDDEN</strong>
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
        :attributeValues="getValuesForAttribute(attribute.id)"
        :selectedCompanyId="selectedCompanyId"
        :isDefault="isDefault">
      </attribute>
    </div>

    <delete-resource-modal v-if="isModalOpen" @close="handleCloseModal" @confirm="handleConfirmDelete">
      <div class="p-8">
        <heading :level="2" class="mb-6">{{ __('Delete Attribute') }}</heading>
        <p class="text-80 leading-normal">
            {{ __('Are you sure you want to delete this attribute? It will be deleted for all companies.') }}
        </p>
      </div>
    </delete-resource-modal>
  </div>
</template>

<script>
import Attribute from './Attribute';

export default {
  props: ['resourceName', 'resourceId', 'field'],
  data() {
    return {
      isModalOpen: false,
      attributeToBeDeletedId: null,
      isAddingNew: false,
      newName: '',
      newValue: '',
      selectedCompanyId: 'default',
      companies: [
        { id: 1, name: 'Company 1' },
        { id: 2, name: 'Company 2' },
        { id: 3, name: 'Company 3' },
      ],
      attributes: [
        { id: 1, name: 'Default Name 1', },
        { id: 2, name: 'Default Name 2', },
        { id: 3, name: 'Default Name 3', },
      ],
      attributeValues: [
        { id: 1, attributeId: 1, companyId: null, value: 'Default',  isHidden: false },
        { id: 2, attributeId: 2, companyId: null, value: 'Default',  isHidden: false },
        { id: 3, attributeId: 3, companyId: null, value: 'Default',  isHidden: false },
        { id: 4, attributeId: 1, companyId: 1,    value: 'Modified', isHidden: true  },
        { id: 5, attributeId: 2, companyId: 1,    value: 'Modified', isHidden: false },
        { id: 6, attributeId: 3, companyId: 1,    value: 'Modified', isHidden: false },
      ]
    };
  },

  mounted () {
    Nova.$on('update:attribute', this.updateAttribute);
    Nova.$on('delete:attribute', this.handleDeleteAttribute);
  },

  computed: {
    isDefault: function () {
      return this.selectedCompanyId === 'default';
    },
  },

  methods: {
    getValuesForAttribute (id) {
      return this.attributeValues.filter((element) => {
        return id === element.attributeId;
      });
    },

    handleAddAttributeClick () {
      this.isAddingNew = true;
    },

    handleSaveAttributeClick () {
      this.isAddingNew = false;
      this.addAttribute();
    },

    handleDeleteAttribute (id) {
      this.isModalOpen = true;
      this.attributeToBeDeletedId = id;
    },

    handleCloseModal () {
      this.isModalOpen = false;
      this.attributeToBeDeletedId = null;
    },

    handleConfirmDelete () {
      this.isModalOpen = false;
      this.deleteAttribute();
    },

    addAttribute () {
      // Axios code goes here
      this.$toasted.show('Successfully added attribute.', { type: 'success' });
    },

    updateAttribute (attribute) {
      window.alert(JSON.stringify(attribute));

      this.attributes = this.attributes.map((item) => {
        if (item.id === attribute.attributeId) {
          return {...item, name: attribute.name};
        }
        return item;
      });


      this.attributeValues = this.attributeValues.map((item) => {
        if (item.attributeId === attribute.attributeId && item.companyId === attribute.companyId) {
          return {...item, value: attribute.value, isHidden: attribute.isHidden};
        }
        return item;
      });

      // Axios code goes here
      this.$toasted.show('Successfully updated attribute.', { type: 'success' });
    },

    deleteAttribute () {
      window.alert(this.attributeToBeDeletedId);

      // Axios code goes here
      this.$toasted.show('Successfully deleted attribute.', { type: 'success' });
    }
  },

  components: {
    Attribute,
  },
};
</script>

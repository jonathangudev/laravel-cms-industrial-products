<template>
  <div>
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
        <create-resource-button
          v-if="!hasSpecSheet"
          resourceName="spec-sheets"
          singularName="Spec Sheet"
          authorizedToCreate="true"
          authorizedToRelate="true"
          relationshipType=""
          viaRelationship=""
          viaResource=""
          viaResourceId="" />
        <button
          type="button"
          class="btn btn-default btn-primary"
          v-if="hasSpecSheet"
          @click="$router.push({name: 'edit', params: { resourceName: 'spec-sheets', resourceId: activeSpecSheet.resourceId }})"
        >
          Edit Spec Sheet
        </button>
      </div>
    </div>

    <div :class="(selectedCompanyId && !hasSpecSheet) ? 'opacity-75' : ''">
      <detail-advanced-media-library-field
        :field="activeSpecSheet.field"
        :resourceId="activeSpecSheet.resourceId"
        :resourceName="activeSpecSheet.resourceName"
        :resource="activeSpecSheet.resource"
      />
    </div>
  </div>
</template>

<script>
export default {
  props: ["resourceName", "resourceId", "field"],
  data() {
    return {
      hasSpecSheet: false,
      selectedCompanyId: null,
      companies: [],
      specSheets: [],
      activeSpecSheet: {
        resource: {},
        resourceName: 'spec-sheets',
        resourceId: null,
        field: {
          value: [],
        }
      }
    };
  },

  methods: {
    setActiveSheet(data) {
      if (data) {
        // If default company
        if (!this.selectedCompanyId) {
          this.hasSpecSheet = true;
        } else if (data.resource.id.value === this.defaultSheet.id.value) {
          // If not default company but using default value
          this.hasSpecSheet = false;
        } else {
          // Not default company
          this.hasSpecSheet = true;
        }

        // Set spec sheet data
        this.activeSpecSheet.resource = data.resource;
        this.activeSpecSheet.resourceId = data.resource.id.value;
        this.activeSpecSheet.field = _.find(data.resource.fields, field => {
          return field.component === "advanced-media-library-field";
        });
      } else {
        // Set spec sheet data to default
        this.hasSpecSheet = false;
        this.activeSpecSheet.resource = {};
        this.activeSpecSheet.resourceId = null;
        this.activeSpecSheet.field = {
          value: [],
        }
      }
    },

    fetchCompanies() {
      return Nova.request().get("/nova-vendor/product-spec-sheet-manager/spec-sheet-data")
        .then(response => {
          this.companies = response.data.companies;
        })
        .catch(error => {
          this.$toasted.show("There was an error fetching the data", {
            type: "error"
          });
        });
    },

    fetchAllSpecSheets () {
      // Fetch spec sheets and filter to only those that belong to this product
      return Nova.request().get("/nova-api/spec-sheets")
        .then(response => {
          this.specSheets = response.data.resources.filter(item => {
            return Object.values(item.fields).some(field => {
              return (field.resourceName === this.resourceName) && (field.belongsToId == this.resourceId);
            });
          });
        }).catch(error => {
          this.$toasted.show("There was an error fetching the data", {
            type: "error"
          });
        });
    },

    fetchSheetById (id) {
      return Nova.request().get("/nova-api/spec-sheets/" + id)
        .catch(error => {
          this.$toasted.show("There was an error fetching the data", {
            type: "error"
          });
        });
    },

    fetchSelectedSheet () {
      // Find spec sheet for selected company
      const sheet = this.specSheets.find(item => {
        return Object.values(item.fields).some(field => {
          return (field.resourceName === "companies") && (field.belongsToId === this.selectedCompanyId);
        });
      });

      // If spec sheet exists, fetch its details
      if (sheet) {
        this.fetchSheetById(sheet.id.value).then(response => this.setActiveSheet(response.data));
      } else if (this.defaultSheet.id.value) {
        // If default exists instead, fetch its details
        this.fetchSheetById(this.defaultSheet.id.value).then(response => this.setActiveSheet(response.data));
      } else {
        // No spec sheet is applicable so show no details
        this.setActiveSheet();
      }
    }
  },

  watch: {
    selectedCompanyId: function () {
      this.fetchSelectedSheet();
    }
  },

  computed: {
    defaultSheet () {
      let sheet = this.specSheets.find(item => {
        return Object.values(item.fields).some(field => {
          return (field.resourceName === "companies") && (field.belongsToId === null);
        });
      });

      // Default sheet does not exist, set null data
      if (!sheet) {
        sheet = {
          id: {
            value: null,
          }
        }
      }

      return sheet;
    }
  },

  mounted() {
    this.fetchCompanies();
    this.fetchAllSpecSheets().then(this.fetchSelectedSheet);
  }
};
</script>

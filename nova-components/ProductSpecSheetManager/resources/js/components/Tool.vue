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
    </div>

    <!-- Need to get the media library field rendering here, and hook it up -->
    <detail-advanced-media-library-field
      :resource="specSheet.resource"
      :resourceName="specSheet.resourceName"
      :resourceId="specSheet.resourceId"
      :field="specSheet.field"
    />
  </div>
</template>

<script>
export default {
  props: ["resourceName", "resourceId", "field"],
  data() {
    return {
      selectedCompanyId: null,
      companies: [],
      specSheet: {
        resource: null,
        resourceName: null,
        resourceId: null,
        field: null
      }
    };
  },

  methods: {
    fetchData() {
      return axios
        .get("/nova-vendor/product-spec-sheet-manager/spec-sheet-data")
        .then(response => {
          this.companies = response.data.companies;
        })
        .catch(error => {
          this.$toasted.show("There was an error fetching the data", {
            type: "error"
          });
        });
    }
  },

  mounted() {
    this.fetchData();

    Nova.request().get("/nova-api/spec-sheets/1");

    axios
      .get("/nova-vendor/product-spec-sheet-manager/fetch/spec-sheets/1")
      .then(response => {
        const field = _.find(resource.fields, field => {
          return field.component == "advanced-media-library-field";
        });

        this.specSheet.resource = response;
        this.specSheet.resourceName = "spec-sheets";
        this.specSheet.resourceId = "1";
        this.specSheet.field = field;

        console.log(response);
      });
  }
};
</script>

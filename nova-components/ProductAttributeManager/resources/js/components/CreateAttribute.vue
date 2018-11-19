<template>
  <form v-if="fields" @submit.prevent="createResource" autocomplete="off">
    <!-- Validation Errors -->
    <validation-errors :errors="validationErrors"/>

    <!-- Fields -->
    <div v-for="field in fields">
      <component
        :is="'form-' + field.component"
        :errors="validationErrors"
        :resource-name="resourceName"
        :field="field"
        :via-resource="viaResource"
        :via-resource-id="viaResourceId"
        :via-relationship="viaRelationship"
      />
    </div>

    <!-- Create Button -->
    <div class="bg-30 flex px-8 py-4">
      <button dusk="create-and-add-another-button" type="button" @click="createAndAddAnother" class="ml-auto btn btn-default btn-primary mr-3">
        {{__('Create &amp; Add Another')}}
      </button>

      <button dusk="create-button" class="btn btn-default btn-primary">
        {{__('Create Attribute')}}
      </button>
    </div>
  </form>
</template>

<script>
import { Errors } from 'laravel-nova';

export default {
  data: () => ({
    relationResponse: null,
    loading: true,
    fields: [
      {
        attribute: 'name',
        component: 'text-field',
        indexName: 'Name',
        name: 'Name',
        panel: null,
        prefixComponent: true,
        sortable: false,
        textAlign: 'left',
        value: null,
      },
      {
        attribute: 'value',
        component: 'text-field',
        indexName: 'Value',
        name: 'Value',
        panel: null,
        prefixComponent: true,
        sortable: false,
        textAlign: 'left',
        value: null,
      },
    ],
    validationErrors: new Errors(),
  }),

  async created() {},

  methods: {
    /**
     * Create a new resource instance using the provided data.
     */
    async createResource() {
      try {
        const response = await this.createRequest();

        this.$toasted.show(
          this.__('The :resource was created!', {
            resource: this.resourceInformation.singularLabel.toLowerCase(),
          }),
          { type: 'success' },
        );

        this.$router.push({
          name: 'detail',
          params: {
            resourceName: this.resourceName,
            resourceId: response.data.id,
          },
        });
      } catch (error) {
        if (error.response.status == 422) {
          this.validationErrors = new Errors(error.response.data.errors);
        }
      }
    },

    /**
     * Create a new resource and reset the form
     */
    async createAndAddAnother() {
      try {
        const response = await this.createRequest();

        this.$toasted.show(
          this.__('The :resource was created!', {
            resource: this.resourceInformation.singularLabel.toLowerCase(),
          }),
          { type: 'success' },
        );

        // Reset the form by refetching the fields
        this.getFields();

        this.validationErrors = new Errors();
      } catch (error) {
        if (error.response.status == 422) {
          this.validationErrors = new Errors(error.response.data.errors);
        }
      }
    },

    /**
     * Send a create request for this resource
     */
    createRequest() {
      return Nova.request().post(
        `/nova-api/${this.resourceName}`,
        this.createResourceFormData(),
      );
    },

    /**
     * Create the form data for creating the resource.
     */
    createResourceFormData() {
      return _.tap(new FormData(), (formData) => {
        _.each(this.fields, (field) => {
          field.fill(formData);
        });

        formData.append('viaResource', this.viaResource);
        formData.append('viaResourceId', this.viaResourceId);
        formData.append('viaRelationship', this.viaRelationship);
      });
    },
  },

  computed: {},
};
</script>

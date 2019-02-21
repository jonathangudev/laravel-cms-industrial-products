<template>
  <div>
    <div class="flex mb-6">
      <div class="w-1/4">
        <label for="company-select" class="inline-block mb-1 text-80">Select a company to edit:</label>
        <select id="company-select" class="w-full form-control form-select" v-model="selectedCompanyId">
          <option value="null">Default</option>
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
      <div class="w-3/4">
        <strong class="text-xs text-80">VALUE</strong>
      </div>
    </div>

    <attribute
      v-for="attribute in attributes"
      :key="attribute.id"
      :attribute="attribute"
      :attributeValues="getValuesForAttribute(attribute.id)"
      :selectedCompanyId="selectedCompanyId">
    </attribute>

  </div>
</template>

<script>
import Attribute from './Attribute';

export default {
  props: ['resourceName', 'resourceId', 'field'],
  data() {
    return {
      selectedCompanyId: null,
      companies: [
        { id: 1, name: 'Company 1' },
        { id: 2, name: 'Company 2' },
        { id: 3, name: 'Company 3' },
      ],
      attributes: [
        { id: 1, name: 'Default Name 1', isHidden: false },
        { id: 2, name: 'Default Name 2', isHidden: false },
        { id: 3, name: 'Default Name 3', isHidden: false },
      ],
      attributeValues: [
        { id: 1, attributeId: 1, companyId: null, value: 'Default' },
        { id: 2, attributeId: 2, companyId: null, value: 'Default' },
        { id: 3, attributeId: 3, companyId: null, value: 'Default' },
        { id: 4, attributeId: 1, companyId: 1,    value: 'Modified' },
        { id: 5, attributeId: 2, companyId: 1,    value: 'Modified' },
        { id: 6, attributeId: 3, companyId: 1,    value: 'Modified' },
      ]
    };
  },

  mounted () {
    Nova.$on('update:attribute', this.updateAttribute);
    Nova.$on('delete:attribute', this.deleteAttribute);
  },

  methods: {
    getValuesForAttribute (id) {
      return this.attributeValues.filter((element) => {
        return id === element.attributeId;
      });
    },

    handleAddAttributeClick () {
      this.attributes.push({
        id: '4',
        name: 'New Attribute',
        value: 'Value',
      });
    },

    handleSaveClick () {
      // Handle save click here
      console.log('handleSaveClick');
      this.updateAttribute();
    },

    updateAttribute (attribute) {
      this.attributes = this.attributes.map((item) => {
        if (item.id === attribute.id) {
          item = {...item, name: attribute.name, value: attribute.value}
        }
        return item;
      });
      
      // Axios code goes here
      this.$toasted.show('Successfully updated attribute.', { type: 'success' });
    },

    deleteAttribute (id) {
      // Axios code goes here
      this.$toasted.show('Successfully deleted attribute.', { type: 'success' });
    }
  },

  components: {
    Attribute,
  },
};
</script>

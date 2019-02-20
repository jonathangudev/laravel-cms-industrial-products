<template>
  <div>
    <div class="flex pb-3 border-b border-40">
      <div class="ml-auto flex">
        <button type="button" class="btn btn-default btn-primary mr-3">
          Add New Attribute
        </button>
        <button type="button" class="btn btn-default btn-primary" @click="handleSaveClick">
          Save Attributes
        </button>
      </div>
    </div>

    <attribute
      v-for="attribute in attributes"
      :key="attribute.name"
      :attribute="attribute">
    </attribute>

    <div>
      <!-- <p>{{ resourceName }}</p>
      <p>{{ resourceId }}</p>
      <p>{{ field }}</p> -->
      <!-- <create-attribute :fields="['name']" resourceName="attribute"></create-attribute> -->
    </div>
  </div>
</template>

<script>
import Attribute from './Attribute';

export default {
  props: ['resourceName', 'resourceId', 'field'],
  data() {
    return {
      attributes: [
        { name: 'test name1', value: 'test value1' },
        { name: 'test name2', value: 'test value2' },
        { name: 'test name3', value: 'test value3' },
      ]
    };
  },

  mounted() {
    //
  },

  methods: {
    handleSaveClick () {
      // Handle save click here
      console.log('handleSaveClick');
      this.updateAttributes();
    },

    updateAttributes () {
      // Axios code goes here
      console.log('handleSaveClick');
    }
  },
  components: {
    Attribute,
  },
};
</script>

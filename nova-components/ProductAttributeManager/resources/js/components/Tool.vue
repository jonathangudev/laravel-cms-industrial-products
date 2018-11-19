<template>
  <div>
    <p>{{ resourceName }}</p>
    <p>{{ resourceId }}</p>
    <p>{{ field }}</p>

    <div class="flex items-center mb-3">
      <div class="ml-auto flex">
        <button class="btn btn-default btn-primary" dusk="create-button">
          Add Attribute
        </button>
      </div>
    </div>
    <div>
      <create-attribute :fields="['name']" resourceName="attribute"></create-attribute>
    </div>
  </div>
</template>

<script>
import CreateAttribute from './CreateAttribute';

export default {
  props: ['resourceName', 'resourceId', 'field'],

  mounted() {
    //
  },
  components: {
    CreateAttribute,
  },
};
</script>

<template>
  <div>Company Catalog Manager
    <tree></tree>
  </div>
</template>

<script>
import Tree from "./Tree";

export default {
  props: ["resourceName", "resourceId", "field"],
  data() {
    return {
      categories: []
    };
  },

  mounted() {
    axios
      .get(`/nova-vendor/company-catalog-manager/${this.resourceId}/categories`)
      .then(response => {
        this.categories = response.data;
      });
  },
  components: {
    Tree
  }
};
</script>

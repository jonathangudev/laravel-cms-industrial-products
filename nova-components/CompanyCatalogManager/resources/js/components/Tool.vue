<template>
  <div>
    <button type="button" class="btn btn-default btn-primary" @click="handleClick">Save</button>
    <draggable-tree :data="categories" draggable>
      <template slot-scope="{data, store}">
        <span v-if="data.children &amp;&amp; data.children.length" @click="store.toggleOpen(data)">
          {{data.open ? '-' : '+'}}&nbsp;
        </span>
        <span>{{data.name}}</span>
      </template>
    </draggable-tree>
  </div>
</template>

<script>
import Tree from "./Tree";
import { DraggableTree } from 'vue-draggable-nested-tree';

export default {
  props: ["resourceName", "resourceId", "field"],
  data() {
    return {
      categories: []
    };
  },
  mounted() {
    // Fetch category data
    axios.get(`/nova-vendor/company-catalog-manager/${this.resourceId}/categories`)
      .then(response => {
        this.categories = response.data;
      })
      .catch(error => {
        this.$toasted.show('Error fetching categories.', {type: 'error'});
    });
  },
  methods: {
    handleClick () {
      const data = this.mapCategories(this.categories);
      
      // Post updated category tree
      axios.put(`/nova-vendor/company-catalog-manager/${this.resourceId}/categories`, data)
        .then(response => {
          this.$toasted.show('Successfully updated categories.', {type: 'success'});
        })
        .catch(error => {         
          this.$toasted.show('Error updating categories.', {type: 'error'});
      });
    },
    mapCategories (categories) {
      // Map categories to clean up data 
      return categories.map(category => {
        let newCat = {...category};
  
        newCat.parent = null;
        newCat._vm = null;
        newCat.company_id = this.resourceId;
        newCat.children = this.mapCategories(category.children);
  
        return newCat;
      });
    },
  },
  components: {
    'draggable-tree': DraggableTree
  }
};
</script>

<style lang="scss">
  .he-tree{
    border: 1px solid #ccc;
    padding: 20px;
    width: 300px;
  }

  .tree-node-inner{
    padding: 5px;
    border: 1px solid #ccc;
    cursor: pointer;
  }

  .draggable-placeholder-inner{
    border: 1px dashed #0088F8;
    box-sizing: border-box;
    background: rgba(0, 136, 249, 0.09);
    color: #0088f9;
    text-align: center;
    padding: 0;
    display: flex;
    align-items: center;
  }
</style>

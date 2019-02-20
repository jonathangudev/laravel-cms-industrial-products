<template>
  <div>
    <div class="flex pb-3 mb-3 border-b border-40">
      <div class="ml-auto flex">
        <button type="button" class="btn btn-default btn-primary mr-3" @click="handleAddClick">
          Add New Category
        </button>
        <button type="button" class="btn btn-default btn-primary" @click="handleSaveClick">
          Save Categories
        </button>
      </div>
    </div>
    <draggable-tree :data="categories" :indent="indent" draggable>
      <template slot-scope="{data, store}">
        <div class="card border border-50 py-2 px-3 tree-node-item">
          <div class="cursor-pointer pr-3" v-if="data.children &amp;&amp; data.children.length" @click="store.toggleOpen(data)">
            <svg v-if="data.open" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M17 11a1 1 0 0 1 0 2H7a1 1 0 0 1 0-2h10z"/></svg>
            <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M17 11a1 1 0 0 1 0 2h-4v4a1 1 0 0 1-2 0v-4H7a1 1 0 0 1 0-2h4V7a1 1 0 0 1 2 0v4h4z"/></svg>
          </div>
          
          <input type="text" name="name" class="appearance-none w-full mr-3" v-model="data.name" :title="data.name">

          <button @click="$router.push({name: 'detail', params: { resourceName: 'categories', resourceId: data.id }})"
            type="button"
            class="btn mr-3"
            title="View"
          >
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="18" viewBox="0 0 22 16" aria-labelledby="view" role="presentation" class="fill-current text-70 hover:text-primary"><path d="M16.56 13.66a8 8 0 0 1-11.32 0L.3 8.7a1 1 0 0 1 0-1.42l4.95-4.95a8 8 0 0 1 11.32 0l4.95 4.95a1 1 0 0 1 0 1.42l-4.95 4.95-.01.01zm-9.9-1.42a6 6 0 0 0 8.48 0L19.38 8l-4.24-4.24a6 6 0 0 0-8.48 0L2.4 8l4.25 4.24h.01zM10.9 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"></path></svg>
          </button>
          <button type="button" class="btn" @click="handleDeleteClick(data, store)" title="Delete">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="fill-current text-70 hover:text-danger"><path class="heroicon-ui" d="M8 6V4c0-1.1.9-2 2-2h4a2 2 0 0 1 2 2v2h5a1 1 0 0 1 0 2h-1v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V8H3a1 1 0 1 1 0-2h5zM6 8v12h12V8H6zm8-2V4h-4v2h4zm-4 4a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0v-6a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 0 1-2 0v-6a1 1 0 0 1 1-1z"/></svg>
          </button>
        </div>
      </template>
    </draggable-tree>
  </div>
</template>

<script>
import { DraggableTree } from 'vue-draggable-nested-tree';

export default {
  props: ["resourceName", "resourceId", "field"],
  data() {
    return {
      categories: [],
      indent: 24,
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
    handleSaveClick () {
      this.updateCategories(this.categories)
    },

    handleAddClick () {
      this.categories.push({
        name: 'New Category',
        company_id: this.resourceId,
      });
    },

    handleDeleteClick (data, store) {
      if (window.confirm("Are you sure you want to delete this category? This will delete all child categories as well.")) {
        store.deleteNode(data);
        this.updateCategories(this.categories)
        .then(() => {
          this.deleteCategory(data.id);
        });
      }
    },

    // Map categories to clean up data 
    mapCategories (categories) {
      return categories.map(category => {
        let newCat = {...category};
  
        newCat.parent = null;
        newCat._vm = null;
        newCat.company_id = this.resourceId;
        newCat.children = this.mapCategories(category.children);
  
        return newCat;
      });
    },

    // Post updated category tree
    updateCategories (data) {
      const newData = this.mapCategories(data);
      return axios.put(`/nova-vendor/company-catalog-manager/${this.resourceId}/categories`, newData)
        .then(response => {
          this.$toasted.show('Successfully updated categories.', {type: 'success'});
        })
        .catch(error => {         
          this.$toasted.show('Error updating categories.', {type: 'error'});
      });
    },

    // Delete category from tree
    deleteCategory (id) {
      return axios.delete(`/nova-vendor/company-catalog-manager/category/${id}`)
        .then(response => {
          this.$toasted.show('Successfully deleted category.', {type: 'success'});
        })
        .catch(error => {         
          this.$toasted.show('Error deleting category.', {type: 'error'});
      });
    }
  },
  components: {
    'draggable-tree': DraggableTree
  }
};
</script>

<style lang="scss">
  .he-tree{
    svg {
      display: block;
    }
  }

  .tree-node-inner{
    cursor: grab;
    max-width: 500px;
  }

  .tree-node-item {
    display: flex;
    align-items: center;
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

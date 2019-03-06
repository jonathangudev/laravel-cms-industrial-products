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
            <strong v-if="data.open">-</strong>
            <strong v-else>+</strong>
          </div>
          
          <input
            type="text"
            name="name"
            class="appearance-none w-full mr-3"
            :title="data.name"
            v-model="data.name"
            @keyup.enter="handleSaveClick">

          <button @click="$router.push({name: 'detail', params: { resourceName: 'categories', resourceId: data.id }})"
            type="button"
            class="btn mr-3"
            title="View"
          >
            <icon type="view" view-box="0 0 22 16" width="22" height="16" class="block text-70 hover:text-primary"/>
          </button>
          <button type="button" class="btn" @click="handleDeleteClick(data, store)" title="Delete">
            <icon type="delete" class="block text-70 hover:text-danger"/>
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
        this.updateCategories(this.categories)
        .then(() => {
          this.deleteCategory(data.id).then(() => {
            const node = this.categories.find(item => item.id === data.id);
            store.deleteNode(node);
          });
        });
      }
    },

    // Map categories to clean up data 
    mapCategories (categories) {
      return categories.map(category => {
        return {
          id: category.id || null,
          name: category.name,
          company_id: this.resourceId,
          children: this.mapCategories(category.children),
        };
      });
    },

    // Post updated category tree
    updateCategories (data) {
      const newData = this.mapCategories(data);     
      return axios.put(`/nova-vendor/company-catalog-manager/${this.resourceId}/categories`, newData)
        .then(response => {
          this.categories = response.data;
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
  .tree-node-inner {
    cursor: grab;
    width: 500px;
  }

  .tree-node-item {
    display: flex;
    align-items: center;
  }

  .draggable-placeholder-inner {
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

<template>
  <div>
    <button type="button" class="btn btn-default btn-primary" @click="handleClick">Save</button>
    <draggable-tree :data="localCategories" draggable>
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
import { DraggableTree } from 'vue-draggable-nested-tree';

export default {
  props: ['categories'],
  data: function () {
    return {
      localCategories: [...this.categories]
    }
  },
  watch: {
    categories: function (val) {
      this.localCategories = [...val]
    }
  },
  methods: {
    handleClick() {
      Nova.$emit('update:categories', this.localCategories);
    }
  },
  components: {
    'draggable-tree': DraggableTree
  }
};
</script>

<style lang="scss">
</style>

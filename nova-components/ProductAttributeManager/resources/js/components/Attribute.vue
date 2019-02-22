<template>
  <div class="flex items-center border-b border-40">
    <div class="w-1/4 py-4 pr-3">
      <input
        v-if="isEditing && isDefault"
        v-model="localName"
        type="text"
        placeholder="Name"
        class="w-full form-control form-input form-input-bordered">
      <strong v-else>{{localName}}</strong>
    </div>

    <div class="flex items-center w-3/4 py-4">
      <div class="w-2/3 pr-3">
        <input
          v-if="isEditing"
          v-model="localValue"
          type="text"
          placeholder="Value"
          class="w-full form-control form-input form-input-bordered">
        <span v-else>{{localValue}}</span>
      </div>

      <div class="w-1/6 pr-3">
        <checkbox v-if="!isDefault && isEditing" :checked="localIsHidden" @input="handleCheckbox"></checkbox>
        <span v-if="!isDefault && !isEditing && localIsHidden" class="fill-current text-70">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" class="block"><path class="heroicon-ui" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-2.3-8.7l1.3 1.29 3.3-3.3a1 1 0 0 1 1.4 1.42l-4 4a1 1 0 0 1-1.4 0l-2-2a1 1 0 0 1 1.4-1.42z"/></svg>
        </span>
      </div>

      <div class="w-1/6 flex items-center justify-end">
        <button v-if="!isEditing"
          @click="handleEditClick"
          type="button"
          class="btn mr-3"
          title="Edit Value"
        >
          <icon type="edit" class="block fill-current text-70 hover:text-primary"/>
        </button>
        <button v-if="!isEditing" type="button" class="btn" @click="handleDeleteClick" title="Delete">
          <icon type="delete" class="block fill-current text-70 hover:text-danger"/>
        </button>
        <button v-if="isEditing" @click="handleCancelClick" type="button" class="btn btn-default btn-danger mr-3">Cancel</button>
        <button v-if="isEditing" @click="handleSaveClick" type="button" class="btn btn-default btn-primary">Save</button>
      </div>    
    </div>
  </div>
</template>

<script>
export default {
  props: ['attribute', 'attributeValues', 'selectedCompanyId', 'isDefault'],
  data () {
    return {
      isEditing: false,
      localName: this.attribute.name,
      localValue: this.getCompanyValues().value,
      localIsHidden: this.getCompanyValues().isHidden,
    };
  },

  watch: {
    // Change values when selected company changes
    selectedCompanyId: function () {
      this.resetAttribute();
    }
  },

  methods: {
    getCompanyValues () {
      // Find attribute that matches currently selected company
      let found = this.attributeValues.find((element) => {
        return this.selectedCompanyId === element.companyId;
      });

      // If not found, use default value
      if (!found) {
        found = this.attributeValues.find((element) => {
          return !element.companyId;
        });
      }

      return found;
    },

    resetAttribute () {
      this.isEditing = false;
      this.localName = this.attribute.name;
      this.localValue = this.getCompanyValues().value;
      this.localIsHidden = this.getCompanyValues().isHidden;
    },

    handleCheckbox (checked) {
      this.localIsHidden = checked;
    },

    handleEditClick () {
      this.isEditing = true;
    },

    handleDeleteClick () {
      Nova.$emit('delete:attribute', this.attribute.id);
    },

    handleCancelClick () {
      this.resetAttribute();
    },

    handleSaveClick () {
      this.isEditing = false;
      Nova.$emit('update:attribute', {
        attributeId: this.attribute.id,
        companyId: (this.isDefault) ? null : this.selectedCompanyId,
        name: this.localName,
        value: this.localValue,
        isHidden: this.localIsHidden,
      });
    },
  }
}
</script>

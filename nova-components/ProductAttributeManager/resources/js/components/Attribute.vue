<template>
  <div class="flex items-center border-b border-40">
    <div class="w-1/4 py-4 pr-3">
      <input
        v-if="isEditing && !selectedCompanyId"
        v-model="localName"
        type="text"
        placeholder="Name"
        class="w-full form-control form-input form-input-bordered">
      <strong v-else>{{localName}}</strong>
    </div>
    
    <div class="w-1/2 py-4">
      <input
        v-if="isEditing"
        v-model="localValue"
        type="text"
        placeholder="Value"
        class="w-full form-control form-input form-input-bordered">
      <span v-else>{{localValue}}</span>
    </div>

    <div class="w-1/4 py-4 flex items-center justify-end">
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
</template>

<script>
export default {
  props: ['attribute', 'attributeValues', 'selectedCompanyId'],
  data () {
    return {
      isEditing: false,
      localName: this.attribute.name,
    };
  },

  computed: {
    localValue: function () {
      return this.getAttributeValue();
    },
  },

  watch: {
    selectedCompanyId: function () {
      this.localValue = this.getAttributeValue();
    }
  },

  methods: {
    getAttributeValue () {
      // Find attribute that matches currently selected company
      let found = this.attributeValues.find((element) => {
        return this.selectedCompanyId === element.companyId;
      });

      if (!found) {
        // If not found, use default value
        found = this.attributeValues.find((element) => {
          return element.companyId === null;
        });
      }

      return found.value;
    },

    handleEditClick () {
      this.isEditing = true;
    },
    
    handleDeleteClick () {
      if(window.confirm('Are you sure you want to delete this attribute? This will delete the attribute for all companies.')) {
        Nova.$emit('delete:attribute', this.attribute.id);
      }
    },

    handleCancelClick () {
      this.isEditing = false;
      this.localName = this.attribute.name;
      this.localValue = this.getAttributeValue();
    },

    handleSaveClick () {
      this.isEditing = false;
      Nova.$emit('update:attribute', {
        id: attribute.id,
        name: this.localName,
        value: this.localValue,
        companyId: this.selectedCompanyId
      });
    },
  }
}
</script>

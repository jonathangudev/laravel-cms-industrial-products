<template>
  <div class="flex items-center border-b border-40">
    <div class="w-1/4 py-4 pr-3">
      <input
        v-if="isEditing && isDefaultCompany"
        v-model="name"
        type="text"
        placeholder="Name"
        class="w-full form-control form-input form-input-bordered"
        @keyup.enter="handleSave"
      >
      <strong v-else>{{name}}</strong>
    </div>

    <div class="flex items-center w-3/4 py-4">
      <div class="w-2/3 pr-3">
        <input
          v-if="isEditing"
          v-model="value"
          type="text"
          placeholder="Value"
          class="w-full form-control form-input form-input-bordered"
          @keyup.enter="handleSave"
        >
        <span v-else :class="{'text-70': $data._isDefaultValue && !isDefaultCompany}">{{value}}</span>
      </div>

      <div class="w-1/6 pr-3">
        <checkbox
          v-if="!isDefaultCompany && isEditing"
          :checked="isHidden"
          @input="handleCheckbox"
          class="cursor-pointer"
        ></checkbox>
        <span v-if="!isDefaultCompany && !isEditing && isHidden" class="fill-current text-70">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            width="24"
            height="24"
            class="block"
          >
            <path
              class="heroicon-ui"
              d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-2.3-8.7l1.3 1.29 3.3-3.3a1 1 0 0 1 1.4 1.42l-4 4a1 1 0 0 1-1.4 0l-2-2a1 1 0 0 1 1.4-1.42z"
            ></path>
          </svg>
        </span>
      </div>

      <div class="w-1/6 flex items-center justify-end">
        <button
          v-if="!isEditing"
          @click="handleEdit"
          type="button"
          class="btn mr-3"
          title="Edit Value"
        >
          <icon type="edit" class="block fill-current text-70 hover:text-primary"/>
        </button>
        <button v-if="canDelete" type="button" class="btn" @click="handleDelete" title="Delete">
          <icon type="delete" class="block fill-current text-70 hover:text-danger"/>
        </button>
        <button
          v-if="isEditing"
          @click="handleCancel"
          type="button"
          class="btn btn-default btn-danger mr-3"
        >Cancel</button>
        <button
          v-if="isEditing"
          @click="handleSave"
          type="button"
          class="btn btn-default btn-primary"
        >Save</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: [
    "attribute",
    "attributeValues",
    "selectedCompanyId",
    "isDefaultCompany"
  ],
  data() {
    return {
      isEditing: false,
      _name: null,
      _value: null,
      _isHidden: null,
      _isDefaultValue: null
    };
  },

  computed: {
    values() {
      return this.attributeValues.filter(element => {
        return this.attribute.id === element.attribute_id;
      });
    },

    attributeValue() {
      // Find attribute that matches currently selected company
      let found = this.values.find(element => {
        return this.selectedCompanyId === element.company_id;
      });

      // If not found, use default value
      if (!found) {
        found = this.values.find(element => {
          return !element.company_id;
        });

        this.$data._isDefaultValue = true;
      }

      if (found.company_id === null) {
        this.$data._isDefaultValue = true;
      } else {
        this.$data._isDefaultValue = false;
      }

      return found;
    },

    name: {
      get() {
        return this.$data._name !== null
          ? this.$data._name
          : this.attribute.name;
      },
      set(data) {
        this.$data._name = data;
      }
    },

    value: {
      get() {
        return this.$data._value !== null
          ? this.$data._value
          : this.attributeValue.value;
      },
      set(data) {
        this.$data._value = data;
      }
    },

    isHidden: {
      get() {
        return this.$data._isHidden !== null
          ? this.$data._isHidden
          : this.attributeValue.is_hidden;
      },
      set(data) {
        this.$data._isHidden = data;
      }
    },

    canDelete() {
      return (
        !this.isEditing &&
        ((this.isDefaultCompany && this.$data._isDefaultValue) ||
          (!this.isDefaultCompany && !this.$data._isDefaultValue))
      );
    },

    updateData() {
      const attribute = _.clone(this.attribute);
      const attributeValue = _.clone(this.attributeValue);

      attribute.name = this.name;

      if (
        this.$data._isDefaultValue === true &&
        this.selectedCompanyId !== attributeValue.company_id
      ) {
        delete attributeValue.id;
        delete attributeValue.created_at;
        delete attributeValue.updated_at;
      }

      attributeValue.value = this.value;
      attributeValue.is_hidden = this.isHidden;
      attributeValue.company_id = this.selectedCompanyId;
      delete attributeValue.attribute;

      return {
        attribute,
        attributeValue
      };
    }
  },

  watch: {
    // Change values when selected company changes
    selectedCompanyId: function() {
      this.resetAttribute();
    }
  },

  methods: {
    resetAttribute() {
      this.isEditing = false;
      this.name = null;
      this.value = null;
      this.isHidden = null;
    },

    handleCheckbox(checked) {
      this.isHidden = checked;
    },

    handleEdit() {
      this.isEditing = true;
    },

    handleDelete() {
      this.$emit("attribute-delete", this.attributeValue.id);
    },

    handleCancel() {
      this.resetAttribute();
    },

    handleSave() {
      this.isEditing = false;
      this.$emit("attribute-update", this.updateData);
    }
  },

  created() {
    this.$parent.$on("reset-attributes", this.resetAttribute);
  }
};
</script>

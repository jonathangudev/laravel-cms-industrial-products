/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports) {

/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file.
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

module.exports = function normalizeComponent (
  rawScriptExports,
  compiledTemplate,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier /* server only */
) {
  var esModule
  var scriptExports = rawScriptExports = rawScriptExports || {}

  // ES6 modules interop
  var type = typeof rawScriptExports.default
  if (type === 'object' || type === 'function') {
    esModule = rawScriptExports
    scriptExports = rawScriptExports.default
  }

  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (compiledTemplate) {
    options.render = compiledTemplate.render
    options.staticRenderFns = compiledTemplate.staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = injectStyles
  }

  if (hook) {
    var functional = options.functional
    var existing = functional
      ? options.render
      : options.beforeCreate

    if (!functional) {
      // inject component registration as beforeCreate hook
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    } else {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functioal component in vue file
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return existing(h, context)
      }
    }
  }

  return {
    esModule: esModule,
    exports: scriptExports,
    options: options
  }
}


/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(2);
module.exports = __webpack_require__(9);


/***/ }),
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

Nova.booting(function (Vue, router) {
    Vue.component('product-attribute-manager', __webpack_require__(3));
});

/***/ }),
/* 3 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(4)
/* template */
var __vue_template__ = __webpack_require__(8)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/Tool.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-68ff5483", Component.options)
  } else {
    hotAPI.reload("data-v-68ff5483", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 4 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__Attribute__ = __webpack_require__(5);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__Attribute___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__Attribute__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//



/* harmony default export */ __webpack_exports__["default"] = ({
  props: ["resourceName", "resourceId", "field"],
  data: function data() {
    return {
      hasDocument: false,
      isModalOpen: false,
      attributeValueToBeDeletedId: null,
      isAddingNew: false,
      newName: "",
      newValue: "",
      selectedCompanyId: null,
      companies: [],
      _attributes: [],
      attributeValues: []
    };
  },


  computed: {
    isDefaultCompany: function isDefaultCompany() {
      return this.selectedCompanyId === null;
    },

    companyName: function companyName() {
      var _this = this;

      var company = this.companies.find(function (item) {
        return _this.selectedCompanyId === item.id;
      });
      return company ? company.name : 'Default';
    },

    companyAttributeIds: function companyAttributeIds() {
      return _.map(this.companyAttributeValues, function (value) {
        return value.attribute_id;
      });
    },
    companyAttributeValues: function companyAttributeValues() {
      var _this2 = this;

      return _.filter(this.attributeValues, function (value) {
        if (_this2.selectedCompanyId !== null) {
          return value.company_id === _this2.selectedCompanyId || value.company_id === null;
        } else {
          return value.company_id === null;
        }
      });
    },
    attributes: function attributes() {
      var _this3 = this;

      return _.filter(this.$data._attributes, function (attribute) {
        return _.includes(_this3.companyAttributeIds, attribute.id);
      });
    }
  },

  methods: {
    getValuesForAttribute: function getValuesForAttribute(id) {
      return this.attributeValues.filter(function (element) {
        return id === element.attribute_id;
      });
    },
    handleAddDocument: function handleAddDocument() {
      this.hasDocument = true;
    },
    handleAddAttribute: function handleAddAttribute() {
      this.isAddingNew = true;
    },
    handleSaveAttribute: function handleSaveAttribute() {
      this.isAddingNew = false;
      this.addAttribute();
    },
    handleCancelAttribute: function handleCancelAttribute() {
      this.isAddingNew = false;
      this.newName = "";
      this.newValue = "";
    },
    handleDeleteAttributeValue: function handleDeleteAttributeValue(id) {
      this.isModalOpen = true;
      this.attributeValueToBeDeletedId = id;
    },
    handleCloseModal: function handleCloseModal() {
      this.isModalOpen = false;
      this.attributeValueToBeDeletedId = null;
    },
    handleConfirmDeleteAttributeValue: function handleConfirmDeleteAttributeValue() {
      this.isModalOpen = false;
      this.deleteAttributeValue();
    },
    addAttribute: function addAttribute() {
      var _this4 = this;

      axios.post("/nova-vendor/product-attribute-manager/" + this.resourceId + "/attribute", {
        company_id: this.selectedCompanyId,
        name: this.newName,
        value: this.newValue
      }).then(function (response) {
        _this4.fetchData().then(function () {
          _this4.$toasted.show("Successfully added attribute.", {
            type: "success"
          });
        });
      }).catch(function (error) {
        _this4.$toasted.show(error.response.data.message, { type: "error" });
      }).then(function () {
        _this4.newName = "";
        _this4.newValue = "";
      });
    },
    updateAttribute: function updateAttribute(attribute) {
      var _this5 = this;

      axios.put("/nova-vendor/product-attribute-manager/attribute", attribute).then(function (response) {
        _this5.fetchData().then(function () {
          _this5.$toasted.show("Successfully updated attribute.", {
            type: "success"
          });
        });
      }).catch(function (error) {
        _this5.$toasted.show(error.response.data.message, { type: "error" });
      });
    },
    deleteAttributeValue: function deleteAttributeValue() {
      var _this6 = this;

      axios.delete("/nova-vendor/product-attribute-manager/attribute-value/" + this.attributeValueToBeDeletedId).then(function (response) {
        _this6.fetchData().then(function () {
          _this6.$toasted.show("Successfully deleted attribute.", {
            type: "success"
          });
        });
      }).catch(function (error) {
        _this6.$toasted.show(error.response.data.message, { type: "error" });
      });
    },
    fetchData: function fetchData() {
      var _this7 = this;

      return axios.get("/nova-vendor/product-attribute-manager/" + this.resourceId + "/attribute-data").then(function (response) {
        _this7.companies = response.data.companies;
        _this7.$data._attributes = response.data.attributes;
        _this7.attributeValues = response.data.attributeValues;
        _this7.$emit("reset-attributes");
      }).catch(function (error) {
        _this7.$toasted.show("There was an error fetching the data", {
          type: "error"
        });
      });
    }
  },

  components: {
    Attribute: __WEBPACK_IMPORTED_MODULE_0__Attribute___default.a
  },

  mounted: function mounted() {
    this.fetchData();
  }
});

/***/ }),
/* 5 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(6)
/* template */
var __vue_template__ = __webpack_require__(7)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/Attribute.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-5148b27e", Component.options)
  } else {
    hotAPI.reload("data-v-5148b27e", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 6 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  props: ["attribute", "attributeValues", "selectedCompanyId", "isDefaultCompany"],
  data: function data() {
    return {
      isEditing: false,
      _name: null,
      _value: null,
      _isHidden: null,
      _isDefaultValue: null
    };
  },


  computed: {
    values: function values() {
      var _this = this;

      return this.attributeValues.filter(function (element) {
        return _this.attribute.id === element.attribute_id;
      });
    },
    attributeValue: function attributeValue() {
      var _this2 = this;

      // Find attribute that matches currently selected company
      var found = this.values.find(function (element) {
        return _this2.selectedCompanyId === element.company_id;
      });

      // If not found, use default value
      if (!found) {
        found = this.values.find(function (element) {
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
      get: function get() {
        return this.$data._name !== null ? this.$data._name : this.attribute.name;
      },
      set: function set(data) {
        this.$data._name = data;
      }
    },

    value: {
      get: function get() {
        return this.$data._value !== null ? this.$data._value : this.attributeValue.value;
      },
      set: function set(data) {
        this.$data._value = data;
      }
    },

    isHidden: {
      get: function get() {
        return this.$data._isHidden !== null ? this.$data._isHidden : this.attributeValue.is_hidden;
      },
      set: function set(data) {
        this.$data._isHidden = data;
      }
    },

    canDelete: function canDelete() {
      return !this.isEditing && (this.isDefaultCompany && this.$data._isDefaultValue || !this.isDefaultCompany && !this.$data._isDefaultValue);
    },
    updateData: function updateData() {
      var attribute = _.clone(this.attribute);
      var attributeValue = _.clone(this.attributeValue);

      attribute.name = this.name;

      if (this.$data._isDefaultValue === true && this.selectedCompanyId !== attributeValue.company_id) {
        delete attributeValue.id;
        delete attributeValue.created_at;
        delete attributeValue.updated_at;
      }

      attributeValue.value = this.value;
      attributeValue.is_hidden = this.isHidden;
      attributeValue.company_id = this.selectedCompanyId;
      delete attributeValue.attribute;

      return {
        attribute: attribute,
        attributeValue: attributeValue
      };
    }
  },

  watch: {
    // Change values when selected company changes
    selectedCompanyId: function selectedCompanyId() {
      this.resetAttribute();
    }
  },

  methods: {
    resetAttribute: function resetAttribute() {
      this.isEditing = false;
      this.name = null;
      this.value = null;
      this.isHidden = null;
    },
    handleCheckbox: function handleCheckbox(checked) {
      this.isHidden = checked;
    },
    handleEdit: function handleEdit() {
      this.isEditing = true;
    },
    handleDelete: function handleDelete() {
      this.$emit("attribute-delete", this.attributeValue.id);
    },
    handleCancel: function handleCancel() {
      this.resetAttribute();
    },
    handleSave: function handleSave() {
      this.isEditing = false;
      this.$emit("attribute-update", this.updateData);
    }
  },

  created: function created() {
    this.$parent.$on("reset-attributes", this.resetAttribute);
  }
});

/***/ }),
/* 7 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "flex items-center border-b border-40" }, [
    _c("div", { staticClass: "w-1/4 py-4 pr-3" }, [
      _vm.isEditing && _vm.isDefaultCompany
        ? _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.name,
                expression: "name"
              }
            ],
            staticClass: "w-full form-control form-input form-input-bordered",
            attrs: { type: "text", placeholder: "Name" },
            domProps: { value: _vm.name },
            on: {
              keyup: function($event) {
                if (
                  !$event.type.indexOf("key") &&
                  _vm._k($event.keyCode, "enter", 13, $event.key, "Enter")
                ) {
                  return null
                }
                return _vm.handleSave($event)
              },
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.name = $event.target.value
              }
            }
          })
        : _c("strong", [_vm._v(_vm._s(_vm.name))])
    ]),
    _vm._v(" "),
    _c("div", { staticClass: "flex items-center w-3/4 py-4" }, [
      _c("div", { staticClass: "w-2/3 pr-3" }, [
        _vm.isEditing
          ? _c("input", {
              directives: [
                {
                  name: "model",
                  rawName: "v-model",
                  value: _vm.value,
                  expression: "value"
                }
              ],
              staticClass: "w-full form-control form-input form-input-bordered",
              attrs: { type: "text", placeholder: "Value" },
              domProps: { value: _vm.value },
              on: {
                keyup: function($event) {
                  if (
                    !$event.type.indexOf("key") &&
                    _vm._k($event.keyCode, "enter", 13, $event.key, "Enter")
                  ) {
                    return null
                  }
                  return _vm.handleSave($event)
                },
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.value = $event.target.value
                }
              }
            })
          : _c(
              "span",
              {
                class: {
                  "text-70": _vm.$data._isDefaultValue && !_vm.isDefaultCompany
                }
              },
              [_vm._v(_vm._s(_vm.value))]
            )
      ]),
      _vm._v(" "),
      _c(
        "div",
        { staticClass: "w-1/6 pr-3" },
        [
          !_vm.isDefaultCompany && _vm.isEditing
            ? _c("checkbox", {
                staticClass: "cursor-pointer",
                attrs: { checked: _vm.isHidden },
                on: { input: _vm.handleCheckbox }
              })
            : _vm._e(),
          _vm._v(" "),
          !_vm.isDefaultCompany && !_vm.isEditing && _vm.isHidden
            ? _c("span", { staticClass: "fill-current text-70" }, [
                _c(
                  "svg",
                  {
                    staticClass: "block",
                    attrs: {
                      xmlns: "http://www.w3.org/2000/svg",
                      viewBox: "0 0 24 24",
                      width: "24",
                      height: "24"
                    }
                  },
                  [
                    _c("path", {
                      staticClass: "heroicon-ui",
                      attrs: {
                        d:
                          "M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-2.3-8.7l1.3 1.29 3.3-3.3a1 1 0 0 1 1.4 1.42l-4 4a1 1 0 0 1-1.4 0l-2-2a1 1 0 0 1 1.4-1.42z"
                      }
                    })
                  ]
                )
              ])
            : _vm._e()
        ],
        1
      ),
      _vm._v(" "),
      _c("div", { staticClass: "w-1/6 flex items-center justify-end" }, [
        !_vm.isEditing
          ? _c(
              "button",
              {
                staticClass: "btn mr-3",
                attrs: { type: "button", title: "Edit Value" },
                on: { click: _vm.handleEdit }
              },
              [
                _c("icon", {
                  staticClass: "block fill-current text-70 hover:text-primary",
                  attrs: { type: "edit" }
                })
              ],
              1
            )
          : _vm._e(),
        _vm._v(" "),
        _vm.canDelete
          ? _c(
              "button",
              {
                staticClass: "btn",
                attrs: { type: "button", title: "Delete" },
                on: { click: _vm.handleDelete }
              },
              [
                _c("icon", {
                  staticClass: "block fill-current text-70 hover:text-danger",
                  attrs: { type: "delete" }
                })
              ],
              1
            )
          : _vm._e(),
        _vm._v(" "),
        _vm.isEditing
          ? _c(
              "button",
              {
                staticClass: "btn btn-default btn-danger mr-3",
                attrs: { type: "button" },
                on: { click: _vm.handleCancel }
              },
              [_vm._v("Cancel")]
            )
          : _vm._e(),
        _vm._v(" "),
        _vm.isEditing
          ? _c(
              "button",
              {
                staticClass: "btn btn-default btn-primary",
                attrs: { type: "button" },
                on: { click: _vm.handleSave }
              },
              [_vm._v("Save")]
            )
          : _vm._e()
      ])
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-5148b27e", module.exports)
  }
}

/***/ }),
/* 8 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _vm.isAddingNew
        ? _c("div", [
            _c("div", { staticClass: "flex items-center border-b border-40" }, [
              _vm._m(0),
              _vm._v(" "),
              _c("div", { staticClass: "w-1/2 pr-3" }, [
                _c("input", {
                  directives: [
                    {
                      name: "model",
                      rawName: "v-model",
                      value: _vm.newName,
                      expression: "newName"
                    }
                  ],
                  staticClass:
                    "w-full form-control form-input form-input-bordered",
                  attrs: { type: "text", placeholder: "Name" },
                  domProps: { value: _vm.newName },
                  on: {
                    keyup: function($event) {
                      if (
                        !$event.type.indexOf("key") &&
                        _vm._k($event.keyCode, "enter", 13, $event.key, "Enter")
                      ) {
                        return null
                      }
                      return _vm.handleSaveAttribute($event)
                    },
                    input: function($event) {
                      if ($event.target.composing) {
                        return
                      }
                      _vm.newName = $event.target.value
                    }
                  }
                })
              ])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "flex items-center" }, [
              _vm._m(1),
              _vm._v(" "),
              _c("div", { staticClass: "w-1/2 pr-3" }, [
                _c("input", {
                  directives: [
                    {
                      name: "model",
                      rawName: "v-model",
                      value: _vm.newValue,
                      expression: "newValue"
                    }
                  ],
                  staticClass:
                    "w-full form-control form-input form-input-bordered",
                  attrs: { type: "text", placeholder: "Value" },
                  domProps: { value: _vm.newValue },
                  on: {
                    keyup: function($event) {
                      if (
                        !$event.type.indexOf("key") &&
                        _vm._k($event.keyCode, "enter", 13, $event.key, "Enter")
                      ) {
                        return null
                      }
                      return _vm.handleSaveAttribute($event)
                    },
                    input: function($event) {
                      if ($event.target.composing) {
                        return
                      }
                      _vm.newValue = $event.target.value
                    }
                  }
                })
              ])
            ]),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "bg-30 flex -mx-6 -mb-3 px-8 py-4 justify-end" },
              [
                _c(
                  "button",
                  {
                    staticClass: "btn btn-default btn-danger mr-3",
                    attrs: { type: "button" },
                    on: { click: _vm.handleCancelAttribute }
                  },
                  [_vm._v("Cancel")]
                ),
                _vm._v(" "),
                _c(
                  "button",
                  {
                    staticClass: "btn btn-default btn-primary",
                    attrs: { type: "button" },
                    on: { click: _vm.handleSaveAttribute }
                  },
                  [_vm._v("Save Attribute")]
                )
              ]
            )
          ])
        : _c(
            "div",
            [
              _c("div", { staticClass: "flex mb-6" }, [
                _c("div", { staticClass: "w-1/4" }, [
                  _c(
                    "label",
                    {
                      staticClass: "inline-block mb-1 text-80",
                      attrs: { for: "company-select" }
                    },
                    [_vm._v("Select a company to edit:")]
                  ),
                  _vm._v(" "),
                  _c(
                    "select",
                    {
                      directives: [
                        {
                          name: "model",
                          rawName: "v-model",
                          value: _vm.selectedCompanyId,
                          expression: "selectedCompanyId"
                        }
                      ],
                      staticClass: "w-full form-control form-select",
                      attrs: { id: "company-select" },
                      on: {
                        change: function($event) {
                          var $$selectedVal = Array.prototype.filter
                            .call($event.target.options, function(o) {
                              return o.selected
                            })
                            .map(function(o) {
                              var val = "_value" in o ? o._value : o.value
                              return val
                            })
                          _vm.selectedCompanyId = $event.target.multiple
                            ? $$selectedVal
                            : $$selectedVal[0]
                        }
                      }
                    },
                    [
                      _c("option", { domProps: { value: null } }, [
                        _vm._v("Default")
                      ]),
                      _vm._v(" "),
                      _vm._l(_vm.companies, function(company) {
                        return _c(
                          "option",
                          { key: company.id, domProps: { value: company.id } },
                          [_vm._v(_vm._s(company.name))]
                        )
                      })
                    ],
                    2
                  )
                ]),
                _vm._v(" "),
                _c("div", { staticClass: "w-3/4 text-right" }, [
                  _c(
                    "button",
                    {
                      staticClass: "btn btn-default btn-primary mr-3",
                      attrs: { disabled: _vm.hasDocument, type: "button" },
                      on: { click: _vm.handleAddDocument }
                    },
                    [_vm._v("Add Downloadable Document")]
                  ),
                  _vm._v(" "),
                  _c(
                    "button",
                    {
                      staticClass: "btn btn-default btn-primary",
                      attrs: { type: "button" },
                      on: { click: _vm.handleAddAttribute }
                    },
                    [_vm._v("Add New Attribute")]
                  )
                ])
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "flex pb-3 border-b border-40" }, [
                _vm._m(2),
                _vm._v(" "),
                _c("div", { staticClass: "flex w-3/4" }, [
                  _c("div", { staticClass: "w-2/3" }, [
                    _c("strong", { staticClass: "text-xs text-80 uppercase" }, [
                      _vm._v(_vm._s(_vm.companyName) + " VALUE")
                    ])
                  ]),
                  _vm._v(" "),
                  _c("div", { staticClass: "w-1/6" }, [
                    !_vm.isDefaultCompany
                      ? _c("strong", { staticClass: "text-xs text-80" }, [
                          _vm._v("HIDDEN")
                        ])
                      : _vm._e()
                  ]),
                  _vm._v(" "),
                  _vm._m(3)
                ])
              ]),
              _vm._v(" "),
              _vm._l(_vm.attributes, function(attribute) {
                return _c("attribute", {
                  key: attribute.id,
                  attrs: {
                    attribute: attribute,
                    attributeValues: _vm.attributeValues,
                    selectedCompanyId: _vm.selectedCompanyId,
                    isDefaultCompany: _vm.isDefaultCompany
                  },
                  on: {
                    "attribute-update": _vm.updateAttribute,
                    "attribute-delete": _vm.handleDeleteAttributeValue
                  }
                })
              })
            ],
            2
          ),
      _vm._v(" "),
      _vm.isModalOpen
        ? _c(
            "delete-resource-modal",
            {
              on: {
                close: _vm.handleCloseModal,
                confirm: _vm.handleConfirmDeleteAttributeValue
              }
            },
            [
              _c(
                "div",
                { staticClass: "p-8" },
                [
                  _c("heading", { staticClass: "mb-6", attrs: { level: 2 } }, [
                    _vm._v("Delete Attribute")
                  ]),
                  _vm._v(" "),
                  _c("p", { staticClass: "text-80 leading-normal" }, [
                    _vm._v(
                      "\n        Are you sure you want to delete this attribute?\n        "
                    ),
                    _vm.isDefaultCompany ? _c("span") : _vm._e()
                  ]),
                  _vm._v(" "),
                  _c(
                    "p",
                    {
                      directives: [
                        {
                          name: "show",
                          rawName: "v-show",
                          value: _vm.isDefaultCompany,
                          expression: "isDefaultCompany"
                        }
                      ],
                      staticClass: "text-80 leading-normal text-xs mt-4"
                    },
                    [
                      _c("span", { staticClass: "font-bold" }, [
                        _vm._v("Note:")
                      ]),
                      _vm._v(
                        "\n        Removing a default attribute\n        "
                      ),
                      _c("strong", [_vm._v("will")]),
                      _vm._v(
                        " remove it from all companies that do not have a customized value\n      "
                      )
                    ]
                  ),
                  _vm._v(" "),
                  _c(
                    "p",
                    {
                      directives: [
                        {
                          name: "show",
                          rawName: "v-show",
                          value: !_vm.isDefaultCompany,
                          expression: "!isDefaultCompany"
                        }
                      ],
                      staticClass: "text-80 leading-normal text-xs mt-4"
                    },
                    [
                      _c("span", { staticClass: "font-bold" }, [
                        _vm._v("Note:")
                      ]),
                      _vm._v(
                        "\n        Removing an attribute that has been customized for a specific company will\n        "
                      ),
                      _c("strong", [_vm._v("not")]),
                      _vm._v(" remove it from any other company\n      ")
                    ]
                  )
                ],
                1
              )
            ]
          )
        : _vm._e()
    ],
    1
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "w-1/4 py-8 pr-3" }, [
      _c("span", { staticClass: "text-80" }, [_vm._v("Name")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "w-1/4 py-8 pr-3" }, [
      _c("span", { staticClass: "text-80" }, [_vm._v("Value")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "w-1/4" }, [
      _c("strong", { staticClass: "text-xs text-80" }, [_vm._v("NAME")])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "w-1/6 text-right" }, [
      _c("strong", { staticClass: "text-xs text-80" }, [_vm._v("ACTIONS")])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-68ff5483", module.exports)
  }
}

/***/ }),
/* 9 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);
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
var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

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
  props: ['resourceName', 'resourceId', 'field'],
  data: function data() {
    return {
      isModalOpen: false,
      attributeToBeDeletedId: null,
      isAddingNew: false,
      newName: '',
      newValue: '',
      selectedCompanyId: 'default',
      companies: [{ id: 1, name: 'Company 1' }, { id: 2, name: 'Company 2' }, { id: 3, name: 'Company 3' }],
      attributes: [{ id: 1, name: 'Default Name 1' }, { id: 2, name: 'Default Name 2' }, { id: 3, name: 'Default Name 3' }],
      attributeValues: [{ id: 1, attributeId: 1, companyId: null, value: 'Default', isHidden: false }, { id: 2, attributeId: 2, companyId: null, value: 'Default', isHidden: false }, { id: 3, attributeId: 3, companyId: null, value: 'Default', isHidden: false }, { id: 4, attributeId: 1, companyId: 1, value: 'Modified', isHidden: true }, { id: 5, attributeId: 2, companyId: 1, value: 'Modified', isHidden: false }, { id: 6, attributeId: 3, companyId: 1, value: 'Modified', isHidden: false }]
    };
  },
  mounted: function mounted() {
    Nova.$on('update:attribute', this.updateAttribute);
    Nova.$on('delete:attribute', this.handleDeleteAttribute);
  },


  computed: {
    isDefault: function isDefault() {
      return this.selectedCompanyId === 'default';
    }
  },

  methods: {
    getValuesForAttribute: function getValuesForAttribute(id) {
      return this.attributeValues.filter(function (element) {
        return id === element.attributeId;
      });
    },
    handleAddAttributeClick: function handleAddAttributeClick() {
      this.isAddingNew = true;
    },
    handleSaveAttributeClick: function handleSaveAttributeClick() {
      this.isAddingNew = false;
      this.addAttribute();
    },
    handleDeleteAttribute: function handleDeleteAttribute(id) {
      this.isModalOpen = true;
      this.attributeToBeDeletedId = id;
    },
    handleCloseModal: function handleCloseModal() {
      this.isModalOpen = false;
      this.attributeToBeDeletedId = null;
    },
    handleConfirmDelete: function handleConfirmDelete() {
      this.isModalOpen = false;
      this.deleteAttribute();
    },
    addAttribute: function addAttribute() {
      // Axios code goes here
      this.$toasted.show('Successfully added attribute.', { type: 'success' });
    },
    updateAttribute: function updateAttribute(attribute) {
      window.alert(JSON.stringify(attribute));

      this.attributes = this.attributes.map(function (item) {
        if (item.id === attribute.attributeId) {
          return _extends({}, item, { name: attribute.name });
        }
        return item;
      });

      this.attributeValues = this.attributeValues.map(function (item) {
        if (item.attributeId === attribute.attributeId && item.companyId === attribute.companyId) {
          return _extends({}, item, { value: attribute.value, isHidden: attribute.isHidden });
        }
        return item;
      });

      // Axios code goes here
      this.$toasted.show('Successfully updated attribute.', { type: 'success' });
    },
    deleteAttribute: function deleteAttribute() {
      window.alert(this.attributeToBeDeletedId);

      // Axios code goes here
      this.$toasted.show('Successfully deleted attribute.', { type: 'success' });
    }
  },

  components: {
    Attribute: __WEBPACK_IMPORTED_MODULE_0__Attribute___default.a
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

/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['attribute', 'attributeValues', 'selectedCompanyId', 'isDefault'],
  data: function data() {
    return {
      isEditing: false,
      localName: this.attribute.name,
      localValue: this.getCompanyValues().value,
      localIsHidden: this.getCompanyValues().isHidden
    };
  },


  watch: {
    // Change values when selected company changes
    selectedCompanyId: function selectedCompanyId() {
      this.resetAttribute();
    }
  },

  methods: {
    getCompanyValues: function getCompanyValues() {
      var _this = this;

      // Find attribute that matches currently selected company
      var found = this.attributeValues.find(function (element) {
        return _this.selectedCompanyId === element.companyId;
      });

      // If not found, use default value
      if (!found) {
        found = this.attributeValues.find(function (element) {
          return !element.companyId;
        });
      }

      return found;
    },
    resetAttribute: function resetAttribute() {
      this.isEditing = false;
      this.localName = this.attribute.name;
      this.localValue = this.getCompanyValues().value;
      this.localIsHidden = this.getCompanyValues().isHidden;
    },
    handleCheckbox: function handleCheckbox(checked) {
      this.localIsHidden = checked;
    },
    handleEditClick: function handleEditClick() {
      this.isEditing = true;
    },
    handleDeleteClick: function handleDeleteClick() {
      Nova.$emit('delete:attribute', this.attribute.id);
    },
    handleCancelClick: function handleCancelClick() {
      this.resetAttribute();
    },
    handleSaveClick: function handleSaveClick() {
      this.isEditing = false;
      Nova.$emit('update:attribute', {
        attributeId: this.attribute.id,
        companyId: this.isDefault ? null : this.selectedCompanyId,
        name: this.localName,
        value: this.localValue,
        isHidden: this.localIsHidden
      });
    }
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
      _vm.isEditing && _vm.isDefault
        ? _c("input", {
            directives: [
              {
                name: "model",
                rawName: "v-model",
                value: _vm.localName,
                expression: "localName"
              }
            ],
            staticClass: "w-full form-control form-input form-input-bordered",
            attrs: { type: "text", placeholder: "Name" },
            domProps: { value: _vm.localName },
            on: {
              input: function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.localName = $event.target.value
              }
            }
          })
        : _c("strong", [_vm._v(_vm._s(_vm.localName))])
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
                  value: _vm.localValue,
                  expression: "localValue"
                }
              ],
              staticClass: "w-full form-control form-input form-input-bordered",
              attrs: { type: "text", placeholder: "Value" },
              domProps: { value: _vm.localValue },
              on: {
                input: function($event) {
                  if ($event.target.composing) {
                    return
                  }
                  _vm.localValue = $event.target.value
                }
              }
            })
          : _c("span", [_vm._v(_vm._s(_vm.localValue))])
      ]),
      _vm._v(" "),
      _c(
        "div",
        { staticClass: "w-1/6 pr-3" },
        [
          !_vm.isDefault && _vm.isEditing
            ? _c("checkbox", {
                attrs: { checked: _vm.localIsHidden },
                on: { input: _vm.handleCheckbox }
              })
            : _vm._e(),
          _vm._v(" "),
          !_vm.isDefault && !_vm.isEditing && _vm.localIsHidden
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
                on: { click: _vm.handleEditClick }
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
        !_vm.isEditing
          ? _c(
              "button",
              {
                staticClass: "btn",
                attrs: { type: "button", title: "Delete" },
                on: { click: _vm.handleDeleteClick }
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
                on: { click: _vm.handleCancelClick }
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
                on: { click: _vm.handleSaveClick }
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
                    staticClass: "btn btn-default btn-primary",
                    attrs: { type: "button" },
                    on: { click: _vm.handleSaveAttributeClick }
                  },
                  [_vm._v("\n        Save Attribute\n      ")]
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
                      _c("option", { attrs: { value: "default" } }, [
                        _vm._v("Default")
                      ]),
                      _vm._v(" "),
                      _vm._l(_vm.companies, function(company) {
                        return _c(
                          "option",
                          { key: company.id, domProps: { value: company.id } },
                          [
                            _vm._v(
                              "\n            " +
                                _vm._s(company.name) +
                                "\n          "
                            )
                          ]
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
                      staticClass: "btn btn-default btn-primary",
                      attrs: { type: "button" },
                      on: { click: _vm.handleAddAttributeClick }
                    },
                    [_vm._v("\n          Add New Attribute\n        ")]
                  )
                ])
              ]),
              _vm._v(" "),
              _c("div", { staticClass: "flex pb-3 border-b border-40" }, [
                _vm._m(2),
                _vm._v(" "),
                _c("div", { staticClass: "flex w-3/4" }, [
                  _vm._m(3),
                  _vm._v(" "),
                  _c("div", { staticClass: "w-1/6" }, [
                    !_vm.isDefault
                      ? _c("strong", { staticClass: "text-xs text-80" }, [
                          _vm._v("HIDDEN")
                        ])
                      : _vm._e()
                  ]),
                  _vm._v(" "),
                  _vm._m(4)
                ])
              ]),
              _vm._v(" "),
              _vm._l(_vm.attributes, function(attribute) {
                return _c("attribute", {
                  key: attribute.id,
                  attrs: {
                    attribute: attribute,
                    attributeValues: _vm.getValuesForAttribute(attribute.id),
                    selectedCompanyId: _vm.selectedCompanyId,
                    isDefault: _vm.isDefault
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
                confirm: _vm.handleConfirmDelete
              }
            },
            [
              _c(
                "div",
                { staticClass: "p-8" },
                [
                  _c("heading", { staticClass: "mb-6", attrs: { level: 2 } }, [
                    _vm._v(_vm._s(_vm.__("Delete Attribute")))
                  ]),
                  _vm._v(" "),
                  _c("p", { staticClass: "text-80 leading-normal" }, [
                    _vm._v(
                      "\n          " +
                        _vm._s(
                          _vm.__(
                            "Are you sure you want to delete this attribute? It will be deleted for all companies."
                          )
                        ) +
                        "\n      "
                    )
                  ])
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
    return _c("div", { staticClass: "w-2/3" }, [
      _c("strong", { staticClass: "text-xs text-80" }, [_vm._v("VALUE")])
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
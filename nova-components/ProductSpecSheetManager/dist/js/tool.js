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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(1);
module.exports = __webpack_require__(6);


/***/ }),
/* 1 */
/***/ (function(module, exports, __webpack_require__) {

Nova.booting(function (Vue, router, store) {
    Vue.component('product-spec-sheet-manager', __webpack_require__(2));
});

/***/ }),
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(3)
/* script */
var __vue_script__ = __webpack_require__(4)
/* template */
var __vue_template__ = __webpack_require__(5)
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
/* 3 */
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
/* 4 */
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

/* harmony default export */ __webpack_exports__["default"] = ({
  props: ["resourceName", "resourceId", "field"],
  data: function data() {
    return {
      hasSpecSheet: false,
      selectedCompanyId: null,
      companies: [],
      specSheets: [],
      activeSpecSheet: {
        resource: {},
        resourceName: 'spec-sheets',
        resourceId: null,
        field: {
          value: []
        }
      }
    };
  },


  methods: {
    setActiveSheet: function setActiveSheet(data) {
      if (data) {
        // If default company
        if (!this.selectedCompanyId) {
          this.hasSpecSheet = true;
        } else if (data.resource.id.value === this.defaultSheet.id.value) {
          // If not default company but using default value
          this.hasSpecSheet = false;
        } else {
          // Not default company
          this.hasSpecSheet = true;
        }

        // Set spec sheet data
        this.activeSpecSheet.resource = data.resource;
        this.activeSpecSheet.resourceId = data.resource.id.value;
        this.activeSpecSheet.field = _.find(data.resource.fields, function (field) {
          return field.component === "advanced-media-library-field";
        });
      } else {
        // Set spec sheet data to default
        this.hasSpecSheet = false;
        this.activeSpecSheet.resource = {};
        this.activeSpecSheet.resourceId = null;
        this.activeSpecSheet.field = {
          value: []
        };
      }
    },
    fetchCompanies: function fetchCompanies() {
      var _this = this;

      return Nova.request().get("/nova-vendor/product-spec-sheet-manager/spec-sheet-data").then(function (response) {
        _this.companies = response.data.companies;
      }).catch(function (error) {
        _this.$toasted.show("There was an error fetching the data", {
          type: "error"
        });
      });
    },
    fetchAllSpecSheets: function fetchAllSpecSheets() {
      var _this2 = this;

      // Fetch spec sheets and filter to only those that belong to this product
      return Nova.request().get("/nova-api/spec-sheets").then(function (response) {
        _this2.specSheets = response.data.resources.filter(function (item) {
          return Object.values(item.fields).some(function (field) {
            return field.resourceName === _this2.resourceName && field.belongsToId == _this2.resourceId;
          });
        });
      }).catch(function (error) {
        _this2.$toasted.show("There was an error fetching the data", {
          type: "error"
        });
      });
    },
    fetchSheetById: function fetchSheetById(id) {
      var _this3 = this;

      return Nova.request().get("/nova-api/spec-sheets/" + id).catch(function (error) {
        _this3.$toasted.show("There was an error fetching the data", {
          type: "error"
        });
      });
    },
    fetchSelectedSheet: function fetchSelectedSheet() {
      var _this4 = this;

      // Find spec sheet for selected company
      var sheet = this.specSheets.find(function (item) {
        return Object.values(item.fields).some(function (field) {
          return field.resourceName === "companies" && field.belongsToId === _this4.selectedCompanyId;
        });
      });

      // If spec sheet exists, fetch its details
      if (sheet) {
        this.fetchSheetById(sheet.id.value).then(function (response) {
          return _this4.setActiveSheet(response.data);
        });
      } else if (this.defaultSheet.id.value) {
        // If default exists instead, fetch its details
        this.fetchSheetById(this.defaultSheet.id.value).then(function (response) {
          return _this4.setActiveSheet(response.data);
        });
      } else {
        // No spec sheet is applicable so show no details
        this.setActiveSheet();
      }
    }
  },

  watch: {
    selectedCompanyId: function selectedCompanyId() {
      this.fetchSelectedSheet();
    }
  },

  computed: {
    defaultSheet: function defaultSheet() {
      var sheet = this.specSheets.find(function (item) {
        return Object.values(item.fields).some(function (field) {
          return field.resourceName === "companies" && field.belongsToId === null;
        });
      });

      // Default sheet does not exist, set null data
      if (!sheet) {
        sheet = {
          id: {
            value: null
          }
        };
      }

      return sheet;
    }
  },

  mounted: function mounted() {
    this.fetchCompanies();
    this.fetchAllSpecSheets().then(this.fetchSelectedSheet);
  }
});

/***/ }),
/* 5 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
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
            _c("option", { domProps: { value: null } }, [_vm._v("Default")]),
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
      _c(
        "div",
        { staticClass: "w-3/4 text-right" },
        [
          !_vm.hasSpecSheet
            ? _c("create-resource-button", {
                attrs: {
                  resourceName: "spec-sheets",
                  singularName: "Spec Sheet",
                  authorizedToCreate: "true",
                  authorizedToRelate: "true",
                  relationshipType: "",
                  viaRelationship: "",
                  viaResource: "",
                  viaResourceId: ""
                }
              })
            : _vm._e(),
          _vm._v(" "),
          _vm.hasSpecSheet
            ? _c(
                "button",
                {
                  staticClass: "btn btn-default btn-primary",
                  attrs: { type: "button" },
                  on: {
                    click: function($event) {
                      return _vm.$router.push({
                        name: "edit",
                        params: {
                          resourceName: "spec-sheets",
                          resourceId: _vm.activeSpecSheet.resourceId
                        }
                      })
                    }
                  }
                },
                [_vm._v("\n        Edit Spec Sheet\n      ")]
              )
            : _vm._e()
        ],
        1
      )
    ]),
    _vm._v(" "),
    _c(
      "div",
      { class: _vm.selectedCompanyId && !_vm.hasSpecSheet ? "opacity-75" : "" },
      [
        _c("detail-advanced-media-library-field", {
          attrs: {
            field: _vm.activeSpecSheet.field,
            resourceId: _vm.activeSpecSheet.resourceId,
            resourceName: _vm.activeSpecSheet.resourceName,
            resource: _vm.activeSpecSheet.resource
          }
        })
      ],
      1
    )
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-68ff5483", module.exports)
  }
}

/***/ }),
/* 6 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);
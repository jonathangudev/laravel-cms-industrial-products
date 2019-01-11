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
/******/ 	__webpack_require__.p = "/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 28);
/******/ })
/************************************************************************/
/******/ ({

/***/ 28:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(29);


/***/ }),

/***/ 29:
/***/ (function(module, exports) {

function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

// Attach event listeners to table headers
var headers = document.getElementsByClassName('js-product-table-sortable-column');
for (var i = 0; i < headers.length; i++) {
	headers[i].addEventListener('click', sortTable);
}

function sortTable(event) {
	var ASC = "asc";
	var DESC = "desc";

	var target = event.currentTarget;

	// Get column index from clicked cell
	var cellIndex = target.cellIndex;

	// Swap sort order
	var order = 1;
	if (target.dataset.sort == ASC) {
		order = -1;
		target.dataset.sort = DESC;
	} else {
		order = 1;
		target.dataset.sort = ASC;
	}

	// Convert HTMLCollection to array for sorting
	var table = target.parentElement.parentElement.parentElement;
	var rows = [].concat(_toConsumableArray(table.tBodies[0].children));

	// Sort rows
	rows.sort(function (rowA, rowB) {
		var dataA = rowA.children[cellIndex].innerText;
		var dataB = rowB.children[cellIndex].innerText;

		if (dataA < dataB) {
			return -1 * order;
		}

		if (dataA > dataB) {
			return 1 * order;
		}

		return 0;
	});

	// Add sorted nodes back to DOM
	var parent = rows[0].parentElement;
	for (var _i = 0; _i < rows.length; _i++) {
		var detachedRow = parent.removeChild(rows[_i]);
		parent.appendChild(detachedRow);
	}
}

/***/ })

/******/ });
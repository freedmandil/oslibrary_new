/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./node_modules/bootstrap/scss/bootstrap-grid.scss":
/*!*********************************************************!*\
  !*** ./node_modules/bootstrap/scss/bootstrap-grid.scss ***!
  \*********************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./node_modules/bootstrap/scss/bootstrap-utilities.scss":
/*!**************************************************************!*\
  !*** ./node_modules/bootstrap/scss/bootstrap-utilities.scss ***!
  \**************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./node_modules/bootstrap/scss/bootstrap.scss":
/*!****************************************************!*\
  !*** ./node_modules/bootstrap/scss/bootstrap.scss ***!
  \****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/app.css":
/*!*******************************!*\
  !*** ./resources/css/app.css ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/js/utils.js":
/*!*******************************!*\
  !*** ./resources/js/utils.js ***!
  \*******************************/
/***/ (() => {

Utils = {};
// Show spinner overlay
Utils.showSpinner = function (message) {
  message = message || 'Loading...';
  $('.spinner-overlay').removeClass('hide');
  if (message) {
    $('.spinner_msg').html(message);
  }
  $('.spinner-overlay').fadeIn();
};

// Hide spinner overlay
Utils.hideSpinner = function () {
  $('.spinner-overlay').fadeOut();
  $('.spinner-overlay').addClass('hide');
};
function renderMessage(options) {
  var bootstrapOptions = {
    bg: 'bg-primary',
    text: 'text-white',
    border: 'border-primary',
    title: 'Notice',
    alert: 'alert alert-primary'
  };

  // Determine bootstrap options based on message level
  switch (options.level) {
    case 'error':
    case 'danger':
      bootstrapOptions.name = 'danger';
      bootstrapOptions.text = "light";
      bootstrapOptions.title = "There was an Error";
      break;
    case 'warning':
      bootstrapOptions.name = 'warning';
      bootstrapOptions.text = "dark";
      bootstrapOptions.title = "Warning Notice";
      break;
    case 'success':
    case 'status':
      bootstrapOptions.name = 'success';
      bootstrapOptions.text = "light";
      bootstrapOptions.title = "Action was successful";
      break;
    case 'info':
      bootstrapOptions.name = 'info';
      bootstrapOptions.text = "dark";
      bootstrapOptions.title = "For Your Information";
      break;
    case 'primary':
    default:
      bootstrapOptions.name = 'primary';
      bootstrapOptions.text = "light";
      bootstrapOptions.title = "Notice";
      break;
  }

  // Construct the message element based on message type
  var message;
  switch (options.type) {
    case 'toast':
      message = renderToast(options.message, bootstrapOptions);
      break;
    case 'alert':
      message = renderAlert(options.message, bootstrapOptions);
      break;
    case 'modal':
      message = renderModal(options.message, bootstrapOptions);
      break;
    default:
      message = renderToast(options.message, bootstrapOptions);
      break;
  }

  // Append the message to the container element
  var containerElement = document.querySelector('#view_container');
  containerElement.innerHTML = message;
}
function renderToast(message, bootstrapOptions) {
  var toast = '<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 11">' + '<div id="liveToast" class="toast ' + bootstrapOptions.bg + ' ' + bootstrapOptions.border + ' border-2" role="alert" aria-live="assertive" aria-atomic="true">' + '<div class="toast-header ' + bootstrapOptions.border + '">' + '<span class="fw-bold">' + bootstrapOptions.title + '</span>' + '</div>' + '<div class="toast-body fw-bold ' + bootstrapOptions.text + '">' + message + '</div>' + '</div>' + '</div>';
  return toast;
}
function renderAlert(message, bootstrapOptions) {
  var alert = '<div id="alertMessage">' + '<div class="alert alert-' + bootstrapOptions.name + ' alert-dismissible fade show ' + bootstrapOptions.border + '" role="alert">' + '<span class="fw-bold">' + bootstrapOptions.title + '</span>&nbsp;&nbsp;' + '<span>' + message + '</span>' + '</div>' + '</div>';
  return alert;
}
function renderModal(message, bootstrapOptions) {
  var modal = '<div class="modal fade" id="viewMessage" tabindex="-1" aria-labelledby="viewMessage" aria-hidden="true">' + '<div class="modal-dialog ' + bootstrapOptions.border + ' ' + bootstrapOptions.bg + '">' + '<div class="modal-content border-0 bg-' + bootstrapOptions.bg + '">' + '<div class="modal-header border-0 ' + bootstrapOptions.alert + '">' + '<h1 class="modal-title fs-5">' + bootstrapOptions.title + '</h1>' + '</div>' + '<div class="modal-body border-0 ' + bootstrapOptions.bg + '">' + message + '</div>' + '<div class="modal-footer border-0">' + '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>' + '</div>' + '</div>' + '</div>' + '</div>';
  return modal;
}
Utils.sendMessage = function (type, level, message) {
  if (type && level && message) {
    var messageOptions = {
      type: type,
      // Specify the type of message (toast, alert, modal)
      level: level,
      // Specify the level of the message (error, warning, success, info, primary)
      message: message // The actual message content
    };

    // Call the renderMessage function with the message options
    renderMessage(messageOptions);
  } else {
    var messageOptions = {
      type: 'toast',
      // Specify the type of message (toast, alert, modal)
      level: 'error',
      // Specify the level of the message (error, warning, success, info, primary)
      message: 'There was an error with this request. Please try again later or contact the Administrator.'
    };

    // Call the renderMessage function with the message options
    renderMessage(messageOptions);
  }
  Utils.sendSysMessage = function (type, level, message) {
    if (type && level && message) {
      var MessageView = new Library.MessagesView({
        type: type,
        level: level,
        message: message
      });
    } else {
      var SessionMessage = new Library.Models.Messages();
      SessionMessage.getMessage().done(function (response) {
        var MessageView = new Library.MessagesView({
          options: {
            type: response.type,
            level: response.level,
            message: response.message
          }
        });
      }).fail(function (error) {
        console.error('Error fetching message:', error);
      });
    }
  };
};
Utils.formatValue = function (value) {
  return value ? value : '';
};

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/utils": 0,
/******/ 			"css/app": 0,
/******/ 			"css/bootstrap": 0,
/******/ 			"css/bootstrap-utilities": 0,
/******/ 			"css/bootstrap-grid": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunkoslibrary"] = self["webpackChunkoslibrary"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/app","css/bootstrap","css/bootstrap-utilities","css/bootstrap-grid"], () => (__webpack_require__("./resources/js/utils.js")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/bootstrap","css/bootstrap-utilities","css/bootstrap-grid"], () => (__webpack_require__("./resources/sass/app.scss")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/bootstrap","css/bootstrap-utilities","css/bootstrap-grid"], () => (__webpack_require__("./node_modules/bootstrap/scss/bootstrap-grid.scss")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/bootstrap","css/bootstrap-utilities","css/bootstrap-grid"], () => (__webpack_require__("./node_modules/bootstrap/scss/bootstrap-utilities.scss")))
/******/ 	__webpack_require__.O(undefined, ["css/app","css/bootstrap","css/bootstrap-utilities","css/bootstrap-grid"], () => (__webpack_require__("./node_modules/bootstrap/scss/bootstrap.scss")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/app","css/bootstrap","css/bootstrap-utilities","css/bootstrap-grid"], () => (__webpack_require__("./resources/css/app.css")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;
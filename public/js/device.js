/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/module/component/modalOperation.js":
/*!*********************************************************!*\
  !*** ./resources/js/module/component/modalOperation.js ***!
  \*********************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   close_modal: () => (/* binding */ close_modal),
/* harmony export */   open_modal: () => (/* binding */ open_modal)
/* harmony export */ });
var open_modal = function open_modal(modal) {
  document.querySelector(".bg").classList.remove("hidden");
  modal.classList.remove("hidden");
};
var close_modal = function close_modal() {
  var bg = document.querySelector(".bg");
  var modals = document.querySelectorAll(".js_modal");
  var alerts = document.querySelectorAll(".js_alert_danger");
  bg.addEventListener("click", function () {
    bg.classList.add("hidden");
    modals.forEach(function (modal) {
      modal.classList.add("hidden");
    });
    if (alerts) {
      alerts.forEach(function (alert) {
        alert.style.display = "none";
      });
    }
  });
};

/***/ }),

/***/ "./resources/js/module/util/fetch.js":
/*!*******************************************!*\
  !*** ./resources/js/module/util/fetch.js ***!
  \*******************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   fetchGetOperation: () => (/* binding */ fetchGetOperation),
/* harmony export */   fetchPostOperation: () => (/* binding */ fetchPostOperation)
/* harmony export */ });
var fetchPostOperation = function fetchPostOperation(data, url) {
  return fetch("".concat("/LP_system/app/Fetch", "/").concat(url), {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify(data)
  }).then(function (response) {
    if (!response.ok) {
      throw new Error("サーバーエラーが発生しました。");
    }
    return response.json();
  })["catch"](function (error) {
    // エラーが発生した場合の処理
    sendErrorLog(error); // エラーログを送信
    redirectToErrorPage(); // エラーページにリダイレクト
  });
};
var fetchGetOperation = function fetchGetOperation(url) {
  return fetch("".concat(url), {
    method: "GET",
    headers: {
      "Content-Type": "application/json"
    }
  }).then(function (response) {
    if (!response.ok) {
      throw new Error("サーバーエラーが発生しました。");
    }
    return response.json();
  })["catch"](function (error) {
    console.log(error);
  });
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
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
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
/************************************************************************/
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/device.js ***!
  \********************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _module_component_modalOperation_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./module/component/modalOperation.js */ "./resources/js/module/component/modalOperation.js");
/* harmony import */ var _module_util_fetch_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./module/util/fetch.js */ "./resources/js/module/util/fetch.js");


var edit_btns = document.querySelectorAll(".js_device_edit_btn");
var edit_modal = document.querySelector(".js_edit_modal");
edit_btns.forEach(function (edit_btn) {
  edit_btn.addEventListener("click", function (e) {
    var target_btn = e.currentTarget;
    var device_id = target_btn.getAttribute("data-id");
    var form = document.getElementById('js_edit_device_form');
    var action = form.getAttribute('action');
    action = action.replace(':id', device_id);
    form.setAttribute('action', action);
    (0,_module_util_fetch_js__WEBPACK_IMPORTED_MODULE_1__.fetchGetOperation)("/device/".concat(device_id, "/edit")).then(function (res) {
      setDeviceDataForEditing(res).then(function () {
        (0,_module_component_modalOperation_js__WEBPACK_IMPORTED_MODULE_0__.open_modal)(edit_modal);
      });
    });
  });
});
var create_btn = document.getElementById("js_create_device_btn");
var create_modal = document.querySelector(".js_create_modal");
create_btn.addEventListener("click", function () {
  (0,_module_component_modalOperation_js__WEBPACK_IMPORTED_MODULE_0__.open_modal)(create_modal);
});

// ページがロードされた後に5秒待ってメッセージを非表示にする
document.addEventListener('DOMContentLoaded', function () {
  var alert = document.getElementById('js_alert_success');
  if (alert) {
    setTimeout(function () {
      alert.style.display = "none";
    }, 4000); // フェードアウトの完了を待って非表示にする
  }
});
(0,_module_component_modalOperation_js__WEBPACK_IMPORTED_MODULE_0__.close_modal)();

// 関数

var setDeviceDataForEditing = function setDeviceDataForEditing(res) {
  return new Promise(function (resolve) {
    var account_input = document.querySelector(".js_device_account_input");
    var name_input = document.querySelector(".js_device_name_input");
    var uid_input = document.querySelector(".js_device_uid_input");
    var file_input = document.querySelector(".js_device_file_input");
    var id_input = document.querySelector(".js_device_id_input");
    account_input.value = res["account_name"];
    name_input.value = res["device_name"];
    uid_input.value = res["uid"];
    file_input.value = res["file_name"];
    id_input.value = res["id"];
    resolve();
  });
};
/******/ })()
;
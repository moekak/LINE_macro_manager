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
/*!*************************************!*\
  !*** ./resources/js/device_show.js ***!
  \*************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _module_component_modalOperation_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./module/component/modalOperation.js */ "./resources/js/module/component/modalOperation.js");
/* harmony import */ var _module_util_fetch_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./module/util/fetch.js */ "./resources/js/module/util/fetch.js");



// URL編集
var edit_btn = document.querySelector(".js_url_edit_btn");
var edit_modal = document.querySelector(".js_url_edit_modal");
if (edit_btn) {
  edit_btn.addEventListener("click", function (e) {
    var target_btn = e.currentTarget;
    console.log(target_btn);
    var url_id = target_btn.getAttribute("data-id");
    var form = document.getElementById("js_edit_url_form");
    var action = form.getAttribute("action");
    action = action.replace(":id", url_id);
    form.setAttribute("action", action);
    (0,_module_util_fetch_js__WEBPACK_IMPORTED_MODULE_1__.fetchGetOperation)("/url/edit/".concat(url_id)).then(function (res) {
      console.log(res);
      setUrlDataForEditing(res).then(function () {
        (0,_module_component_modalOperation_js__WEBPACK_IMPORTED_MODULE_0__.open_modal)(edit_modal);
      });
    });
  });
}

// 自動返信メッセージの処理
var message_btn = document.querySelector(".js_message_edit_btn");
var message_modal = document.querySelector(".js_message_edit_modal");
if (message_btn) {
  message_btn.addEventListener("click", function (e) {
    var target_btn = e.currentTarget;
    var message_id = target_btn.getAttribute("data-id");
    var form = document.getElementById("js_edit_message_form");
    var action = form.getAttribute("action");
    action = action.replace(":id", message_id);
    form.setAttribute("action", action);
    (0,_module_util_fetch_js__WEBPACK_IMPORTED_MODULE_1__.fetchGetOperation)("/message/edit/".concat(message_id)).then(function (res) {
      console.log(res);
      setMessageDataForEditing(res).then(function () {
        (0,_module_component_modalOperation_js__WEBPACK_IMPORTED_MODULE_0__.open_modal)(message_modal);
      });
    });
  });
}

// 一斉送信メッセージの処理
var group_message_btns = document.querySelectorAll(".js_group_message_edit_btn");
var group_message_modal = document.querySelector(".js_group_message_edit_modal");
if (group_message_btns) {
  group_message_btns.forEach(function (btn) {
    btn.addEventListener("click", function (e) {
      var target_btn = e.currentTarget;
      var group_message_id = target_btn.getAttribute("data-id");
      var form = document.getElementById("js_edit_group_message_form");
      var action = form.getAttribute("action");
      action = action.replace(":id", group_message_id);
      form.setAttribute("action", action);
      (0,_module_util_fetch_js__WEBPACK_IMPORTED_MODULE_1__.fetchGetOperation)("/group_message/edit/".concat(group_message_id)).then(function (res) {
        console.log(res);
        setGroupMessageDataForEditing(res).then(function () {
          (0,_module_component_modalOperation_js__WEBPACK_IMPORTED_MODULE_0__.open_modal)(group_message_modal);
        });
      });
    });
  });
}

// 自動返信メッセージ編集
var setMessageDataForEditing = function setMessageDataForEditing(res) {
  return new Promise(function (resolve) {
    var message_input = document.querySelector(".js_message_input");
    var id_input = document.querySelector(".js_message_id_input");
    message_input.value = res["message"];
    id_input.value = res["id"];
    resolve();
  });
};
// url編集
var setUrlDataForEditing = function setUrlDataForEditing(res) {
  return new Promise(function (resolve) {
    var url_input = document.querySelector(".js_url_account_input");
    var id_input = document.querySelector(".js_url_id_input");
    url_input.value = res["url"];
    id_input.value = res["id"];
    resolve();
  });
};

// 一斉送信メッセージ編集
var setGroupMessageDataForEditing = function setGroupMessageDataForEditing(res) {
  return new Promise(function (resolve) {
    var group_message_input = document.querySelector(".js_group_message_input");
    var id_input = document.querySelector(".js_group_message_id_input");
    group_message_input.value = res["message"];
    id_input.value = res["id"];
    resolve();
  });
};

// ページがロードされた後に5秒待ってメッセージを非表示にする
document.addEventListener("DOMContentLoaded", function () {
  var alert = document.getElementById("js_alert_success");
  if (alert) {
    setTimeout(function () {
      alert.style.display = "none";
    }, 4000); // フェードアウトの完了を待って非表示にする
  }
});
(0,_module_component_modalOperation_js__WEBPACK_IMPORTED_MODULE_0__.close_modal)();
var message_create_btn = document.getElementById("js_create_group_message_btn");
var message_create_modal = document.querySelector(".js_group_message_create_modal");
message_create_btn.addEventListener("click", function () {
  (0,_module_component_modalOperation_js__WEBPACK_IMPORTED_MODULE_0__.open_modal)(message_create_modal);
});
var select = document.querySelector(".js_select_element");
var btn = document.querySelector(".js_select_btn");
select.addEventListener("change", function (e) {
  console.log(e.target.value); // 選択された値をコンソールに表示
  var value = e.target.value;
  if (value && value !== "日付を選択してください") {
    btn.classList.remove("disable-btn");
  } else {
    btn.classList.add("disable-btn");
  }
});
var form = document.getElementById("js_date_form");
form.addEventListener("keydown", function (e) {
  if (event.key === 'Enter') {
    event.preventDefault(); // Enterキーによるデフォルトの動作（送信）を無効化
  }
});
var message_containers = document.querySelectorAll(".js_message_container");
console.log(message_containers.length);
if (message_containers.length == 1) {
  message_containers[0].querySelector(".operation2").querySelector(".js_delete_form").classList.add("hidden");
} else {
  message_containers[0].querySelector(".operation2").querySelector(".js_delete_form").classList.remove("hidden");
}
/******/ })()
;
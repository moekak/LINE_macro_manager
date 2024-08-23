import { open_modal, close_modal } from "./module/component/modalOperation.js";
import { fetchGetOperation } from "./module/util/fetch.js";

// URL編集
const edit_btn = document.querySelector(".js_url_edit_btn");
const edit_modal = document.querySelector(".js_url_edit_modal");

if(edit_btn){
    edit_btn.addEventListener("click", (e) => {
    let target_btn = e.currentTarget;

    console.log(target_btn);
    let url_id = target_btn.getAttribute("data-id");
    let form = document.getElementById("js_edit_url_form");
    let action = form.getAttribute("action");
    action = action.replace(":id", url_id);
    form.setAttribute("action", action);

    fetchGetOperation(`/url/edit/${url_id}`).then((res) => {
        console.log(res);
        setUrlDataForEditing(res).then(() => {
            open_modal(edit_modal);
        });
    });
});
}


// 自動返信メッセージの処理
const message_btn = document.querySelector(".js_message_edit_btn");
const message_modal = document.querySelector(".js_message_edit_modal");

if(message_btn){
    message_btn.addEventListener("click", (e) => {
        let target_btn = e.currentTarget;
        let message_id = target_btn.getAttribute("data-id");
        let form = document.getElementById("js_edit_message_form");
        let action = form.getAttribute("action");
        action = action.replace(":id", message_id);
        form.setAttribute("action", action);

        fetchGetOperation(`/message/edit/${message_id}`).then((res) => {
            console.log(res);
            setMessageDataForEditing(res).then(() => {
                open_modal(message_modal);
            });
        });
    });
}

// 一斉送信メッセージの処理
const group_message_btns = document.querySelectorAll(".js_group_message_edit_btn");
const group_message_modal = document.querySelector(".js_group_message_edit_modal");
if(group_message_btns){
    group_message_btns.forEach((btn) => {
    btn.addEventListener("click", (e) => {
        let target_btn = e.currentTarget;
        let group_message_id = target_btn.getAttribute("data-id");
        let form = document.getElementById("js_edit_group_message_form");
        let action = form.getAttribute("action");
        action = action.replace(":id", group_message_id);
        form.setAttribute("action", action);

        fetchGetOperation(`/group_message/edit/${group_message_id}`).then((res) => {
            console.log(res);
            setGroupMessageDataForEditing(res).then(() => {
                open_modal(group_message_modal);
            });
        });
    });
});

}

// 自動返信メッセージ編集
const setMessageDataForEditing = (res) => {
    return new Promise((resolve) => {
        const message_input = document.querySelector(".js_message_input");
        const id_input = document.querySelector(".js_message_id_input");

        message_input.value = res["message"];
        id_input.value = res["id"];

        resolve();
    });
};
// url編集
const setUrlDataForEditing = (res) => {
    return new Promise((resolve) => {
        const url_input = document.querySelector(".js_url_account_input");
        const id_input = document.querySelector(".js_url_id_input");

        url_input.value = res["url"];
        id_input.value = res["id"];

        resolve();
    });
};

// 一斉送信メッセージ編集
const setGroupMessageDataForEditing = (res) => {
      return new Promise((resolve) => {
          const group_message_input = document.querySelector(".js_group_message_input");
          const id_input = document.querySelector(".js_group_message_id_input");
  
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

close_modal();



const message_create_btn = document.getElementById("js_create_group_message_btn")
const message_create_modal = document.querySelector(".js_group_message_create_modal")
message_create_btn.addEventListener("click", ()=>{
    open_modal(message_create_modal)
})


const select = document.querySelector(".js_select_element");
const btn = document.querySelector(".js_select_btn")

select.addEventListener("change", (e) => {
    console.log(e.target.value);  // 選択された値をコンソールに表示
    let value = e.target.value

    if(value && value !== "日付を選択してください"){
        btn.classList.remove("disable-btn")
    }else{
        btn.classList.add("disable-btn")
    }
});


const form = document.getElementById("js_date_form");
form.addEventListener("keydown", (e)=>{
    if (event.key === 'Enter') {
        event.preventDefault();  // Enterキーによるデフォルトの動作（送信）を無効化
    }
})


const message_containers =document.querySelectorAll(".js_message_container")
console.log(message_containers.length);

if(message_containers.length == 1){
    message_containers[0].querySelector(".operation2").querySelector(".js_delete_form").classList.add("hidden")
}else{
    message_containers[0].querySelector(".operation2").querySelector(".js_delete_form").classList.remove("hidden")
}
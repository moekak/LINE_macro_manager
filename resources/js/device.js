import { open_modal, close_modal } from "./module/component/modalOperation.js"
import { fetchGetOperation } from "./module/util/fetch.js"

const edit_btns = document.querySelectorAll(".js_device_edit_btn")
const edit_modal = document.querySelector(".js_edit_modal")


edit_btns.forEach((edit_btn)=>{
      edit_btn.addEventListener("click", (e)=>{

            let target_btn =e.currentTarget;
            let device_id = target_btn.getAttribute("data-id")
            let form = document.getElementById('js_edit_device_form');
            let action = form.getAttribute('action');
            action = action.replace(':id', device_id);
            form.setAttribute('action', action);
                        
            fetchGetOperation(`/device/${device_id}/edit`)
            .then((res)=>{
                  setDeviceDataForEditing(res)
                  .then(()=>{
                        open_modal(edit_modal)
                  })

            })
      })

})

const create_btn = document.getElementById("js_create_device_btn")
const create_modal = document.querySelector(".js_create_modal")

create_btn.addEventListener("click", ()=>{
      open_modal(create_modal)
})

// ページがロードされた後に5秒待ってメッセージを非表示にする
document.addEventListener('DOMContentLoaded', function() {

      var alert = document.getElementById('js_alert_success');
      if (alert) {
            setTimeout(function() {
            alert.style.display = "none";
            }, 4000); // フェードアウトの完了を待って非表示にする
      }

});

close_modal()

// 関数

const setDeviceDataForEditing = (res) =>{
      return new Promise((resolve)=>{
            const account_input     = document.querySelector(".js_device_account_input")
            const name_input        = document.querySelector(".js_device_name_input")
            const uid_input         = document.querySelector(".js_device_uid_input")
            const file_input        = document.querySelector(".js_device_file_input")
            const id_input          = document.querySelector(".js_device_id_input")

            account_input.value     = res["account_name"]
            name_input.value        = res["device_name"]
            uid_input.value         = res["uid"]
            file_input.value        = res["file_name"] 
            id_input.value          = res["id"]

            resolve()
      })
}


// デバイス削除確認モーダル

const delete_btns = document.querySelectorAll(".js_delete_btn")
const delete_confirm_modal = document.querySelector(".js_delete_modal")

delete_btns.forEach((btn)=>{
      btn.addEventListener("click", (e)=>{
            let device_id = e.currentTarget.getAttribute("data-id")
            // formにパラメータを設置
            let form = document.getElementById('js_delete_form');
            let action = form.getAttribute('action');
            action = action.replace(':id', device_id);
            form.setAttribute('action', action);
            open_modal(delete_confirm_modal)
            console.log(device_id);
            
      })
})

const cancel_btn = document.querySelector(".js_cancel_btn")
cancel_btn.addEventListener("click", ()=>{
      const bg          =  document.querySelector(".bg")
      delete_confirm_modal.classList.add("hidden")
      bg.classList.add("hidden")
})

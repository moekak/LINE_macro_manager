import { open_modal, close_modal } from "./module/component/modalOperation.js";
import { fetchGetOperation } from "./module/util/fetch.js"

const edit_btn = document.querySelector(".js_url_edit_btn")
const edit_modal = document.querySelector(".js_url_edit_modal")

console.log(edit_btn);

edit_btn.addEventListener("click", (e)=>{

      let target_btn =e.currentTarget;

      console.log(target_btn);
      let url_id = target_btn.getAttribute("data-id")
      let form = document.getElementById('js_edit_url_form');
      let action = form.getAttribute('action');
      action = action.replace(':id', url_id);
      form.setAttribute('action', action);
                  
      fetchGetOperation(`/url/edit/${url_id}`)
      .then((res)=>{
            console.log(res);
            setUrlDataForEditing(res)
            .then(()=>{
                  open_modal(edit_modal)
            })

      })
})



const setUrlDataForEditing = (res) =>{
      return new Promise((resolve)=>{
            const url_input     = document.querySelector(".js_url_account_input")
            const id_input          = document.querySelector(".js_url_id_input")

            url_input.value     = res["url"]
            id_input.value          = res["id"]

            resolve()
      })
}



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
export const open_modal = (modal)=>{
      document.querySelector(".bg").classList.remove("hidden")
      modal.classList.remove("hidden")
}


export const close_modal = () =>{
      const bg          =  document.querySelector(".bg")
      const modals      = document.querySelectorAll(".js_modal")
      const alerts = document.querySelectorAll(".js_alert_danger")

      bg.addEventListener("click", ()=>{
            bg.classList.add("hidden")
            modals.forEach((modal)=>{
                  modal.classList.add("hidden")
            })

            if(alerts){
                  alerts.forEach((alert)=>{
                        alert.style.display = "none"
                  })
            }
      })
}
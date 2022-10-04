function productCard() {

  //Global variable
  var promotionData = { promotion: {id:"", title:"", item:"", pricereg:"", pricesale:""}, duedate: "", name: "", phone: "" };
  var countdown = {days: "00",hours: "00",minutes: "00",seconds: "00"}

  const card1 = document.querySelector('.product-card');
  const buttons = document.querySelectorAll(".product-button");
  const fieldGroup = document.querySelector(".elementor-field-group-field_1");
  const promotionFields = document.querySelectorAll(".promotion-field"); // Promotion Field Widget support

  const promotionDataSet = (parent) => {
    promotionData.promotion.id = parent.getAttribute("product-id");
    promotionData.promotion.title = parent.getElementsByTagName("h3")[0]? parent.getElementsByTagName("h3")[0].innerHTML : "";
    promotionData.promotion.item = parent.querySelector(".product-items")? parent.querySelector(".product-items").innerHTML : "";
    promotionData.promotion.pricereg = parent.querySelector(".regular-price")? parent.querySelector(".regular-price").innerHTML : "";
    promotionData.promotion.pricesale = parent.querySelector(".sale-price")? parent.querySelector(".sale-price").innerHTML : "";
  }

  const localStorageInitialize = (receiver, key) => {
    if (localStorage.getItem(key)){
      receiver = JSON.parse(localStorage[key])
    }
  }

  const localStorageUpdate = (source, key) => {
    localStorage.setItem(key, JSON.stringify(source));
  }

  const checkTypeOfFiled = (field) => {
    if (field){
      if (field.classList.contains("elementor-field-type-textarea")) {
        return "textarea";
      } else if (field.classList.contains("elementor-field-type-radio")) {
        return "radio";
      } else if (field.classList.contains("elementor-field-type-checkbox")) {
        return "checkbox";
      } else if (field.classList.contains("elementor-field-type-select")) {
        return "dropdown";
      } else {
        return null;
      }
    }
    
  }

  /*
  *
  * Init function
  *
  */

  const init = () => {
      
    // Get data from "formPass" then put it into ${promotionData}
    localStorageInitialize(promotionData, "formPass")

    promotionDataSet(card1)

    // Update field_1
    if (checkTypeOfFiled(fieldGroup) == "textarea") {
      fieldGroup.getElementsByTagName("textarea")[0].value = promotionData.promotion.title
    }

    localStorageUpdate(promotionData, "formPass")

  }

  /*
  *
  * Countdown
  * 
  */
  
  const countdowmController = () => {
    // Update the count down every 1 second
    const x = setInterval(function(){

      const ElementorCountdownWrapper = document.querySelector(".elementor-countdown-wrapper");
      const AutoCountdownWrapper = document.querySelector(".countdown-wrapper");
      
      // Elementor Pro Countdown widget
      if (ElementorCountdownWrapper !== null){
        countdown.days = ElementorCountdownWrapper.querySelector(".elementor-countdown-days").innerHTML;
        countdown.hours = ElementorCountdownWrapper.querySelector(".elementor-countdown-hours").innerHTML;
        countdown.minutes= ElementorCountdownWrapper.querySelector(".elementor-countdown-minutes").innerHTML;
        countdown.seconds= ElementorCountdownWrapper.querySelector(".elementor-countdown-seconds").innerHTML;
      } // Countdown Auto widget
        else if (AutoCountdownWrapper !== null){
        countdown.days = "00";
        countdown.hours = AutoCountdownWrapper.querySelector(".countdown-hours").innerHTML;
        countdown.minutes= AutoCountdownWrapper.querySelector(".countdown-minutes").innerHTML;
        countdown.seconds= AutoCountdownWrapper.querySelector(".countdown-seconds").innerHTML;
      }
      
      let productCountdown = {
        days: document.querySelectorAll(".product-countdown-days"),
        hours: document.querySelectorAll(".product-countdown-hours"),
        minutes: document.querySelectorAll(".product-countdown-minutes"),
        seconds: document.querySelectorAll(".product-countdown-seconds")
      }
      
      productCountdown.days.forEach(element => {
        element.innerHTML = countdown.days;
      });
      productCountdown.hours.forEach(element => {
        element.innerHTML = countdown.hours;
      });
      productCountdown.minutes.forEach(element => {
        element.innerHTML = countdown.minutes;
      });
      productCountdown.seconds.forEach(element => {
        element.innerHTML = countdown.seconds;
      });
  
      return countdown;

    }, 1000);
    
  }

  /*
  *
  * Progress bar
  * 
  */

  const progressBarController = () => {

    const progressBar = document.querySelectorAll('.progress');
    const timeout = setTimeout(()=>{
  
      progressBar.forEach(element => {
  
        if (countdown.days == "03"){
          element.style.width = "42%";
          element.setAttribute("value", 42); 
        }
        if (countdown.days == "02"){
          element.style.width = "46%";
          element.setAttribute("value", 46); 
        }
        else if (countdown.days == "01"){
          element.style.width = "54%";
          element.setAttribute("value", 54); 
        }
        else if (countdown.days == "00"){
          let getHours = countdown.hours;
      
          parseInt(getHours);
          let stock = 50;
          let lastHour = 20; // 20 = 20.00, 4 = 4.00
          let sold = stock/lastHour * (24 - parseInt(getHours));
          let totalSale = (stock + sold <= 100)? stock + sold : 100 ;
          element.style.width = totalSale + "%";
          element.setAttribute("value", totalSale); 
          
        } else {
          element.style.width = "16%";
          element.setAttribute("value", 16); 
        }
    
        let progressValue = element.getAttribute("value"); 
        let progressText = element.querySelector(".progress-text");
        if(progressValue > 99){
          progressText.innerHTML = "เหลือ 1 เซตสุดท้าย";
        } else if (progressValue > 90){
          progressText.innerHTML = "เหลือน้อยกว่า 3 เซต";
        } else if (progressValue > 50){
          progressText.innerHTML = "ใกล้จะหมด";
        } else if (progressValue > 40){
          progressText.innerHTML = "ขายดี";
        }
      });
      
    }, 1000);

  }
  


  /*
  *
  * Items Toggle
  * 
  */

  const productToggleController = () => {

    const productToggle = document.querySelectorAll(".product-toggle");
    const productItems = document.querySelector(".product-items");



    if (productToggle){
      productToggle.forEach(element => {

        if (productItems.classList.contains("visible")){
          element.classList.add("rotate");
        }

        element.addEventListener("click", (event)=>{
          let target = event.target.parentElement.parentElement;
    
          try {
            event.target.classList.toggle("rotate");
            target.querySelector(".product-items").classList.toggle("visible");
          } catch (error) {
            
          }
          
        })
      })
    }

  }
  
  


  /*
  *
  * Button Click Listening
  *
  */


  const setLocalProductDetail = () => {

    buttons.forEach(item => {
    
      item.addEventListener("click", (button)=>{

        let card = button.path[3]; // button's parent
        let productId = card.getAttribute("product-id"); // this card's product-id
        
        /*
        *
        * LocalStorage
        *
        */

        // Get data from "formPass" then put it into ${promotionData}
        localStorageInitialize(promotionData, "formPass")
        
        // Set ${promotionData} value from this card's data
        promotionDataSet(card)
        
        // Update localStorage
        localStorageUpdate(promotionData, "formPass")
      

        /*
        *
        * Form field_1 support
        *
        */

        switch (checkTypeOfFiled(fieldGroup)) {

          case "textarea":

            fieldGroup.getElementsByTagName("textarea")[0].value = promotionData.promotion.title

            // Update field_1 selected item
            if (promotionFields) {
                
              promotionFields.forEach(element => {
                element.classList.remove("selected")
                
                let fieldPromotionId = element.getAttribute("promotion-id")
                if (productId == fieldPromotionId){
                  element.classList.add("selected")
                }

              })
              
            }

            break;

          case "radio":

              document.getElementById("form-field-field_1-" + (productId - 1)).checked = true;

            break;

          case "checkbox":
            console.log("checkbox - currently not support.");
            break;

          case "dropdown":
              document.getElementById("form-field-field_1").selectedIndex = productId - 1;
            break;

          default: {
            break;
          }
        }

      }) // click eventListener
  
    })
  }
  

  /*
  *
  * Form submission
  *
  */

  const formDataToLocalStorage = () => {

    const formThank = document.querySelector('[id*="thank"]'); // Form

    if (formThank) { // If form_thank is not null
      
      // get correct form ID
      const form = document.getElementById(formThank.id);
      const formField2 = document.getElementById("form-field-field_2");
      const formField3 = document.getElementById("form-field-field_3");
            
      form.addEventListener("submit", function () {

            // Get data from "formPass" then put it into ${promotionData}
            localStorageInitialize(promotionData, "formPass")

            // add input data into ${promotionData}
            promotionData.name = formField2? formField2.value : null; // name
            promotionData.phone = formField3? formField3.value : null; // phone
            
            // Update localStorage
            localStorageUpdate(promotionData, "formPass")


        }); // End Even Listener
    }
  }
  
  try {
    init()
    countdowmController()
    progressBarController()
    productToggleController()
    setLocalProductDetail()

    if (promotionFields !== null || promotionFields.length === 0){
      formDataToLocalStorage()
    }
  } catch (error) {
    console.log(error)
  }
  
}

window.addEventListener("DOMContentLoaded", (event) => {
  jQuery(window).on("elementor/frontend/init", () => {

    const productCardHandler = ($element) => {
      elementorFrontend.elementsHandler.addHandler(productCard, {
        $element,
      });
    };
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/product-card.default",
      productCardHandler
    );

  });
});

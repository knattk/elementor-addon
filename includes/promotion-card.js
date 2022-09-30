function promotionCard() {
  localStorage.clear();

  var promotionData = { promotion: {id:"", title:"", item:"", pricereg:"", pricesale:""}, duedate: "", name: "", phone: "" };
  const firstCard = document.querySelector('.promotion-card')
  const promotionCardButtons = document.querySelectorAll(".card-button");
  const fieldGroup1 = document.querySelector(".elementor-field-group-field_1");
  const field1 = document.querySelector("#form-field-field_1");
  const promotionFields = document.querySelectorAll(".promotion-field"); // Promotion Field Widget support
  
  

  const localStorageUpdate = (source, key) => {
    localStorage.setItem(key, JSON.stringify(source));
  }
  const localStorageInitialize = (receiver, key) => {
      if (localStorage.getItem(key)){
        receiver = JSON.parse(localStorage[key])
      }
  }
  const promotionDataSet = (parent) => {
    promotionData.promotion.title = parent.querySelector(".card-title")? parent.querySelector(".card-title").innerHTML : "";
    promotionData.promotion.item = parent.querySelector(".card-list")? parent.querySelector(".card-list").innerHTML : "";
    promotionData.promotion.pricereg = parent.querySelector(".price-regular")? parent.querySelector(".price-regular").innerHTML : "";
    promotionData.promotion.pricesale = parent.querySelector(".price-sale")? parent.querySelector(".price-sale").innerHTML : "";
  }
  const checkTypeOfFiled = (field) => {
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

  /*
  *
  * Init function
  *
  */

  const init = () => {
    
    // Get data from "formPass" then put it into ${promotionData}
    localStorageInitialize(promotionData, "formPass")

    promotionDataSet(firstCard)

    switch (checkTypeOfFiled(fieldGroup1)) {
      case "textarea":
        field1.value = promotionData.promotion.title
        break;
    }

    localStorageUpdate(promotionData, "formPass")

  }

  let promotionCards = [].slice.call(document.querySelectorAll(".promotion-card"));



  
  /*
  *
  * Event: Click promotion card's button.
  *
  */
  
  
  

  promotionCardButtons.forEach(button => {
    
    button.addEventListener("click", () => {
      let card = button.parentNode.parentNode.parentNode.parentNode.parentNode;
      let productId = card.getAttribute("product-id");

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

      switch (checkTypeOfFiled(fieldGroup1)) {

        case "textarea":
          

          field1.value = promotionData.promotion.title

          // Update field_1 selected item
          if (promotionFields) {
              
            promotionFields.forEach(element => {
              let fieldPromotionId = element.getAttribute("promotion-id")

              element.classList.remove("selected")
              
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
          break;

        case "dropdown":
            document.getElementById("form-field-field_1").selectedIndex = productId - 1;
          break;

        default: {
          break;
        }
      }

    })
  })

  /*
  *
  * Form submission
  *
  */

  const formDataToLocalStorage = () => {

    const formThank = document.querySelector('[id*="thank"]'); // Form

    if (formThank) { // If form_thank is not null
      
      const formField2 = document.getElementById("form-field-field_2");
      const formField3 = document.getElementById("form-field-field_3");
            
      document.getElementById(formThank.id).addEventListener("submit", function () {

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

  /*
  *
  * Featured Number
  *
  */
 
  //  String control
  var promotionCardDOM = {
    card: "promotion-card",
    register: "count-number",
    stock: "stock-number",
  }

  // Random register number
  cal = (min, max) => {
    min = Math.floor(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min) + min);
  }

  // Add Commas to register number
  addCommas = (x) => {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
  }

  // Set fetured item 
  var featuredItem;
  for (let i = 0; i < promotionCards.length; i++) {
    if (promotionCards[i].classList.contains("featured")) {
      featuredItem = promotionCards[i];
      break;
    }
  }

  if (featuredItem !== null) {
    
    // Settings
    var setNum = {
      start: function () {
        return parseInt(
          featuredItem.querySelector("." + promotionCardDOM.register).textContent.replace(/,/g, "")
        );
      },
      min: 2,
      max: 4,
    }

    // Check stock available.
    stockAvailable = () => {
      const midnight = new Date().setHours(0, 0, 0, 0);
      const today = new Date().getTime();
      let now = today - midnight, //How far from midnight.
          time = (hours) => {
            return hours * 1000 * 60 * 60;
          }, // Convert hours to minutes.
          itemStart = 100,
          itemEnd = 2,
          activeHours = time(15), // 15 hrs 6AM - 9PM
          timeToDecrease = Math.floor(activeHours / (itemStart - itemEnd)); //Decrease 1 piece of product every {$timeToDecrease} minutes.

      if (now >= time(6) && now < time(21)) {
        // If time is between 6AM - 9PM
        return (
          "เหลือ " +
          Math.floor(itemStart - (now - time(6)) / timeToDecrease) +
          " เซตสุดท้าย"
        ); // How many item left.
      } else {
        return "กำลังจะหมด";
      }
    }

    // Update register register (promotionCardDOM.register)
    updateRegisterCounter = () => {
      featuredItem.querySelector("." + promotionCardDOM.register).textContent = addCommas(localStorage.CountRegistered)
    }

    // Update stock counter (promotionCardDOM.stock)
    updateStockCounter = () => {
      if (featuredItem.querySelector("." + promotionCardDOM.stock) !== null) {
        featuredItem.querySelector("." + promotionCardDOM.stock).textContent = `${stockAvailable()}`;
      }
    }

    // DOM
    var countdownDOM = {
      featured: document.getElementsByClassName("featured")[0],
      stockAvailable: document.getElementsByClassName("card-notification")[0],
      days: document.getElementsByClassName("elementor-countdown-days")[0],
      hours: document.getElementsByClassName("elementor-countdown-hours")[0],
      minutes: document.getElementsByClassName("elementor-countdown-minutes")[0],
      seconds: document.getElementsByClassName("elementor-countdown-seconds")[0],
    }

    checkTimeout = () => {
      if (countdownDOM.days && countdownDOM.hours && countdownDOM.minutes) {
        if (
          countdownDOM.days.innerHTML === "00" &&
          countdownDOM.hours.innerHTML === "00" &&
          countdownDOM.minutes.innerHTML === "00"
        ) {
          return true;
        } else {
          return false;
        }
      }
    }

    stockHandler = () => {
      if (checkTimeout()) {
        featuredItem.querySelector("." + promotionCardDOM.stock).textContent =
          "โปรโมชั่นนี้หมดแล้ว";
      }
    }

    window.addEventListener("load", (event) => {
      if (localStorage.CountRegistered) {
        //Exit

          // Get base number from DOM.
          localStorage.CountRegistered = Number(localStorage.CountRegistered) + cal(setNum.min, setNum.max);
          updateRegisterCounter()
          updateStockCounter()
      } else {
          //Set LocalStorage
          localStorage.CountRegistered = setNum.start();
          updateRegisterCounter()
          updateStockCounter()
      }

      stockHandler();
    })
  } //Featured Item

  init()
  if (promotionFields !== null || promotionFields.length === 0){
    formDataToLocalStorage()
  }
}

window.addEventListener("DOMContentLoaded", (event) => {
  jQuery(window).on("elementor/frontend/init", () => {

    const promotionCardHandler = ($element) => {
      elementorFrontend.elementsHandler.addHandler(promotionCard, {
        $element,
      });
    };
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/promotion-card.default",
      promotionCardHandler
    );

  });
});

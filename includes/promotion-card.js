function promotionCard() {
  localStorage.clear();


  /*
  *
  * Init function
  *
  */

  let formData = { promotion: "", duedate: "", name: "", phone: "" }; // JSON

  function setPromotion(promotionTitle, promotionItems, regularPrice, salePrice){
    formData.promotion = {
      title: promotionTitle,
      item: promotionItems,
      pricereg: regularPrice,
      pricesale: salePrice,
    }
  }

  function checkTypeOfFiled(field) {
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

  const registerForm = document.querySelector('[id*="thank"]'); // Form
  const field_1 = document.querySelector(".elementor-field-group-field_1"); // Field_1

  let promotionCards = [].slice.call(document.querySelectorAll(".promotion-card"));
  console.log(promotionCards)
  let promotionCardsButton = [].slice.call(document.querySelectorAll('[id^="select-item"]'));
  

  
  let clickedCard, cardTitle, cardList, cardPriceRegular, cardPriceSale; // Card details

  // Set default promotion to JSON
  const setDefaultFormData = function () {
    cardTitle = promotionCards[0].getElementsByClassName("card-title")[0] ? promotionCards[0].getElementsByClassName("card-title")[0].innerHTML : null;
    cardList = promotionCards[0].getElementsByClassName("card-list")[0] ? promotionCards[0].getElementsByClassName("card-list")[0].innerHTML : null;
    cardPriceRegular = promotionCards[0].getElementsByClassName( "price-regular" )[0] ? promotionCards[0].getElementsByClassName("price-regular")[0].innerHTML : null;
    cardPriceSale = promotionCards[0].getElementsByClassName("price-sale")[0] ? promotionCards[0].getElementsByClassName("price-sale")[0].innerHTML : null;

    setPromotion(cardTitle, cardList, cardPriceRegular, cardPriceSale)
    
  }

  setDefaultFormData();


  
  /*
  *
  * Event: Click promotion card's button.
  *
  */
  

  // Check if field_1 is exit.
  if (field_1 !== null) {

    for (var i = 0; i < promotionCardsButton.length; i++) {

      // when user click the button
      promotionCardsButton[i].addEventListener("click", function (e) {

       // passing information into localStorage
        function updateItemToLocalStorage(item) {
          clickedCard = item.parentNode.parentNode.parentNode;
          cardTitle = clickedCard.getElementsByClassName("card-title")[0] ? clickedCard.getElementsByClassName("card-title")[0].innerHTML : null;
          cardList = clickedCard.getElementsByClassName("card-list")[0] ? clickedCard.getElementsByClassName("card-list")[0].innerHTML : null;
          cardPriceRegular = clickedCard.getElementsByClassName("price-regular")[0] ? clickedCard.getElementsByClassName("price-regular")[0].innerHTML.replace(/,/g, "") : null;
          cardPriceSale = clickedCard.getElementsByClassName("price-sale")[0] ? clickedCard.getElementsByClassName("price-sale")[0].innerHTML.replace(/,/g, "") : null;

          // Update clicked item to ${formData}
          setPromotion(cardTitle, cardList, cardPriceRegular, cardPriceSale)
        }

        updateItemToLocalStorage(this);

        //  Check type of Field_1
        switch (checkTypeOfFiled(field_1)) {

          case "textarea":

            //Promotion Field Support
            let promotionFields = document.getElementById("promotion-fields");
            let promotionField = document.querySelectorAll(".promotion-field");

            // If using promotion-field widget.
            if (promotionFields !== null) {
              
              // Clear selected class.
              [].forEach.call(promotionField, function (field) {
                field.classList.remove("selected");
              });

              // Add .selected to the classList of clicked item.
              document.getElementById("promotion-field-" + this.id[this.id.length - 1]).classList.add("selected");

              // Update field_1.
              document.getElementById("form-field-field_1").value = document.getElementById("promotion-field-" + this.id[this.id.length - 1]).querySelector(".pro").innerText;

            } else {
              // Put card title into field_1 instead.
              document.getElementById("form-field-field_1").value = this.parentNode.parentNode.parentNode.querySelector(".card-title").innerText;
            }

            break;

          case "radio":
            if (i <= promotionCardsButton.length) {
              document.getElementById("form-field-field_1-" + this.id[this.id.length - 1]).checked = true;
            } else {
              document.getElementById("form-field-field_1-0").checked = true;
            }
            break;

          case "checkbox":
            console.log("checkbox - currently not support.");
            break;

          case "dropdown":
            if (i <= promotionCardsButton.length) {
              document.getElementById("form-field-field_1").selectedIndex =
                this.id[this.id.length - 1];
            } else {
              document.getElementById("form-field-field_1").selectedIndex = 0;
            }
            break;

          default: {
            break;
          }
        }
      }); //Event listener
    }
  }

  /*
  *
  * Event: Click submit button
  *
  */

  if (registerForm != null) {
    document
      .getElementById(registerForm.id)
      .addEventListener("submit", function () {
        let field_2 = document.getElementById("form-field-field_2").value; // name
        let field_3 = document.getElementById("form-field-field_3").value; // phone

        // Update form data to ${formData}
        formData.name = field_2;
        formData.phone = field_3;

        // Set localStorage
        localStorage.setItem("formPass", JSON.stringify(formData));
      }); // End Even Listener
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
      console.log(`update register ${localStorage.CountRegistered}`)
    }

    // Update stock counter (promotionCardDOM.stock)
    updateStockCounter = () => {
      if (featuredItem.querySelector("." + promotionCardDOM.stock) !== null) {
        featuredItem.querySelector("." + promotionCardDOM.stock).textContent = `${stockAvailable()}`;
        console.log('update stock')
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
          console.log(`localStorage.CountRegistered ${localStorage.CountRegistered}`)
          updateRegisterCounter()
          updateStockCounter()
      } else {
          //Set LocalStorage
          localStorage.CountRegistered = setNum.start();
          console.log(`localStorage.CountRegistered ${localStorage.CountRegistered}`)
          updateRegisterCounter()
          updateStockCounter()
      }

      stockHandler();
    })
  } //Featured Item
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

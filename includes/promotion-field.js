function PromotionField() {

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

  const registerForm = document.querySelector('[id*="thank"]'); // Form
  const promotionField = document.querySelector(".promotion-field"); // Promotion field


  /*
  *
  * Update selected item to "field_1"
  *
  */

  // Check if promotion field widget is exit
  if (
    document.getElementById("form-field-field_1") &&
    document.querySelector(".promotion-field")
  ) {
    // Set default selected item.
    document.querySelector(".promotion-field").classList.add("selected");

    // Copy selected item to the form.
    document.getElementById("form-field-field_1").value = document
      .querySelector(".promotion-field")
      .querySelector(".pro").innerText;

    // When clicked promotion field...
    document
      .getElementById("promotion-fields")
      .addEventListener("click", function (e) {

        // Clear old selected item.
        let fieldItems = document.querySelectorAll(".promotion-field");

        [].forEach.call(fieldItems, function (fieldItem) {
          fieldItem.classList.remove("selected");
        });

        // Set new selected item.
        if (e.target.closest(".promotion-field") !== null) {
          
          // Add .selected class
          e.target.closest(".promotion-field").classList.add("selected");

          // Copy selected info item to the Form
          document.getElementById("form-field-field_1").value = e.target
            .closest(".promotion-field")
            .querySelector(".pro").innerText;

          (function setFormData() {

            let promotionTitle = e.target.closest(".promotion-field").querySelector(".promotion-title")? e.target.closest(".promotion-field").querySelector(".promotion-title").innerHTML : null;
            let promotionItem = e.target.closest(".promotion-field").querySelector(".promotion-item")? e.target.closest(".promotion-field").querySelector(".promotion-item").innerHTML : null;
            let promotionPriceReg = e.target.closest(".promotion-field").querySelector(".price-regular")? parseInt(e.target.closest(".promotion-field").querySelector(".price-regular").innerHTML.replace(/,/g, "")) : null;
            let promotionPriceSale = e.target.closest(".promotion-field").querySelector(".price-sale")? parseInt(e.target.closest(".promotion-field").querySelector(".price-sale").innerHTML.replace(/,/g, "")) : null;

            setPromotion(promotionTitle, promotionItem, promotionPriceReg, promotionPriceSale)
            
          })();
        }
      });
  }


  /*
  *
  * Promotion card support
  *
  */

    let promotionCard = document.querySelector(".promotion-card-container");

    // If card exit
    if (promotionCard) {
        let promotionCardButton = [].slice.call(
            document.querySelectorAll('[id^="select-item"]')
        );
        for (var i = 0; i < promotionCardButton.length; i++) {

        // ---------------------------------------
        //  EVENT: CLICK PROMOTION CARD'S BUTTON
        // ---------------------------------------
          promotionCardButton[i].addEventListener("click", function (e) {
            updateItemToLocalStorage(this);
          }); //Event listener
        }
    }

    // ---------------------------------------
    //  Update Clicked Card Details
    // ---------------------------------------
  function updateItemToLocalStorage(item) {
    clickedCard = item.parentNode.parentNode.parentNode;
    cardTitle = clickedCard.getElementsByClassName("card-title")[0] ? clickedCard.getElementsByClassName("card-title")[0].innerHTML : null;
    cardItemList = clickedCard.getElementsByClassName("card-list")[0] ? clickedCard.getElementsByClassName("card-list")[0].innerHTML : null;
    cardPriceRegular = clickedCard.getElementsByClassName("price-regular")[0] ? clickedCard.getElementsByClassName("price-regular")[0].innerHTML.replace(/,/g, "") : null;
    cardPriceSale = clickedCard.getElementsByClassName("price-sale")[0] ? clickedCard.getElementsByClassName("price-sale")[0].innerHTML.replace(/,/g, "") : null;

    // Update clicked item to ${formData}
    setPromotion(cardTitle, cardItemList, cardPriceRegular, cardPriceSale)
  }


  /*
  *
  * Create JSON and redirect after form submission
  *
  */
  
  

  // Set default promotion to JSON
  (function setFormData() {
    let promotionTitle = promotionField.getElementsByClassName("pro")[0]? promotionField.getElementsByClassName("pro")[0].innerHTML : null;
    let promotionItem = promotionField.getElementsByClassName("promotion-item")[0]? promotionField.getElementsByClassName("promotion-item")[0].innerHTML : null;
    let promotionPriceReg = promotionField.getElementsByClassName("price-regular")[0]? parseInt(promotionField.getElementsByClassName("price-regular")[0].innerHTML.replace(/,/g, "")) : null;
    let promotionPriceSale = promotionField.getElementsByClassName("price-sale")[0]? parseInt(promotionField.getElementsByClassName("price-sale")[0].innerHTML.replace(/,/g, "")) : null;

    setPromotion(promotionTitle, promotionItem, promotionPriceReg, promotionPriceSale)

  })();
  
  // If form is exit (id*="thank")
  if (registerForm != null) {
    
    document
      .getElementById(registerForm.id)
      .addEventListener("submit", function () {

        // Update form data to ${formData}
        formData.name = document.getElementById("form-field-field_2").value; // name
        formData.phone = document.getElementById("form-field-field_3").value; // phone

        // Set localStorage
        localStorage.setItem("formPass", JSON.stringify(formData));

      }); // End Even Listener
  }
}

window.addEventListener("DOMContentLoaded", (event) => {
  jQuery(window).on("elementor/frontend/init", () => {

    const promotionFieldHandler = ($element) => {
      elementorFrontend.elementsHandler.addHandler(PromotionField, {
        $element,
      });
    };
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/promotion-field.default",
      promotionFieldHandler
    );

  });
})

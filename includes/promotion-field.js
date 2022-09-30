function PromotionField() {

  //Global variable
  var promotionData = { promotion: {id:"", title:"", item:"", pricereg:"", pricesale:""}, duedate: "", name: "", phone: "" }
  var promotionFields = document.querySelectorAll(".promotion-field")
  let firstField = promotionFields[0]
  var field1 = document.querySelector('#form-field-field_1')
  
  
  const getChildData = (parent, child) => {
    return parent.querySelector(child) ? parent.querySelector(child).innerHTML : ""
  }

  const promotionDataSet = (parent) => {

    promotionData.promotion.id = parent.getAttribute("promotion-id")
    promotionData.promotion.title = getChildData(parent, ".promotion-title")
    promotionData.promotion.item = getChildData(parent, ".promotion-items")
    promotionData.promotion.pricereg = getChildData(parent, ".regular-price")
    promotionData.promotion.pricesale = getChildData(parent, ".sale-price")

  }

  const localStorageInitialize = (receiver, key) => {
    if (localStorage.getItem(key)){
      receiver = JSON.parse(localStorage[key])
    }
}

  const localStorageUpdate = (source, key) => {
    localStorage.setItem(key, JSON.stringify(source));
  }

  /*
  *
  * Init function
  *
  */

  const init = () => {

    // Add .selected class to first promotion
    firstField.classList.add("selected")

    // set default promotion
    promotionDataSet(firstField)
    field1.value = promotionData.promotion.title

    // Update localStorage
    localStorageUpdate(promotionData, "formPass")
  }

  /*
  *
  * Click Listening
  *
  */

  const clickController = () => {
    
    promotionFields.forEach(field => {
      
      field.addEventListener("click", function(){
        
        promotionFields.forEach(element => {
          element.classList.remove("selected")
        })

        this.classList.add("selected")
        // set default promotion from clicked field's data
        promotionDataSet(field)

        field1.value = promotionData.promotion.title
        // Update localStorage
        localStorageUpdate(promotionData, "formPass")
  
      })
    
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

            localStorageInitialize(promotionData, "formPass")

            // add input data into ${promotionData}
            promotionData.name = formField2? formField2.value : null; // name
            promotionData.phone = formField3? formField3.value : null; // phone
            
            // Update localStorage
            localStorageUpdate(promotionData, "formPass")

        }); // End Even Listener
    }
  }

  init()
  clickController()
  formDataToLocalStorage()

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

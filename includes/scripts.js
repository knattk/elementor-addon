"use strict";

// ---------------------------------------
//
//  WIDGET : PromotionCard
//
// ---------------------------------------

var promotioncardCounter = function () {
  
  var promotionCard = [].slice.call(document.querySelectorAll('[id^="select-item"]'));
  var field_1 = document.querySelector(".elementor-field-group-field_1");
  
  // DOM
  var formtype = {
    textarea: 'elementor-field-type-textarea',
    radio: 'elementor-field-type-radio',
    checkbox: 'elementor-field-type-checkbox',
    dropdown: 'elementor-field-type-select',
  }

  // Check type of field_1
  function checkTypeOfFiled1 () {
    if (field_1.classList.contains(formtype.textarea)){
        return 'textarea';
    } else if (field_1.classList.contains(formtype.radio)){
        return 'radio';
    } else if (field_1.classList.contains(formtype.checkbox)){
        return 'checkbox';
    } else if (field_1.classList.contains(formtype.dropdown)){
        return 'dropdown';
    } else {
        return null;
    }
  }

  // Check if field_1 already exit.
  if (field_1 !== null) {

    for (var i = 0; i < promotionCard.length; i++) {
      // Event Listener
      promotionCard[i].addEventListener("click",function () {

            switch (checkTypeOfFiled1()) {

              case 'textarea':
                // Clear select
                let doms = document.querySelectorAll('.em-promotion');
                [].forEach.call(doms, function(dom) {
                  dom.classList.remove('selected');
                });
                // Add .selected to classList
                document.getElementById("em-promotion-" + this.id[this.id.length - 1]).classList.add('selected');
                // Update textarea
                document.getElementById('form-field-field_1').value = document.getElementById("em-promotion-" + this.id[this.id.length - 1]).querySelector('.name').innerText;
                break;

              case 'radio':
                if (i <= promotionCard.length) {
                  document.getElementById(
                    "form-field-field_1-" + this.id[this.id.length - 1]
                  ).checked = true;
                } else {
                  document.getElementById("form-field-field_1-0").checked = true;
                }
                break;

              case 'checkbox':
                console.log('checkbox');
                break;

              case 'dropdown':
                if (i <= promotionCard.length) {
                  document.getElementById(
                    "form-field-field_1"
                  ).selectedIndex = this.id[this.id.length - 1];
                } else {
                  document.getElementById("form-field-field_1").selectedIndex = 0;
                }
                break;

              default: { 
                console.log('default');
                break;
              } 

            } // End Switch

        },
        false
      );
    }
  }


  // Update Featured Number -------------------

  var getLocal,
      featuredItem = null;
  // String
  var strings = {
    container: "promotion-card",
    number: "count-number",
    stock: "stock-number",
  };

  // Random Number
  var cal = (min, max) => {
    min = Math.floor(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min) + min);
  };

  // Add Commas to number
  var addCommas = (x) => {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  };

  // DOM
  var domCard = document.getElementsByClassName(strings.container);
  
  // Check Featured and get the order number
  for (let i = 0; i < domCard.length; i++) {
    if (domCard[i].classList.contains("featured")) {
      featuredItem = domCard[i];
      break;
    }
  }

  if (featuredItem !== null) {
    // Settings
    var setNum = {
      start: function () {
        return parseInt(
          featuredItem
            .querySelector("." + strings.number) //Looking for register counter DOM.
            .textContent.replace(/,/g, "")
        );
      },
      min: 2,
      max: 4,
    };

    //Check Stock
    var stockAvailable = () => {
        const midnight = new Date().setHours(0, 0, 0, 0);
        const today = new Date().getTime();
        let now = today - midnight, //How far from midnight.
            time = (hours) => { return hours * 1000 * 60 * 60;}, // Convert hours to minutes.
            itemStart = 100,
            itemEnd = 2,
            activeHours = time(15), // 15 hrs 6AM - 9PM
            timeToDecrease = Math.floor(activeHours / (itemStart - itemEnd)); //Decrease 1 piece of product every {$timeToDecrease} minutes.

        if (now >= time(6) && now < time(21)){ // If time is between 6AM - 9PM
          return "เหลือ " + Math.floor( itemStart - ((now - time(6)) / timeToDecrease) ) + " เซตสุดท้าย"; // How many item left.
        } else {   
          return "กำลังจะหมด"; 
        }     
    };
    
    // UpdateDom
    var updateDom = () => {
        // Register
        featuredItem.querySelector("." + strings.number).textContent = addCommas(localStorage.CountRegistered);
        // Stock
        if(featuredItem.querySelector("." + strings.stock) !== null){
          featuredItem.querySelector("." + strings.stock).textContent = `${stockAvailable()}`;
        }
    };

    // DOM
    var domHandler = {
        featured : document.getElementsByClassName("featured")[0],
        stockAvailable : document.getElementsByClassName("card-notification")[0],
        days : document.getElementsByClassName("elementor-countdown-days")[0],
        hours : document.getElementsByClassName("elementor-countdown-hours")[0],
        minutes : document.getElementsByClassName("elementor-countdown-minutes")[0],
        seconds : document.getElementsByClassName("elementor-countdown-seconds")[0]
    }

    var checkTimeout = function() {
        if (domHandler.days.innerHTML === "00" && domHandler.hours.innerHTML === "00" && domHandler.minutes.innerHTML === "00"){
            return true;
        }else {
            return false;
        }
    }

    var stockHandler = function() {
        if(checkTimeout()){
          featuredItem.querySelector("." + strings.stock).textContent = 'โปรโมชั่นนี้หมดแล้ว';
        }
    }

    window.addEventListener('load', (event) => {
      if (localStorage.CountRegistered) {
          //Exit
          localStorage.CountRegistered = Number(localStorage.CountRegistered) + cal(setNum.min, setNum.max);
          updateDom();
        
        
      } else {
          //Set LocalStorage
          localStorage.CountRegistered = setNum.start();
          updateDom();
      }

      stockHandler();
    });

  }//Featured Item

};

// ---------------------------------------
//
//  WIDGET : Countdown Auto
//
// ---------------------------------------

var countdownAuto = function () {
  (() => {
    clearInterval(x);

    // Set the date we're counting down to
    var countDownDate = new Date().setHours(24, 0, 0, 0);

    // Get DOM
    var domHrs = document.getElementById("domHrs"),
      domMin = document.getElementById("domMin"),
      domSec = document.getElementById("domSec");

    // Update the count down every 1 second
    var x = setInterval(countdown, 1000);

    function countdown() {
      // Get today's date and time
      var now = new Date().getTime();

      // Find the distance between now and the count down date
      var distance = countDownDate - now;

      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor(
        (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
      );
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);

      // Output the result in an element
      domHrs.innerHTML = hours;
      domMin.innerHTML = minutes;
      domSec.innerHTML = seconds;

      // If time is over, do this
      if (distance < 0) {
        clearInterval(x);

        // Output the result in an element
        domHrs.innerHTML = 0;
        domMin.innerHTML = 0;
        domSec.innerHTML = 0;
        countDownDate = new Date().setHours(24, 0, 0, 0);
        x = setInterval(countdown, 1000);
      }
    } //Function Countdown
  })();
};

// ---------------------------------------
//
//  WIDGET : PromotionForm
//
// ---------------------------------------


var promotionForm = function () {

  // --------------------------------------- 
  //
  // UPDATE SELECTED ITEM TO "field_1"
  // 
  // ---------------------------------------

 

  // Check if exit
  if(document.getElementById('form-field-field_1') && document.querySelector('.em-promotion')){

    document.querySelector('.em-promotion').classList.add('selected');

    //Copy selected item to the Form
    document.getElementById('form-field-field_1').value = document.querySelector('.em-promotion').querySelector('.name').innerText;
    
    document.getElementById('em-promotions').addEventListener("click", function(e){
  
      // Clear .selected
      let doms = document.querySelectorAll('.em-promotion');

      [].forEach.call(doms, function(dom) {
        // do whatever
        dom.classList.remove('selected');
      });
      
      if (e.target.closest(".em-promotion") !== null){
         
        //Add .selected
        e.target.closest(".em-promotion").classList.add("selected");
    
        //Copy selected item to the Form
        document.getElementById('form-field-field_1').value = e.target.closest(".em-promotion").querySelector('.name').innerText;
      }
    
    })
  }

  // ---------------------------------------
  //
  //  CREATE JSON AND REDIRECT AFTER FORM SUBMISSION
  //
  // ---------------------------------------

  // CLEAR LOCAL STORAGE
  window.localStorage.removeItem('formOutput');

  // DOM
  var strings = {
    // Form field
    field1: "form-field-field_1", // Promotion
    field2: "form-field-field_2", // Name
    field3: "form-field-field_3", // Phone
  }

  // EVENT LISTENER

      // get form
        // check form
        var checkFormId = function (){
          if (document.getElementById("form-thank") != null){
            return "form-thank";
          } else if (document.getElementById("form_thank") != null){
            return "form_thank";
          } else {
            return null;
          }
        }

        if (checkFormId() != null ){

          // when click submit button
          document.getElementById(checkFormId()).addEventListener("submit", function(){

            // find selected item
            let selectedItem = document.querySelector('.selected'),
            promotionTitle = selectedItem.querySelector('.pro').innerText,
            regularPrice = parseInt(selectedItem.querySelector('.price-regular').innerText.replace(/\,/g,'')),
            salePrice = parseInt(selectedItem.querySelector('.price-sale').innerText.replace(/\,/g,''));

            // get field value
            let field2 = document.getElementById("form-field-field_2").value, // name
                field3 = document.getElementById("form-field-field_3").value; // phone


            // JSON DATA SET
            let formData = {
              url: location.protocol + '//' + location.host + location.pathname,
              promotion: {
                title: promotionTitle,
                regularprice: regularPrice,
                saleprice: salePrice,
              },
              customer:{
                name: field2,
                phone: field3,
              }
            };

            // LOCAL STORAGE
            localStorage.setItem("formOutput", JSON.stringify(formData));
            // COMMAND REDIRECT
            //window.location.href = document.location.origin + "/thanks";

          })// End Even Listener



        }
}

// ---------------------------------------
//
//  WIDGET : FormOutput
//
// ---------------------------------------

var formOutput = function () {

  // Handle JSON
  const formData = JSON.parse(localStorage['formOutput']);

  // Check if not empty
  function checkBlank(field){
    return field.length == 0 ? '-' : field;
  }
  
  // Add commas to numer
  var addCommas = (number) => {
      return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }
  
  // DOM
  document.getElementById("em-output-pro").innerHTML = checkBlank(formData.promotion.title);
  document.getElementById("em-output-discount").innerHTML = `รวมส่วนลด<span>-${checkBlank(addCommas(parseInt(formData.promotion.regularprice) - parseInt(formData.promotion.saleprice)))}</span>`;
  document.getElementById("em-output-name").innerHTML = `คุณ ${checkBlank(formData.customer.name)}`;
  document.getElementById("em-output-phone").innerHTML = `เบอร์ติดต่อ ${checkBlank(formData.customer.phone)}`;
  
  // DOM - Button
  document.getElementById("share-facebook").setAttribute('href', 'https://www.facebook.com/sharer/sharer.php?u=' + formData.url);
  document.getElementById("share-line").setAttribute('href', 'https://social-plugins.line.me/lineit/share?url=' + formData.url);


};

/*-------------- Handler --------------*/

window.addEventListener("DOMContentLoaded", (event) => {
  jQuery(window).on("elementor/frontend/init", () => {

    const promotioncardHandler = ($element) => {
      elementorFrontend.elementsHandler.addHandler(promotioncardCounter, {
        $element,
      });
    };

    elementorFrontend.hooks.addAction(
      "frontend/element_ready/promotion-card.default",
      promotioncardHandler
    );

    const promotionFormHandler = ($element) => {
      elementorFrontend.elementsHandler.addHandler(promotionForm, {
        $element,
      });
    };
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/promotion-form.default",
      promotionFormHandler
    );

    const countdownAutoHandler = ($element) => {
      elementorFrontend.elementsHandler.addHandler(countdownAuto, {
        $element,
      });
    };
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/countdown-auto.default",
      countdownAutoHandler
    );

    const formOutputHandler = ($element) => {
      elementorFrontend.elementsHandler.addHandler(formOutput, {
        $element,
      });
    };
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/form-output.default",
      formOutputHandler
    );

  });
});
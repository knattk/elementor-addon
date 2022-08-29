function CountdownAuto() {
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
      let now = new Date().getTime();

      // Find the distance between now and the count down date
      let distance = countDownDate - now;

      // Time calculations for days, hours, minutes and seconds
      // var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      let hours = Math.floor(
        (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
      );
      let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      let seconds = Math.floor((distance % (1000 * 60)) / 1000);

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
}

window.addEventListener("DOMContentLoaded", (event) => {
  jQuery(window).on("elementor/frontend/init", () => {

    const countdownAutoHandler = ($element) => {
      elementorFrontend.elementsHandler.addHandler(CountdownAuto, {
        $element,
      });
    };
    elementorFrontend.hooks.addAction(
      "frontend/element_ready/countdown-auto.default",
      countdownAutoHandler
    );

  });
})
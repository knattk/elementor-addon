function CountdownAuto() {
    (() => {
        // Set the date we're counting down to
        var countDownDate = new Date().setHours(24, 0, 0, 0);

        // Root element
        let countdownContainer =
            document.querySelectorAll('.countdown-wrapper');
        // Get DOM

        countdownContainer.forEach((container) => {
            if (!container) return;

            let domHrs = container.querySelector('#domHrs');
            let domMin = container.querySelector('#domMin');
            let domSec = container.querySelector('#domSec');

            if (!domHrs || !domMin || !domSec) return;

            // Update the count down every 1 second
            var sec = setInterval(countdown, 1000);

            function countdown() {
                // Get today's date and time
                let now = new Date().getTime();

                // Find the distance between now and the count down date
                let distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                // var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                let hours = Math.floor(
                    (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60),
                );
                let minutes = Math.floor(
                    (distance % (1000 * 60 * 60)) / (1000 * 60),
                );
                let seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Output the result in an element
                domHrs.innerHTML = hours;
                domMin.innerHTML = minutes;
                domSec.innerHTML = seconds;

                // If time is over, do this
                if (distance < 0) {
                    clearInterval(sec);

                    // Output the result in an element
                    domHrs.innerHTML = 0;
                    domMin.innerHTML = 0;
                    domSec.innerHTML = 0;
                    countDownDate = new Date().setHours(24, 0, 0, 0);
                    sec = setInterval(countdown, 1000);
                }
            } //Function Countdown
        });
    })();
}

window.addEventListener('DOMContentLoaded', (event) => {
    jQuery(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction(
            'frontend/element_ready/countdown-auto.default',
            CountdownAuto,
        );
    });
});

function productCard() {
    let promotionData = {
        promotion: { id: '', title: '', item: '', pricereg: '', pricesale: '' },
        duedate: '',
        name: '',
        phone: '',
    };
    let countdown = { days: '00', hours: '00', minutes: '00', seconds: '00' };
    let selectedPromotionId = 1;

    const productCards = document.querySelectorAll('.product-card');
    const productButtons = document.querySelectorAll('.product-card-button');
    const field_1 = document.querySelector('.elementor-field-group-field_1');

    // Update promotionData
    const updatePromotionData = () => {
        const selectedCard = document.querySelector(
            `[product-id="${selectedPromotionId}"]`
        );

        promotionData.promotion.id = selectedPromotionId
            ? selectedPromotionId
            : '';
        promotionData.promotion.title = selectedCard.getElementsByTagName(
            'h3'
        )[0]
            ? selectedCard.getElementsByTagName('h3')[0].innerHTML
            : '';
        promotionData.promotion.item = selectedCard.querySelector(
            '.product-items'
        )
            ? selectedCard.querySelector('.product-items').innerHTML
            : '';
        promotionData.promotion.pricereg = selectedCard.querySelector(
            '.regular-price'
        )
            ? selectedCard.querySelector('.regular-price').innerHTML
            : '';
        promotionData.promotion.pricesale = selectedCard.querySelector(
            '.sale-price'
        )
            ? selectedCard.querySelector('.sale-price').innerHTML
            : '';

        setPromotionDataToLocalStorage();
        updatePromotionFieldValue();
    };
    // Set promotion data to localStorage
    const setPromotionDataToLocalStorage = () => {
        if (promotionData) {
            localStorage.setItem(
                'promotionData',
                JSON.stringify(promotionData)
            );
        }
    };
    // Check type of input field
    const checkTypeOfFiled = (field) => {
        if (field) {
            if (field.classList.contains('elementor-field-type-textarea')) {
                return 'textarea';
            } else if (field.classList.contains('elementor-field-type-radio')) {
                return 'radio';
            } else if (
                field.classList.contains('elementor-field-type-checkbox')
            ) {
                return 'checkbox';
            } else if (
                field.classList.contains('elementor-field-type-select')
            ) {
                return 'dropdown';
            } else {
                return null;
            }
        }
    };
    // Update field_1 value
    const updatePromotionFieldValue = () => {
        let local = localStorage.getItem('promotionData');
        let typeOfField = checkTypeOfFiled(field_1);

        if (typeOfField == 'textarea') {
            field_1.getElementsByTagName('textarea')[0].value = local
                ? JSON.parse(local).promotion.title
                : promotionData.promotion.title;

            // Support Promotion Field widget
            let fieldCards = document.querySelectorAll('.promotion-field');

            if (fieldCards) {
                fieldCards.forEach((field) => {
                    field.classList.remove('selected');
                });
                // select new card

                let selectedField = document.querySelector(
                    `.promotion-field[promotion-id="${selectedPromotionId}"]`
                );
                if (selectedField) {
                    selectedField.classList.add('selected');
                }
                return;
            }
        } else if (typeOfField == 'radio') {
            let radio = document.querySelector(
                `#form-field-field_1-${selectedPromotionId - 1}`
            );
            if (radio) {
                radio.checked = true;
            }
            return;
        }
    };

    /*
     *
     * Countdown
     *
     */

    const countdowmController = () => {
        // Update the count down every 1 second
        const x = setInterval(function () {
            const ElementorCountdownWrapper = document.querySelector(
                '.elementor-countdown-wrapper'
            );
            const AutoCountdownWrapper =
                document.querySelector('.countdown-wrapper');

            // Elementor Pro Countdown widget
            if (ElementorCountdownWrapper !== null) {
                countdown.days = ElementorCountdownWrapper.querySelector(
                    '.elementor-countdown-days'
                ).innerHTML;
                countdown.hours = ElementorCountdownWrapper.querySelector(
                    '.elementor-countdown-hours'
                ).innerHTML;
                countdown.minutes = ElementorCountdownWrapper.querySelector(
                    '.elementor-countdown-minutes'
                ).innerHTML;
                countdown.seconds = ElementorCountdownWrapper.querySelector(
                    '.elementor-countdown-seconds'
                ).innerHTML;
            } // Countdown Auto widget
            else if (AutoCountdownWrapper !== null) {
                countdown.days = '00';
                countdown.hours =
                    AutoCountdownWrapper.querySelector(
                        '.countdown-hours'
                    ).innerHTML;
                countdown.minutes =
                    AutoCountdownWrapper.querySelector(
                        '.countdown-minutes'
                    ).innerHTML;
                countdown.seconds =
                    AutoCountdownWrapper.querySelector(
                        '.countdown-seconds'
                    ).innerHTML;
            }

            let productCountdown = {
                days: document.querySelectorAll('.product-countdown-days'),
                hours: document.querySelectorAll('.product-countdown-hours'),
                minutes: document.querySelectorAll(
                    '.product-countdown-minutes'
                ),
                seconds: document.querySelectorAll(
                    '.product-countdown-seconds'
                ),
            };

            productCountdown.days.forEach((element) => {
                element.innerHTML = countdown.days;
            });
            productCountdown.hours.forEach((element) => {
                element.innerHTML = countdown.hours;
            });
            productCountdown.minutes.forEach((element) => {
                element.innerHTML = countdown.minutes;
            });
            productCountdown.seconds.forEach((element) => {
                element.innerHTML = countdown.seconds;
            });

            return countdown;
        }, 1000);
    };

    /*
     *
     * Progress bar
     *
     */

    const progressBarController = () => {
        const progressBar = document.querySelectorAll('.progress');
        const timeout = setTimeout(() => {
            progressBar.forEach((element) => {
                if (countdown.days == '03') {
                    element.style.width = '42%';
                    element.setAttribute('value', 42);
                }
                if (countdown.days == '02') {
                    element.style.width = '46%';
                    element.setAttribute('value', 46);
                } else if (countdown.days == '01') {
                    element.style.width = '54%';
                    element.setAttribute('value', 54);
                } else if (countdown.days == '00') {
                    let getHours = countdown.hours;

                    parseInt(getHours);
                    let stock = 50;
                    let lastHour = 20; // 20 = 20.00, 4 = 4.00
                    let sold = (stock / lastHour) * (24 - parseInt(getHours));
                    let totalSale = stock + sold <= 100 ? stock + sold : 100;
                    element.style.width = totalSale + '%';
                    element.setAttribute('value', totalSale);
                } else {
                    element.style.width = '16%';
                    element.setAttribute('value', 16);
                }

                let progressValue = element.getAttribute('value');
                let progressText = element.querySelector('.progress-text');
                if (progressValue > 99) {
                    progressText.innerHTML = 'เหลือ 1 เซตสุดท้าย';
                } else if (progressValue > 90) {
                    progressText.innerHTML = 'เหลือน้อยกว่า 3 เซต';
                } else if (progressValue > 50) {
                    progressText.innerHTML = 'ใกล้จะหมด';
                } else if (progressValue > 40) {
                    progressText.innerHTML = 'ขายดี';
                }
            });
        }, 1000);
    };

    /*
     *
     * Items Toggle
     *
     */

    const productToggleController = () => {
        const productToggle = document.querySelectorAll('.product-toggle');
        const productItems = document.querySelector('.product-items');

        if (productToggle) {
            productToggle.forEach((element) => {
                if (productItems.classList.contains('visible')) {
                    element.classList.add('rotate');
                }

                element.addEventListener('click', (event) => {
                    let target = event.target.parentElement.parentElement;

                    try {
                        event.target.classList.toggle('rotate');
                        target
                            .querySelector('.product-items')
                            .classList.toggle('visible');
                    } catch (error) {}
                });
            });
        }
    };

    const init = () => {
        localStorage.removeItem('promotionData');

        updatePromotionFieldValue();
        // Get selected promotion data
        productButtons.forEach((button) => {
            button.addEventListener('click', (e) => {
                // get product-id
                selectedPromotionId = button.getAttribute('product-id');
                updatePromotionData();
            });
        });

        countdowmController();
        progressBarController();
        productToggleController();
    };

    init();
}

window.addEventListener('DOMContentLoaded', (event) => {
    jQuery(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction(
            'frontend/element_ready/product-card.default',
            productCard
        );
    });
});

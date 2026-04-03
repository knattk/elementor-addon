// Initialize product card behavior and widget integrations.
function productCard() {
    const STORAGE_KEY = 'formPass';
    const DEFAULT_PROMOTION_DATA = {
        promotion: { id: '', title: '', item: '', pricereg: '', pricesale: '' },
        duedate: '',
        name: '',
        phone: '',
    };
    const countdown = { days: '00', hours: '00', minutes: '00', seconds: '00' };
    let promotionData = { ...DEFAULT_PROMOTION_DATA };

    const card1 = document.querySelector('.product-card');
    const buttons = document.querySelectorAll('.product-button');
    const fieldGroup = document.querySelector('.elementor-field-group-field_1');
    const promotionFields = document.querySelectorAll('.promotion-field'); // Promotion Field Widget support

    // Copy selected product details into the shared state object.
    const setPromotionData = (parent) => {
        if (!parent) {
            return;
        }

        const titleElement = parent.querySelector('h3');
        const itemElement = parent.querySelector('.product-items');
        const regularPriceElement = parent.querySelector('.regular-price');
        const salePriceElement = parent.querySelector('.sale-price');

        promotionData.promotion.id = parent.getAttribute('product-id') || '';
        promotionData.promotion.title = titleElement
            ? titleElement.innerHTML
            : '';
        promotionData.promotion.item = itemElement ? itemElement.innerHTML : '';
        promotionData.promotion.pricereg = regularPriceElement
            ? regularPriceElement.innerHTML
            : '';
        promotionData.promotion.pricesale = salePriceElement
            ? salePriceElement.innerHTML
            : '';
    };

    // Load stored promotion state and safely merge defaults.
    const loadPromotionData = () => {
        try {
            const raw = localStorage.getItem(STORAGE_KEY);
            if (!raw) {
                promotionData = {
                    ...DEFAULT_PROMOTION_DATA,
                    promotion: { ...DEFAULT_PROMOTION_DATA.promotion },
                };
                return;
            }

            const parsedData = JSON.parse(raw);
            promotionData = {
                ...DEFAULT_PROMOTION_DATA,
                ...parsedData,
                promotion: {
                    ...DEFAULT_PROMOTION_DATA.promotion,
                    ...(parsedData && parsedData.promotion
                        ? parsedData.promotion
                        : {}),
                },
            };
        } catch (error) {
            promotionData = {
                ...DEFAULT_PROMOTION_DATA,
                promotion: { ...DEFAULT_PROMOTION_DATA.promotion },
            };
        }
    };

    // Persist latest promotion state for cross-widget usage.
    const savePromotionData = () => {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(promotionData));
    };

    // Detect supported Elementor field type for field_1.
    const getFieldType = (field) => {
        if (!field) {
            return null;
        }

        if (field.classList.contains('elementor-field-type-textarea')) {
            return 'textarea';
        }

        if (field.classList.contains('elementor-field-type-radio')) {
            return 'radio';
        }

        if (field.classList.contains('elementor-field-type-checkbox')) {
            return 'checkbox';
        }

        if (field.classList.contains('elementor-field-type-select')) {
            return 'dropdown';
        }

        return null;
    };

    /*
     *
     * Init function
     *
     */

    // Initialize initial product data and sync form field value.
    const init = () => {
        loadPromotionData();

        setPromotionData(card1);

        // Update field_1
        if (getFieldType(fieldGroup) === 'textarea') {
            const textarea = fieldGroup.querySelector('textarea');
            if (textarea) {
                textarea.value = promotionData.promotion.title;
            }
        }

        savePromotionData();
    };

    /*
     *
     * Countdown
     *
     */

    // Sync countdown values from available countdown widgets.
    const countdownController = () => {
        // Update the count down every 1 second
        setInterval(() => {
            const elementorCountdownWrapper = document.querySelector(
                '.elementor-countdown-wrapper',
            );
            const autoCountdownWrapper =
                document.querySelector('.countdown-wrapper');

            // Elementor Pro Countdown widget
            if (elementorCountdownWrapper !== null) {
                const daysElement = elementorCountdownWrapper.querySelector(
                    '.elementor-countdown-days',
                );
                const hoursElement = elementorCountdownWrapper.querySelector(
                    '.elementor-countdown-hours',
                );
                const minutesElement = elementorCountdownWrapper.querySelector(
                    '.elementor-countdown-minutes',
                );
                const secondsElement = elementorCountdownWrapper.querySelector(
                    '.elementor-countdown-seconds',
                );

                countdown.days = daysElement
                    ? daysElement.textContent || '00'
                    : '00';
                countdown.hours = hoursElement
                    ? hoursElement.textContent || '00'
                    : '00';
                countdown.minutes = minutesElement
                    ? minutesElement.textContent || '00'
                    : '00';
                countdown.seconds = secondsElement
                    ? secondsElement.textContent || '00'
                    : '00';
            } // Countdown Auto widget
            else if (autoCountdownWrapper !== null) {
                const hoursElement =
                    autoCountdownWrapper.querySelector('.countdown-hours');
                const minutesElement =
                    autoCountdownWrapper.querySelector('.countdown-minutes');
                const secondsElement =
                    autoCountdownWrapper.querySelector('.countdown-seconds');

                countdown.days = '00';
                countdown.hours = hoursElement
                    ? hoursElement.textContent || '00'
                    : '00';
                countdown.minutes = minutesElement
                    ? minutesElement.textContent || '00'
                    : '00';
                countdown.seconds = secondsElement
                    ? secondsElement.textContent || '00'
                    : '00';
            }

            const productCountdown = {
                days: document.querySelectorAll('.product-countdown-days'),
                hours: document.querySelectorAll('.product-countdown-hours'),
                minutes: document.querySelectorAll(
                    '.product-countdown-minutes',
                ),
                seconds: document.querySelectorAll(
                    '.product-countdown-seconds',
                ),
            };

            productCountdown.days.forEach((element) => {
                element.textContent = countdown.days;
            });
            productCountdown.hours.forEach((element) => {
                element.textContent = countdown.hours;
            });
            productCountdown.minutes.forEach((element) => {
                element.textContent = countdown.minutes;
            });
            productCountdown.seconds.forEach((element) => {
                element.textContent = countdown.seconds;
            });
        }, 1000);
    };

    /*
     *
     * Progress bar
     *
     */

    // Update stock progress bars based on countdown state.
    const progressBarController = () => {
        const progressBar = document.querySelectorAll('.progress');
        setTimeout(() => {
            progressBar.forEach((element) => {
                if (countdown.days === '03') {
                    element.style.width = '42%';
                    element.setAttribute('value', 42);
                }
                if (countdown.days === '02') {
                    element.style.width = '46%';
                    element.setAttribute('value', 46);
                } else if (countdown.days === '01') {
                    element.style.width = '54%';
                    element.setAttribute('value', 54);
                } else if (countdown.days === '00') {
                    const hours = Number.parseInt(countdown.hours, 10) || 0;
                    const stock = 50;
                    const lastHour = 20; // 20 = 20.00, 4 = 4.00
                    const sold = (stock / lastHour) * (24 - hours);
                    const totalSale = stock + sold <= 100 ? stock + sold : 100;
                    element.style.width = totalSale + '%';
                    element.setAttribute('value', totalSale);
                } else {
                    element.style.width = '16%';
                    element.setAttribute('value', 16);
                }

                const progressValue = Number(element.getAttribute('value'));
                const progressText = element.querySelector('.progress-text');
                if (!progressText) {
                    return;
                }

                if (progressValue > 99) {
                    progressText.textContent = 'เหลือ 1 เซตสุดท้าย';
                } else if (progressValue > 90) {
                    progressText.textContent = 'เหลือน้อยกว่า 3 เซต';
                } else if (progressValue > 50) {
                    progressText.textContent = 'ใกล้จะหมด';
                } else if (progressValue > 40) {
                    progressText.textContent = 'ขายดี';
                }
            });
        }, 1000);
    };

    /*
     *
     * Items Toggle
     *
     */

    // Handle expand/collapse interactions for product item lists.
    const productToggleController = () => {
        const productToggles = document.querySelectorAll('.product-toggle');

        if (productToggles.length > 0) {
            productToggles.forEach((toggle) => {
                const relatedProductItems = toggle
                    .closest('.product-content')
                    .querySelector('.product-items');

                if (!relatedProductItems) {
                    return;
                }

                if (relatedProductItems.classList.contains('visible')) {
                    toggle.classList.add('rotate');
                }

                toggle.addEventListener('click', () => {
                    try {
                        toggle.classList.toggle('rotate');
                        relatedProductItems.classList.toggle('visible');
                    } catch (error) {
                        console.error(
                            'Error toggling product items visibility:',
                            error,
                        );
                    }
                });
            });
        }
    };

    /*
     *
     * Button Click Listening
     *
     */

    // Save clicked product details and reflect selection in form inputs.
    const setLocalProductDetail = () => {
        buttons.forEach((item) => {
            item.addEventListener('click', () => {
                const card = item.closest('.product-card'); // button's parent
                if (!card) {
                    return;
                }

                const productId = card.getAttribute('product-id'); // this card's product-id
                const productIndex = Number.parseInt(productId, 10);

                /*
                 *
                 * LocalStorage
                 *
                 */

                loadPromotionData();

                // Set ${promotionData} value from this card's data
                setPromotionData(card);

                // Update localStorage
                savePromotionData();

                /*
                 *
                 * Form field_1 support
                 *
                 */

                switch (getFieldType(fieldGroup)) {
                    case 'textarea':
                        if (fieldGroup) {
                            const textarea =
                                fieldGroup.querySelector('textarea');
                            if (textarea) {
                                textarea.value = promotionData.promotion.title;
                            }
                        }

                        // Update field_1 selected item
                        if (promotionFields.length > 0) {
                            promotionFields.forEach((element) => {
                                element.classList.remove('selected');

                                const fieldPromotionId =
                                    element.getAttribute('promotion-id');
                                if (productId === fieldPromotionId) {
                                    element.classList.add('selected');
                                }
                            });
                        }

                        break;

                    case 'radio':
                        if (!Number.isNaN(productIndex)) {
                            const radioField = document.getElementById(
                                'form-field-field_1-' + (productIndex - 1),
                            );
                            if (radioField) {
                                radioField.checked = true;
                            }
                        }

                        break;

                    case 'checkbox':
                        console.log('checkbox - currently not support.');
                        break;

                    case 'dropdown':
                        if (!Number.isNaN(productIndex)) {
                            const dropdownField =
                                document.getElementById('form-field-field_1');
                            if (dropdownField) {
                                dropdownField.selectedIndex = productIndex - 1;
                            }
                        }
                        break;

                    default: {
                        break;
                    }
                }
            }); // click eventListener
        });
    };

    /*
     *
     * Form submission
     *
     */

    // Store submitted customer info alongside the selected promotion.
    const formDataToLocalStorage = () => {
        const formThank = document.querySelector('[id*="thank"]'); // Form

        if (formThank) {
            // If form_thank is not null

            // get correct form ID
            const form = document.getElementById(formThank.id);
            const formField2 = document.getElementById('form-field-field_2');
            const formField3 = document.getElementById('form-field-field_3');
            if (!form) {
                return;
            }

            form.addEventListener('submit', () => {
                loadPromotionData();

                // add input data into ${promotionData}
                promotionData.name = formField2 ? formField2.value : null; // name
                promotionData.phone = formField3 ? formField3.value : null; // phone

                // Update localStorage
                savePromotionData();
            }); // End Even Listener
        }
    };

    try {
        init();
        countdownController();
        progressBarController();
        productToggleController();
        setLocalProductDetail();
        formDataToLocalStorage();
    } catch (error) {
        console.log(error);
    }
}

// Register productCard when Elementor frontend is ready.
window.addEventListener('DOMContentLoaded', () => {
    jQuery(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction(
            'frontend/element_ready/product-card.default',
            productCard,
        );
    });
});

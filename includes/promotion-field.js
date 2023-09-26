function PromotionField() {
    //Global variable
    var promotionData = {
        promotion: { id: '', title: '', item: '', pricereg: '', pricesale: '' },
        duedate: '',
        name: '',
        phone: '',
    };
    const promotionFields = document.querySelectorAll('.promotion-field');
    const field_1 = document.querySelector('.elementor-field-group-field_1');

    let selectedPromotionId = 1;

    const getChildData = (parent, child) => {
        return parent.querySelector(child)
            ? parent.querySelector(child).innerHTML
            : '';
    };

    const setPromotionData = (parent) => {
        promotionData.promotion.id = parent.getAttribute('promotion-id')
            ? parent.getAttribute('promotion-id')
            : '';
        promotionData.promotion.title = getChildData(parent, '.promotion-title')
            ? getChildData(parent, '.promotion-title')
            : '';
        promotionData.promotion.item = getChildData(parent, '.promotion-items')
            ? getChildData(parent, '.promotion-items')
            : 'null';
        promotionData.promotion.pricereg = getChildData(
            parent,
            '.regular-price'
        )
            ? getChildData(parent, '.regular-price')
            : '';
        promotionData.promotion.pricesale = getChildData(parent, '.sale-price')
            ? getChildData(parent, '.sale-price')
            : '';
    };

    const localStorageInitialize = (receiver, storageKey) => {
        if (localStorage.getItem(storageKey)) {
            receiver = JSON.parse(localStorage[storageKey]);
        }
    };

    const localStorageUpdate = (source, storageKey) => {
        localStorage.setItem(storageKey, JSON.stringify(source));
    };

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
    /*
     *
     * Init function
     *
     */

    const init = () => {
        // Add .selected class to first promotion
        promotionFields[0].classList.add('selected');

        // set default promotion
        setPromotionData(promotionFields[0]);

        // Update localStorage
        localStorageUpdate(promotionData, 'formPass');

        // Update field_1
        if (checkTypeOfFiled(field_1) == 'textarea') {
            field_1.getElementsByTagName('textarea')[0].value =
                promotionData.promotion.title;
        }
    };

    /*
     *
     * Click Listening
     *
     */

    const clickController = () => {
        promotionFields.forEach((field) => {
            field.addEventListener('click', function () {
                promotionFields.forEach((element) => {
                    element.classList.remove('selected');
                });

                // Add .selected to this card
                this.classList.add('selected');

                // Store this card info in ${promotionData}
                setPromotionData(field);

                // Update localStorage
                localStorageUpdate(promotionData, 'formPass');

                // Update field_1
                if (checkTypeOfFiled(field_1) == 'textarea') {
                    field_1.getElementsByTagName('textarea')[0].value =
                        promotionData.promotion.title;
                }
            });
        });
    };

    /*
     *
     * Form submission
     *
     */

    const formDataToLocalStorage = () => {
        const formThank = document.querySelector('[id*="thank"]'); // Form

        if (formThank) {
            // get correct form ID
            const form = document.getElementById(formThank.id);
            const formField2 = document.getElementById('form-field-field_2');
            const formField3 = document.getElementById('form-field-field_3');

            form.addEventListener('submit', function () {
                localStorageInitialize(promotionData, 'formPass');

                // add input data into ${promotionData}
                promotionData.name = formField2 ? formField2.value : null; // name
                promotionData.phone = formField3 ? formField3.value : null; // phone

                // Update localStorage
                localStorageUpdate(promotionData, 'formPass');
            }); // End Even Listener
        }
    };

    try {
        init();
        clickController();
        formDataToLocalStorage();
    } catch (error) {
        console.log(error);
    }
}

window.addEventListener('DOMContentLoaded', (event) => {
    jQuery(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction(
            'frontend/element_ready/promotion-field.default',
            PromotionField
        );
    });
});

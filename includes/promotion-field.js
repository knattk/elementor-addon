function PromotionField() {
    const promotionFields = document.querySelectorAll('.promotion-field');
    const fieldGroup = document.querySelector('.elementor-field-group-field_1');
    const promotionData = {
        promotion: { id: '', title: '', item: '', pricereg: '', pricesale: '' },
        duedate: '',
        name: '',
        phone: '',
    };

    const getInnerHTML = (parent, selector) =>
        parent.querySelector(selector)?.innerHTML || '';

    const setPromotionData = (element) => {
        promotionData.promotion.id = element.getAttribute('promotion-id');
        promotionData.promotion.title = getInnerHTML(
            element,
            '.promotion-title'
        );
        promotionData.promotion.item = getInnerHTML(
            element,
            '.promotion-items'
        );
        promotionData.promotion.pricereg = getInnerHTML(
            element,
            '.regular-price'
        );
        promotionData.promotion.pricesale = getInnerHTML(
            element,
            '.sale-price'
        );
    };

    const updateLocalStorage = (key, data) => {
        localStorage.setItem(key, JSON.stringify(data));
    };

    const loadLocalStorage = (key) => {
        const saved = localStorage.getItem(key);
        return saved ? JSON.parse(saved) : null;
    };

    const getFieldType = (element) => {
        if (!element) return null;
        if (element.classList.contains('elementor-field-type-textarea'))
            return 'textarea';
        if (element.classList.contains('elementor-field-type-radio'))
            return 'radio';
        if (element.classList.contains('elementor-field-type-checkbox'))
            return 'checkbox';
        if (element.classList.contains('elementor-field-type-select'))
            return 'dropdown';
        return null;
    };

    const setDefaultField = () => {
        if (!promotionFields.length) return;

        const defaultField = promotionFields[0];
        defaultField.classList.add('selected');
        setPromotionData(defaultField);
        updateLocalStorage('formPass', promotionData);

        if (getFieldType(fieldGroup) === 'textarea') {
            fieldGroup.querySelector('textarea').value =
                promotionData.promotion.title;
        }
    };

    const handleCardClicks = () => {
        promotionFields.forEach((card) => {
            card.addEventListener('click', () => {
                promotionFields.forEach((c) => c.classList.remove('selected'));
                card.classList.add('selected');
                setPromotionData(card);
                updateLocalStorage('formPass', promotionData);

                if (getFieldType(fieldGroup) === 'textarea') {
                    fieldGroup.querySelector('textarea').value =
                        promotionData.promotion.title;
                }
            });
        });
    };

    const hookFormSubmission = () => {
        const formThank = document.querySelector('[id*="thank"]');
        if (!formThank) return;

        const form = document.getElementById(formThank.id);
        const nameField = document.getElementById('form-field-field_2');
        const phoneField = document.getElementById('form-field-field_3');

        if (!form) return;

        form.addEventListener('submit', () => {
            const savedData = loadLocalStorage('formPass') || promotionData;
            savedData.name = nameField?.value || '';
            savedData.phone = phoneField?.value || '';
            updateLocalStorage('formPass', savedData);
        });
    };

    try {
        setDefaultField();
        handleCardClicks();
        hookFormSubmission();
    } catch (err) {
        console.error('[PromotionField] Error:', err);
    }
}

window.addEventListener('DOMContentLoaded', () => {
    jQuery(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction(
            'frontend/element_ready/promotion-field.default',
            PromotionField
        );
    });
});

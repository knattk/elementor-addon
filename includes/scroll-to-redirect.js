function ScrollToRedirect($scope) {
    const scopeEl = $scope && $scope[0] ? $scope[0] : document;
    const widget = scopeEl.querySelector('.scroll-to-redirect');

    if (!widget) return;

    const lineURL =
        sessionStorage.getItem('lineURL') || widget.getAttribute('data-to');
    const cancelBtn = widget.querySelector('.button-cancel');
    const countdownEl = widget.querySelector('.cancel-countdown');
    const mode = widget.getAttribute('data-mode') || 'inline';
    const isPopupMode = mode === 'popup';
    const options = { threshold: 0.9 };

    let clickStop = false;
    let interval = null;
    let hasTriggeredRedirect = false;

    if (!lineURL) return;

    const startCountdown = (callback, seconds = 4) => {
        if (interval) {
            clearInterval(interval);
            interval = null;
        }

        let counter = seconds;
        if (countdownEl) countdownEl.textContent = ` (${counter})`;

        interval = setInterval(() => {
            counter--;
            if (countdownEl) countdownEl.textContent = ` (${counter})`;

            if (counter <= 0) {
                clearInterval(interval);
                callback();
            }
        }, 1000);

        return interval;
    };

    const handleRedirectTrigger = () => {
        const inEditor = document.body.classList.contains(
            'elementor-editor-active',
        );
        if (inEditor || clickStop || hasTriggeredRedirect) return;

        hasTriggeredRedirect = true;
        startCountdown(() => {
            window.location.href = lineURL;
        });
    };

    const cancelRedirect = () => {
        clickStop = true;
        hasTriggeredRedirect = true;
        clearInterval(interval);
        interval = null;
        widget.classList.remove('show-popup');
        widget.classList.add('dismissed');
    };

    const handlePopupOnScroll = () => {
        if (!isPopupMode || clickStop) return;

        const percentTrigger = parseFloat(widget.getAttribute('data-percent'));

        if (isNaN(percentTrigger) || percentTrigger < 0 || percentTrigger > 100)
            return;

        const onScroll = () => {
            const scrollPos = window.scrollY + window.innerHeight;
            const totalHeight = document.documentElement.scrollHeight;
            const scrolledPercent = (scrollPos / totalHeight) * 100;

            if (scrolledPercent >= percentTrigger) {
                widget.classList.add('show-popup');
                window.removeEventListener('scroll', onScroll); // only trigger once
            }
        };

        window.addEventListener('scroll', onScroll);
    };

    const initObserver = () => {
        const observer = new IntersectionObserver((entries) => {
            for (const entry of entries) {
                if (entry.isIntersecting) {
                    handleRedirectTrigger();
                    observer.unobserve(entry.target);
                }
            }
        }, options);

        observer.observe(widget);
    };

    // Setup listeners and observers
    // if (!isPopupMode) {
    initObserver();
    // }

    handlePopupOnScroll();

    cancelBtn?.addEventListener('click', cancelRedirect);
}

// Elementor hook
window.addEventListener('DOMContentLoaded', () => {
    jQuery(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction(
            'frontend/element_ready/scroll-to-redirect.default',
            ScrollToRedirect,
        );
    });
});

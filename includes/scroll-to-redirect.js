function ScrollToRedirect() {
    const lineURL =
        sessionStorage.getItem('lineURL') ||
        document.querySelector('.scroll-to-redirect')?.getAttribute('data-to');
    const cancelBtn = document.querySelector('.button-cancel');
    const countdownEl = document.querySelector('.cancel-countdown');
    const autoRedirectPopup = document.querySelector('.auto-redirect-popup');
    const redirectTargets = document.querySelectorAll('.redirect-start');

    const options = { threshold: 0.9 };
    let clickStop = false;
    let interval = null;

    const startCountdown = (callback, seconds = 4) => {
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
        const inEditor = document.querySelector('.elementor-editor-active');
        if (inEditor || clickStop || !lineURL) return;

        const interval = startCountdown(() => {
            window.location.href = lineURL;
        });
    };

    const cancelRedirect = () => {
        clickStop = true;
        clearTimeout(interval);
        interval = null;
        autoRedirectPopup?.classList.remove('show-popup');
    };

    const handlePopupOnScroll = () => {
        if (!autoRedirectPopup || clickStop) return;

        const percentTrigger = parseFloat(
            autoRedirectPopup.getAttribute('data-percent')
        );

        if (isNaN(percentTrigger) || percentTrigger < 0 || percentTrigger > 100)
            return;

        const onScroll = () => {
            const scrollPos = window.scrollY + window.innerHeight;
            const totalHeight = document.documentElement.scrollHeight;
            const scrolledPercent = (scrollPos / totalHeight) * 100;

            if (scrolledPercent >= percentTrigger) {
                autoRedirectPopup.classList.add('show-popup');
                window.removeEventListener('scroll', onScroll); // only trigger once
            }
        };

        window.addEventListener('scroll', onScroll);
    };

    const initObserver = () => {
        const observer = new IntersectionObserver((entries) => {
            for (const entry of entries) {
                if (entry.isIntersecting) handleRedirectTrigger();
            }
        }, options);

        redirectTargets.forEach((el) => observer.observe(el));
    };

    // Setup listeners and observers
    initObserver();
    handlePopupOnScroll();

    cancelBtn?.addEventListener('click', cancelRedirect);
}

// Elementor hook
window.addEventListener('DOMContentLoaded', () => {
    jQuery(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction(
            'frontend/element_ready/scroll-to-redirect.default',
            ScrollToRedirect
        );
    });
});

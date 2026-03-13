// public/js/lazy-loading.js

// Lazy loading images
document.addEventListener("DOMContentLoaded", function() {
    // Check if IntersectionObserver is supported
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    const src = img.getAttribute('data-src');
                    
                    if (src) {
                        img.src = src;
                        img.classList.add('loaded');
                        imageObserver.unobserve(img);
                    }
                }
            });
        }, {
            rootMargin: '50px 0px', // Start loading when image is 50px from viewport
            threshold: 0.01
        });

        // Observe all images with data-src attribute
        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    } else {
        // Fallback for older browsers
        loadImagesImmediately();
    }
    
    // Lazy load background images
    const bgObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const element = entry.target;
                const bgSrc = element.getAttribute('data-bg');
                
                if (bgSrc) {
                    element.style.backgroundImage = `url('${bgSrc}')`;
                    element.classList.add('bg-loaded');
                    bgObserver.unobserve(element);
                }
            }
        });
    }, {
        rootMargin: '50px 0px',
        threshold: 0.01
    });

    // Observe elements with data-bg attribute
    document.querySelectorAll('[data-bg]').forEach(element => {
        bgObserver.observe(element);
    });
    
    // Lazy load iframes
    const iframeObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const iframe = entry.target;
                const src = iframe.getAttribute('data-src');
                
                if (src) {
                    iframe.src = src;
                    iframeObserver.unobserve(iframe);
                }
            }
        });
    }, {
        rootMargin: '100px 0px',
        threshold: 0.01
    });

    // Observe all iframes with data-src attribute
    document.querySelectorAll('iframe[data-src]').forEach(iframe => {
        iframeObserver.observe(iframe);
    });
});

// Fallback function
function loadImagesImmediately() {
    document.querySelectorAll('img[data-src]').forEach(img => {
        const src = img.getAttribute('data-src');
        if (src) {
            img.src = src;
        }
    });
    
    document.querySelectorAll('[data-bg]').forEach(element => {
        const bgSrc = element.getAttribute('data-bg');
        if (bgSrc) {
            element.style.backgroundImage = `url('${bgSrc}')`;
        }
    });
}
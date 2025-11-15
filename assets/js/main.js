/**
 * Main JavaScript for Zo's Art Gallery
 */

// Mobile menu toggle
document.addEventListener('DOMContentLoaded', function() {
    const mobileToggle = document.querySelector('.mobile-menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    const siteHeader = document.querySelector('.site-header');

    if (mobileToggle && navMenu) {
        mobileToggle.addEventListener('click', function() {
            const isActive = navMenu.classList.toggle('active');
            mobileToggle.setAttribute('aria-expanded', isActive ? 'true' : 'false');
        });
    }

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(e) {
        if (navMenu && navMenu.classList.contains('active')) {
            if (!e.target.closest('.navbar')) {
                navMenu.classList.remove('active');
                if (mobileToggle) {
                    mobileToggle.setAttribute('aria-expanded', 'false');
                }
            }
        }
    });

    window.addEventListener('resize', function() {
        if (window.innerWidth > 768 && navMenu && navMenu.classList.contains('active')) {
            navMenu.classList.remove('active');
            if (mobileToggle) {
                mobileToggle.setAttribute('aria-expanded', 'false');
            }
        }
    });

    const updateHeaderState = function() {
        if (!siteHeader) {
            return;
        }

        if (window.scrollY > 10) {
            siteHeader.classList.add('is-scrolled');
        } else {
            siteHeader.classList.remove('is-scrolled');
        }
    };

    updateHeaderState();
    window.addEventListener('scroll', updateHeaderState);
    
    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            alert.style.opacity = '0';
            setTimeout(function() {
                alert.remove();
            }, 300);
        }, 5000);
    });
});

// Disable right-click on images (image protection)
document.addEventListener('contextmenu', function(e) {
    if (e.target.tagName === 'IMG' && !e.target.closest('.admin-body')) {
        e.preventDefault();
        return false;
    }
});

// Disable dragging images
document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('img');
    images.forEach(function(img) {
        img.addEventListener('dragstart', function(e) {
            if (!e.target.closest('.admin-body')) {
                e.preventDefault();
                return false;
            }
        });
    });
});

// Form validation helpers
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

// Gallery filter form - submit on change
document.addEventListener('DOMContentLoaded', function() {
    const filterSelects = document.querySelectorAll('.filter-form select');
    filterSelects.forEach(function(select) {
        select.addEventListener('change', function() {
            this.form.submit();
        });
    });
});

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Add loading state to forms
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('form');
    forms.forEach(function(form) {
        form.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn && !submitBtn.disabled) {
                submitBtn.disabled = true;
                submitBtn.textContent = 'Processing...';
                
                // Re-enable after 5 seconds as fallback
                setTimeout(function() {
                    submitBtn.disabled = false;
                    submitBtn.textContent = submitBtn.dataset.originalText || 'Submit';
                }, 5000);
            }
        });
    });
});

// Image lazy loading fallback for older browsers
if ('loading' in HTMLImageElement.prototype) {
    // Browser supports native lazy loading
} else {
    // Fallback for browsers that don't support lazy loading
    const images = document.querySelectorAll('img[loading="lazy"]');
    const imageObserver = new IntersectionObserver(function(entries, observer) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src || img.src;
                observer.unobserve(img);
            }
        });
    });
    
    images.forEach(function(img) {
        imageObserver.observe(img);
    });
}

// Hero slideshow
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.hero-slide');
    if (slides.length > 0) {
        let currentSlide = 0;
        
        function nextSlide() {
            slides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % slides.length;
            slides[currentSlide].classList.add('active');
        }
        
        // Change slide every 5 seconds
        setInterval(nextSlide, 5000);
    }
});

// Console welcome message
console.log('%cWelcome to Zo\'s Art Gallery!', 'font-size: 20px; font-weight: bold; color: #2c3e50;');
console.log('%cAll artwork is protected by copyright.', 'font-size: 14px; color: #e74c3c;');

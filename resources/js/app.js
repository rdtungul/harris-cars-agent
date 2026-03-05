/**
 * Harris Cars Service Center — Main JavaScript
 */

import './bootstrap';
import Alpine from 'alpinejs';

// Register Alpine globally
window.Alpine = Alpine;

// Auto-dismiss flash messages after 5 seconds
document.addEventListener('DOMContentLoaded', function () {
    const flashMessages = document.querySelectorAll('[data-flash-auto-dismiss]');
    flashMessages.forEach(function (el) {
        setTimeout(function () {
            el.style.transition = 'opacity 0.3s ease';
            el.style.opacity = '0';
            setTimeout(function () {
                el.remove();
            }, 300);
        }, 5000);
    });
});

// Smooth scroll for anchor links
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
});

// Confirmation dialogs for delete buttons (Alpine-independent fallback)
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-confirm]').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            if (!confirm(this.getAttribute('data-confirm'))) {
                e.preventDefault();
            }
        });
    });
});

// Auto-generate slug from title fields in admin forms
document.addEventListener('DOMContentLoaded', function () {
    const titleField = document.querySelector('[data-slug-source]');
    const slugField  = document.querySelector('[data-slug-target]');

    if (titleField && slugField && slugField.value === '') {
        titleField.addEventListener('input', function () {
            slugField.value = this.value
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '');
        });
    }
});

// Start Alpine
Alpine.start();

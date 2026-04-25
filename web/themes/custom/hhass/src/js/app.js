import '../css/style.css';   // <-- this must match the filesystem path

import Alpine from 'alpinejs';
window.Alpine = Alpine;

document.addEventListener('alpine:init', () => {
    Alpine.data('profileHome', () => ({
        menuOpen: false,
        activeService: 0,
        services: [
            { title: 'Drupal Engineering', detail: 'Custom modules, theme architecture, and maintainable code for long-term scale.' },
            { title: 'UI System Design', detail: 'Tailwind component systems with clean visual hierarchy and responsive behavior.' },
            { title: 'Delivery & Support', detail: 'Release planning, QA hardening, and continuous optimization after launch.' }
        ],
        setService(index) {
            this.activeService = index;
        }
    }));
});

Alpine.start();

(function ($, Drupal) {
    Drupal.behaviors.hhass = {
        attach: function (context, settings) {
            // Your JS here…
        }
    };
})(jQuery, Drupal);

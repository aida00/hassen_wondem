import '../css/style.css';   // <-- this must match the filesystem path

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

(function ($, Drupal) {
    Drupal.behaviors.hhass = {
        attach: function (context, settings) {
            // Your JS here…
        }
    };
})(jQuery, Drupal);

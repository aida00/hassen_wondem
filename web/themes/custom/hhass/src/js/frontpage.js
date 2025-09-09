// 1) bring in Tailwind output
import '../css/frontpage.css';

// 2) Alpine bootstrap
import Alpine from 'alpinejs';
window.Alpine = Alpine;

document.addEventListener('alpine:init', () => {
    Alpine.data('heroSection', () => ({
        opened: false,
        toggle() { this.opened = !this.opened; }
    }));
});

Alpine.start();

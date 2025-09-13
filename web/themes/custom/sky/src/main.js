// check why the line below have issue and if needed
// import 'vite/dynamic-import-polyfill';

// All CSS have to be imported in JS
import '/components/style.scss';
import './style.css';

import '/components/components.js';

// import $ from 'jquery';

import Alpine from 'alpinejs';
import ui from '@alpinejs/ui';
import focus from '@alpinejs/focus';
import collapse from '@alpinejs/collapse';

// import Swiper JS
import Swiper from 'swiper/bundle';

// import styles bundle
import 'swiper/css/bundle';

Alpine.plugin(ui);
Alpine.plugin(focus);
Alpine.plugin(collapse);

window.Alpine = Alpine;

Alpine.start();
document.addEventListener('DOMContentLoaded', function () {
    const progressCircle = document.querySelector(".autoplay-progress svg");
    const progressContent = document.querySelector(".autoplay-progress span");

    const swiper = new Swiper('.swiper', {
            // Optional parameters
            direction: 'horizontal',
            slidesPerView: 1,
            loop: true,
            autoplay: {
                delay: 4500,
                disableOnInteraction: false
            },

            // If we need pagination
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                renderBullet: function (index, className) {
                    return '<span class="' + className + '">' +
                    '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="10" viewBox="0 0 30 10"><rect width="30" height="10" rx="5" fill="#070d15"/></svg>' +
                    '</span>';
                }
            },

        // Navigation arrows
        navigation:{
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

    // on: {
    //     autoplayTimeLeft(s, time, progress) {
    //         progressCircle.style.setProperty("--progress", 1 - progress);
    //         progressContent.textContent = `${Math.ceil(time / 1000)}s`;
    //     }
    // }
})
    ;
});
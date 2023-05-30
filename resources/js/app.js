import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';

window.Alpine = Alpine;
Alpine.plugin(focus);

Alpine.start();


document.addEventListener('DOMContentLoaded', function () {

    const dataDesktopRun = document.querySelectorAll('[data-desktop-run]');
    const phoneSize = 450;

    for (let i = 0; i < dataDesktopRun.length; i++) {
        dataDesktopRun[i].addEventListener('click', function (e) {
            // Prevent link following if viewport size is larger than phoneSize
            if (window.innerWidth > phoneSize) {
                e.preventDefault();

                // Get function name and check if it's defined in global scope
                const code = this.getAttribute('data-desktop-run');
                try {
                    let fn = new Function(code);
                    fn();
                } catch (error) {
                    console.error('Error executing JavaScript code: ' + error);
                }
            }
        });
    }
});

import './bootstrap';

import Alpine from 'alpinejs';
import {Components} from "./components";

document.addEventListener('alpine:init', () => {
    Alpine.data("menu", Components.menu);
})
window.Alpine = Alpine;
Alpine.start();

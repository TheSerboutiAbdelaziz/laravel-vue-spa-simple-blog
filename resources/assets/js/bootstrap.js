
// Load Lodash Library
window._ = require('lodash');

// Load UIkit CSS Library
window.UIkit = require("uikit");
window.Icons = require("uikit/dist/js/uikit-icons");
UIkit.use(window.Icons);

// Load Axios HTTP Library
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

// Load VueJS Framwork
window.Vue = require('vue');
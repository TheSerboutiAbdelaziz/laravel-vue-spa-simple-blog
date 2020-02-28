require('./bootstrap');

import axios from 'axios'
import store from './store/index'
import router from './router/router'
import App from './components/App'
// ALert Global Components
import Flash from './components/shared/Flash'
// Loader Global Components
import Loader from './components/shared/Loader'

import { ValidationObserver, ValidationProvider, configure } from 'vee-validate';
// Import Vue Filters
import './utils/filters.js';

// Axios Base URL Config
axios.defaults.baseURL = 'http://127.0.0.1:8000/api/v1/';

// Set token in Http Header
const devlogToken = localStorage.getItem('token');
if (devlogToken) {
	axios.defaults.headers.common['Authorization'] = devlogToken;
}

// Load vee-validate components
Vue.component('ValidationObserver', ValidationObserver);
Vue.component('ValidationProvider', ValidationProvider);
// Load ALert Components
Vue.component('Flash', Flash);
// Load Loader Components
Vue.component('Loader', Loader);

// Vee-Validate Config
configure({
	classes:{
		invalid:'uk-form-danger'
	}
})

// Vue App Instance
const app = new Vue({
    el: '#app',
    store,
    router,
    render: h => h(App) 
});


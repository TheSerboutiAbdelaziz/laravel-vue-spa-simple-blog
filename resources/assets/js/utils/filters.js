import Vue from 'vue';

Vue.filter('truncate', (value) => {
	return value.substring(0, 22) + '...';
});
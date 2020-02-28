import Vue from 'vue';
import Vuex from 'vuex';
// Web Modules
import web_stories from './modules/web_stories';
// Admin Modules
import stories from './modules/admin/stories';
import comments from './modules/admin/comments';
import users from './modules/admin/users';
// Auth Modules
import auth from './modules/auth/auth';
import user from './modules/auth/user';

Vue.use(Vuex);

const store = new Vuex.Store({
    modules: {
    	//Web
        web_stories,
        //Admin
        stories,
        comments,
        users,
        //Auth 
        auth,
        user
    }
});

export default store;
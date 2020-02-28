////////// Middleware ////////////////
// Store 
import  store from  '../store/index';

const isAuthenticated = (to, from, next) => {
	if (store.getters.isAuth) {
		return next();
	}else{
		return next('/')
	}
}

const isAdmin = (to, from, next) => {
	if (!store.getters.isAdmin) {
		return next();
	}else{
		return next({ name: 'dashboard' })
	}	
}
///////////////////////////////////

// Web Components 
import Home from '../components/pages/Home';
import Contact from '../components/pages/Contact';
import Stories from '../components/pages/stories/Stories';
import Story from '../components/pages/stories/Story';
import NotFound from '../components/pages/NotFound';
// Auth Components 
import Login from '../components/pages/auth/Login';
import Register from '../components/pages/auth/Register';
// Admin Rout Component
import Admin from '../components/admin/layouts/Admin';
// Admin Dashboard Component
import Dashboard from '../components/admin/dashboard/Dashboard';
// Admin User Components 
import UsersList from '../components/admin/users/UsersList';
import ProfileDetail from '../components/admin/users/ProfileDetail';
// Admin Story Components 
import StoriesList from '../components/admin/stories/StoriesList';
import AddStory from '../components/admin/stories/AddStory';
import EditStory from '../components/admin/stories/EditStory';
// Admin Comment Components 
import CommentsList from '../components/admin/comments/CommentsList';

const routes = [

// Web Pages Routes

	{ path:'/', name: 'home', component: Home },
	{ path:'/contact', name: 'contact', component: Contact },
	{ path:'/stories', name: 'stories' , component: Stories },
	{ path:'/story/:id', name : 'story', component: Story},
	{ path:'*', name: 'notfound', component: NotFound },

// Auth Pages Routes

	{ path:'/login', name: 'login', component: Login },
	{ path:'/register', name: 'register', component: Register },

// Admin Pages Routes
	
	{ path:'/admin', component: Admin, beforeEnter: isAuthenticated, children: [
			// Admin Dashboard Page
			{ path: '', name: 'dashboard', component: Dashboard },
			// Admin Stories Pages
			{ path: 'stories', name: 'admin-stories', component: StoriesList },
			{ path: 'addStory', name : 'admin-addStory', component: AddStory},
			{ path: 'editStory/:id', name : 'admin-editStory', component: EditStory},
			// Admin Users Pages
			{ path: 'users', name : 'admin-users', component: UsersList,  beforeEnter: isAdmin},
			{ path: 'profile/:id', name : 'admin-profile', component: ProfileDetail, beforeEnter: isAdmin},
			// Admin Comment Page
			{ path: 'comments', name : 'admin-comments', component: CommentsList},
		]
	},

];

export default routes;
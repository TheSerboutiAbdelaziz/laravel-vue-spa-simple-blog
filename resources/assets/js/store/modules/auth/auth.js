
const state = {
	token: localStorage.getItem('token') || '',
}

const getters = {
	isAuth: (state) => !!state.token,
}		

const actions = {
	authenticate:  ({ commit, dispatch }, form) => {
			let authUrl = form.action;
			let data = {}
		
		// Dispatched from register component
		if (authUrl === 'register') {
			authUrl = 'signup';
			data = {
				name: form.name,
				email: form.email,
				password: form.password,
				password_confirmation: form.password_confirmation,
			}
		}

		// Dispatched from login component
		if (authUrl === 'login') {
			 authUrl = 'signin';
			data = {
                email: form.email,
                password: form.password
			}
		}

		return new Promise((resolve, reject) => {
			axios.post(authUrl, data)
				.then( res => {
					// Get token from Api response
					const token = res.data.token;
					// Store token in localStorage
					localStorage.setItem('token', token);
					// Set token in HTTP header 
					axios.defaults.headers.common['Authorization'] = token;
					// Commit data
					commit('GET_TOKEN', token);
					// Get authenticated user info
					dispatch('authUser');
					resolve(res);
				})
				.catch( err => {
					// Remove token from localStorage
					localStorage.removeItem('token');
					reject(err)
				});
		}) //End Promise
	},

	logout: ({ commit }) => { 
		return new Promise((resolve, reject) => {
			axios.get('admin/signout')
				.then( res => {
					// Store token in localStorage
					localStorage.removeItem('token');
					// Set token in HTTP header 
					delete axios.defaults.headers.common['Authorization'];
					// Remove user state
					commit('GET_TOKEN');
					resolve(res);
				})
				.catch( err => {
					reject(err.response.data.errors)
				});
		}) //End Promise
	},
}

const mutations = {
	GET_TOKEN: (state, api_token) => state.token = api_token,
}

export default {
	state,
	getters,
	actions,
	mutations	
}


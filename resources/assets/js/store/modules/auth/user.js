
const state = {
	user: ''
}

const getters = {
	authProfile: (state) => state.user,
	isAdmin: (state) => !state.user.role
}		

const actions = {
	authUser: async ({ commit }) => { 
		const res = await axios.get('admin/user');
		commit('GET_USER', res.data);			
	},
}

const mutations = {
	GET_USER: (state, api_auth_user) => state.user = api_auth_user,
}

export default {
	state,
	getters,
	actions,
	mutations	
}


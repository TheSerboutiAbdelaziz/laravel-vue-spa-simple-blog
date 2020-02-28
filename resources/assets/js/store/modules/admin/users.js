
const state = {
	users: [],
	profile: '',
	status: false
};

const getters = {
	users: (state) => state.users,
	userProfile: (state) => state.profile,
	usersLoader: (state) => state.status,

};

const actions = {
	getAllUsers: async ({ commit }) => { 
		commit('STATUS', true);
		const res = await axios.get('admin/users');
		commit('GET_ALL_USERS', res.data);
		commit('STATUS', false);
	},

	getSingleUser: async ({ commit }, {id} ) => {
		commit('STATUS', true);
		const res = await axios.get(`admin/users/${id}`);
		commit('GET_SINGLE_USER',  res.data);
		commit('STATUS', false);
	},
};

const  mutations = {
	GET_ALL_USERS: (state, api_admin_users) => state.users = api_admin_users,
	GET_SINGLE_USER: (state, api_user) => state.profile = api_user,
	STATUS: (state, status) => state.status = status,
};

export default {
	state,
	getters,
	actions,
	mutations
}
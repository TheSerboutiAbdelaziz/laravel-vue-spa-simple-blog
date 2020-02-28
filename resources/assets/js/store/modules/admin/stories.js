
const state = {
	stories: [],
	story: '',
	status: false
};

const getters = {
	stories: (state) => state.stories,
	story: (state) => state.story,
	storiesLoader: (state) => state.status,

};

const actions = {
	getAllStories: async ({ commit }) => {
		commit('STATUS', true);
		const res = await axios.get('admin/stories');
		commit('GET_ALL_STORIES', res.data);
		commit('STATUS', false);
	},

	getSingleStory: async ({ commit }, {id} ) => {
		commit('STATUS', true);
		const res = await axios.get(`admin/stories/${id}`);
		commit('GET_SINGLE_STORY',  res.data);
		commit('STATUS', false);
	},

	createNewStory: ({ commit }, form) => {

		const config = {
			headers: {
				'Content-Type': 'multipart/form-data'
			}
		};

		return new Promise((resolve, reject) => {
			axios.post('admin/stories', form, config)
				.then( res => {
					commit('NEW_STORY', res.data.data);
					resolve(res.data.message);
				})
				.catch( err => {
					reject(err.response.data.errors);
				});
		}) //End Promise
	},


	updateStory: ({ commit }, form) => {

		const config = {
			headers: {
				'Content-Type': 'multipart/form-data'
			}
		};

		return new Promise((resolve, reject) => {
			axios.post(`admin/stories/${form.id}`, form.data, config)
				.then( res => {
					commit('UPDATE_STORY', form);
					resolve(res.data.message);
				})
				.catch( err => {
					reject(err.response.data.errors);
				});
		}) //End Promise
	},

	deleteStory: ({ commit, dispatch }, {id}) => { 
		return new Promise((resolve, reject) => {
			axios.delete(`admin/stories/${id}`)
				.then( res => {
					commit('DELETE_STORY', id);
					resolve(res.data.message);
					dispatch('getAllStories');
				})
				.catch( err => {
					reject('Action failed!')
				});
		}) //End Promise
	},

};

const  mutations = {
	GET_ALL_STORIES: (state, api_admin_stories) => state.stories = api_admin_stories,
	GET_SINGLE_STORY: (state, api_story) => state.story = api_story,
	NEW_STORY: (state, api_new_story) => state.stories.unshift(api_new_story),
	UPDATE_STORY: (state, updated_story) => {
			let story = state.stories.find(item => item.id == updated_story.id);
			return story = updated_story.data; 
	},	
	DELETE_STORY: (state, deleted_story) => state.stories = state.stories.filter((item) => ( item.id == deleted_story )),
	STATUS: (state, status) => state.status = status,
};

export default {
	state,
	getters,
	actions,
	mutations
}




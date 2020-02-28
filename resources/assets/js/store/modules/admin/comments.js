import Vue from 'vue'
const state = {
	comments: [],
	status: false
};

const getters = {
	comments: (state) => state.comments,
	commentsLoader: (state) => state.status
};

const actions = {
	getAllComments: async ({ commit }) => {
		commit('STATUS', true);
		const res = await axios.get('admin/comments');
		commit('GET_ALL_COMMENTS', res.data);
		commit('STATUS', false);
	},

	createNewComment: ({ commit, dispatch }, form) => {
		return new Promise((resolve, reject) => {
			axios.post('admin/comments', { content: form.content, story_id: form.story_id})
				.then( res => {
					commit('ADD_NEW_COMMENT', res.data.data);	
					resolve(res.data.message);
					dispatch('getSingleWebStory', { id: form.story_id })
				})
				.catch(err => {
					reject(err);
				});
		}) //End Promise
	},

	deleteComment: ({ commit, dispatch }, {id}) => {
		return new Promise((resolve, reject) => {
			axios.delete(`admin/comments/${id}`)
				.then( res => {
					commit('DELETE_COMMENT', id);
					resolve(res.data.message);
					dispatch('getAllComments');
				})
				.catch(err => reject(err.response.data.message));
		}) //End Promise
	},

};

const  mutations = {
	GET_ALL_COMMENTS: (state, api_admin_comments) => state.comments = api_admin_comments,
	ADD_NEW_COMMENT: (state, api_new_comment) =>  state.comments.push(api_new_comment),
	DELETE_COMMENT: (state, deleted_comment) => state.comments = state.comments.filter(item => item.id == deleted_comment),
	STATUS: (state, status) => state.status = status,

};

export default {
	state,
	getters,
	actions,
	mutations
}

const state = {
	web_stories: [],
	pagination: {},
	web_story: '',
	status: false
};	

const getters = {
	webStories: (state) => state.web_stories,
	webStory: (state) => state.web_story,
	pagination: (state) => state.pagination,
	latestStories: (state) => state.web_stories.slice(0,3),
	webStoriesLoader: (state) => state.status,

}; 

const actions = {
	getAllWebStories: async ({ commit }, {p}) => {
		commit('STATUS', true);
		const res = await axios.get(`stories?page=${p}`);
		commit('GET_ALL_WEB_STORIES', res.data.data);
		commit('PAGINATION', res.data.meta);
		commit('STATUS', false);
	},
	getSingleWebStory: async ({ commit }, {id} ) => {
		commit('STATUS', true);
		const res = await axios.get(`stories/${id}`);
		commit('GET_SINGLE_WEB_STORY',  res.data);
		commit('STATUS', false);
	},
};

const mutations = {
	GET_ALL_WEB_STORIES: (state, api_stories) => state.web_stories = api_stories,
	PAGINATION: (state, api_pages) => state.pagination = api_pages,
	GET_SINGLE_WEB_STORY: (state, api_story) => state.web_story = api_story,
	STATUS: (state, status) => state.status = status,
};

export default {
	state,
	mutations,
	actions,
	getters
} 





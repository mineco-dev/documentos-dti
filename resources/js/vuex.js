import Vue from 'vue/dist/vue.js'
import Vuex from 'vuex'


Vue.use(Vuex)

export default new Vuex.Store({
	state: {
		user: {}
	},

	mutations: {
		setUser(state, user) {
			state.user = user
		}
	}

})
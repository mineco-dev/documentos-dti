import Vue from 'vue/dist/vue.js'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
	mode: 'history',
	linkActiveClass: 'active',
 	linkExactActiveClass: 'exact-active',
	routes: [
	{
		path: '/home',
		name: 'home',
		component: require('./components/HomeComponent').default,
		meta: { title: 'Home'}
	},
	{
		path: '/user/profile',
		name: 'user.profile',
		component: require('./components/user/ProfileComponent').default,
		meta: { title: 'Perfil de usuario'}
	},
	{
		path: '/user/post/:id',
		name: 'user.post.show',
		component: require('./components/user/ShowPostComponent').default,
		meta: { title: 'Perfil de usuario'}
	}
	]
})

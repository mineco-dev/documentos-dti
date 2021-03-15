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
		path: '/saludos',
		component: require('./components/RouterView').default,
		children: [
		{
			path: 'index',
			name: 'saludos.index',
			component: require('./components/catalogos/saludos/IndexComponent').default,
			meta: { title: 'Saludos'}
		},
		{
			path: 'create',
			name: 'saludos.create',
			component: require('./components/catalogos/saludos/CreateComponent').default,
			meta: { title: 'Registrar saludo'}
		},
		{
			path: ':id/edit',
			name: 'saludos.edit',
			component: require('./components/catalogos/saludos/EditComponent').default,
			meta: { title: 'Modificar saludo'}
		}
		]
	},
	{
		path: '/dependencias',
		component: require('./components/RouterView').default,
		children: [
		{
			path: 'index',
			name: 'dependencias.index',
			component: require('./components/catalogos/dependencias/IndexComponent').default,
			meta: { title: 'Títulos'}
		},
		{
			path: 'create',
			name: 'dependencias.create',
			component: require('./components/catalogos/dependencias/CreateComponent').default,
			meta: { title: 'Registrar saludo'}
		},
		{
			path: ':id/edit',
			name: 'dependencias.edit',
			component: require('./components/catalogos/dependencias/EditComponent').default,
			meta: { title: 'Modificar saludo'}
		}
		]
	},
	{
		path: '/entidades',
		component: require('./components/RouterView').default,
		children: [
		{
			path: 'index',
			name: 'entidades.index',
			component: require('./components/catalogos/entidades/IndexComponent').default,
			meta: { title: 'Títulos'}
		},
		{
			path: 'create',
			name: 'entidades.create',
			component: require('./components/catalogos/entidades/CreateComponent').default,
			meta: { title: 'Registrar saludo'}
		},
		{
			path: ':id/edit',
			name: 'entidades.edit',
			component: require('./components/catalogos/entidades/EditComponent').default,
			meta: { title: 'Modificar saludo'}
		}
		]
	},
	{
		path: '/cargos',
		component: require('./components/RouterView').default,
		children: [
		{
			path: 'index',
			name: 'cargos.index',
			component: require('./components/catalogos/cargos/IndexComponent').default,
			meta: { title: 'Títulos'}
		},
		{
			path: 'create',
			name: 'cargos.create',
			component: require('./components/catalogos/cargos/CreateComponent').default,
			meta: { title: 'Registrar saludo'}
		},
		{
			path: ':id/edit',
			name: 'cargos.edit',
			component: require('./components/catalogos/cargos/EditComponent').default,
			meta: { title: 'Modificar saludo'}
		}
		]
	},
	{
		path: '/destinatarios',
		component: require('./components/RouterView').default,
		children: [
		{
			path: 'index',
			name: 'destinatarios.index',
			component: require('./components/catalogos/destinatarios/IndexComponent').default,
			meta: { title: 'Títulos'}
		},
		{
			path: 'create',
			name: 'destinatarios.create',
			component: require('./components/catalogos/destinatarios/CreateComponent').default,
			meta: { title: 'Registrar saludo'}
		},
		{
			path: ':id/edit',
			name: 'destinatarios.edit',
			component: require('./components/catalogos/destinatarios/EditComponent').default,
			meta: { title: 'Modificar saludo'}
		}
		]
	},
	{
		path: '/documentos',
		name: 'documentos.index',
		component: require('./components/documentos/IndexComponent').default,
		meta: { title: 'Listado de documentos'}
	},
	{
		path: '/reservar',
		name: 'reservar.documento',
		component: require('./components/documentos/CreateComponent').default,
		meta: { title: 'Reservar documento'}
	},
	{
		path: '/documentos/:id',
		name: 'documentos.show',
		component: require('./components/ShowDocumentComponent').default,
		meta: { title: 'Detalle de documento'}
	}
	]
})

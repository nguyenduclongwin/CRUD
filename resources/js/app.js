require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

import Home from './components/views/Home';
import App from './components/App';
import Login from './components/Auth/Login';
import Register from './components/Auth/Register';
import Article from './components/Articles/Article';
import Add from './components/Articles/Add';
import Edit from './components/Articles/Edit';
const router = new VueRouter({
    mode: 'history',
    routes:[
        {
            path:'/',
            name: 'Home',
            component: Home,
            meta: { requiresAuth: true} 
        },
        {
            path:'/login',
            name: 'Login',
            component: Login
        },
        {
            path:'/register',
            name: 'Register',
            component: Register
        },
        {
            path:'/article',
            name: 'Article',
            component: Article,
            meta: { requiresAuth: true} 
        },
        {
            path:'/add-article',
            name: 'Add-Article',
            component: Add,
            meta: { requiresAuth: true} 
        },
        {
            path:'/edit-article',
            name: 'Edit-Article',
            component: Edit,
            meta: { requiresAuth: true} 
        }
    ]
});
router.beforeEach((to, from, next) => {
	if (to.meta.requiresAuth) {
		const authUser = JSON.parse(window.localStorage.getItem('authUser'))
		if (!(authUser && authUser.access_token )) {
			next({ name: 'Login' })
		}
	}
	next()
})
var app = new Vue({
    el: '#app',
    router:router,
    render: h => h(App)
})
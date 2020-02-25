require('./bootstrap');

import Vue from 'vue';
import App from './components/App';
import VueRouter from 'vue-router';
import routes from './routes'
Vue.use(VueRouter);
const router = new VueRouter({
    mode: 'history',
    routes
});
router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth) {
        const authUser = JSON.parse(window.localStorage.getItem('authUser'));
        if (!(authUser && authUser.access_token)) {
            next({ name: 'Login' });
        }
    }
    next();
})
var app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App)
})
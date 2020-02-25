import Home from './components/views/Home';
import Login from './components/Auth/Login';
import Register from './components/Auth/Register';
import Article from './components/Articles/Article';
import Add from './components/Articles/Add';
import Edit from './components/Articles/Edit';

const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home,
        meta: { requiresAuth: true }
    },
    {
        path: '/login',
        name: 'Login',
        component: Login
    },
    {
        path: '/register',
        name: 'Register',
        component: Register
    },
    {
        path: '/article',
        name: 'Article',
        component: Article,
        meta: { requiresAuth: true }
    },
    {
        path: '/add-article',
        name: 'Add-Article',
        component: Add,
        meta: { requiresAuth: true }
    },
    {
        path: '/edit-article',
        name: 'Edit-Article',
        component: Edit,
        meta: { requiresAuth: true }
    }
]
export default routes;
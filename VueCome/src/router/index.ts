import { createRouter, createWebHistory } from 'vue-router'
import Login from "../views/Login.vue"
import Dashboard from "../views/Dashboard.vue"
import RequestPassword from '../views/RequestPassword.vue'
import ResetPassword from '../views/ResetPassword.vue'
import Register from '../views/Register.vue'
import Products from '../views/Products.vue'
// import GuestLayout from '../components/GuestLayout.vue'
import store from '../store'


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
        path: '/',
        name: 'Dashboard',
        component: Dashboard,
        meta: {requiresAuth: true},
    },
    {
        path: '/Products',
        name: 'Products',
        component: Products,
        meta: {requiresAuth: true},
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
    },
    {
        path: '/Register',
        name: 'Register',
        component: Register,
    },
    {
        path: '/RequestPassword',
        name: 'RequestPassword',
        component: RequestPassword
    },
    {
        path: '/ResetPassword/token',
        name: 'ResetPassword',
        component: ResetPassword,
        meta: {requiresToken: true},

    },
  ]
})

router.beforeEach((to, from, next)=>{
    if(to.meta.requiresAuth && !store.state.user.token){
        next({name: 'login'})
    } else if(store.state.user.token && to.name ===  'Register') {
        next({name: 'Dashboard'});
    } else if(store.state.user.token && to.name === 'login') {
        next({name: 'Dashboard'})
    } else {
        next()
    };

    if (to.meta.requiresToken){
        next({name: 'ResetPassowrd'});
    }
} )

export default router


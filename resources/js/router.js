import Vue from 'vue'
import VueRouter from 'vue-router'


Vue.use(VueRouter)




const routes = [

    {
        path: '/',
        name: 'home',
        component: () => import(/* webpackChunkName: "Home" */ './components/home')
    },

    {
        path: '/cart',
        name: 'cartHome',
        component: () => import(/* webpackChunkName: "cartHome" */ './components/cart/CartHome.vue')
    },
    {
        path: '/details/:id',
        name: 'details',
        component: () => import(/* webpackChunkName: "details" */ './components/Shop/Details')
    },
    {
        path: '/checkout',
        name: 'checkout',
        component: () => import(/* webpackChunkName: "checkout" */ './components/checkout')
    },
]


export default new VueRouter({routes})

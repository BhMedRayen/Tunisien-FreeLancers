import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeView from '../views/HomeView.vue'
import singup from "../views/Auth/SignUpView.vue"
import login from "../views/Auth/LoginView.vue"
import ForgotPassword from "../views/Auth/ForgotPasswordView.vue"
import VerifyToken from "../views/Auth/VerifyTokenView.vue"
import chnagerPass from "../views/Auth/ChangerPasswordView.vue"
Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/VerifyToken',
    name: 'VerifyToken',
    component: VerifyToken
  },
  {
    path: '/chnagerPass',
    name: 'chnagerPass',
    component: chnagerPass
  },
  {
    path: '/ForgotPassword',
    name: 'ForgotPassword',
    component: ForgotPassword
  },
  
  {
    path: '/signup',
    name: 'signup',
    component: singup
  },
  {
    path: '/login',
    name: 'login',
    component: login
  },
  {
    path: '/about',
    name: 'about',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router

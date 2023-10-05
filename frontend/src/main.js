import Vue from 'vue'
import './plugins/axios'
import App from './App.vue'
import router from './router'
import store from './store'
import vuetify from './plugins/vuetify'
import 'aos/dist/aos.css';
Vue.config.productionTip = false
import {PiniaVuePlugin,createPinia} from "pinia"
Vue.use(PiniaVuePlugin);
export const pinia=createPinia();


import Echo from "laravel-echo"
window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.VUE_APP_WEBSOCKETS_KEY,
    wsHost:process.env.VUE_APP_WEBSOCKETS_SERVER,
    wsPort: 6001,
    cluster: "mt1",
    forceTLS: false,
    disableStats: true,
});

new Vue({
  router,
  store,
  vuetify,
  pinia,
  render: h => h(App)
}).$mount('#app')

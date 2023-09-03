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
new Vue({
  router,
  store,
  vuetify,
  pinia,
  render: h => h(App)
}).$mount('#app')

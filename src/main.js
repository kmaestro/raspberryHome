import Vue from 'vue'
import App from './App.vue'
import './registerServiceWorker'
import router from './router'
import store from './store'
import dateFilter from '@/filters/date.filter'
import Loader from '@/components/app/Loader'
import FullCalendar from 'vue-full-calendar'
import 'materialize-css/dist/js/materialize.min'
import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.config.productionTip = false

Vue.filter('date', dateFilter)
Vue.component('Loader', Loader)
Vue.use(FullCalendar)

new Vue({
  router,
  store,
  VueAxios,
  axios,
  render: h => h(App)
}).$mount('#app')

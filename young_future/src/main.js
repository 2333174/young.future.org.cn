// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import ElementUI from 'element-ui'
import axios from 'axios'
import store from './vuex'
import cookies from 'vue-cookies';
Vue.use(ElementUI)

Vue.config.productionTip = false
Vue.prototype.$axios=axios
Vue.prototype.$cookies=cookies

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  components: { App },
  template: '<App/>'
})

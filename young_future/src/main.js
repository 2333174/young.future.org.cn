// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import ElementUI from 'element-ui'
import axios from 'axios'
import store from './vuex'
import cookies from 'vue-cookies';
import '../static/css/animate.css'
import VueWayPoint from 'vue-waypoint'



Vue.use(ElementUI)
Vue.use(VueWayPoint)

Vue.config.productionTip = false
Vue.prototype.$axios=axios
Vue.prototype.$cookies=cookies
/*
 *@Author:蔡旭
 *@Time:2019-11-24
 *@description:路由拦截
*/
router.beforeEach((to,from,next)=>{
  if (to.meta.requireAuth){
    if (cookies.get("token")){
      var params = new URLSearchParams();
      params.append('token', cookies.get('token'));
      axios.post("/api/php/auth.php",params).then(res=>{
        if (res.data.status=="success"){
          cookies.set("token",res.data.token)
          next();
          store.state.userName=res.data.uname;
        }else{
          cookies.remove("token");
          next({
            path:"login",
          })
          // if(res.data.message=="伪造token信息"){
          //   this.$message(res.data.message);
          // }
        }
      })
    }else{
      next({
        path:"login",
      })
    }
  }else{
    console.log(to.path);
    if (cookies.get("token")&&to.path=="/login"){
      next({
        path:"/manager"
      })
    }else{
      next()
    }
  }
})
/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  components: { App },
  template: '<App/>'
})

import Vue from "vue"
import Vuex from "vuex"

Vue.use(Vuex);
const store= new Vuex.Store({
    state:{
        userName:"青年传媒集团",
        column:"用户管理"
    },
    mutations:{
        //修改state的操作放在这里，这里不允许异步
    },
    actions:{
        //异步操作放这里，如果需要修改数据，调用mutations的方法
    }
})
export default store;
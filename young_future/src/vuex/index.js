import Vue from "vue"
import Vuex from "vuex"

/*
 *@Author:蔡旭
 *@Time:2019-11-24
 *@description:全局变量
*/
Vue.use(Vuex);
const store= new Vuex.Store({
    state:{
        account:'',
        userName:"青年传媒集团",
        column:"用户管理",
        pageTitle:"珞青报管理",
        newspaper_active:0,
        passModal:false,
        listType: '',
        listData:[
            // {
            //   link:'',
            //   title:'【土建】观脱贫成效，奔全面小康',
            //   date:'2020-01-19'
            // },
            // {
            //   link:'',
            //   title:'【法院】情系母校，缘梦武大——会同一中，我们回来啦',
            //   date:'2020-01-18'
            // },
            // {
            //   link:'',
            //   title:'【水利】水利水电学院举办寒假实践培训活动',
            //   date:'2020-01-18'
            // },
            // {
            //   link:'',
            //   title:'【土建】载阳承梦，莹莹予众',
            //   date:'2020-01-18'
            // },
            // {
            //   link:'',
            //   title:'【土建】观脱贫成效，奔全面小康',
            //   date:'2020-01-19'
            // },
            // {
            //   link:'',
            //   title:'【法院】情系母校，缘梦武大——会同一中，我们回来啦',
            //   date:'2020-01-18'
            // },
            // {
            //   link:'',
            //   title:'【水利】水利水电学院举办寒假实践培训活动',
            //   date:'2020-01-18'
            // },
            // {
            //   link:'',
            //   title:'【土建】载阳承梦，莹莹予众',
            //   date:'2020-01-18'
            // },
            // {
            //   link:'',
            //   title:'【土建】观脱贫成效，奔全面小康',
            //   date:'2020-01-19'
            // },
            // {
            //   link:'',
            //   title:'【法院】情系母校，缘梦武大——会同一中，我们回来啦',
            //   date:'2020-01-18'
            // },
            // {
            //   link:'',
            //   title:'【水利】水利水电学院举办寒假实践培训活动',
            //   date:'2020-01-18'
            // },
            // {
            //   link:'',
            //   title:'【土建】载阳承梦，莹莹予众',
            //   date:'2020-01-18'
            // },
          ]
    },
    mutations:{
        //修改state的操作放在这里，这里不允许异步
    },
    actions:{
        //异步操作放这里，如果需要修改数据，调用mutations的方法
    }
})
export default store;
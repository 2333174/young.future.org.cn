import Vue from 'vue'
import Router from 'vue-router'
import Login from '@/login'
import AddUser from '@/manage/user/add'
import ManageUser from '@/manage/user/manage'
import AddNewspaper from '@/manage/newspaper/add'
import ManageNewspaper from '@/manage/newspaper/manage'
import AddPassage from '@/manage/passage/add'
import ManagePassage from '@/manage/passage/manage'
import Manage from '@/manage'
import HomePage from '@/homePage'
import ListPage from '@/listPage'
import Article from '@/contentPage/article.vue'
import NewsPaper from '@/contentPage/newspaper.vue'
Vue.use(Router)
const originalPush = Router.prototype.push
Router.prototype.push = function push(location) {
  return originalPush.call(this, location).catch(err => err)
}
export default new Router({
  mode: 'hash',
  routes: [
    {
      path:'/article/:id',
      name:'Article',
      component:Article
    },
    {
      path:'/newspaper/:title',
      name:'newspaper',
      component:NewsPaper
    },
    {
      path: '/manager',
      name: 'Manage',
      meta:{
        requireAuth:true,
      },
      component: Manage,
      children: [
        {
          path: 'user/add',
          name: 'AddUser',
          meta:{
            requireAuth:true,
          },
          component: AddUser
        },
        {
          path:'user/manager',
          name: 'ManageUser',
          meta:{
            requireAuth:true,
          },
          component: ManageUser
        },
        {
          path: 'newspaper/add',
          name: 'AddNewspaper',
          meta:{
            requireAuth:true,
          },
          component: AddNewspaper
        },
        {
          path:'newspaper/manager',
          name: 'ManageNewspaper',
          meta:{
            requireAuth:true,
          },
          component: ManageNewspaper
        },
        {
          path: 'passage/add',
          name: 'AddPassage',
          meta:{
            requireAuth:true,
          },
          component: AddPassage
        },
        {
          path:'passage/manager',
          name: 'ManagePassage',
          meta:{
            requireAuth:true,
          },
          component: ManagePassage
        },
      ]
    },
    {
      path: '/',
      name: 'home',
      component:HomePage
    },
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
    {
      path: '/listpage',
      name: 'ListPage',
      component: ListPage,
      // children: [
      //   {
      //     path: 'news',
      //     name: 'news',
      //     component: AddUser
      //   },
      //   {
      //     path:'newspaper',
      //     name: 'newspaper',
      //     component: ManageUser
      //   },
      //   {
      //     path: 'literature',
      //     name: 'literature',
      //     component: AddNewspaper
      //   },
      //   {
      //     path:'courier',
      //     name: 'courier',  

      //   },
      //   {
      //     path:'handpicked',
      //     name: 'handpicked',  
      //   },
      //   {
      //     path:'topic',
      //     name:'topic'
      //   }
      // ]
    }
  ]
})

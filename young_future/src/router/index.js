import Vue from 'vue'
import Router from 'vue-router'
import HelloWorld from '@/components/HelloWorld'
import Login from '@/login'
import AddUser from '@/manage/user/add'
import ManageUser from '@/manage/user/manage'
import AddNewspaper from '@/manage/newspaper/add'
import ManageNewspaper from '@/manage/newspaper/manage'
import AddPassage from '@/manage/passage/add'
import ManagePassage from '@/manage/passage/manage'
import Manage from '@/manage'
import HomePage from '@/homePage'

Vue.use(Router)

export default new Router({
  routes: [
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
  ]
})

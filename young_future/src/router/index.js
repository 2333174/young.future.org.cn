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

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'AddUser',
      component: AddUser
    },
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
    {
      path: '/manager/user/add',
      name: 'AddUser',
      component: AddUser
    },
    {
      path:'/manager/user/manager',
      name: 'ManageUser',
      component: ManageUser
    },
    {
      path: '/manager/newspaper/add',
      name: 'AddNewspaper',
      component: AddNewspaper
    },
    {
      path:'/manager/newspaper/manager',
      name: 'ManageNewspaper',
      component: ManageNewspaper
    },
    {
      path: '/manager/passage/add',
      name: 'AddPassage',
      component: AddPassage
    },
    {
      path:'/manager/passage/manager',
      name: 'ManagePassage',
      component: ManagePassage
    },
  ]
})

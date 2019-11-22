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

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/manager',
      name: 'Manage',
      component: Manage,
      children: [
        {
          path: 'user/add',
          name: 'AddUser',
          component: AddUser
        },
        {
          path:'user/manager',
          name: 'ManageUser',
          component: ManageUser
        },
        {
          path: 'newspaper/add',
          name: 'AddNewspaper',
          component: AddNewspaper
        },
        {
          path:'newspaper/manager',
          name: 'ManageNewspaper',
          component: ManageNewspaper
        },
        {
          path: 'passage/add',
          name: 'AddPassage',
          component: AddPassage
        },
        {
          path:'passage/manager',
          name: 'ManagePassage',
          component: ManagePassage
        },
      ]
    },
    {
      path: '/',
      name: 'home',
      redirect:"/manager"
    },
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
  ]
})

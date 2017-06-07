import Vue from 'vue'
import Router from 'vue-router'
// import Hello from '@/components/Hello'
import Home from '@/components/Home'
import Admin from '@/components/admin/Admin'
import AllRecords from '@/components/admin/AllRecords'
import Arranger from '@/components/admin/Arranger'
import Normal from '@/components/admin/Normal'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/admin',
      name: 'admin',
      component: Admin,
      children: [
        {
          path: 'list',
          name: 'all-records',
          component: AllRecords
        },
        {
          path: 'arranger',
          name: 'arranger',
          component: Arranger
        },
        {
          path: 'normal',
          component: Normal
        }
      ]
    }
  ]
})

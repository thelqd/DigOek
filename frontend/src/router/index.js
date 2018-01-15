import Vue from 'vue'
import Router from 'vue-router'
import Hotels from '@/components/Hotels'
import Welcome from '@/components/Welcome'
import Login from '@/components/Login'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Welcome',
      component: Welcome
    },
    {
      path: '/Hotels',
      name: 'Hotels',
      component: Hotels
    },
    {
      path: '/Login',
      name: 'Login',
      component: Login
    }
  ]
})

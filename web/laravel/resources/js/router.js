import Vue from 'vue'
import VueRouter from 'vue-router'
import Mypage from './pages/Mypage.vue'
import Login from './pages/Login.vue'
import CreateWordQuestion from './pages/CreateWordQuestion.vue'
import SystemError from './pages/errors/System.vue'

import store from './store'

// VueRouterプラグインを使用する
// これによって<RouterView />コンポーネントなどを使うことができる
Vue.use(VueRouter)

// パスとコンポーネントのマッピング
const routes = [
  {
    path: '/',
    component: Mypage,
  },
  {
    path: '/login',
    component: Login,
    beforeEnter(to, from, next) {
      if (store.getters['auth/check']) {
        next('/')
      } else {
        next()
      }
    },
  },
  {
    path: '/create-word-question',
    component: CreateWordQuestion,
  },
  {
    path: '/500',
    component: SystemError,
  },
]

// VueRouterインスタンスを作成する
const router = new VueRouter({
  mode: 'history',
  routes,
})

// VueRouterインスタンスをエクスポートする
// app.jsでインポートするため
export default router

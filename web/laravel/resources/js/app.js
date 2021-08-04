import Vue from 'vue'
import router from './router'
import App from './App.vue'
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';
Vue.use(Vuetify);

new Vue({
  el: '#app',
  router, // ルーティングの定義を読み込む
  components: { App }, // ルートコンポーネントの使用を宣言する
  template: '<App />', // ルートコンポーネントを描画する
  vuetify: new Vuetify({
    iconfont: 'mdi',
  }),
})
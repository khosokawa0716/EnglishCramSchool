<template>
  <div>
    <h3>マイページ</h3>
    <ul v-if="isAdmin">
      <li><router-link to="/admin">管理者用のマイページ</router-link></li>
    </ul>
    <p>ようこそ {{ username }} さん</p>
    <h5>もんだいをとく</h5>
    <ul v-for="group in groups" :key="group.index">
      <li>
        <router-link :to="`/answer-word-question/${group.id}`">{{
          group.name
        }}</router-link>
      </li>
    </ul>
  </div>
</template>
<script>
import { OK } from '../util'

export default {
  data() {
    return {
      groups: [],
    }
  },
  computed: {
    isAdmin() {
      return this.$store.getters['auth/username'] === 'admin'
    },
    username() {
      return this.$store.getters['auth/username']
    },
  },
  methods: {
    async fetch() {
      const response = await axios.get(`/api/create-group`)
      // エラーの処理
      if (response.status !== OK) {
        this.$store.commit('error/setCode', response.status)
        return false
      }
      // 成功の場合、問題の情報をプロパティに代入
      this.groups = []
      for (let i = 0; i < response.data.length; i++) {
        let group = new Object()
        group.id = response.data[i].id
        group.name = response.data[i].name
        this.groups.push(group)
      }
    },
  },
  created() {
    this.fetch()
  },
}
</script>

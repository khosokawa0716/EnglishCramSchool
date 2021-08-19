<template>
  <div>
    <h1>Mypage</h1>
    <v-btn>test</v-btn>
    <div v-if="isAdmin">
      <router-link to="/admin">管理者用のマイページへ</router-link>
    </div>
  </div>
</template>
<script>
export default {
  computed: {
    isAdmin() {
      return this.$store.getters['auth/username'] === 'admin'
    },
  },
}
</script>

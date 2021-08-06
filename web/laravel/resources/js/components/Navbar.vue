<template>
  <v-app-bar color="cyan lighten-5" absolute>
    <RouterLink to="/"> 英語塾 </RouterLink>
    <span> username </span>
    <div>
      <RouterLink to="/login"> Login / Register </RouterLink>
    </div>
    <v-btn color="primary" @click="logout">Logout</v-btn>
  </v-app-bar>
</template>
<script>
export default {
  methods: {
    async logout() {
      await this.$store.dispatch('auth/logout')
      this.$router.push('/login')
    },
  },
}
</script>

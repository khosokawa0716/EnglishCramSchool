<template>
  <v-app>
    <Navbar />
    <main>
      <div class="container">
        <RouterView />
      </div>
    </main>
    <Footer />
  </v-app>
</template>
<script>
import Navbar from './components/Navbar.vue'
import Footer from './components/Footer.vue'

export default {
  components: {
    Navbar,
    Footer
  }
}
</script>
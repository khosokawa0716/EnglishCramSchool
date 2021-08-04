<template>
  <v-app-bar color="cyan lighten-5" absolute>
    <RouterLink to="/"> 英語塾 </RouterLink>
    <span> username </span>
    <div>
      <RouterLink to="/login"> Login / Register </RouterLink>
    </div>
    <v-btn color="primary">Logout</v-btn>
  </v-app-bar>
</template>

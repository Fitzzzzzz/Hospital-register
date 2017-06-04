<template>
  <div id="app">
    <router-view></router-view>
    <v-footer :style="{textAlign: 'center'}">
          Ant Design ©2016 Created by Ant UED
        </v-footer>
  </div>
</template>

<script>
export default {
  name: 'app'
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
}
.container {
  width: 100%;
  max-width: 1350px;
  margin: 0 auto;
}
</style>

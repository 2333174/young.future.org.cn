<template>
  <div id="app">
      <router-view/>
  </div>
</template>

<script>
import sider from '@/components/sider.vue'
export default {
  name: 'App',
  components:{
    sider,
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  position:absolute;
  left: 0;
  right: 0;
}
</style>

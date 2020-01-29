<template>
<div>
  <div class="listpage">
   <homeheader/>
  </div>
  <!-- <homeheader/> -->
  <!-- <router-view/> -->
  <div>{{$store.state.listType}}</div>
</div>
</template>

<script>
import homeheader from '@/components/header.vue'
export default {
  components:{
      homeheader
  },
  watch: {
    listType:''
  },
}
</script>

<style>
.listpage {
    background-image: url("/static/img/bg.png");
    position: relative;
    background-color: #49b1f5;
    background-position: center;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    background-size: cover;
    background-attachment: local;
    height: 100vh;
}
</style>
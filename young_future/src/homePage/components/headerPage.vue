<template>
<div class="full_page" id="nav" >
   <homeheader/>
</div>
</template>

<script>
import homeheader from '@/components/header.vue'
export default {
  components:{
    homeheader
  }
}
</script>

<style lang="less">

#nav {
  background-image: url("/static/img/cover_future.png");
  position: relative;
  background-color: #49b1f5;
  background-position: center;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  background-size: cover;
}
#nav.full_page {
  background-attachment: local;
  height: 100vh;
}
@media (min-width:500px) {
  #nav {
    background-image: url("/static/img/cover_future.png");
  }
}
@media (max-width:500px) {
  #nav {
    background-image: url("/static/img/phonebg.png");
  }
}
</style>
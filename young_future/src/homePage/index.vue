<template>
  <div class="homePage">
    <headPage/>
    <columnPage/>
  </div>
</template>

<script>
import headPage from '@/homePage/components/headerPage.vue'
import columnPage from '@/homePage/components/columnPage.vue'
export default {
  components:{
        headPage,
        columnPage
  },
  mounted(){
    document.title='珞珈青年网'
  }
}
</script>

<style>
.homePage{
  height: 100vh;
  overflow:auto;
}
*::-webkit-scrollbar {
  width: 8px;
  height: 8px;
}
*::-webkit-scrollbar-thumb {
  background: #409eff;
}
*::-webkit-scrollbar-track {
  background-color: transparent;
}
</style>
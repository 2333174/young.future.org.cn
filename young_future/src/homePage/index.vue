<template>
  <div class="homePage">
    <headPage/>
    <columnPage/>
    <secolPage/>
    <footsection/>
  </div>
</template>

<script>
import headPage from '@/homePage/components/headerPage.vue'
import columnPage from '@/homePage/components/columnPage.vue'
import secolPage from '@/homePage/components/secondColumnPage.vue'
import footsection from '@/components/footsection.vue'
export default {
  components:{
        headPage,
        columnPage,
        secolPage,
        footsection
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
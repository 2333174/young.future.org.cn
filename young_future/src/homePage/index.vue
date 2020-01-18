<template>
  <div>
    <headPage/>
  </div>
</template>

<script>
import headPage from '@/homePage/components/headerPage.vue'
export default {
  components:{
        headPage
  },
  mounted(){
    document.title='珞珈青年网'
  }
}
</script>

<style>

</style>
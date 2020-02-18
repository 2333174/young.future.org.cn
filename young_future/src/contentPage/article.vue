<template>
  <div style="height:100vh;overflow:auto;">
    <homeheader/>
    <div class="main">
      <el-card class="articleTitle">

      </el-card>
      <el-card class="articleContent">

      </el-card>
    </div>
    <footSection/>
  </div>

</template>

<script>
import homeheader from '@/components/header.vue'
import footSection from '@/components/footSection.vue'
export default {
  data() {
    return {
      
    }
  },
  mounted() {
    console.log(this.$route.params.id);
    
  },
  components:{
      homeheader,
      footSection
  },
}
</script>

<style lang="less" scoped>
.main{
  padding:10px;
  background-color: #f1f1f1;
  min-height: 80vh;
  .articleTitle{
    margin-bottom: 10px;
  }
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
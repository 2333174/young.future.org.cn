<template>
<div style="height:100vh;overflow:auto;" >
  <div>
    <homeheader/>
    <div class='listMain'>
      <div class="listHeader">{{$store.state.listType}}</div>
      <el-card class='listCard'></el-card>
    </div>
  </div>
  <footSection/>
  <img src="/static/img/bg.png" class="listBackground"/>
  <!-- <div class="listpage">
  </div> -->
  <!-- <homeheader/> -->
  <!-- <router-view/> -->

</div>
</template>

<script>
import homeheader from '@/components/header.vue'
import footSection from '@/components/footSection.vue'
export default {
  components:{
      homeheader,
      footSection
  },
  watch: {
    listType:''
  },
}
</script>

<style lang='less'>
.listBackground{
  position: absolute;
  top:0px;
  left: 0;
  z-index: -1;
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.listMain{
  width:90%;
  margin: 40px auto 40px;
  .listCard{
    background-color: rgba(134, 150, 167, 0.6);
    width:100%;
    border: none;
    min-height: 100vh;
  }
  .listHeader{
    text-align: left;
    font-size: 40px;
    font-weight: bold;
    color: black;
    font-family: "华文行楷";
    margin-left: 10px;
    margin-bottom: 20px;
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
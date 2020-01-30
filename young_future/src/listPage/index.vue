<template>
<div>
  <div>
    <homeheader/>
    <el-card class='listCard'>
      <div>
        <span class="listHeader">{{$store.state.listType}}</span>
      </div>
    </el-card>
  </div>
  <img src="/static/img/bg.png" class="listBackground"/>
  <!-- <div class="listpage">
  </div> -->
  <!-- <homeheader/> -->
  <!-- <router-view/> -->

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

<style lang='less'>
.listpage {
  background-image: url("/static/img/bg.png");
  position: absolute;
  top:0px;
  left: 0;
  background-color: #49b1f5;
  background-position: center;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  background-size: cover;
  background-attachment: local;
  height: 100vh;
  z-index: -1;
}
.listBackground{
  position: absolute;
  top:0px;
  left: 0;
  z-index: -1;
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.listCard{
      background-color: rgba(134, 150, 167, 0.6);
      width:90%;
      margin: 40px auto auto;
      border: none;
      .listHeader{
        font-size: 20px;
        font-weight: bold;
        font-family: SJ;
        padding: 0 10px;
        border: 2px solid rgb(101,101,101);
      }
    }
</style>
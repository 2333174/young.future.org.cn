<template>
<div style="height:100vh;overflow:auto;" >
  <div>
    <homeheader/>
    <div class='listMain'>
      <div class="listHeader">{{$store.state.listType}}</div>
      <el-card class='listCard'>
        <div v-for="item in listData.slice((currentPage - 1) * pageSize ,currentPage * pageSize < this.total?currentPage * pageSize:this.total)"  class="item">
          <a :href="item.link" target="_blank">
          <span style="font-weight:bold;">{{item.title}}</span>
          <span style="float:right">{{item.date}}</span>
          </a>
        </div>
        <div style="margin-top: 20px" class="pag">
          <el-pagination
          background
          :current-page.sync="currentPage"
          :page-size="pageSize"
          layout="total,prev, pager, next, jumper"
          :total="total">
        </el-pagination>
        </div>
      </el-card>
    </div>
  </div>
  <footSection/>
  <img src="/static/img/image/1.JPG" class="listBackground"/>

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
  data(){
    return{
      currentPage:1,
      pageSize:12,
      listData:this.$store.state.listData,
      total:this.$store.state.listData.length,
    }
    },
    components:{
      homeheader,
      footSection
  },
  watch: {
    listType:'',
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

}
.listMain{
  width:80%;
  margin: 40px auto 40px;
  .listCard{
    background-color: rgba(134, 150, 167, 0.6);
    width:100%;
    border: none;
    min-height: 100vh;
    position: relative;
    .el-card__body{
      padding-top: 40px;
    }
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
.pag{
  position: absolute;
  bottom: 20px;
  left:0;
  right: 0;
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
a{
  font-size: 17px;
  color: black;
}
a:link{
  text-decoration:none;
}
a:hover{
  color:#14427E;
}
.item {
  font-size: 18px;
  cursor: pointer;
  padding: 9px 5px;
  border-bottom:1px dashed lightgray;
  text-align: left;
}

</style>

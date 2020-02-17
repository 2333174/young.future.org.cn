<template>
<div style="height:100vh;overflow:auto;" >
  <div>
    <homeheader/>
    <div class='listMain'>
      <div class="listHeader">{{$store.state.listType}}</div>
      <el-card class='listCard'>
        <div v-for="item in $store.state.listData.slice((currentPage - 1) * pageSize ,currentPage * pageSize < $store.state.listData.length?currentPage * pageSize:$store.state.listData.length)"  class="item">
          <a :href="item.link" target="_blank">
          <span style="font-weight:bold;">{{item.pTitle}}</span>
          <span style="float:right">{{item.pUpdateTime|normalizeTime}}</span>
          </a>
        </div>
        <div style="margin-top: 20px" class="pag">
          <el-pagination
          background
          :current-page.sync="currentPage"
          :page-size="pageSize"
          layout="total,prev, pager, next, jumper"
          :total="$store.state.listData.length">
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
      // listData:this.$store.state.listData,
      // total:this.$store.state.listData.length,
    }
    },
    components:{
      homeheader,
      footSection
  },
  watch:{
    '$store.state.listType':function(newFlag, oldFlag){
       console.log(newFlag,oldFlag);
       this.$axios.get("/api/php/getListPage.php?type="+newFlag).then((res)=>{
         if(res.data.status=='success'){
          this.$store.state.listData=res.data.list
         }else{
           this.$message.error(res.data.message)
         }
       })
       //更新列表数据
    }
  },
  mounted() {
    console.log(this.$store.state.listType,'test');
    switch (this.$route.query.type) {
      case "news":
        this.$store.state.listType="新闻"
        break;
      case "literature":
        this.$store.state.listType="文韵"
        break;
      case "newspaper":
        this.$store.state.listType="珞青报"
        break;
      case "courier":
        this.$store.state.listType="最新速递"
        break;
      case "handpicked":
        this.$store.state.listType="往期精选"
        break;
      case "topic":
        this.$store.state.listType="专题"
        break;
      default:
        break;
    }
    this.$axios
      .get("/api/php/getListPage.php?type="+this.$store.state.listType)
      .then((res)=>{
        if(res.data.status=='success'){
        this.$store.state.listData=res.data.list
        }else{
          this.$message.error(res.data.message)
        }
    })
  },
  filters:{
    normalizeTime(strDate) {
      var date = new Date(strDate)
      var timeNum = 8 //小时数
      date.setHours(date.getHours() + timeNum)
      var y = date.getFullYear()
      var m = date.getMonth() + 1
      m = m < 10 ? '0' + m : m
      var d = date.getDate()
      d = d < 10 ? '0' + d : d
      var str = y + '-' + m + '-' + d
      return str
    }
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
  .el-pagination__total {
    color:black;
    font-weight: bold;
  }
  .el-pagination__jump {
    margin-left: 24px;
    font-weight: bold;
    color: black;
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

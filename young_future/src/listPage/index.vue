<template>
<div style="height:100vh;overflow:auto;" >
  <div>
    <homeheader/>
    <div class='listMain'>
      <div class="listHeader">{{$store.state.listType}}</div>
      <el-card 
        class='listCard' 
        v-loading='loading' 
        element-loading-text="加载中"
        element-loading-background="rgba(134, 150, 167, 0.6)">
        <div v-if="$store.state.listType!='珞青报'&&loadFinish" v-for="item in $store.state.listData.slice((currentPage - 1) * pageSize ,currentPage * pageSize < $store.state.listData.length?currentPage * pageSize:$store.state.listData.length)"  class="item">
          <a @click="$router.push('/article/'+item.pID)" target="_blank">
          <span style="font-weight:bold;">{{item.pTitle}}</span>
          <span style="float:right">{{item.pUpdateTime|normalizeTime}}</span>
          </a>
        </div>

        <div v-if="$store.state.listType =='珞青报'&&loadFinish " align="center">
          <el-row class="newspaperList">
            <el-col  v-for="item in $store.state.listData.slice((currentPage - 1) * pageSize, (currentPage - 1) * pageSize+12)" :key="item.title" >
              <el-card :body-style="{ padding: '0px' }" style="margin:0px 0px 37px 0px" >
                <el-image :src="'/api/newspaper/'+item.title+'/cover.jpg'" class="image"/>
                <div style="padding: 0px;">
                  <div class="bottom clearfix" style="padding-bottom: 10px;">
                    <div class="text">{{item.title}}</div>
                    <div class="time">{{item.uploadTime | normalizeTime}}</div>   
                    <el-button  class="button" size="mini" type="primary" @click="$router.push('/newspaper/'+item.title)" round>查看详情 ></el-button>      
                  </div>
                </div>
              </el-card>
            </el-col>
          </el-row>
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
      loadFinish:false,
      loading:false,
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
       this.loadFinish=false
       this.loading=true
       console.log(newFlag,oldFlag);
       if (this.$route.query.type!=='search'){
        this.$axios.get("/api/php/getListPage.php?type="+newFlag).then((res)=>{
          this.loading=false
          if(res.data.status=='success'){
            this.$store.state.listData=res.data.list
            this.loadFinish=true
          }else{
            this.$message.error(res.data.message)
          }
        })
       }else{
         this.$axios
        .get("/api/php/getListPage.php?type=search&keyword="+this.$route.query.keyword)
        .then(res=>{
          this.loading=false
          if(res.data.status=='success'){
            this.$store.state.listData=res.data.list
            this.loadFinish=true
          }else{
            this.$message.error(res.data.message)
          }   
        })
       }
       //更新列表数据
    }
  },
  mounted() {
    console.log(this.$store.state.listType,'test');
    this.loadFinish=false
    this.loading=true
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
      case "search":
        this.$store.state.listType="搜索结果"
        break;
      default:
        break;
    }
    if (this.$route.query.type!=='search'){
      this.$axios
        .get("/api/php/getListPage.php?type="+this.$store.state.listType)
        .then((res)=>{
          console.log(res.data);
          this.loading=false
          if(res.data.status=='success'){
            this.$store.state.listData=res.data.list
            this.loadFinish=true
          }else{
            this.$message.error(res.data.message)
          }
      })
    }else if (this.$route.query.type==='search'){
      this.$axios
        .get("/api/php/getListPage.php?type=search&keyword="+this.$route.query.keyword)
        .then(res=>{
          this.loading=false
          if(res.data.status=='success'){
            this.$store.state.listData=res.data.list
            this.loadFinish=true
          }else{
            this.$message.error(res.data.message)
          }   
        })
    }
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

<style lang="less" scoped>
.listBackground{
  position: absolute;
  top:0px;
  left: 0;
  z-index: -1;
  width: 100%;
  height: 100%;

}
.listMain{
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
  /deep/ .el-pagination__total {
    color:black;
    font-weight: bold;
  }
  /deep/ .el-pagination__jump {
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

 .time {
    font-size: 13px;
    color: #999;
  }
  
  .bottom {
    margin-top: 13px;
    line-height: 12px;
  }


  .image {
    width: 100%;
    display: block;
  }

  .clearfix:before,
  .clearfix:after {
      display: table;
      content: "";
  }
  
  .clearfix:after {
      clear: both
  }
  .news {

  }
  .text {
    font-size:15px;
    margin:0px 0px 7px 0px;
    line-height:20px;
    font-family: Heiti SC;
    font-weight: 520
  }

  .newspaperList {
    margin-bottom: 20px;
    &:last-child {
      margin-bottom: 0;
    }
  }
  .row-bg {
    padding: 10px 0;
  }
@media (min-width: 900px) {
  .button {
    margin:5px 5px 0px 0px;
    
  }
}
@media (max-width: 900px) {
  .button {
    margin:5px 5px 0px 0px;
    
  }
}
@media (min-width: 700px) {
  .listMain{
    width: 80%
  }
  .el-col {
    width:25%;
    border-radius: 4px;
    padding-right:20px;
    padding-left:20px;
  }
}
@media (max-width: 700px) {
  .listMain{
    width: 95%
  }
  .el-col {
    width:50%;
    border-radius: 4px;
    padding-right:20px;
    padding-left:20px;
  }
}
</style>

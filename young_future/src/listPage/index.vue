<template>
<div style="height:100vh;overflow:auto;" >
  <div>
    <homeheader/>
    <div class='listMain'>
      <div class="listHeader">{{$store.state.listType}}</div>
      <el-card class='listCard'>
        <div v-if="$store.state.listType!='珞青报'" v-for="item in listData.slice((currentPage - 1) * pageSize ,currentPage * pageSize < this.total?currentPage * pageSize:this.total)"  class="item">
          <a :href="item.link" target="_blank">
          <span style="font-weight:bold;">{{item.title}}</span>
          <span style="float:right">{{item.date}}</span>
          </a>
        </div>

<div v-if="$store.state.listType ='珞青报' " align="center">

<div >
<el-row type="flex" class="row-bg" justify="space-around" >
  <el-col :span="5" v-for="item in listData.slice(0, 4)" :key="item.title" >
    <el-card :body-style="{ padding: '3px' }" style="margin:0px 0px 37px 0px" >
      <img :src="item.imgsrc" class="image">
      <div style="padding: 0px;">
        <div class="bottom clearfix" style="padding-bottom: 10px;">
          <el-button  class="button" size="mini" type="primary" @click="$router.push('/newspaper/'+item.title)" round>查看详情 ></el-button>
          <div class="text">{{item.title}}</div>
          <div class="time">{{item.date}}</div>         
        </div>
      </div>
    </el-card>
  </el-col>
</el-row>
</div>
<div >
<el-row type="flex" class="row-bg" justify="space-around" >
  <el-col :span="5" v-for="item in listData.slice(0, 4)" :key="item.title" >
    <el-card :body-style="{ padding: '3px' }" style="margin:0px 0px 37px 0px" >
      <img :src="item.imgsrc" class="image">
      <div style="padding: 0px;">
        <div class="bottom clearfix" style="padding-bottom: 10px;">
          <el-button  class="button" size="mini" type="primary" @click="$router.push('/newspaper/'+item.title)" round>查看详情 ></el-button>
          <div class="text">{{item.title}}</div>
          <div class="time">{{item.date}}</div>       
        </div>
      </div>
    </el-card>
  </el-col>
</el-row>
</div>
<div >
<el-row type="flex" class="row-bg" justify="space-around" >
  <el-col :span="5" v-for="item in listData.slice(0, 4)" :key="item.title" >
    <el-card :body-style="{ padding: '3px' }" style="margin:0px 0px 37px 0px" >
      <img :src="item.imgsrc" class="image">
      <div style="padding: 0px;">
        <div class="bottom clearfix" style="padding-bottom: 10px;">
          <el-button  class="button" size="mini" type="primary" @click="$router.push('/newspaper/'+item.title)" round>查看详情 ></el-button>
          <div class="text">{{item.title}}</div>
          <div class="time">{{item.date}}</div>   
        </div>
      </div>
    </el-card>
  </el-col>
</el-row>
</div>

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
  data(){
    message: 'welcome'

    time: '上传时间'
  
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

 .time {
    font-size: 13px;
    color: #999;
  }
  
  .bottom {
    margin-top: 13px;
    line-height: 12px;
  }

  .button {
    padding: 0;
    float: right;
    margin:0px 5px 0px 0px;
    
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

  .el-row {
    margin-bottom: 20px;
    &:last-child {
      margin-bottom: 0;
    }
  }
  .el-col {
    border-radius: 4px;
  }
  .row-bg {
    padding: 10px 0;
  }
</style>

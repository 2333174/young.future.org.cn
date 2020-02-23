<template>
  <div class="column_second">
    <div class="newspaper_column" v-waypoint="{ active: true, callback: onWaypoint_newspaper, options: intersectionOptions }">
     <el-container>
        <el-header>
          <div style="margin: 15px;">
            <span class="news-header">珞&nbsp;&nbsp;青&nbsp;&nbsp;报</span>
          </div>  
        </el-header>
        <el-row class="newspaperRow" justify="center" :gutter="50">
          <el-col class="newspaperCol" v-for="item in LQBList" :key="item.title" >
            <div >
              <el-card :body-style="{ padding: '0px' }">
                <div >
                  <img :src="'/api/newspaper/'+item.title+'/cover.jpg'" style="width:100%" />
                  <div style="padding-bottom: 10px;">
                    <div>
                      <el-button type="text" class="button" @click="$router.push('/newspaper/'+item.title)">{{item.title}}</el-button>
                      <div>{{ item.uploadTime|normalizeTime }} </div>
                    </div>
                  </div>
                </div>
              </el-card>
            </div>
          </el-col>
        </el-row>
     </el-container> 
    </div>
    <div class="muti_column" v-waypoint="{ active: true, callback: onWaypoint_muti, options: intersectionOptions }">
      <el-row :gutter="6" style="margin:15px 10px auto">
        <el-col class="mutiCol" align="center">
          <el-card class="el-card1" shadow="hover">
            <div slot="header">
              <span>最新速递</span>
              <el-button class="buttonMore" type="text" @click="$router.push({path:'/listpage',query:{type:'courier'}});$store.state.listType='最新速递'">
                更多
              </el-button>
            </div>
          <div class='columnCard' v-for="item in newsqList">
            <span class="infospan" @click="$router.push('/article/'+item.pID)">
              <div class="listContain">
                {{item.pTitle}}
              </div>
              <div class="listDate">
                {{item.pUpdateTime|normalizeTime}}
              </div>
            </span>
          </div>
          </el-card>
        </el-col>
          <el-col class="mutiCol" align="center">
            <el-card class="el-card2" shadow="hover">
              <div slot="header" :header-row-style="{height:'100px'}">
                <span>往期精彩</span>
                <el-button class="buttonMore" type="text" @click="$router.push({path:'/listpage',query:{type:'handpicked'}});$store.state.listType='往期精选'">
                  更多
                </el-button>
              </div>
              <div class='columnCard' v-for="item in handPickedList">
                <span class="infospan" @click="$router.push('/article/'+item.pID)" >
                  <div class="listContain">
                    {{item.pTitle}}
                  </div>
                  <div class="listDate">
                    {{item.pUpdateTime|normalizeTime}}
                  </div>
                </span>
              </div>
            </el-card>
          </el-col>
        <el-col class="mutiCol" align="center">
           <el-card class="el-card3" shadow="hover">
          <div slot="header">
            <span>专题</span>
            <el-button class="buttonMore" type="text" @click="$router.push({path:'/listpage',query:{type:'topic'}});$store.state.listType='专题'">
              更多
            </el-button>
          </div>
          <div class='columnCard' v-for="item in topicList">
              <span class="infospan" @click="$router.push('/article/'+item.pID)">
                <div class="listContain">
                  {{item.pTitle}}
                </div>
                <div class="listDate">
                  {{item.pUpdateTime|normalizeTime}}
                </div>
              </span>
          </div>
        </el-card>
        </el-col>
      </el-row>
    </div>

  </div>
</template>

<script>
export default {
  data() {
    return {
      intersectionOptions: {
        root: null,
        rootMargin: '0px 0px 0px 0px',
        threshold: 0.1 // [0.25, 0.75] if you want a 25% offset!
      },
    }
  },
  props:["LQBList","newsqList","handPickedList","topicList"],
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
  methods: {
    onWaypoint_muti ({ el, going, direction }) {
      // going: in, out
      // direction: top, right, bottom, left      
      if (going === this.$waypointMap.GOING_IN) {
        $(el).addClass("animated slideInLeft")
      }
    },
    onWaypoint_newspaper ({ el, going, direction }) {
      // going: in, out
      // direction: top, right, bottom, left      
      if (going === this.$waypointMap.GOING_IN) {
        $(el).addClass("animated slideInLeft")
      }
    },
  },
}
</script>

<style lang="less">
.column_second{
  background-attachment: local;
  height: auto;
  background-color: white;
}
.muti_column{
  min-height: 464px; 
  background-color: #e1e5e7;
  padding-top: 50px;
  .el-card1 {
    background-image: url("/static/img/image/bac1.jpg");
    width: 98%;
    display: block;
  }
  .el-card2 {
    background-image: url("/static/img/image/bac2.jpg");
      width: 98%;
      display: block;
    }
  .el-card3 {
    background-image: url("/static/img/image/bac3.jpg");
    width: 98%;
    display: block;
  }
  .el-card__body {
    padding-left: 0px;
    padding-top: 10px;
    height:200px;
  }
  .listContain{
    width: 60%;
    line-height: 20px;
    padding: 5px;
    text-align: left;
    float: left;
    padding-left: 0px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space:nowrap;
    margin-left: 5px;
  }
  .listDate{
    float: right;
    height: 25px;
  }
  .el-card__header{
    font-size: 25px;
    font-weight: bold;
    color:darkslategray;
  }
}
.buttonMore{
  float: right;
  color: cadetblue;
}
.infospan{
  cursor: pointer;
  font-size: 17px;
  color: black;
}
a:link{
  text-decoration:none;
}
.infospan:hover{
  color:steelblue;
}
.newspaper_column{
  min-height: 464px;
  padding-top: 20px;
}
.news-header{
  font-size: 20px;
  font-weight: bold;
  font-family: SJ;
  padding: 0 10px;
  border: 2px solid rgb(101,101,101);
  }
@media (min-width: 700px) {
  .newspaperRow{
    margin:15px 20px 10px !important;
  }
  .newspaperCol{
    width:25%;
    margin-bottom:30px;
  }
  .mutiCol{
    width:33%
  }
}
@media (max-width: 700px) {
  .newspaperRow{
    margin:15px 0px 10px !important;
  }
  .newspaperCol{
    width:50%;
    margin-bottom:20px;
  }
  .mutiCol{
    width:100%;
    margin-bottom: 20px;
    .el-card1,.el-card2,.el-card3{
      background-image: none
    }
  }
}
</style>
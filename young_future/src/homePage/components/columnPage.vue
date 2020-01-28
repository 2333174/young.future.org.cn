<template>
<div class="column-first">
  <section class="newsColumn" v-waypoint="{ active: true, callback: onWaypoint_news, options: intersectionOptions }" >
    <div style="padding:15px;">
      <span class="news-header">新&nbsp;&nbsp;闻</span>
    </div>
    <div class="news-area">
      <div class="news_block">
        <el-carousel @change="newsChange">
          <el-carousel-item v-for="item in newsList" :key="item.title">
            <img :src="item.imgUrl" style="width:100%"/>
          </el-carousel-item>
        </el-carousel>
      </div>
      <div class="news-card">
        <el-card class="news-card" shadow="hover">
          <div slot="header" class="cardHeader">
            <span style="padding-left:5px;">新闻</span>
            <el-button type="primary" style="float: right; padding: 3px 5px;margin-right:5px;">更多<i class="el-icon-arrow-right el-icon--right"></i></el-button>
            <!-- <el-button style="float: right; padding: 3px 5px" icon="el-icon-more" type="primary"></el-button> -->
          </div>
          <div v-for="newsItem in newsList" :key="newsItem.title" :class="{'item':true,'itemScroll':newsItem.isScroll}">
            <span style="font-weight:bold">{{newsItem.title}}</span>
            <span style="float:right">{{newsItem.date}}</span>
          </div>
        </el-card>
      </div>
    </div>
  </section>
  <section class="art-Column" v-waypoint="{ active: true, callback: onWaypoint_art, options: intersectionOptions }">
    <div style="padding:15px;">
      <span class="art-header">文&nbsp;&nbsp;韵</span>
    </div>
    <div class="art-area">
      <div class="art-card">
        <el-card class="art-card" shadow="hover">
          <div slot="header" class="cardHeader">
            <span style="padding-left:5px;">文韵</span>
            <el-button type="primary" style="float: right; padding: 3px 5px;margin-right:5px;">更多<i class="el-icon-arrow-right el-icon--right"></i></el-button>
            <!-- <el-button style="float: right; padding: 3px 5px" icon="el-icon-more" type="primary"></el-button> -->
          </div>
          <div v-for="artItem in artList" :key="artItem.title" class="item">
            <span style="font-weight:bold">{{artItem.title}}</span>
            <span style="float:right">{{artItem.date}}</span>
          </div>
        </el-card>
      </div>
      <div class="art_block">
          <img src="/static/img/cover_future.png" style="width:100%"/>
          <!-- <el-carousel @change="newsChange">
            <el-carousel-item v-for="item in newsList" :key="item.title">
              <img :src="item.imgUrl" style="width:100%"/>
            </el-carousel-item>
          </el-carousel> -->
      </div>
    </div>
  </section>
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
      carousel_list:["/static/img/cover.jpg","/static/img/cover_future.png"],
      newsList:[
        {title:"新闻一",imgUrl:"/static/img/cover.jpg",date:"2019-01-02",isScroll:true},
        {title:"新闻二",imgUrl:"/static/img/cover_future.png",date:"2019-01-03",isScroll:false},
        {title:"新闻三",imgUrl:"/static/img/bg.png",date:"2019-01-04",isScroll:false},
        {title:"新闻四",imgUrl:"/static/img/42.jpg",date:"2019-01-05",isScroll:false},
        {title:"新闻五",imgUrl:"/static/img/bg.png",date:"2019-01-01",isScroll:false},
      ],
      artList:[
        {title:"文章标题一",date:"2019-01-02",isScroll:true},
        {title:"文章标题二",date:"2019-01-03",isScroll:false},
        {title:"文章标题三",date:"2019-01-04",isScroll:false},
        {title:"文章标题四",date:"2019-01-05",isScroll:false},
        {title:"文章标题五",date:"2019-01-01",isScroll:false},
      ]
    }
  },
  mounted() {
    
  },
  methods: {
    onWaypoint_news ({ el, going, direction }) {
      // going: in, out
      // direction: top, right, bottom, left      
      if (going === this.$waypointMap.GOING_IN) {
        console.log('news waypoint going in!')
        $(el).addClass("animated slideInLeft")
      }
    },
    onWaypoint_art ({el, going, direction }) {
      // going: in, out
      // direction: top, right, bottom, left
      if (going === this.$waypointMap.GOING_IN) {
        console.log('art waypoint going in!')
        $(el).addClass("animated slideInLeft")
      }
    },
    newsChange(index){  
      this.newsList[index].isScroll=true;
      let m = index-1>=0? index-1:this.newsList.length-1
      this.newsList[m].isScroll=false;
      m = index+1<this.newsList.length?index+1:0;
      this.newsList[m].isScroll=false;
    }
  },
}
</script>

<style lang="less">
.column-first{
  background-attachment: local;
  background-color: white;
  height: 140vh;
}
.cardHeader{
  font-size: 18px;
  font-weight: bold;
}
.cardHeader:before,
.cardHeader:after{
    display: table;
    content: "";
}
.cardHeader:after {
  clear: both;
}
.newsColumn{
  margin-top: 10px;
  background-attachment: local;
  background-color: white;
  display: block;
  padding-top: 10px;
  height: 50%;
   .news-header{
    font-size: 20px;
    font-weight: bold;
    font-family: SJ;
    padding: 0 10px;
    border: 2px solid rgb(101,101,101);
  }
  .news-area{
    display: flex;
    width: 100%;
    margin-top: 30px;
    justify-content: center;
    .news_block{
      display: flex;
      width: 40%;
      margin-right:40px;
      .el-carousel{
        width: 100%;
      }
    }
    .news-card{
      text-align: left;
      display: flex;
      width: 40%;
      .el-card{
        width:100%;
        display:block;
        .item {
          font-size: 15px;
          cursor: pointer;
          padding: 9px 5px; 
          border-bottom:1px dashed lightgray; 
        }
        .item:hover{
          color: #409EFF;
        }
      }
    }
  }
}
.itemScroll{
  background-color: #e1e5e7;
}
.art-Column{
  background-attachment: local;
  height: 50%;
  display: block;
  background-color: #e1e5e7;
  padding-top: 20px;
  .art-header{
    font-size: 20px;
    font-weight: bold;
    font-family: SJ;
    padding: 0 10px;
    border: 2px solid rgb(0,0,0);
    color: #000;
  }
  .art-area{
    display: flex;
    width: 100%;
    margin-top: 30px;
    justify-content: center;
    .art_block{
      display: flex;
      width: 40%;
      margin-left:40px;
      img{
        box-shadow: 0 2px 4px rgba(0, 0, 0, .12), 0 0 6px rgba(0, 0, 0, .04);
        border: 1px solid #EBEEF5;
      }
    }
    .art-card{
      text-align: left;
      display: flex;
      width: 40%;
      .el-card{
        width:100%;
        display:block;
        .item {
          font-size: 15px;
          cursor: pointer;
          padding: 9px 5px; 
          border-bottom:1px dashed lightgray; 
        }
        .item:hover{
          color: #409EFF;
        }
      }
    }
  }
  
}

</style>
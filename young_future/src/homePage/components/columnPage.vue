<template>
  <div class="column_first">
    <div class="newsColumn">
      <div style="padding:15px;">
        <span class="news-header">新&nbsp;&nbsp;闻</span>
      </div>
      <div class="news-area">
        <div class="news_block">
            <el-carousel>
              <el-carousel-item v-for="item in carousel_list" :key="item">
                <img :src="item" style="width:100%"/>
              </el-carousel-item>
            </el-carousel>
        </div>
        <div class="news-card">
          <el-card class="news-card" shadow="hover">
            <div slot="header" class="cardHeader">
              <span>新闻</span>
            </div>
            <div v-for="newsItem in newsList" :key="newsItem.content" :class="{'item':true,'itemScroll':newsItem.isScroll}">
              {{newsItem.content}}
            </div>
          </el-card>
        </div>
      </div>
    </div>
    <div class="muti-Column">

    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      carousel_list:["/static/img/cover.jpg","/static/img/cover_future.png"],
      newsList:[
        {content:"新闻一",isScroll:false},
        {content:"新闻二",isScroll:false},
        {content:"新闻三",isScroll:false},
        {content:"新闻四",isScroll:false},
      ]
    }
  },
}
</script>

<style lang="less">
.column_first{
  background-attachment: local;
  height: 140vh;
  background-color: white;
}
.newsColumn{
  margin-top: 20px;
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
      display: flex;
      width: 40%;
      .el-card{
        width:100%;
        display:block;
        .item {
          font-size: 16px;
          cursor: pointer;
          margin-bottom: 18px;
          padding-top:3px;
          padding-bottom:3px; 
        }
        .item:hover{
          background-color: gray;
        }
      }
    }
  }
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
.muti-Column{
  height: 50%;
  background-color: #e1e5e7;
}
.itemScroll{
  background-color: #e1e5e7;
}


</style>
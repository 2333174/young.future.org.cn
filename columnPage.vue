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
      <el-row class="el-row">
        <el-col :span="8" align="center">
          <el-card class="el-card1" shadow="hover">
            <div slot="header">
              <span>新闻速递</span>
              <el-button class="buttonMore" type="text" onClick="window.open('http://www.baidu.com')">
                更多
              </el-button>
            </div>
          <div>
              <ul style="list-style: none">
                <li >
                  <a href="http://www.baidu.com" target="_blank">
                    <div class="listContain">
                      【土建】观脱贫成效，奔全面小康
                    </div>
                    <div class="listDate">
                      2020-01-19
                    </div>
                  </a>
                </li>
                <li >
                  <a href="http://www.baidu.com" target="_blank">
                    <div class="listContain">
                      【法院】情系母校，缘梦武大——会同一中，我们回来啦
                    </div>
                    <div class="listDate">
                      2020-01-18
                    </div>
                  </a>
                </li>
                <li >
                  <a href="http://www.baidu.com" target="_blank">
                    <div class="listContain">
                      【水利】水利水电学院举办寒假实践培训活动
                    </div>
                    <div class="listDate">
                      2020-01-18
                    </div>
                  </a>
                </li>
                <li >
                  <a href="http://www.baidu.com" target="_blank">
                    <div class="listContain">
                      【土建】载阳承梦，莹莹予众
                    </div>
                    <div class="listDate">
                      2020-01-18
                    </div>
                  </a>
                </li>
              </ul>
          </div>
          </el-card>
        </el-col>
          <el-col :span="8" align="center">
            <el-card class="el-card2" shadow="hover">
              <div slot="header" class="card-header" :header-row-style="{height:'100px'}">
                <span>往期精彩</span>
                <el-button class="buttonMore" type="text" onClick="window.open('http://www.baidu.com')">
                  更多
                </el-button>
              </div>
              <div>
                <ul style="list-style: none">
                  <li>
                    <a href="http://www.baidu.com" target="_blank">
                      <div class="listContain">
                        【土建】观脱贫成效，奔全面小康
                      </div>
                      <div class="listDate">
                        2020-01-19
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="http://www.baidu.com" target="_blank">
                      <div class="listContain">
                        【法院】情系母校，缘梦武大——会同一中，我们回来啦
                      </div>
                      <div class="listDate">
                        2020-01-18
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="http://www.baidu.com" target="_blank">
                      <div class="listContain">
                        【水利】水利水电学院举办寒假实践培训活动
                      </div>
                      <div class="listDate">
                        2020-01-18
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="http://www.baidu.com" target="_blank">
                      <div class="listContain">
                        【土建】载阳承梦，莹莹予众
                      </div>
                      <div class="listDate">
                        2020-01-18
                      </div>
                    </a>
                  </li>
                </ul>
              </div>
            </el-card>
          </el-col>
        <el-col :span="8" align="center">
           <el-card class="el-card3" shadow="hover">
          <div slot="header" class="card-header">
            <span>专题</span>
            <el-button class="buttonMore" type="text" onClick="window.open('http://www.baidu.com')">
              更多
            </el-button>
          </div>
             <div>
               <ul style="list-style: none">
                 <li>
                   <a href="http://www.baidu.com" target="_blank">
                     <div class="listContain">
                       【土建】观脱贫成效，奔全面小康
                     </div>
                     <div class="listDate">
                       2020-01-19
                     </div>
                   </a>
                 </li>
                 <li>
                   <a href="http://www.baidu.com" target="_blank">
                     <div class="listContain">
                       【法院】情系母校，缘梦武大——会同一中，我们回来啦
                     </div>
                     <div class="listDate">
                       2020-01-18
                     </div>
                   </a>
                 </li>
                 <li>
                   <a href="http://www.baidu.com" target="_blank">
                     <div class="listContain">
                       【水利】水利水电学院举办寒假实践培训活动
                     </div>
                     <div class="listDate">
                       2020-01-18
                     </div>
                   </a>
                 </li>
                 <li>
                   <a href="http://www.baidu.com" target="_blank">
                     <div class="listContain">
                       【土建】载阳承梦，莹莹予众
                     </div>
                     <div class="listDate">
                       2020-01-18
                     </div>
                   </a>
                 </li>
               </ul>
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
     position: relative;
     display: inline-block;
     text-align: center;
     font-size: 2rem;
     padding: 30px;
     letter-spacing: 0.2rem;
     min-width: 18rem;

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
          background-color: lightsteelblue;
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
.muti-Column {
  height: 50%;
  margin-top: 50px;
  margin-left: 125px;
  margin-right: 125px;
  background-color: whitesmoke;
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
    padding-top: 30px;
    padding-bottom: 200px;
  }
    .listContain{
      width: 270px;
      height: 30px;
      text-align: left;
      float: left;
      padding-left: 0px;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space:nowrap;
      margin-left: 0px;
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
a{
  font-size: 17px;
  color: black;
}
a:link{
  text-decoration:none;
}
a:hover{
  color:steelblue;
}
</style>

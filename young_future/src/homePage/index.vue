<template>
  <div class="homePage">
    <headPage/>
    <columnPage :newsList="newsList" :artList="artList"/>
    <secolPage :LQBList="LQBList" :newsqList="newsqList" :handPickedList="handPickedList" :topicList="topicList" />
    <footSection/>
  </div>
</template>

<script>
import headPage from '@/homePage/components/headerPage.vue'
import columnPage from '@/homePage/components/columnPage.vue'
import secolPage from '@/homePage/components/secondColumnPage.vue'
import footSection from '@/components/footSection.vue'
export default {
  data() {
    return {
      newsList:[
        {pID:"1",pTitle:"新闻一",imgUrl:"/static/img/cover.jpg",pUpdateTime:"2019-01-02",isScroll:true},
        {pID:"2",pTitle:"新闻二",imgUrl:"/static/img/cover_future.png",pUpdateTime:"2019-01-03",isScroll:false},
        {pID:"3",pTitle:"新闻三",imgUrl:"/static/img/bg.png",pUpdateTime:"2019-01-04",isScroll:false},
        {pID:"4",pTitle:"新闻四",imgUrl:"/static/img/42.jpg",pUpdateTime:"2019-01-05",isScroll:false},
        {pID:"5",pTitle:"新闻五",imgUrl:"/static/img/bg.png",pUpdateTime:"2019-01-01",isScroll:false},
      ],
      artList:[
        {pID:"6",pTitle:"文章标题一",pUpdateTime:"2019-01-02"},
        {pID:"7",pTitle:"文章标题二",pUpdateTime:"2019-01-03"},
        {pID:"8",pTitle:"文章标题三",pUpdateTime:"2019-01-04"},
        {pID:"9",pTitle:"文章标题四",pUpdateTime:"2019-01-05"},
        {pID:"10",pTitle:"文章标题五",pUpdateTime:"2019-01-01"},
      ],
      LQBList:[
      {title:"珞青报标题一",imgUrl:"/static/img/image/bac1.jpg",updateTime:"2019-01-02"},
      {title:"珞青报标题二",imgUrl:"/static/img/image/bac1.jpg",updateTime:"2019-01-03"},
      {title:"珞青报标题三",imgUrl:"/static/img/image/bac1.jpg",updateTime:"2019-01-04"},
      {title:"珞青报标题四",imgUrl:"/static/img/image/bac1.jpg",updateTime:"2019-01-05"},
      ],
      newsqList:[
        {
          pID:"11",
          pTitle:'【土建】观脱贫成效，奔全面小康',
          pUpdateTime:'2020-01-19'
        },
        {
          pID:"12",
          pTitle:'【法院】情系母校，缘梦武大——会同一中，我们回来啦',
          pUpdateTime:'2020-01-18'
        },
        {
          pID:"13",
          pTitle:'【水利】水利水电学院举办寒假实践培训活动',
          pUpdateTime:'2020-01-18'
        },
        {
          pID:"14",
          pTitle:'【土建】载阳承梦，莹莹予众',
          pUpdateTime:'2020-01-18'
        },
      ],
      handPickedList:[
        {
          pID:"15",
          pTitle:'【土建】观脱贫成效，奔全面小康',
          pUpdateTime:'2020-01-19'
        },
        {
          pID:"16",
          pTitle:'【法院】情系母校，缘梦武大——会同一中，我们回来啦',
          pUpdateTime:'2020-01-18'
        },
        {
          pID:"17",
          pTitle:'【水利】水利水电学院举办寒假实践培训活动',
          pUpdateTime:'2020-01-18'
        },
        {
          pID:"18",
          pTitle:'【土建】载阳承梦，莹莹予众',
          pUpdateTime:'2020-01-18'
        }
      ],
      topicList:[
        {
          pID:"19",
          pTitle:'【土建】观脱贫成效，奔全面小康',
          pUpdateTime:'2020-01-19'
        },
        {
          pID:"20",
          pTitle:'【法院】情系母校，缘梦武大——会同一中，我们回来啦',
          pUpdateTime:'2020-01-18'
        },
        {
          pID:"21",
          pTitle:'【水利】水利水电学院举办寒假实践培训活动',
          pUpdateTime:'2020-01-18'
        },
        {
          pID:"22",
          pTitle:'【土建】载阳承梦，莹莹予众',
          pUpdateTime:'2020-01-18'
        }
      ],
    }
  },
  components:{
        headPage,
        columnPage,
        secolPage,
        footSection
  },
  mounted(){
    document.title='珞珈青年网'
    /**
     * 这里获取首页需要展示的信息
     * 5条最新的新闻 5条文韵文章 4条珞青报 4条往期精选 4条新闻快讯 4条专题
     * 将信息分别绑定到newsList artList等data上
     *  */ 
    // this.$axios.get('/api/php/').then(res=>{

    // })
  }
}
</script>

<style scoped>
.homePage{
  height: 100vh;
  overflow:auto;
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
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
      newsList:[],
      artList:[],
      LQBList:[],
      newsqList:[],
      handPickedList:[],
      topicList:[],
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
    this.$axios.get('/api/php/getHomeList.php').then(res=>{
      console.log(res.data);
      this.newsList=res.data.list.newsList
      this.artList=res.data.list.artList
      this.LQBList=res.data.list.LQBList
      this.newsqList=res.data.list.newsqList
      this.handPickedList=res.data.list.handPickedList
      this.topicList=res.data.list.topicList
    })
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
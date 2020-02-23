<template>
  <div style="height:100vh;overflow:auto;">
    <homeheader/>
    <div class="main" v-loading='loading' element-loading-text="拼命加载中">
      <el-card class="articleTitle">
        <div class="title">
            {{this.article.pTitle}}
          </div>
          <div class="articleInfo">
            <span class="info"><i class="el-icon-edit"></i>作者:{{this.article.pAuthor}}</span>
            <span class="info"><i class="el-icon-user"></i>发布者：{{this.article.pPublisher}}</span>
            <span class="info"><i class="el-icon-time"></i>发布时间：{{this.article.pUpdateTime}}</span>
            <span class="info"><i class="el-icon-folder"></i>分类：{{this.article.pCategory}}</span>
            <span class="info"><i class="el-icon-view"></i>浏览量：{{this.article.pViews}}</span>
          </div>
      </el-card>
      <el-card class="articleCard">
        <div id="articleContent"/>
      </el-card>
    </div>
    <footSection/>
  </div>

</template>

<script>
import homeheader from '@/components/header.vue'
import footSection from '@/components/footSection.vue'
export default {
  data() {
    return {
      article:{},
      loading:false
    }
  },
  mounted() {
    console.log(this.$route.params.id);
    this.loading=true;
    this.$axios
      .get("/api/php/getContent.php?type=article&key="+this.$route.params.id)
      .then((res)=>{
        console.log(res.data);
        this.article=res.data.content[0]
        const articleContent_el = document.getElementById('articleContent');
        articleContent_el.innerHTML = this.article.pContent;
        articleContent_el.innerHTML += "<link rel='stylesheet' href='/static/css/style.css'>"
        this.loading=false
      })
  },
  components:{
      homeheader,
      footSection
  },
}
</script>

<style lang="less" scoped>
.main{
  padding:10px 30px;
  background-color: #f1f1f1;
  min-height: 80vh;
}
.articleTitle{
  margin-top: 20px;
  margin-bottom: 10px;
  .title{
    font-size: 18px;
    font-weight: bold;
  }
  .articleInfo{
    font-size:15px;
    margin-top:8px;
    width: 100%; 
    position: relative;
    .info{
      margin-right: 20px;
    }
  }
}
.articleCard{
  margin-bottom:20px; 
}
#articleContent{
  text-align: left;
  font-size: 14px;
  p{
    img{
      text-align: center;
      width:70% !important;
    }
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
.w-e-text p{
  margin: 20px;
}
</style>
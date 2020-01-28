<template>
<div class="full_page" id="nav" >
   <div class="header">
     <div class="header_center">
        <div class="logo-info">
            <img src="@/assets/logo_black.png" alt="">
        </div>
        <div class="center">
            <a class="site-page" href="/">
              <span> 首页</span>
            </a>
            <a class="site-page" href="/categories/">
              <span> 新闻</span>
            </a>
            <a class="site-page" href="/archives/">
              <span> 文韵</span>
            </a>
            <a class="site-page" href="/tags/">
              <span> 珞青报</span>
            </a>
            <a class="site-page" href="/categories/">
              <span> 新闻速递</span>
            </a>
             <a class="site-page" href="/categories/">
              <span> 往期精选</span>
            </a>
            <a class="site-page" href="/link/">
              <span>专题</span>
            </a>

        </div>
        <div class="right">
             <el-input placeholder="请输入文章标题" v-model="titleName" class="searchClass">
               <el-button slot="append" icon="el-icon-search"></el-button>
            </el-input>
        </div>
      </div>
   </div>
   <!-- <div class="scroll-down">
      <i class="el-icon-bottom scroll-down-effects"></i>
    </div> -->
</div>
</template>

<script>
export default {
  data() {
    return {
      titleName:"",
    }
  },
}
</script>

<style lang="less">
@font-face {
	font-family:SJ;
	src: url('/static/font/SJ.TTF');
}
#nav {
    background-image: url("/static/img/cover_future.png");
    position: relative;
    background-color: #49b1f5;
    background-position: center;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    background-size: cover;
}
#nav.full_page {
    background-attachment: local;
    height: 100vh;
}
.site-page::after {
  position: absolute;
  bottom: 0;
  left: 0px;
  z-index: -1;
  width: 0;
  height: 3px;
  background-color: #000000;
  //background-color: #80c8f8;
  content: "";
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  -ms-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}
.site-page:hover::after {
  width: 100%;
}
.header {
  background-color: rgba(255, 255, 255, 1);
  height: 64px;
  width: 100%;
  .header_center{ 
    height: 100%;
    display: flex;
    justify-content: space-between;
    .logo-info {
      display: flex;
      align-items: center;
      color: #fff;
      height: 100%;
      img {
          width: 130px;
          margin-left: 20px;
          margin-right: 20px;
          vertical-align: middle;
      }
    }
    .center {
      display: flex;
      a{
        position: relative;
        display: inline-block !important;
        opacity: 1 !important;
        -ms-filter: none !important;
        filter: none !important;
        text-decoration: none;
        margin: auto 20px;
        padding-bottom: 3px;
        color: #000000;
        text-shadow: none;
        font-size: 16px;
        z-index: 0;
        font-family:   SJ;
        font-weight: bold;
        -webkit-transition: all 0.2s;
        -moz-transition: all 0.2s;
        -o-transition: all 0.2s;
        -ms-transition: all 0.2s;
        transition: all 0.2s;
      }
      a:hover {
        color: #000000;
        text-decoration: none;
      }
    }
    .right{
      display: flex;
      .searchClass{
          border: 0.5px solid rgb(101,101,101);
          border-radius: 50%;
          background: rgb(250, 250, 250);
          position: relative;
          -ms-filter: none !important;
          filter: none !important;
          margin:auto 20px;
          .el-input-group__append {
            border: none;
            background-color: transparent;
          }
          .el-input__inner {
            width: 0px;
            padding: 0px;
            height: 36px;
            line-height: 36px;
            border: none;
            background-color: transparent;
          }
          .el-icon-search{
            font-size: 16px;
            color: #409eff;
          }
          .el-button{
            padding: 0
          }
      }
      .searchClass:hover{
        border: 0.5px solid rgb(101,101,101);
        border-radius: 20px;
        background: #fff;
        .el-icon-search{
          color: #409eff;
          font-size: 16px;
          font-weight: bold;
        }
        .el-input__inner {
            width: 100%;
            padding: 0 15px;
            height: 36px;
            line-height: 36px;
            border: none;
            background-color: transparent;
            -webkit-transition: all .5s;
            -moz-transition: all .5s;
            transition: all .5s;
        }
        .el-button{
          padding: 12px 20px;
        }
      }
    }    
  }
}

</style>
<template>
<nav class="full_page" id="nav" >
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
            <a class="site-page" href="/categories/">
              <span> 新闻速递</span>
            </a>
             <a class="site-page" href="/categories/">
              <span> 往期精选</span>
            </a>
            <a class="site-page" href="/archives/">
              <span> 文韵</span>
            </a>
            <a class="site-page" href="/tags/">
              <span> 珞青报</span>
            </a>
            <a class="site-page" href="/link/">
              <span>专题</span>
            </a>
            <a class="site-page" href="/about/">
              <span> 精选</span>
            </a>
        </div>
        <div class="right">
             <el-input placeholder="请输入文章标题" v-model="titleName" class="searchClass">
               <el-button slot="append" icon="el-icon-search"></el-button>
            </el-input>
        </div>
      </div>
   </div>
   <!-- <div class="abstract" style="top:262px;">
     <h3>珞珈青年网</h3>
     <span>Welcome To Wuhan young.future.org.cn</span>
   </div> -->
   <div class="scroll-down">
      <i class="el-icon-bottom scroll-down-effects"></i>
    </div>
    <!-- <div class="scroll-down">
        <i class="el-icon-bottom scroll-down-effects" style="color:#ffffff"></i>
    </div> -->
</nav>
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
    margin-bottom: 20px;
    background-color: #49b1f5;
    background-position: center;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    background-size: cover;
    .scroll-down {
    position: absolute;
    bottom: 0;
    width: 100%;
    cursor: pointer;
    height: 42px;
    font-size: 30px;
    text-align: center;
    }
    .scroll-down-effects {
      -webkit-animation: pulse 1.5s infinite;
      -webkit-animation: pulse 1.5s infinite;
      -moz-animation: pulse 1.5s infinite;
      -o-animation: pulse 1.5s infinite;
      -ms-animation: pulse 1.5s infinite;
      animation: pulse 1.5s infinite;
      position: absolute;
      color: #fff;
    }
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
.abstract{
  position: absolute;
  text-align: center;
  min-height: 80px;
  width: 100%;
  color: #fff;
  h3{
    font-size: 32px;
    letter-spacing: 31px;
    margin-bottom: 16px;
  }
  span{
    letter-spacing: 10px;
    font-size: 14px;
    font-weight: bold;
    font-family: "Microsoft YaHei",Arial-normal,"open sans","Helvetica Neue",Helvetica,Arial,sans-serif;
  }
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
      justify-content: flex-start;
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
      justify-content: space-between;
      a{
        position: relative;
        display: inline-block !important;
        opacity: 1 !important;
        -ms-filter: none !important;
        filter: none !important;
        text-decoration: none;
        margin: 20px 20px auto;
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
      justify-content: space-between;
      .searchClass{
          border: 0.5px solid rgb(101,101,101);
          border-radius: 20px;
          background: rgb(250, 250, 250);
          position: relative;
          -ms-filter: none !important;
          filter: none !important;
          margin:auto 20px;
          width:100%
      }
      .searchClass .el-input-group__append {
        border: none;
        background-color: transparent;
      }
      .searchClass .el-input__inner {
        height: 36px;
        line-height: 36px;
        border: none;
        background-color: transparent;
      }
      .searchClass .el-icon-search{
        font-size: 16px;
        color: #409eff;
      }
      .searchClass:hover{
        border: 0.5px solid rgb(101,101,101);
        background: #fff;
      }
      .searchClass:hover .el-icon-search{
        color: #409eff;
        font-size: 16px;
        font-weight: bold;
      }
    }
    
         
        // .el-input{
        //   border: 1px solid #c5c5c5;
        //   position: relative;
        //   display: inline-block !important;
        //   -ms-filter: none !important;
        //   filter: none !important;
        //   margin:0 20px;
        //   width: 10%;
        // }
    
  }
}

</style>
<template>
<nav class="full_page" id="nav" >
   <div class="header">
     <div class="header_center">
       <img src="@/assets/logo.png" alt="">
        <!-- <div class="logo-info">
            
        </div> -->
        <a class="site-page" href="/">
              <span> 首页</span>
            </a>
            <a class="site-page" href="/archives/">
              <span> 文韵</span>
            </a>
            <a class="site-page" href="/categories/">
              <span> 新闻</span>
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
             <el-input placeholder="请输入文章标题" v-model="titleName" class="searchClass">
               <el-button slot="append" icon="el-icon-search"></el-button>
            </el-input>
      </div>
   </div>
   <div class="abstract" style="top:262px;">
     <h3>珞珈青年网</h3>
     <span>Welcome To Wuhan young.future.org.cn</span>
   </div>
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
.header {
  background-color: rgba(0, 0, 0, 0.3);
  height: 64px;
  width: 100%;
  .header_center{ 
    height: 100%;
    img {
        width: 130px;
        margin-right: 20px;
        vertical-align: middle;
    }
    a{
          position: relative;
          display: inline-block !important;
          opacity: 1 !important;
          -ms-filter: none !important;
          filter: none !important;
          text-decoration: none;
          margin: 20px 20px auto;
          color: #eeeeee;
          text-shadow: none;
          font-size: 16px;
          z-index: 0;
          font-family:   Lato, Helvetica Neue For Number, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, PingFang SC, Hiragino Sans GB, "Microsoft YaHei", Helvetica Neue, Helvetica, Arial, sans-serif;
          font-weight: bold;
          -webkit-transition: all 0.2s;
          -moz-transition: all 0.2s;
          -o-transition: all 0.2s;
          -ms-transition: all 0.2s;
          transition: all 0.2s;
        }
        a:hover {
          color: #ffffff;
          text-decoration: none;
        }
        .search-input{
          position: relative;
          display: inline-block !important;
          -ms-filter: none !important;
          filter: none !important;
          margin:0 20px;
          width:30%
        }
        .searchClass{
            border: 1px solid #c5c5c5;
            border-radius: 20px;
            background: #f4f4f4;
            position: relative;
            -ms-filter: none !important;
            filter: none !important;
            margin:0 20px;
            width:20%
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
        }
        .searchClass:hover{
          border: 1px solid #D5E3E8;
          background: #fff;
        }
        .searchClass:hover .el-icon-search{
          color: #409eff;
          font-size: 16px;
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
#nav {
    background-image: url("/static/img/cover1.jpg");
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
  background-color: #ffffff;
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

</style>
<template>
  <div class="header">
    <div class="header_center">
      <div class="logo-info">
        <img src="@/assets/logo_black.png" alt />
      </div>
      <div class="center">
        <span class="site-page" @click="$router.push('/')">首页</span>
        <span
          class="site-page"
          @click="$router.push({path:'/listpage',query:{type:'news'}});$store.state.listType='新闻'"
        >新闻</span>
        <span
          class="site-page"
          @click="$router.push({path:'/listpage',query:{type:'literature'}});$store.state.listType='文韵'"
        >文韵</span>
        <span
          class="site-page"
          @click="$router.push({path:'/listpage',query:{type:'newspaper'}});$store.state.listType='珞青报'"
        >珞青报</span>
        <span
          class="site-page"
          @click="$router.push({path:'/listpage',query:{type:'courier'}});$store.state.listType='最新速递'"
        >最新速递</span>
        <span
          class="site-page"
          @click="$router.push({path:'/listpage',query:{type:'handpicked'}});$store.state.listType='往期精选'"
        >往期精选</span>
        <span
          class="site-page"
          @click="$router.push({path:'/listpage',query:{type:'topic'}});$store.state.listType='专题'"
        >专题</span>
      </div>
      <div class="right">
        <el-input placeholder="请输入文章标题" v-model="titleName" @keyup.enter.native="enterSearch" class="searchClass">
          <el-button slot="append" icon="el-icon-search" @click="enterSearch"></el-button>
        </el-input>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      titleName:"",
    }
  },
  methods: {
    enterSearch(){
      this.$router.push({path:'/listpage',query:{type:'search',keyword:this.titleName}})
      this.$axios
        .get("/api/php/getListPage.php?type=search&keyword="+this.titleName)
        .then(res=>{
          console.log(res.data);
          this.$store.state.listData=res.data.list     
        })
    }
  },
}
</script>
<style lang='less'>
@font-face {
  font-family: SJ;
  src: url("/static/font/SJ.TTF");
}
.header {
  background-color: rgba(255, 255, 255, 1);
  height: 64px;
  width: 100%;
  .header_center {
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
      span {
        cursor: pointer;
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
        font-family: SJ;
        font-weight: bold;
        -webkit-transition: all 0.2s;
        -moz-transition: all 0.2s;
        -o-transition: all 0.2s;
        -ms-transition: all 0.2s;
        transition: all 0.2s;
      }
      span:hover {
        color: #000000;
        text-decoration: none;
      }
    }
    .right {
      display: flex;
      .searchClass {
        border: 0.7px solid rgb(101, 101, 101);
        border-radius: 50%;
        background: rgb(250, 250, 250);
        position: relative;
        -ms-filter: none !important;
        filter: none !important;
        margin: auto 20px;
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
        .el-icon-search {
          font-size: 16px;
          color: #409eff;
        }
        .el-button {
          padding: 0;
        }
      }
      .searchClass:hover {
        border: 0.7px solid rgb(101, 101, 101);
        border-radius: 20px;
        background: #fff;
        .el-icon-search {
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
          -webkit-transition: all 0.5s;
          -moz-transition: all 0.5s;
          transition: all 0.5s;
        }
        .el-button {
          padding: 12px 20px;
        }
      }
    }
  }
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
</style>
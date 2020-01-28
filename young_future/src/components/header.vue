<template>
  <div class="header">
        <div class="logo-info">
            <img src="@/assets/logo_blue.jpg" alt="">
            <div class="title">珞青网后台管理</div>
        </div>
        <div class="right">
          <div class="user-img">
              <img src="@/assets/qingchuan.png" alt="">
              <el-dropdown @command="handleCommand">
              <p style="cursor: pointer;color: #409EFF;">
                {{this.$store.state.userName}}
                <i class="el-icon-arrow-down el-icon--right"></i>
              </p>
              <el-dropdown-menu slot="dropdown">
                <el-dropdown-item command="changePassword">修改密码</el-dropdown-item>
                <el-dropdown-item command="loginOut">注销</el-dropdown-item>
              </el-dropdown-menu>
              </el-dropdown>
          </div>
        </div>
    </div>
</template>

<script>
export default {
  methods: {
    handleCommand(command) 
    {
      console.log(command);
      if (command=="loginOut"){
        console.log("1");
        this.$cookies.remove('token');
        this.$router.push("/login");
      }
      if (command=="changePassword"){
        this.$store.state.passModal=true;
      }
    }
  },
}
</script>

<style lang="less" scoped>
  .el-icon-arrow-down {
    font-size: 12px;
  }
.header {
  display: flex;
  justify-content: space-between;
  height: 64px;
  width: 100%;
  padding: 0 50px;
  background-color:#545c64;
  .right {
    display: flex;
    justify-content: space-between;
   }
  .user-img {
        display: flex;
        align-items: center;
        justify-content: center;
        img {
          width: 30px;
          height: 30px;
          margin-right: 10px;
          border-radius: 50%;
        }
        p {
            align-items: center;
            color: #fff;
            margin-bottom: 0;
        }
    }
   
  .logo-info {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    color: #fff;
    height: 100%;
    img {
      // height: 100%;
      width: 130px;
      margin-right: 20px;
    }
    .title {
      float: left;
      font-size: 20px;
      font-weight: 500;
    }
  }
}
</style>
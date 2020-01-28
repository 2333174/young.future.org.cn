<template>
<div id="footer">
  <div>Copyright © 2001-2019 All Right Reserved 版权所有 武汉大学未来网</div>
  <div>主办单位 共青团武汉大学委员会</div>
  <div style="white-space: normal;">技术支撑：武汉大学青年传媒集团未来网管理团队技术组 | <span class='aLogin' @click="linkToLogin">后台</span></div>
  <div style="white-space: normal;">页面设计：武汉大学青年传媒集团未来网管理团队设计组</div>
</div>
</template>

<script>
export default {
  methods: {
    linkToLogin(){
      this.$router.push('/login')
    }
  },
}
</script>

<style lang="less">
#footer{
  padding: 24px 20px 20px ;
  background: #409eff;
  background-attachment: local;
  color: white;
  font-size: 14px;
  font-family:  Lato, Helvetica Neue For Number, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, PingFang SC, Hiragino Sans GB, "Microsoft YaHei", Helvetica Neue, Helvetica, Arial, sans-serif;
  div{
    margin: 4px auto;
  }
}
.aLogin{
  cursor: pointer;
}
.aLogin:hover{
  text-decoration: underline; 
}

</style>
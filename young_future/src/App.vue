<template>
  <div id="app" class="row">
      <div id="sider" style="width:15%;">
        <sider/>
      </div>
      <div class="col-8">
        <router-view/>
      </div>
    <!-- </div>
    <el-container>
      <el-aside style="width:auto;"><sider/></el-aside>
      <el-main><router-view/></el-main>
    </el-container> -->
  </div>
</template>

<script>
import sider from '@/components/sider.vue'
export default {
  name: 'App',
  components:{
    sider,
  }
}
</script>

<style>
#sider{
  width: auto;
  position: absolute;
  top:0;
  bottom: 0;
}
/* .el-container {
  height: 100%;
  width:100%;
}
.el-aside {
  width: auto;
  position: absolute;
  top:0;
  bottom: 0;
} */
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
</style>

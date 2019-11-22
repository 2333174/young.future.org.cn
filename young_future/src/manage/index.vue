<template>
<div>
    <div id="sider" style="width:15%;">
        <sider/>
    </div>
    <div class="col-8">
        <router-view/>
    </div>   
</div> 
</template>
<script>
import sider from '@/components/sider.vue'
export default {
    name: 'Manage',
    components:{
        sider,
    }
}
</script>
<style scoped>
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
</style>
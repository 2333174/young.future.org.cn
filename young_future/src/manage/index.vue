<template>
<div>
    <div>
      <header1/>
    </div>
    <div class="content">
        <sider id="sider"/>
        <div id="main"><router-view/></div>
    </div>  
</div> 
</template>
<script>
import sider from '@/components/sider.vue'
import header1 from '@/components/header.vue'
export default {
    name: 'Manage',
    components:{
        sider,
        header1
    },
    mounted() {
      document.title="珞青网后台管理";
    },
}
</script>
<style scoped>
.content{
  display: flex;
  width: 100%;
  height: 100%;
  top: 64px;
  position: absolute;
}
.content #sider{
  width: 205px;
  bottom: 0;
}
#main{
  flex-grow: 1;
  overflow: auto
}
</style>
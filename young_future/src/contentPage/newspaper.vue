<template>
  <div style="height:100vh;overflow:auto;">
    <homeheader/>
    <div class="main">
       <el-image-viewer 
          v-if="showViewer" 
          :on-close="closeViewer" 
          :url-list="[previewUrl]" />
        <el-card>
          <div id="flipbook"> 
              <el-image v-for="item in newspaperImg" @dblclick="previewPicture(item)" :key='item'
                :src="item">
              </el-image>
              <!-- <div> Page 2 </div>
              <div> Page 3 </div>
              <div> Page 4 </div>
              <div class="hard"></div>
              <div class="hard"></div> -->
          </div>
        </el-card>
    </div>
 
    <footSection/>
  </div>

</template>

<script>
import homeheader from '@/components/header.vue'
import footSection from '@/components/footSection.vue'
import turn from '@/assets/turn.min.js'
import ElImageViewer from 'element-ui/packages/image/src/image-viewer'
export default {
  data() {
    return {
      newspaperImg:[
        '/static/img/newspaperTest/1.jpg',
        '/static/img/newspaperTest/2.jpg',
        '/static/img/newspaperTest/3.jpg',
        '/static/img/newspaperTest/4.jpg',
        '/static/img/newspaperTest/5.jpg',
        '/static/img/newspaperTest/6.jpg',
      ],
      previewUrl:'',
      showViewer:false
    }
  },
  methods: {
    previewPicture(src){
      this.previewUrl=src;
      this.showViewer=true
    },
    closeViewer(){
      this.showViewer=false
    }
  },
  mounted() {
    console.log(this.$route.params.title);
    $("#flipbook").turn({
    height: 1200,
		autoCenter: true
	});
  },
  components:{
      homeheader,
      footSection,
      ElImageViewer
  },
}
</script>

<style lang="less" scoped>
.main{
  padding:10px;
  background-color: #f1f1f1;
  min-height: 80vh;
  padding: 20px;
  .el-card{
    text-align: center;
    // #flipbook{
    //   margin: 0 auto;
    // }
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
</style>
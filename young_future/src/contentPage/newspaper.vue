<template>
  <div style="height:100vh;overflow:auto;">
    <homeheader/>
    <div class="main">
       <el-image-viewer 
          v-if="showViewer" 
          :on-close="closeViewer" 
          :url-list="[previewUrl]" />
        <el-card class="titleCard">
          <div class="title">
            {{$route.params.title}} <i class="el-icon-download download" @click="download"/>
          </div>
          <div class="newspaperInfo">
            <span class="info"><i class="el-icon-user"></i>发布者：青年传媒集团</span>
            <span class="info"><i class="el-icon-time"></i>发布时间：2020-02-18 16:21:22</span>
            <span class="info"><i class="el-icon-view"></i>浏览量：20</span>
          </div>
        </el-card>
        <el-card id='newspaperCard'>
          <i class='el-icon-back leftArrow' @click="paperBack"/>
          <i class='el-icon-right rightArrow' @click="paperGo"/>
          <div id="flipbook"> 
              <el-image class="newsImage" v-for="item in newspaperImg" @dblclick="previewPicture(item)" :key='item'
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
      showViewer:false,
      width:0,
      height:0,
    }
  },
  methods: {
    previewPicture(src){
      this.previewUrl=src;
      this.showViewer=true;
    },
    closeViewer(){
      this.showViewer=false
    },
    download(){
      window.open('/api/newspaper/'+this.$route.params.title+'/'+this.$route.params.title+'.pdf')
    },
    paperBack(){
      $("#flipbook").turn("previous");
      if ($("#flipbook").turn("page")==1){
        $('.leftArrow').css('left','10%');
        $('.rightArrow').css('right','10%');
      }else{
        $('.leftArrow').css('left','0');
        $('.rightArrow').css('right','0');
      }
    },
    paperGo(){
      $("#flipbook").turn("next");
      if ($("#flipbook").turn("page")==this.newspaperImg.length){
        $('.leftArrow').css('left','10%');
        $('.rightArrow').css('right','10%');
      }else{
        $('.leftArrow').css('left','0');
        $('.rightArrow').css('right','0');
      }
    }
  },
  mounted() {
    console.log(this.$route.params.title);
    this.width=document.getElementById('newspaperCard').offsetWidth-40
    this.height=this.width*(4678/6650)
    window.onresize = ()=>{
      this.width = document.getElementById('newspaperCard').offsetWidth-40;
      this.height =this. width*(4678/6650)
      $('#flipbook').turn('size', this.width, this.height);
    };
    let self=this
    $("#flipbook").turn({
        width:this.width,
        height:this.height,
        autoCenter: true,
        when: {
          turning: function(event, page, pageObject) {
            console.log(page);
            if (page==1 || page==self.newspaperImg.length){
              $('.leftArrow').css('left','10%');
              $('.rightArrow').css('right','10%');
            }else{
              $('.leftArrow').css('left','0');
              $('.rightArrow').css('right','0');
            }
          }
        }
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
  background-color: #f1f1f1;
  min-height: 80vh;
  padding: 20px;
  .titleCard{
    .title{
      font-size: 18px;
      font-weight: bold;
      .download{
        cursor: pointer;
      }
      .download:hover{
        color: #409eff;
      }
    }
    .newspaperInfo{
      font-size:15px;
      margin-top:5px;
      width: 100%; 
      position: relative;
      .info{
        margin-right: 20px;
      }
    }
  }
  #newspaperCard{
    // display: flex;
    text-align: center;
    background-color: #f1f1f1;
    border: none;
    box-shadow:none;
    position: relative;
    .el-card__body{
      padding: 0;
    }
    #flipbook{
      z-index: 1;
    }
    .leftArrow{
      z-index: 2;
      position: absolute;
      cursor: pointer;
      font-size: 30px;
      left:10%;
      top:50%
    }
    .rightArrow{
      z-index: 2;
      position: absolute;
      cursor: pointer;
      font-size: 30px;
      right:10%;
      top:50%
    }
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
<template>
  <div style="height:100vh;overflow:auto;">
    <homeheader/>
    <div class="main" v-loading='loading' element-loading-text="拼命加载中">
       <el-image-viewer 
          v-if="showViewer" 
          :on-close="closeViewer" 
          :url-list="[previewUrl]" />
        <el-card class="titleCard">
          <div class="title">
            {{$route.params.title}} <i class="el-icon-download download" @click="download"/>
          </div>
          <div class="newspaperInfo">
            <span class="info"><i class="el-icon-user"></i>发布者：【{{this.newspaperInfo.uploadPerson}}】</span>
            <span class="info"><i class="el-icon-time"></i>发布时间：【{{this.newspaperInfo.uploadTime}}】</span>
            <span class="info"><i class="el-icon-view"></i>浏览量：【{{this.newspaperInfo.viewTimes}}】</span>
          </div>
        </el-card>
        <el-card id='newspaperCard'>
          <i class='el-icon-back leftArrow' @click="paperBack"/>
          <i class='el-icon-right rightArrow' @click="paperGo"/>
          <div id="flipbook"> 
              <el-image class="newsImage" v-for="item in newspaperImg" @dblclick="previewPicture(item)" :key='item'
                :src="item">
                <div slot="placeholder" class="image-slot">
                  加载中<span class="dot">...</span>
                </div>
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
      newspaperImg:[],
      previewUrl:'',
      showViewer:false,
      width:0,
      height:0,
      newspaperInfo:{},
      loading:false,
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
      if ($("#flipbook").turn("page")==1&&(this.$store.state.bodyWidth>700)){
        $('.leftArrow').css('left','10%');
        $('.rightArrow').css('right','10%');
      }else{
        $('.leftArrow').css('left','0');
        $('.rightArrow').css('right','0');
      }
    },
    paperGo(){
      $("#flipbook").turn("next");
      if ($("#flipbook").turn("page")==this.newspaperImg.length&&(this.$store.state.bodyWidth>700)){
        $('.leftArrow').css('left','10%');
        $('.rightArrow').css('right','10%');
      }else{
        $('.leftArrow').css('left','0');
        $('.rightArrow').css('right','0');
      }
    }
  },
  mounted() {
    this.$store.state.bodyWidth= document.body.clientWidth 
    this.loading=true 
    this.$axios
      .get("/api/php/getContent.php?type=newspaper&key="+this.$route.params.title)
      .then((res)=>{
        if (res.data.status=='success'){
          this.newspaperInfo=res.data.content[0]
          for(var i=0;i<this.newspaperInfo.coverNum;i++){
            this.newspaperImg.push('/api/newspaper/'+this.newspaperInfo.title+'/cover'+i+'.jpg')
          }
        }else{
          this.$message.error('获取珞青报失败')
        }
      }).then(()=>{
          let duration=1000 
          if(document.body.clientWidth<700){
            this.width=document.getElementById('newspaperCard').offsetWidth-20
            this.height=this.width*(4678/3325)
            duration/=2 
          }else{
            this.width=document.getElementById('newspaperCard').offsetWidth-40
            this.height=this.width*(4678/6650)
          }
          let self=this
          $("#flipbook").turn({
              width:this.width,
              height:this.height,
              duration:duration,
              autoCenter: true,
              when: {
                turning: function(event, page, pageObject) {
                  if ((page==1 || page==self.newspaperImg.length)&&(document.body.clientWidth>700)){
                    $('.leftArrow').css('left','10%');
                    $('.rightArrow').css('right','10%');
                  }else{
                    $('.leftArrow').css('left','0');
                    $('.rightArrow').css('right','0');
                  }
                }
              }
          });
          if(document.body.clientWidth<700){
            $('#flipbook').turn('display','single')
          }
          window.onresize=()=>{
            this.$store.state.bodyWidth=document.body.clientWidth
            if(document.body.clientWidth<700){
              $('#flipbook').turn('display','single')
              this.width = document.getElementById('newspaperCard').offsetWidth-20;
                this.height =this. width*(4678/3325)
                $('#flipbook').turn('size', this.width, this.height);
            }else{
              $('#flipbook').turn('display','double')
              this.width = document.getElementById('newspaperCard').offsetWidth-40;
              this.height =this. width*(4678/6650)
              $('#flipbook').turn('size', this.width, this.height);
            }
          }
          this.loading=false
      })
  },
  destroyed(){
    window.onresize=null
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
  padding: 20px;
  min-height: 80vh;
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
  }
  #newspaperCard{
    // display: flex;
    text-align: center;
    background-color: #f1f1f1;
    border: none;
    box-shadow:none;
    position: relative;
    
    #flipbook{
      z-index: 1;
    }
    .leftArrow{
      z-index: 2;
      position: absolute;
      cursor: pointer;
      font-size: 30px;
      top:50%
    }
    .rightArrow{
      z-index: 2;
      position: absolute;
      cursor: pointer;
      font-size: 30px;
      top:50%
    }
    // #flipbook{
    //   margin: 0 auto;
    // }
  }
}
@media (min-width: 700px) {
  .newspaperInfo{
    font-size:15px;
    width: 100%; 
    margin-top:8px;
    position: relative;
    .info{
      margin-right: 20px;
    }
  }
  .main{
    padding: 20px;
  }
  .leftArrow{
    left:10%;
  }
  .rightArrow{
    right:10%;
  }
}
@media (max-width: 700px) {
  #newspaperCard{
    /deep/ .el-card__body{
      padding:20px 10px;
    }
  }
  .newspaperInfo{
    font-size:14px;
    margin-top:8px;
    width: 100%; 
    .info{
      margin-right: 5px;
    }
  }
  .main{
    padding: 10px;
  }
  .leftArrow{
    left:0;
  }
  .rightArrow{
    right:0;
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
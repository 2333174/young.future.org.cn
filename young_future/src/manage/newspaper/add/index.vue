<template>
<!-- 这里写登录页面html,按规定格式写好注释 -->
<div>
<div class="page_header">
  <i class="el-icon-notebook-2"/>&nbsp;{{this.$store.state.pageTitle}}
</div>
<div class="addMain">
  <div class="step">
    <el-steps :active="this.$store.state.newspaper_active" align-center>
      <el-step title="上传珞青报" icon="el-icon-edit"></el-step>
      <el-step title="上传版面" icon="el-icon-upload"></el-step>
    </el-steps>
  </div>
  <!--
    对话框
  -->
  <el-dialog title="预览"
  :visible.sync="isPreview"
  width="40%"
  center>
    <img :src="previewURL"/>
    <span slot="footer" class="dialog-footer">
      <el-button type="primary" @click="isPreview = false">确 定</el-button>
    </span>
  </el-dialog>
  <el-card shadow="hover">
  <el-form v-if="this.$store.state.newspaper_active==0" id="newspaper_form" label-position="left" label-width="110px" :model="newsForm" :rules="rules" ref="newsForm" class="demo-newsForm">
    <el-form-item label="标题" prop="name">
      <el-input v-model="newsForm.name" placeholder="请输入标题"></el-input>
    </el-form-item>
    <el-form-item label="版面数量" prop="coverNum">
      <el-input v-model="newsForm.coverNum" oninput="value=value.replace(/[^\d.]/g,'')" placeholder="请输入版面数量" @change="initCover"></el-input>
    </el-form-item>
    <el-form-item label="上传封面" prop="coverList">
      <el-upload
        :class="{'upload-demo':true, 'visiable':isHidden1}"
        ref="coverUpload"
        :on-remove="handleCoverRemove"
        :file-list="newsForm.coverList"
        :on-change="checkCoverNum"
        :auto-upload="false"
        :limit="1"
        drag
        action="https://jsonplaceholder.typicode.com/posts/">
          <i class="el-icon-upload"></i>
          <div class="el-upload__text">将图片拖到此处，或<em>点击上传</em></div>
      </el-upload>
    </el-form-item>
    <el-form-item label="上传报纸原件" prop="newsFileList">
      <el-upload
        :class="{'upload-demo':true, 'visiable1':isHidden2}"
        ref="fileUpload"
        :on-remove="handleNewsRemove"
        :file-list="newsForm.newsFileList"
        :on-change="checkFileNum"
        :auto-upload="false"
        :limit="1"
        drag
        action="https://jsonplaceholder.typicode.com/posts/">
          <i class="el-icon-upload"></i>
          <div class="el-upload__text">将PDF文件拖到此处，或<em>点击上传</em></div>
      </el-upload>
    </el-form-item>
    <el-form-item>
      <el-button type="primary" @click="next('newsForm')">下一步</el-button>
    </el-form-item>
  </el-form>
  <el-table
    default-expand-all
    stripe
    border
    v-if="this.$store.state.newspaper_active==1"
    :data="newsForm.coverData"
    style="width: 100%"
    :cell-style="{'text-align':'center'}">
     <el-table-column label="上传版面" header-align="center">
        <el-table-column type="index" label="版面"  width="50" header-align="center"/>
        <el-table-column
            prop="name"
            label="图片"
            header-align="center"
        >
          <template slot-scope="scope">
            <el-upload
              v-if="scope.row.cover.length === 0"
              class="upload-demo"
              action="https://jsonplaceholder.typicode.com/posts/"
              :show-file-list="false"
              :file-list="scope.row.cover"
              :on-change="(file,fileList)=>choosePicture(file,fileList,scope.$index)"
              :auto-upload="false">
              <el-button  icon="el-icon-picture-outline" slot="trigger" size="small"></el-button>
            </el-upload>
            <span v-if="scope.row.cover.length !== 0">{{scope.row.cover[0].name}}</span>
          </template>
        </el-table-column>
        <el-table-column label="操作" header-align="center">
            <template slot-scope="scope">
              <el-button
                size="mini"
                @click="preview(scope.$index)">预览</el-button>
                <el-button
                size="mini"
                type="danger"
                @click="clearPicture(scope.$index)">
                重置</el-button>
            </template>
        </el-table-column>
     </el-table-column>
  </el-table>
  <div v-if="this.$store.state.newspaper_active==1" style="margin:20px auto 5px">
    <el-button type="primary" @click="before('newsForm')">上一步</el-button>
    <el-button @click="submit('newsForm')" type="success">提交</el-button>
  </div>
  </el-card>
</div>
</div>
</template>

<script>
export default {
  created(){
    this.$store.state.newspaper_active=0;
  },
  //数据绑定
  data() {
      return {
        active:0,
        previewURL:"",
        isPreview:false,
        isHidden1:false,
        isHidden2:false,
        newsForm: {
          name: '',
          coverNum: '',
          coverList:[],
          newsFileList:[],
          coverData:[]
        },
        rules: {
          name: [
            { required: true, message: '请输入标题', trigger: ['change','blur'] },
          ],
          coverNum: [
            { required: true, message: '请输入版面数', trigger: ['change','blur'] },
            {max:2, message:'版面数过多'}
          ],
          coverList:[
            { type: 'array', required:true,message:'请上传封面',trigger:['blur','change']}
          ],
          newsFileList:[
            { type: 'array', required:true,message:'请上传封面',trigger:['blur','change']}
          ]
        }
      }
  },
  //用axios请求数据
  methods: {
      //下一步
      next(formName){
        this.$refs[formName].validate((valid) => {
          if (valid) {
            if (this.$store.state.newspaper_active++ > 1){

            } ;
          }else{

          }
        })
      },
      //上一步
      before(formName){
        this.$store.state.newspaper_active--;
        // if (this.newsForm.coverList.length>0){
        //   document.getElementsByClassName('el-upload')[0].style.display="none"
        // }else{
        //   document.getElementsByClassName('el-upload')[0].style.display="inline-block"
        // }
        // if (this.newsForm.newsFileList.length>0){
        //   document.getElementsByClassName('el-upload')[1].style.display="none"
        // }else{
        //   document.getElementsByClassName('el-upload')[1].style.display="inline-block"
        // }
      },
      /*
        -初始化版面
        -版面数更新后，表格的行数跟着改变
      */
      initCover(){
        if (this.newsForm.coverNum>30){
          this.$message.error("版面数过多");
          return
        }
        this.newsForm.coverData=[];
        for (var i=0;i<this.newsForm.coverNum;i++){
          this.newsForm.coverData.push({
            name:"",
            cover:[]
          })
        }
      },
      /*
        -选择版面图片
      */
      choosePicture(file,fileList,index){
        const isJPG = ((file.raw.type === 'image/jpeg') || (file.raw.type === 'image/png') || (file.raw.type === 'image/jpeg'));
        if (!isJPG) {
          this.$message.error('上传版面图片只能是 JPG 或 PNG 格式!');
          fileList.splice(0,1)
        }
        this.newsForm.coverData[index].cover=fileList
      },
      /*
        -预览版面
      */
      preview(index){
        if (this.newsForm.coverData[index].cover.length<1){
          this.$message.error('请先上传版面');
          return
        }
        this.isPreview=true
        let file=this.newsForm.coverData[index].cover[0]
        this.localFile=file.raw
        let reader = new FileReader()
        reader.readAsDataURL(this.localFile);
        reader.onload=()=>{
            this.previewURL=reader.result
        }
      },
      /*
       -重置版面
      */
      clearPicture(index){
        this.newsForm.coverData[index].cover=[]
      },
      handleCoverRemove(file,fileList){
        this.newsForm.coverList=fileList
        console.log(this.newsForm.coverList);
        this.isHidden1=false
        //document.getElementsByClassName('el-upload')[0].style.display="inline-block"
      },
      checkCoverNum(file, fileList){
        const isJPG = ((file.raw.type === 'image/jpeg') || (file.raw.type === 'image/png') || (file.raw.type === 'image/jpeg'));
        const isLt2M = file.size / 1024 / 1024 < 5;

        if (!isJPG) {
          this.$message.error('上传图片只能是 JPG 或 PNG 格式!');
          fileList.splice(0,1)
        }
        if (!isLt2M) {
          this.$message.error('上传图片大小不能超过 5MB!');
          fileList.splice(0,1)
        }
        this.newsForm.coverList=fileList
        console.log(this.newsForm.coverList);
        
        if (fileList.length>=1){
          this.isHidden1=true
          //document.getElementsByClassName('el-upload')[0].style.display="none"
        }
      },
      handleNewsRemove(file,fileList){
        this.newsForm.newsFileList=fileList
        console.log(this.newsForm.coverList);
        this.isHidden2=false
        //document.getElementsByClassName('el-upload')[1].style.display="inline-block"
      },
      checkFileNum(file, fileList){
        console.log(file.raw.type)
        const isJPG = (file.raw.type === 'application/pdf');
        const isLt2M = file.size / 1024 / 1024 < 5;

        if (!isJPG) {
          this.$message.error('上传文件只能是 PDF 格式!');
          fileList.splice(0,1)
        }
        this.newsForm.newsFileList=fileList
        console.log(this.newsForm.coverList);
        
        if (fileList.length>=1){
          this.isHidden2=true;
          // document.getElementsByClassName('el-upload')[1].style.display="none"
        }
      }
  },
}
</script>

<style>
/* 这里写css */
#newspaper_form{
  padding-top:1rem; 
}
.el-card{
  width:90%;
  margin: 0 auto 80px;
}
.page_header{
  display: flex;
  align-items: center;
  height: 49px;
  padding: 0 35px;
  font-size: 2rem;
  background-color: #fcfcfc;
  box-shadow: 1px 4px 6px #ccc;
}
.addMain{
    overflow: auto;
}
.el-dialog img{
  width: 100%;
}
.step{
  margin: auto;
  margin-top:20px; 
  width: 50%;
}
.el-step__title{
  font-size: 10px;
}
.el-upload--text{
  width: 100%;
}
.el-upload-dragger{
  width: 100%
}
.visiable .el-upload{
  display: none !important;
}
.visiable1 .el-upload{
  display: none;
}
.el-form-item{
  width:90%;
  margin: 20px auto
}
</style>
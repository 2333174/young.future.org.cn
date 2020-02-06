<template>
  <!-- 这里写登录页面html,按规定格式写好注释 -->
  <div class="addMain">
    <div class="page_header">
      <i class="el-icon-document"/>&nbsp;{{this.$store.state.pageTitle}}
    </div>
    <el-dialog title="文章预览"
          :visible="dialogVisible" width="70%" center>
      <div id="dialogInfo"/>
      <span slot="footer" class="dialog-footer">
        <el-button type="primary" @click="dialogVisible = false">确 定</el-button>
      </span>
    </el-dialog>
    <el-card class="addCard" shadow="hover">
      <el-form id="passage_form" label-position="left" label-width="110px" :model="passForm" :rules="rules" ref="passForm" class="passForm">
        <el-form-item label="标题" prop="title">
          <el-input v-model="passForm.title" placeholder="请输入标题"/>
        </el-form-item>
        <el-form-item label="作者" prop="author">
          <el-input v-model="passForm.author" placeholder="请输入作者"/>
        </el-form-item>
        <el-form-item id="categoryItem" label="类别" prop="category">
          <el-col :span="24">
            <el-radio-group v-model="passForm.category" clearable  placeholder="请选择类别" @change="radioChange">
              <el-radio
                v-for="item in options"
                :key="item.value"
                :label="item.label">
              </el-radio>
            </el-radio-group>
          </el-col>
        </el-form-item>
        <el-form-item id="editorItem" label="内容" prop="content">
          <div ref="editor" style="text-align:left" v-model="passForm.content"></div>
        </el-form-item>
        <el-form-item v-show="uploadVisible" label="封面" prop="cover">
          <el-upload class="upload-demo"
                     action="https://jsonplaceholder.typicode.com/posts/"
                     :file-list="passForm.cover"
                     accept=".jpg,.jpeg,.png,.gif,.bmp,.JPG,.JPEG,.PNG,.GIF,.BMP"
                     :limit="1"
                     :auto-upload="false"
                     :cell-style="{'text-align':'center'}"
                     :on-change="changeFileList">
            <i class="el-icon-upload"></i>
            <div class="el-upload__text">将封面图片拖到此处，或<em>点击上传</em></div>
            <div class="el-upload__tip" slot="tip">只能上传jpg/png文件，且不超过500kb</div>
          </el-upload>
        </el-form-item>
        <div style="margin:20px auto 5px">
          <el-button v-on:click="Preview">预览</el-button>
          <el-button @click="submit('passForm')" type="success">提交</el-button>
        </div>
      </el-form>
    </el-card>
  </div>
</template>

<script>
  /**
   * @Author: Zhou Pengchuan
   * @Time: 2020-1-31
   * @Description: Add Passage
   */
  import E from 'wangEditor'

  export default {
    //数据绑定
    data() {
      return {
        dialogVisible: false,
        uploadVisible: false,
        passForm: {
          title: '',
          author: '',
          category: '',
          content: '',
          cover: []
        },
        rules: {
          title: [
            { required: true, message: '请输入标题', trigger: ['change','blur'] },
          ],
          author: [
            { required: true, message: '请输入作者', trigger: ['change','blur'] },
          ],
          category: [
            { required: true, message: '请输入类别', trigger: ['change','blur'] },
          ],
          content: [
            { required: true, message: '请输入内容', trigger: ['change','blur'] },
          ],
          cover: [
            { required: true, message: '请上传封面', trigger: ['change','blur'] },
          ]
        },
        options: [{
          value: '文韵',
          label: '文韵'
        },{
          value: '新闻',
          label: '新闻'
        },{
          value: '最新速递',
          label: '最新速递'
        },{
          value: '专题',
          label: '专题'
        }]
      }
    },
    //用axios请求数据
    mounted() {
      this.$store.state.pageTitle="添加文章";
      const editor = new E(this.$refs.editor);
      editor.customConfig.onchange = (html) => {
        this.passForm.content = html;
      };
      editor.customConfig.uploadImgShowBase64 = true;         // 使用Base64进行编码
      editor.customConfig.pasteFilterStyle = false;           // 粘贴带格式的文本可以保存其格式
      editor.customConfig.showLinkImg = false;                // 取消显示网络来源的图片
      editor.customConfig.zIndex = 10;                        // 设置其z-Index
      editor.customConfig.onblur = function (html) {
        if (html == null || html === '')
          this.$message.error("文章内容不可为空");
      };
      editor.create();
    },
    methods: {
      /**
       * @function: 获取内容
       * @description: 仅用于测试
       */
      getContent: function () {
        alert(this.passForm.cover);
      },
      /**
       * @function submit the form
       * @param formName name of the form
       */
      submit: function(formName) {
        if (this.passForm.title === '' || this.passForm.author === '' ||this.passForm.category === ''
          || this.passForm.content == null || this.passForm.content === ''
          || (this.passForm.category === '新闻' && this.passForm.cover == null)) {
          this.$message.error("请填写必需项");
          return;
        }
        let formData = new FormData();
        // 相关数据
        if (this.passForm.category === '新闻') {
          let cover = this.passForm.cover[0].raw;
          formData.append('cover', cover);
        }
        formData.append('title', this.passForm.title);
        formData.append('author', this.passForm.author);
        formData.append('category', this.passForm.category);
        formData.append('content', this.passForm.content);
        formData.append('publisher', this.$store.state.userName);
        // 通过axios上传
        this.$axios.post("/api/php/uploadPassage.php", formData).then(
          res=>{
            console.log(res.data);
            if (res.data.status === 'success') {
              this.$message.success("上传成功");
              setTimeout(()=> {
                this.$router.push("/manager/passage/manager")
              }, 1000);
            }else{
              this.$message.error(res.data.message)
            }
          }
        );
      },
      Preview: function() {
        const dialogInfo = document.getElementById('dialogInfo');
        this.dialogVisible = true;
        dialogInfo.innerHTML = this.passForm.content;
      },
      handleRemove: function(file, fileList) {
        console.log(file, fileList);
      },
      radioChange: function() {
        this.uploadVisible = this.passForm.category === '新闻';
      },
      changeFileList: function(file, fileList) {
        this.passForm.cover = fileList;
      }
    }
  }
</script>

<style>
  /* 这里写css */
  .page_header{
    display: flex;
    align-items: center;
    height: 49px;
    padding: 0 35px;
    font-size: 2rem;
    background-color: #fcfcfc;
    box-shadow: 1px 4px 6px #ccc;
  }
  #categoryItem {
    z-index: 50;
  }
  .addMain .addCard{
    width: 90%;
    margin: 20px auto 80px;
  }
  .addMain{
    overflow: auto;
  }
  #passage_form {
    padding-top:1rem;
  }
  /* table 样式 */
  table {
    border-top: 1px solid #ccc;
    border-left: 1px solid #ccc;
  }
  table td,
  table th {
    border-bottom: 1px solid #ccc;
    border-right: 1px solid #ccc;
    padding: 3px 5px;
  }
  table th {
    border-bottom: 2px solid #ccc;
    text-align: center;
  }

  /* blockquote 样式 */
  blockquote {
    display: block;
    border-left: 8px solid #d0e5f2;
    padding: 5px 10px;
    margin: 10px 0;
    line-height: 1.4;
    font-size: 100%;
    background-color: #f1f1f1;
  }

  /* code 样式 */
  code {
    display: inline-block;
    *display: inline;
    *zoom: 1;
    background-color: #f1f1f1;
    border-radius: 3px;
    padding: 3px 5px;
    margin: 0 3px;
  }
  pre code {
    display: block;
  }

  /* ul ol 样式 */
  ul, ol {
    margin: 10px 0 10px 20px;
  }
</style>

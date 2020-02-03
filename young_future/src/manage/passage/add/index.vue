<template>
  <!-- 这里写登录页面html,按规定格式写好注释 -->
  <div>
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
            <el-radio-group v-model="passForm.category" clearable  placeholder="请选择类别">
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

        <div style="margin:20px auto 5px">
          <el-button v-on:click="Preview">预览</el-button>
          <el-button @click="submit('passForm')" type="success">提交</el-button>
        </div>
      </el-form>
      <!--全屏-->
      <div id="cover"></div>
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
        passForm: {
          title: '',
          author: '',
          category: '',
          content: ''
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
          this.$message.error(html);
      };
      editor.create();
    },
    methods: {
      /**
       * @function: 获取内容
       * @description: 仅用于测试
       */
      getContent: function () {
        alert(this.passForm.content);
      },
      /**
       * @function submit the form
       * @param formName name of the form
       */
      submit: function(formName) {
        let formData = new FormData();
        // 相关数据
        formData.append('title', this.passForm.title);
        formData.append('author', this.passForm.author);
        formData.append('category', this.passForm.category);
        formData.append('content', this.passForm.content);
        formData.append('publisher', this.$store.state.userName);
        // 通过axios上传
        this.$axios.post("/api/php/uploadPassage.php", formData).then(
          res=>{
            console.log(res.data);
            if (res.data.status == 'success') {
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
      Preview: function () {
        const dialogInfo = document.getElementById('dialogInfo');
        this.dialogVisible = true;
        dialogInfo.innerHTML = this.passForm.content;
      },
    },

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


<template>
  <!-- 这里写登录页面html,按规定格式写好注释 -->
  <div>
    <div class="page_header">
      <i class="el-icon-document"/>&nbsp;{{this.$store.state.pageTitle}}
    </div>
    <el-card class="addCard" shadow="hover">
      <el-form id="passage_form" label-position="left" label-width="110px" :model="passForm" :rules="rules" ref="passForm" class="passForm">
        <el-form-item label="标题" prop="title">
          <el-input v-model="passForm.title" placeholder="请输入标题"></el-input>
        </el-form-item>
        <el-form-item label="作者" prop="author">
          <el-input v-model="passForm.author" placeholder="请输入作者"></el-input>
        </el-form-item>
        <el-form-item label="类别" prop="category" >
          <el-select v-model="passForm.category" clearable filterable placeholder="请选择类别">
            <el-option
              v-for="item in options"
              :key="item.value"
              :label="item.label"
              :value="item.value">
            </el-option>
          </el-select>
        </el-form-item>
        <el-form-item label="内容" prop="content">
          <div ref="toolbar" style="text-align: left"></div>
          <div style="padding: 5px 0; color: #ccc"/>
          <div ref="editor" style="text-align:left"></div>
          <button v-on:click="getContent">查看内容</button>
        </el-form-item>

        <div style="margin:20px auto 5px">
          <el-button @click="submit('passForm')" type="success" :disabled="cantSubmit">提交</el-button>
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
        cantSubmit: false,
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

        },
        options: [{
          value: '文韵',
          label: '文韵'
        },{
          value: '新闻',
          label: '新闻'
        },{
          value: '新闻速递',
          label: '新闻速递'
        },{
          value: '专题',
          label: '专题'
        }]
      }
    },
    //用axios请求数据
    mounted() {
      this.$store.state.pageTitle="添加文章";
      const editor = new E(this.$refs.toolbar, this.$refs.editor);
      editor.customConfig.onchange = (html) => {
        this.passForm.content = html;
      };
      editor.create();
    },
    methods: {
      /**
       * @function: 获取内容
       * @description: 仅用于测试
       */
      getContent: function () {
        alert(this.passForm.content)
      },
      /**
       * @function
       * @param formName
       */
      submit: function(formName) {

      }
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
</style>

<template>
<!-- 这里写登录页面html,按规定格式写好注释 -->
<div>
<el-page-header content="详情页面" style="padding-top:1rem;">
</el-page-header>
<hr/>
<el-form id="newspaper_form" :model="ruleForm" :rules="rules" ref="ruleForm" label-width="50%" class="demo-ruleForm">
  <el-form-item label="标题" prop="name">
    <el-input v-model="ruleForm.name"></el-input>
  </el-form-item>
  <el-form-item>
    <el-button type="primary" @click="submitForm('ruleForm')">立即创建</el-button>
    <el-button @click="resetForm('ruleForm')">重置</el-button>
  </el-form-item>
</el-form>
</div>
</template>

<script>
export default {
    //数据绑定
    data() {
        return {
            ruleForm: {
          name: '',
          region: '',
          date1: '',
          date2: '',
          delivery: false,
          type: [],
          resource: '',
          desc: ''
        },
        rules: {
          name: [
            { required: true, message: '请输入活动名称', trigger: 'change' },
            { min: 3, max: 5, message: '长度在 3 到 5 个字符', trigger: 'change' }
          ],
          region: [
            { required: true, message: '请选择活动区域', trigger: 'change' }
          ],
          date1: [
            { type: 'date', required: true, message: '请选择日期', trigger: 'change' }
          ],
          date2: [
            { type: 'date', required: true, message: '请选择时间', trigger: 'change' }
          ],
          type: [
            { type: 'array', required: true, message: '请至少选择一个活动性质', trigger: 'change' }
          ],
          resource: [
            { required: true, message: '请选择活动资源', trigger: 'change' }
          ],
          desc: [
            { required: true, message: '请填写活动形式', trigger: 'change' }
          ]
        }
        }
    },
    //用axios请求数据
    methods: {
        
    },
}
</script>

<style>
/* 这里写css */
#newspaper_form{
  padding-top:1rem; 
}
</style>
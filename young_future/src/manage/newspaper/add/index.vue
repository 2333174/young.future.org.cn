<template>
<!-- 这里写登录页面html,按规定格式写好注释 -->
<el-form :model="ruleForm" :rules="rules" ref="ruleForm" label-width="100px" class="demo-ruleForm">
  <el-form-item label="标题" prop="name">
    <el-input v-model="ruleForm.name"></el-input>
  </el-form-item>

  <el-form-item>
    <el-button type="primary" @click="submitForm('ruleForm')">立即创建</el-button>
    <el-button @click="resetForm('ruleForm')">重置</el-button>
  </el-form-item>
</el-form>

</template>

<script>
export default {
    //数据绑定
    data() {
        return {
            
        }
    },
    //用axios请求数据
    methods: {
        
    },
}
</script>

<style>
/* 这里写css */
</style>
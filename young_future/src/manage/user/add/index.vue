<template>
<!-- 这里写登录页面html,按规定格式写好注释 -->
<div>
    <div class="page_header">
        <i class="el-icon-user"/>&nbsp;{{this.$store.state.pageTitle}}
    </div>
    <el-card class='userCard' shadow="hover">
        <el-form
          id="user_form"
          label-position="left"
          label-width="110px"
          :model="userform"
          :rules="rules"
          ref="userform"
          class="demo-userForm">
            <el-form-item label="账号" prop="uAccount">
              <el-input v-model="userform.uAccount" placeholder="请输入账号"></el-input>
            </el-form-item>
            <el-form-item label="用户名" prop="uName">
              <el-input v-model="userform.uName" placeholder="请输入用户名"></el-input>
            </el-form-item>
            <el-form-item label="年级" prop="uGrade">
              <el-input v-model.number="userform.uGrade" placeholder="请填写年级，例如“2017”"></el-input>
            </el-form-item>
            <el-form-item label="密码" prop="uPassword">
              <el-input type="password" v-model="userform.uPassword" placeholder="请输入密码"></el-input>
            </el-form-item>
            <el-form-item label="确认密码" prop="confirmPassword" >
              <el-input type="password" v-model="userform.confirmPassword" placeholder="请再输入一次密码"></el-input>
            </el-form-item>
            <el-form-item>
              <el-button type="primary" class="useradd__submit" @click="submitForm('userform')" :disabled="cantSubmit">提交</el-button>
              <el-button @click="resetForm('userform')">重置</el-button>
             </el-form-item>
        </el-form>
    </el-card>
</div>
</template>

<script>
export default {
    //数据绑定
    data() {
        var validatePass = (rule, value, callback) => {
        if (value === '') {
          callback(new Error('请输入密码'));
        } else {
          if (this.userform.comfirmPassword !== '') {
            this.$refs.userform.validateField('checkPass');
          }
          callback();
        }};
        var validatePass2 = (rule, value, callback) => {
        if (value === '') {
          callback(new Error('请再次输入密码'));
        } else if (value !== this.userform.uPassword) {
          callback(new Error('两次输入密码不一致!'));
        } else {
          callback();
        }};
        return {
            cantSubmit:false,
            userform:{
                uAccount:'',
                uName:'',
                uGrade:'',
                uPassword:'',
                confirmPassword:'',
            },
            rules: {
                uAccount: [
                    { required: true, message: '请输入账户', trigger: ['change','blur'] },
                ],
                uName: [
                    { required: true, message: '请输入用户名', trigger: ['change','blur'] },
                ],
                uGrade:[
                    { required:false,trigger:['blur','change'] },
                ],
                uPassword:[
                    { required:true,message:'',validator: validatePass,trigger:['blur','change'] }
                ],
                confirmPassword:[
                    { required:true,message:'',validator: validatePass2,trigger:['blur'] }
                ]
                }




        }
    },
    mounted(){
        this.$store.state.pageTitle="添加用户"
    },
    //用axios请求数据
    methods: {
        submitForm(formName) {
        this.$refs[formName].validate((valid) => {
          if (valid) {

            let params = new URLSearchParams();
            params.append('token',this.$cookies.get("token"));
            params.append('uAccount',this.userform.uAccount);
            params.append('uPassword',this.userform.uPassword);
            params.append('uName',this.userform.uName);
            params.append('uGrade',this.userform.uGrade);

            this.$axios.post("/api/php/uploadUser.php",params).then(
              res=>{
                console.log(res.data);
                if (res.data.status=="success"||res.data.status=="Success"){
                  this.$message.success("上传成功")
                  this.cantSubmit=true
                  setTimeout(()=> {
                    this.$router.push("/manager/user/manager")
                  }, 1000);
                }else{
                  this.$message.error(res.data.message)
                }
              }
            )
          } else {
            console.log('error submit!!');
            return false;
          }
        });
      },
      resetForm(formName) {
        this.$refs[formName].resetFields();
      }
    },
}
</script>

<style>
.page_header{
  display: flex;
  align-items: center;
  height: 49px;
  padding: 0 35px;
  font-size: 2rem;
  background-color: #fcfcfc;
  box-shadow: 1px 4px 6px #ccc;
}
#user_form{
  padding-top:1rem;
}
.userCard{
  width:90%;
  margin: 20px auto 80px;
}
.el-form-item{
  width:90%;
  margin: 20px auto
}
</style>

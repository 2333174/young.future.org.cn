<template>
<div>
    <div>
      <header1/>
    </div>
    <div class="content">
        <el-dialog title="修改密码" :visible.sync="$store.state.passModal">
          <el-form :model="passwordForm" ref="passwordForm" status-icon :rules="rules" label-position="left">
            <el-form-item label="原密码" label-width="100px" prop="oldPassword">
              <el-input v-model="passwordForm.oldPassword" type="password" autocomplete="off"></el-input>
            </el-form-item>
            <el-form-item label="新密码" label-width="100px" prop="newPassword">
              <el-input v-model="passwordForm.newPassword" type="password" autocomplete="off"></el-input>
            </el-form-item>
            <el-form-item label="确认新密码" label-width="100px" prop="newPasswordRepeat">
              <el-input v-model="passwordForm.newPasswordRepeat"  type="password" autocomplete="off"></el-input>
            </el-form-item>
          </el-form>
          <div slot="footer" class="dialog-footer">
            <el-button @click="cancelModal">取 消</el-button>
            <el-button type="primary" @click="enterModal">确 定</el-button>
          </div>
        </el-dialog>
        <sider id="sider"/>
        <div id="main"><router-view/></div>
    </div>  
</div> 
</template>
<script>
import sider from '@/components/sider.vue'
import header1 from '@/components/header.vue'
export default {
    name: 'Manage',
    data() {
      var checkoldPassword = (rule, value, callback) => {
        if (value === '') {
          return callback(new Error('旧密码不能为空'));
        }else{
          callback()
        }
        
      };
      var validatePass = (rule, value, callback) => {
        if (value === '') {
          callback(new Error('请输入密码'));
        } else {
          if (this.passwordForm.newPasswordRepeat !== '') {
            this.$refs.passwordForm.validateField('newPasswordRepeat');
          }
          callback();
        }
      };
      var validatePass2 = (rule, value, callback) => {
        if (value === '') {
          callback(new Error('请再次输入密码'));
        } else if (value !== this.passwordForm.newPassword) {
          callback(new Error('两次输入密码不一致!'));
        } else {
          callback();
        }
      };
      return {
        passwordForm:{
          oldPassword:'',
          newPassword:'',
          newPasswordRepeat:'',
        },
        rules: {
          oldPassword: [
            { validator: checkoldPassword, trigger: 'blur' }
          ],
          newPassword: [
            { validator: validatePass, trigger: 'blur' }
          ],
          newPasswordRepeat: [
            { validator: validatePass2, trigger: 'blur' }
          ]
        }
      }
    },
    components:{
        sider,
        header1
    },
    mounted() {
      document.title="珞青网后台管理";
    },
    methods: {
      cancelModal(){
        this.$store.state.passModal = false 
      },
      enterModal(){
        this.$refs.passwordForm.validate((valid) => {
          if (valid) {
            var params = new URLSearchParams();
            params.append('token', this.$cookies.get("token"));
            params.append('oldPassword', this.passwordForm.oldPassword);
            params.append('newPassword', this.passwordForm.newPassword);
            this.$axios.post("/api/php/changePassword.php",params).then(
              res=>{
                console.log(res.data);
                if (res.data.status!=="success"){
                    this.$message.error(res.data.message || "未知错误")   
                }else{
                    this.$message.success("修改成功,请重新登录")
                    this.$store.state.passModal = false
                    this.$cookies.remove('token');
                    this.$router.push("/login");
                }
              }
            );
          }else{

          }
        })
        
      }
    },
}
</script>
<style scoped>
.content{
  display: flex;
  width: 100%;
  height: 100%;
  top: 64px;
  position: absolute;
}
.content #sider{
  width: 205px;
  bottom: 0;
}
#main{
  flex-grow: 1;
  overflow: auto
}
</style>
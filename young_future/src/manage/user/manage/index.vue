<template>
<!-- 这里写登录页面html,按规定格式写好注释 -->
<div>
    <div class="page_header">
        <i class="el-icon-user"/>&nbsp;{{this.$store.state.pageTitle}}
    </div>
    <el-card class="manageCard" shadow="hover">
        <el-table
            default-expand-all
            stripe
            border
            :data="userList"
            style="width: 100%"
            :cell-style="{'text-align':'center'}">
            <el-table-column label="用户管理" header-align="center">
                <el-table-column type="index" label="#"  width="50" header-align="center"/>
                <el-table-column
                    prop="uAccount"
                    label="账户"
                    header-align="center"/>
                <el-table-column
                    prop="uName"
                    label="用户名"
                    header-align="center"/>
                <el-table-column
                    prop="uGrade"
                    label="年级"
                    header-align="center"/>
                <el-table-column label="操作" header-align="center">
                    <template slot-scope="scope">
                    <el-button
                    size="mini"
                    type="danger"
                    @click="deleteUser(scope.row.uID,scope.$index)">
                    删除</el-button>
                    </template>
                </el-table-column>
            </el-table-column>
        </el-table>
    </el-card>
</div>

</template>

<script>
export default {
    //数据绑定
    data() {
        return {
            userList:[]
        }
    },
    mounted(){
        this.$store.state.pageTitle="管理用户"
        this.$axios.get("/api/php/opUser.php",
        {params:{
            'token':this.$cookies.get("token"),
            'type':'get'
            }}).then(
        res=>{
                console.log(res.data);
                if (res.data.status!=="success"){
                    this.$message.error(res.data.message || "未知错误")   
                }else{
                    this.userList=res.data.list
                }
            }
        );

    },
    //用axios请求数据
    methods: {
        deleteUser(uID,index){
            console.log(uID);
            
            this.$axios.get("/api/php/opUser.php",
            {params:{
                'token':this.$cookies.get("token"),
                'type':'delete',
                'uID':uID
                }}).then(
            res=>{
                    console.log(res.data);
                    if (res.data.status!=="success"){
                        this.$message.error(res.data.message || "删除失败")   
                    }else{
                        this.$message.success("删除成功")
                        this.userList.splice(index,1)
                    }
                }
            );
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
</style>
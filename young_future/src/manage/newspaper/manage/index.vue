<template>
<div>
    <div class="page_header">
        <i class="el-icon-notebook-2"/>&nbsp;{{this.$store.state.pageTitle}}
    </div>
    <el-card class="manageCard" shadow="hover">
        <el-table
            default-expand-all
            stripe
            border
            :data="newspaperList"
            style="width: 100%"
            :cell-style="{'text-align':'center'}"
            v-loading="loading || deleteloading"
            >
            <el-table-column label="珞青报" header-align="center">
                <el-table-column type="index" label="#"  width="50" header-align="center"/>
                <el-table-column
                    prop="title"
                    label="标题"
                    header-align="center"/>
                <el-table-column
                    prop="uploadTime"
                    label="上传时间"
                    header-align="center"/>
                <el-table-column
                    prop="uploadPerson"
                    label="上传者"
                    header-align="center"/>
                <el-table-column
                    prop="viewTimes"
                    label="浏览量"
                    header-align="center"/>
                <el-table-column label="操作" header-align="center">
                    <template slot-scope="scope">
                    <el-button
                    size="mini"
                    @click="view(scope.row.title)">浏览</el-button>
                    <el-button
                    size="mini"
                    type="danger"
                    @click="deletePaper(scope.row.title,scope.$index)">
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
            newspaperList:[],
            loading:false,
            deleteloading:false
        }
    },
    mounted(){
        this.$store.state.pageTitle="管理珞青报"
        this.loading=true,
        this.$axios.get("/api/php/opNewsPaper.php",
        {params:{
            'token':this.$cookies.get("token"),
            'type':'get'
            }}).then(
        res=>{
                console.log(res.data);
                this.loading=false;
                if (res.data.status!=="success"){
                    this.$message.error(res.data.message || "未知错误")   
                }else{
                    this.newspaperList=res.data.list
                }
            }
        );
    },
    //用axios请求数据
    methods: {
        //跳转到文章界面
        view(title){
            this.$router.push('/newspaper/'+title)
        },
        deletePaper(title,index){
            console.log(title);
            this.deleteloading=true
            this.$axios.get("/api/php/opNewsPaper.php",
            {params:{
                'token':this.$cookies.get("token"),
                'type':'delete',
                'title':title
                }}).then(
            res=>{
                    console.log(res.data);
                    this.deleteloading=false
                    if (res.data.status!=="success"){
                        this.$message.error(res.data.message || "删除失败")   
                    }else{
                        this.$message.success("删除成功")
                        this.newspaperList.splice(index,1)
                    }
                }
            );
        }
    },
}
</script>

<style>
/* 这里写css */
.manageCard{
    width:90%;
    margin: 20px auto 80px;
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
</style>
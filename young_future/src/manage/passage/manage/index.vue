<template>
<div>
    <div class="page_header">
        <i class="el-icon-document"/>&nbsp;{{this.$store.state.pageTitle}}
    </div>
    <el-card class="manageCard" shadow="hover">
        <el-table
            default-expand-all
            stripe
            border
            :data="passageList"
            style="width: 100%"
            :cell-style="{'text-align':'center'}">
            <el-table-column label="文章" header-align="center">
                <el-table-column type="index" label="#"  width="50" header-align="center"/>
                <el-table-column
                    prop="pTitle"
                    label="标题"
                    header-align="center"/>
                <el-table-column
                    prop="pAuthor"
                    label="作者"
                    header-align="center"/>
                <el-table-column
                    prop="pPublisher"
                    label="发布者"
                    header-align="center"/>
                <el-table-column
                    prop="pCategory"
                    label="类别"
                    header-align="center"/>
                <el-table-column
                    prop="pUpdateTime"
                    label="更新时间"
                    header-align="center"/>
                <el-table-column
                    prop="pViews"
                    label="浏览量"
                    header-align="center"/>
                <el-table-column label="操作" header-align="center">
                    <template slot-scope="scope">
                    <el-button
                    size="mini"
                    @click="view(scope.row.pTitle)">浏览</el-button>
                    <el-button
                    size="mini"
                    type="danger"
                    @click="deletePaper(scope.row.pID,scope.$index)">
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
            passageList:[]
        }
    },
    mounted(){
        this.$store.state.pageTitle="管理文章"
        this.$axios.get("/api/php/opPassage.php",
        {params:{
            'token':this.$cookies.get("token"),
            'type':'get'
            }}).then(
        res=>{
                console.log(res.data);
                if (res.data.status!=="success"){
                    this.$message.error(res.data.message || "未知错误")   
                }else{
                    this.passageList=res.data.list
                }
            }
        );
    },
    //用axios请求数据
    methods: {
        //跳转到文章界面
        view(title){

        },
        deletePaper(pID,index){
            console.log(pID);
            
            this.$axios.get("/api/php/opPassage.php",
            {params:{
                'token':this.$cookies.get("token"),
                'type':'delete',
                'pID':pID
                }}).then(
            res=>{
                    console.log(res.data);
                    if (res.data.status!=="success"){
                        this.$message.error(res.data.message || "删除失败")   
                    }else{
                        this.$message.success("删除成功")
                        this.passageList.splice(index,1)
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
    margin: 20px 15px 80px;
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
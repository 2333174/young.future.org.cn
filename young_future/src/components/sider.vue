<template>
            <el-menu
            default-active="1"
            class="el-menu-vertical-demo"
            @open="handleOpen"
            @close="handleClose"
            background-color="#545c64"
            text-color="#fff"
            active-text-color="#ffd04b"
            style="height:100%"
            router
            >
            <el-submenu index="1">
                <template slot="title">
                <i class="el-icon-user"></i>
                <span>用户管理</span>
                </template>
                <el-menu-item index="/manager/user/add">添加用户</el-menu-item>
                <el-menu-item index="/manager/user/manager">添加用户</el-menu-item>
            </el-submenu>
            <el-submenu index="2">
                <template slot="title">
                <i class="el-icon-document"></i>
                <span>文章管理</span>
                </template>
                <el-menu-item index="/manager/passage/add">添加文章</el-menu-item>
                <el-menu-item index="/manager/passage/manager">管理文章</el-menu-item>
            </el-submenu>
            <el-submenu index="3">
                <template slot="title">
                <i class="el-icon-notebook-1"></i>
                <span>珞青报管理</span>
                </template>
                <el-menu-item index="/manager/newspaper/add">添加珞青报</el-menu-item>
                <el-menu-item index="/manager/newspaper/manager">管理珞青报</el-menu-item>
            </el-submenu>
            </el-menu>

</template>

<script>
  export default {
    methods: {
      handleOpen(key, keyPath) {
        console.log(key, keyPath);
      },
      handleClose(key, keyPath) {
        console.log(key, keyPath);
      }
    }
  }
</script>
<template lang="html">
  <el-container>
    <sidebar></sidebar>
    <el-container class="content">
      <el-header>
        <navbar></navbar>
      </el-header>
      <el-main class="main-app"><router-view></router-view></el-main>
    </el-container>
  </el-container>
</template>

<script>
import Navbar from './Navbar.vue'
import Sidebar from './Sidebar.vue'
export default {
  components: {
    Navbar, Sidebar
  }
}
</script>

<style>
  .main-app{
    margin-top: 30px;
  }
</style>

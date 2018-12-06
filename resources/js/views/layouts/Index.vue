<template lang="html">
  <div class="app-wrapper" :class="classObj">
    <sidebar class="sidebar-container"></sidebar>
    <el-container class="main-container">
      <el-header>
        <navbar></navbar>
      </el-header>
      <el-main class="main-app"><router-view></router-view></el-main>
    </el-container>
  </div>
</template>

<script>
import Navbar from './Navbar.vue'
import Sidebar from './Sidebar.vue'
export default {
  components: {
    Navbar, Sidebar
  },
  data(){
    return {
      classObj() {
        return {
          hideSidebar: !this.sidebar,
          openSidebar: this.sidebar
        }
      }
    }
  },
  computed: {
    sidebar() {
      return this.$store.state.app.sidebar
    }
  }
}
</script>

<style>
  .main-app{
    background-color: whitesmoke;
  }
  ul{
    list-style: none !important;
  }
</style>

<template lang="html">
    <el-menu
      class="sidebar"
      :collapse="sidebar"
      background-color="#545c64"
      text-color="#fff"
      active-text-color="#ffd04b"
      :router="true">
      <el-menu-item index="home">
        <div class="icon-menu"><fa icon="file-invoice" /></div>
        <span>Documentos</span>
      </el-menu-item>
      <el-menu-item index="2">
        <div class="icon-menu"><fa icon="bookmark" /></div>
        <span>Cupones</span>
      </el-menu-item>
      <el-menu-item index="payments">
        <div class="icon-menu"><fa icon="money-bill" /></div>
        <span>Forma de pago</span>
      </el-menu-item>
      <el-menu-item index="4">
        <div class="icon-menu"><fa icon="users" /></div>
        <span>Terceros</span>
      </el-menu-item>
    </el-menu>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  data() {
    return {
      isCollapse: true
    }
  },
  computed:{
    ...mapGetters(['sidebar'])
  },
  methods: {
   }
}
</script>

<style lang="css">
.sidebar:not(.el-menu--collapse) {
    width: 200px;
  }
.sidebar{
  height: -webkit-fill-available;
}
.icon-menu{
  text-align: center;
    float: left;
    width: 20px;
    margin-left: 7px;
    margin-right: 12px;
}
</style>

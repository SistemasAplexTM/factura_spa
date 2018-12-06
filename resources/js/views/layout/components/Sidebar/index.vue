<template lang="html">
  <el-scrollbar wrapClass="scrollbar-wrapper">
    <el-menu
        :show-timeout="200"
        :default-active="$route.path"
        :collapse="isCollapse"
        background-color="#3B4F64"
        text-color="#fff"
        active-text-color="#ffd04b"
        :router="true"
        >
      <el-menu-item index="documents">
        <icon-aplex name="file-invoice" :type="'awesome'" class="icon-menu"/>
        <span slot="title">Documentos</span>
      </el-menu-item>
      <el-menu-item index="cupons">
        <icon-aplex name="bookmark" :type="'awesome'" class="icon-menu"/>
        <span slot="title">Cupones</span>
      </el-menu-item>
      <el-menu-item index="payments">
        <icon-aplex name="money-bill" :type="'awesome'" class="icon-menu"/>
        <span slot="title">Forma de pago</span>
      </el-menu-item>
      <el-menu-item index="terceros">
        <icon-aplex name="users" :type="'awesome'" class="icon-menu"/>
        <span slot="title">Terceros</span>
      </el-menu-item>
    </el-menu>
  </el-scrollbar>
</template>
<script>
  import { mapGetters } from 'vuex'
  export default {
    computed: {
      ...mapGetters([
        'sidebar'
      ]),
      isCollapse() {
        return !this.sidebar
      }
    },
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

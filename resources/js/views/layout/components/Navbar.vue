<template>
  <el-menu class="navbar" mode="horizontal">
    <hamburger :toggle-click="toggleSideBar" :is-active="sidebar" class="hamburger-container"/>
    <!-- <breadcrumb /> -->
    <div class="right-menu">
      <el-dropdown class="avatar-container right-menu-item" trigger="click">
        <div class="avatar-wrapper">
          <img :src="'http://tusimagenesde.com/wp-content/uploads/2018/03/foto-perfil-1.png?imageView2/1/w/80/h/80'" class="user-avatar">
          <i class="el-icon-caret-bottom"/>
        </div>
        <el-dropdown-menu slot="dropdown" class="user-dropdown">
          <router-link class="inlineBlock" to="/perfil">
            <el-dropdown-item>
              Perfil
            </el-dropdown-item>
          </router-link>
          <el-dropdown-item divided>
            <span style="display:block;" @click="logout()">Salir</span>
          </el-dropdown-item>
        </el-dropdown-menu>
      </el-dropdown>
    </div>
  </el-menu>
</template>

<script>
import { mapGetters } from 'vuex'
import { logout } from '@/api/auth'
import Breadcrumb from '@/components/Breadcrumb'
import Hamburger from '@/components/Hamburger'

export default {
  components: {
    Breadcrumb,
    Hamburger
  },
  data() {
    return {

    }
  },
  computed: {
    ...mapGetters([
      'sidebar'
    ])
  },
  methods: {
    toggleSideBar() {
      this.$store.dispatch('toggleSideBar')
    },
    logout(){
      logout().then(({data}) => {
        if (data.code == 200) {
          localStorage.removeItem('setup')
          location.reload(true)
        }
      }).catch(error => {
        console.log(error);
      })
    },
    refresh(){
      location.reload()
    }
  }
}
</script>

<style rel="stylesheet/scss" lang="scss" scoped>
.navbar {
  height: 60px;
  line-height: 70px !important;
  border-radius: 0px !important;
  .hamburger-container {
    line-height: 70px;
    height: 60px;
    float: left;
    padding: 0 10px;
  }
  .right-menu {
    float: right;
    height: 100%;
    &:focus{
     outline: none;
    }
    .right-menu-item {
      display: inline-block;
      margin: 0 8px;
    }
    .avatar-container {
      height: 50px;
      margin-right: 30px;
      .avatar-wrapper {
        cursor: pointer;
        margin-top: 5px;
        position: relative;
        .user-avatar {
          width: 40px;
          height: 40px;
          border-radius: 10px;
        }
        .el-icon-caret-bottom {
          position: absolute;
          right: -20px;
          top: 25px;
          font-size: 12px;
        }
      }
    }
  }
}
</style>

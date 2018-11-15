<template lang="html">
  <el-menu
    class="navbar"
    mode="horizontal">
    <hamburger :toggle-click="toggleSideBar" :is-active="!sidebar" class="hamburger-container"/>
    <div class="fr avatar-container">
      <el-dropdown class="" trigger="click">
        <div class="">
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
import Hamburger from '@/components/Hamburger'
import Avatar from 'vue-avatar'
import { logout } from '@/api/auth'
import { mapGetters } from 'vuex'

export default {
  name: 'Navbar',
  components: {
    Avatar, Hamburger
  },
  data() {
    return {

    };
  },
  computed:{
    ...mapGetters(['sidebar'])
  },
  methods: {
    toggleSideBar() {
      this.$store.dispatch('toggleSideBar')
    },
    logout(){
      logout().then(({data}) => {
        if (data.code == 200) {
          location.reload(true)
        }
      }).catch(error => {
        console.log(error);
      })
    }
  }
}
</script>

<style lang="css" scoped>
.hamburger-container {
    line-height: 70px;
    height: 60px;
    float: left;
    padding: 0 10px;
  }
.user-avatar{
  width: 40px;
  border-radius: 100px;
  cursor: pointer;
  vertical-align: middle;
}
.avatar-container:hover{
  mix-blend-mode:darken;
}
.avatar-container{
  margin-right: 10px;
  padding: 5px;
}
</style>

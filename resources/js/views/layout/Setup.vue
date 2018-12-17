<template lang="html">
  <img style="width: 100%" src="https://www.unocero.com/wp-content/uploads/2018/03/Agua.gif" alt="">
</template>

<script>
import { setup } from '@/api/setup'
export default {
  data(){
    return {

    }
  },
  created(){
    this.getSetup()
  },
  methods:{
    getSetup(){
      let me = this
      setup().then(({data}) => {
        localStorage.setItem('setup', JSON.stringify(data.data))
        setTimeout(function () {
          var route = (me.$route.query.route && me.$route.query.route.indexOf("js") > -1) ? me.$route.query.route : '/'
          me.$router.push({path: route })
        }, 300);
      }).catch( error => { console.log(error); })
    }
  }
}
</script>

<style lang="css">
</style>

<template>
  <div class="">
    <i>
      <icon-vue-awesome v-if="type == 'vue-awesome'" :name="name" :scale="scale"/>
    </i>
    <i v-if="type == 'lnr'" :class="'lnr lnr-' + name" :style="'font-size: '+ scale + 'em'"></i>
  </div>
</template>

<script>
import 'vue-awesome/icons'
import Icon, * as IconVueAwesome from 'vue-awesome/components/Icon'

// Vue.component('icon-vue-awesome', Icon)

export default {
  name: 'icon',
  components: { IconVueAwesome },
  props: ["name", "scale", "type"],
  data(){
    return {

    }
  }
}
</script>

<style lang="css" scoped>
div{
  display: inline-block;
}
</style>

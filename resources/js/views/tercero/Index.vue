<template lang="html">
  <div>
      <sticky :className="'sub-navbar draft'" title="Terceros">
      </sticky>
    <el-row :gutter="24">
      <el-col :span="8">
        <form-module @refresh="refreshTable"></form-module>
      </el-col>
      <el-col :span="16">
        <list ref="list"></list>
      </el-col>
    </el-row>
  </div>
</template>

<script>
import List from './List'
import FormModule from './Form'
import Sticky from '@/components/Sticky'
export default {
  components: {
    List, FormModule, Sticky
  },
  methods:{
    refreshTable(){
      this.$refs.list.refresh()
    }
  }
}
</script>

<style>

</style>

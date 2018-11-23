<template lang="html">
  <div>
      <sticky :className="'sub-navbar draft'" title="Forma de pago">
      </sticky>
    <el-row :gutter="24">
      <el-col :span="8">
        <form-payment @refresh="refreshTable"></form-payment>
      </el-col>
      <el-col :span="16">
        <list ref="list"></list>
      </el-col>
    </el-row>
  </div>
</template>

<script>
import List from './List'
import FormPayment from './Form'
import Sticky from '@/components/Sticky'
export default {
  components: {
    List, FormPayment, Sticky
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

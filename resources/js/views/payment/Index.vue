<template lang="html">
  <el-row :gutter="24">
    <el-col :span="8">
      <form-payment></form-payment>
    </el-col>
    <el-col :span="16">
      <list></list>
    </el-col>
  </el-row>
</template>

<script>
import List from './List'
import FormPayment from './Form'
export default {
  components: {
    List, FormPayment
  }
}
</script>

<style>

</style>

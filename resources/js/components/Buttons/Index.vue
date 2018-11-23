<template lang="html">
  <div class="">
    <el-button size="small" class="btn-create" type="primary" @click="submitForm(form)">Crear</el-button>
    <el-button size="small" class="btn-cancel" @click="resetForm(form)">Limpiar</el-button>
  </div>
</template>

<script>
export default {
  props: {
    form: {
      required: true
    }
  },
  methods: {

  }
}
</script>

<style lang="css" scoped>
.btn-create{

}
.btn-cancel{

}
</style>

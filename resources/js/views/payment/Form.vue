<template lang="html">
	<el-card shadow="hover">
	  <el-form ref="form" :model="form" label-width="120px">
	  <el-form-item label="Descripción">
	    <el-input v-model="form.name"></el-input>
	  </el-form-item>
	  <el-form-item>
	    <el-button type="primary" @click="onSubmit">Create</el-button>
	    <el-button>Cancel</el-button>
	  </el-form-item>
	</el-form>
</el-card>
</template>

<script>
export default {
  data() {
      return {
        form: {
          name: '',
          region: '',
          date1: '',
          date2: '',
          delivery: false,
          type: [],
          resource: '',
          desc: ''
        }
      }
    },
    methods: {
      onSubmit() {
        console.log('submit!');
      }
    }
}
</script>

<style>

</style>

<template lang="html">
	<el-card shadow="hover">
		<div slot="header" class="clearfix">
            <sticky :className="'sub-navbar draft'" title="">
            	<div class="text-right">
	              <el-button v-if="!editing" size="small" type="primary" @click="submit()">
	                Guardar
	              </el-button>
	              <el-button v-else size="small" type="primary" @click="update">
	                Actualizar
	              </el-button>
	              <el-button id="cancelButton" type="default" size="small" @click="reset">Cancelar</el-button>
              	</div>
            </sticky>
        </div>
		<el-form ref="form" :model="form" label-width="120px" label-position="left" :rules="rules">
			<el-form-item label="Descripción" prop="descripcion">
			    <el-input v-model="form.descripcion"></el-input>
			</el-form-item>
			<el-form-item>
			    
			</el-form-item>
		</el-form>
	</el-card>
</template>

<script>
import Sticky from '@/components/Sticky'
import { save } from '@/api/payment'

export default {
	components:{ Sticky },
  data() {
      return {
      	editing: false,
        form: {
          descripcion: null
        },
        rules: {
          descripcion: [
            { required: true, message: 'Completa este campo', trigger: 'blur' }
          ]
        }
      }
    },
    methods: {
      submit() {
        this.$refs['form'].validate((valid) => {
          if (valid) {
            save(this.form).then(({ data }) => {
              if(data.code == 200){
                this.reset()
                this.$message({
                  showClose: true,
                  message: 'Registro exitoso.',
                  type: 'success'
                });
              }else{
                this.$message({
                  showClose: true,
                  message: 'Error: '+ data.error.errorInfo,
                  type: 'error'
                });
              }
            }).catch(error => {
              this.$message({
                showClose: true,
                message: 'Error.',
                type: 'error'
              });
            })
          } else {
            console.log('error submit!!');
            return false;
          }
        });
        
      },
      update() {
        //
      },
      reset() {
        this.$emit('refresh')
        this.$refs['form'].resetFields();
      }
    }
}
</script>

<style>

</style>

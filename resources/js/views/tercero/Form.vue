<template lang="html">
	<el-card shadow="hover">
		<div slot="header" class="clearfix">
            <sticky :className="'sub-navbar draft'" title="">
            	<div class="text-right">
	              <el-button v-if="!editing" size="small" type="success" icon="el-icon-plus" :loading="loading" @click="submit()">
	                Guardar
	              </el-button>
	              <el-button v-else size="small" type="primary" icon="el-icon-edit-outline" :loading="loading" @click="submit()">
	                Actualizar
	              </el-button>
	              <el-button id="cancelButton" type="default" size="small" icon="el-icon-circle-close" @click="reset(true)">Cancelar</el-button>
              	</div>
            </sticky>
        </div>
		  <el-form ref="form" :model="form" label-width="120px" label-position="left" :rules="rules">
  			<el-form-item label="Documento" prop="documento">
            <el-input v-model="form.documento" placeholder="Ingrese el documento o NIT" prefix-icon="el-icon-edit"></el-input>
        </el-form-item>
        <el-form-item label="Nombre" prop="nombre">
  			    <el-input v-model="form.nombre" placeholder="Ingrese el nombre" prefix-icon="el-icon-edit"></el-input>
  			</el-form-item>
        <el-form-item label="Dirección" prop="direccion">
            <el-input v-model="form.direccion" placeholder="Ingrese la dirección" prefix-icon="el-icon-location"></el-input>
        </el-form-item>
        <el-form-item label="Teléfono" prop="telefono">
            <el-input v-model="form.telefono" type="tel" placeholder="Ingrese el teléfono" prefix-icon="el-icon-phone-outline"></el-input>
        </el-form-item>
        <el-form-item label="Ciudad" prop="ciudad">
            <el-input v-model="form.ciudad" placeholder="Ingrese la ciudad" prefix-icon="el-icon-location-outline"></el-input>
        </el-form-item>
        <el-form-item label="Email" prop="email">
            <el-input v-model="form.email" type="email" placeholder="Ingrese el email" prefix-icon="el-icon-message"></el-input>
        </el-form-item>
        <el-form-item label="Nacimiento" prop="nacimiento">
            <el-date-picker
              v-model="form.nacimiento"
              type="date"
              placeholder="Selecciona fecha"
              class="width-full">
            </el-date-picker>
          </el-form-item>
          <el-col :span="8">
            <el-form-item class="labelOff" prop="cliente">
              <el-switch v-model="form.cliente" active-text="Cliente"></el-switch>
              </el-form-item>
            </el-col>
            <el-col :span="8">
              <el-form-item class="labelOff" prop="vendedor">
              <el-switch v-model="form.vendedor" active-text="Vendedor"></el-switch>
              </el-form-item>
            </el-col>
            <el-col :span="8">
              <el-form-item class="labelOff" prop="proveedor">
              <el-switch v-model="form.proveedor" active-text="Proveedor"></el-switch>
            </el-form-item>
            </el-col>
		</el-form>
	</el-card>
</template>

<script>
import Sticky from '@/components/Sticky'
import { save, update } from '@/api/tercero'
import { mapGetters } from 'vuex'

export default {
	components:{ Sticky },
  computed:{
    ...mapGetters([
        'tercero_editing'
      ])
  },
  watch:{
    tercero_editing: function(value, oldValue){
      if(value){
        if(value.cliente == 1){
          value.cliente = true
        }else{
          value.cliente = false
        }
        if(value.vendedor == 1){
          value.vendedor = true
        }else{
          value.vendedor = false
        }
        if(value.proveedor == 1){
          value.proveedor = true
        }else{
          value.proveedor = false
        }
        this.form = value
        this.editing = true
      }
    }
  },
  data() {
      return {
        editing: false,
      	loading: false,
        form: {
          documento: null,
          nombre: null,
          direccion: null,
          telefono: null,
          ciudad: null,
          email: null,
          nacimiento: null,
          cliente: false,
          vendedor: false,
          proveedor: false,
        },
        rules: {
          documento: [
            { required: true, message: 'Completa este campo', trigger: 'blur' }
          ],
          nombre: [
            { required: true, message: 'Completa este campo', trigger: 'blur' }
          ],
          direccion: [
            { required: true, message: 'Completa este campo', trigger: 'blur' }
          ],
          telefono: [
            { required: true, message: 'Completa este campo', trigger: 'blur' }
          ],
          ciudad: [
            { required: true, message: 'Completa este campo', trigger: 'blur' }
          ],
        }
      }
    },
    methods: {
      submit() {
        this.loading = true;
        this.$refs['form'].validate((valid) => {
          if (valid) {
            if (!this.editing) {
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
            }else{
              update(this.form).then(({ data }) => {
                if(data.code == 200){
                  this.reset()
                  this.$message({
                    showClose: true,
                    message: 'Actualización exitosa.',
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
            }
          } else {
            this.loading = false;
            console.log('error submit!!');
            return false;
          }
        });
        
      },
      update() {
        //
      },
      reset(cancel) {
        if(!cancel){
          this.$emit('refresh')
        }
        this.$refs['form'].resetFields();
        this.form.id = null
        this.editing = false
        this.loading = false;
      }
    }
}
</script>

<style>
.labelOff > .el-form-item__content{
  margin-left: 0px !important;
}
</style>
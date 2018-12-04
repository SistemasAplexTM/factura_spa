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
			<el-form-item label="Código" prop="codigo_barras">
			    <el-input v-model="form.codigo_barras" placeholder="Código de barras" prefix-icon="el-icon-edit"></el-input>
			</el-form-item>
			<el-form-item label="Descuento" prop="descuento">
			    <el-input type="number" min="0" v-model="form.descuento" placeholder=".00" prefix-icon="el-icon-edit"></el-input>
			</el-form-item>
			<el-form-item label="Descripción" prop="descripcion">
			    <el-input type="textarea" v-model="form.descripcion" placeholder="Nombre del descripción" prefix-icon="el-icon-edit"></el-input>
			</el-form-item>
			<el-form-item label="Fecha inicio" prop="fecha_inicio">
			    <el-date-picker
	              v-model="form.fecha_inicio"
	              type="date"
	              placeholder="Selecciona fecha"
	              class="width-full">
            	</el-date-picker>
			</el-form-item>
			<el-form-item label="Fecha fin" prop="fecha_fin">
			    <el-date-picker
	              v-model="form.fecha_fin"
	              type="date"
	              placeholder="Selecciona fecha"
	              class="width-full">
            	</el-date-picker>
			</el-form-item>
			<el-form-item label="Cantidad" prop="cantidad">
			    <el-input type="number" min="0" v-model="form.cantidad" placeholder=".00" prefix-icon="el-icon-edit"></el-input>
			</el-form-item>
		</el-form>
	</el-card>
</template>

<script>
import Sticky from '@/components/Sticky'
import { save, update } from '@/api/cupons'
import { mapGetters } from 'vuex'

export default {
	components:{ Sticky },
  computed:{
    ...mapGetters([
        'cupons_editing'
      ])
  },
  watch:{
    cupons_editing: function(value, oldValue){
      if(value){
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
          descripcion: null,
          codigo_barras: null,
          descuento: null,
          fecha_inicio: null,
          fecha_fin: null,
          cantidad: null,
        },
        rules: {
          descripcion: [
            { required: true, message: 'Completa este campo', trigger: 'blur' }
          ],
          codigo_barras: [
            { required: true, message: 'Completa este campo', trigger: 'blur' }
          ],
          descuento: [
            { required: true, message: 'Completa este campo', trigger: 'blur' }
          ],
          fecha_inicio: [
            { required: true, message: 'Completa este campo', trigger: 'blur' }
          ],
          fecha_fin: [
            { required: true, message: 'Completa este campo', trigger: 'blur' }
          ],
          cantidad: [
            { required: true, message: 'Completa este campo', trigger: 'blur' }
          ]
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
              var datos = {
                id : this.form.id,
                descripcion : this.form.descripcion,
                codigo_barras : this.form.codigo_barras,
                descuento : this.form.descuento,
                fecha_inicio : this.form.fecha_inicio,
                fecha_fin : this.form.fecha_fin,
                cantidad : this.form.cantidad,
              }
              update(datos).then(({ data }) => {
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

</style>

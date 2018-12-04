<template lang="html">
  <div>
      <sticky :className="'sub-navbar draft'">
      	<div class="text-right">
          <el-button v-if="!editing" size="small" type="success" icon="el-icon-plus" :loading="loading" @click="submit()">
            Guardar
          </el-button>
          <el-button v-else size="small" type="primary" icon="el-icon-edit-outline" :loading="loading" @click="submit()">
            Actualizar
          </el-button>
          <el-button size="small" type="primary" icon="el-icon-edit-outline" :loading="loading" @click="submit()">
            Cambiar bodega
          </el-button>
          <el-button id="cancelButton" type="default" size="small" icon="el-icon-circle-close" @click="reset(true)">Cancelar</el-button>
          <el-button id="cancelButton" type="danger" size="small" icon="el-icon-circle-close" @click="reset(true)">Anular</el-button>
          <el-button id="cancelButton" type="danger" size="small" icon="el-icon-circle-close" @click="reset(true)">Eliminar detalle</el-button>
      	</div>
      </sticky>

      <form-document></form-document>
    	
  </div>
</template>

<script>
import FormDocument from './Form'
import Sticky from '@/components/Sticky'
export default {
  components: {
    Sticky, FormDocument
  },
  data(){
  	return {
  		editing: false,
        loading: false,
  	}
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

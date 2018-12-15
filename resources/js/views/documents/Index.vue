<template lang="html">
  <div>
      <sticky :className="'sub-navbar draft'">
      	<div class="text-right">
          <el-button id="cancelButton" type="default" size="small" icon="el-icon-tickets" @click="">Listar</el-button>
          <el-dropdown v-if="!editing" split-button type="success"
          :loading="loading"
          @click="submit"
          icon="el-icon-plus"
          size="small"
          @keyup.ctrl.13="submit">
            Guardar
            <el-dropdown-menu slot="dropdown">
              <el-dropdown-item>Guardar borrador</el-dropdown-item>
              <el-dropdown-item>Guardar e imprimir</el-dropdown-item>
            </el-dropdown-menu>
          </el-dropdown>
          <el-button v-else size="small" type="primary" icon="el-icon-edit-outline" :loading="loading" @click="submit()">
            Actualizar
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
import { save } from '@/api/document'
import { mapGetters } from 'vuex'

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
  computed:{
    ...mapGetters([
      'totals', 'table_detail', 'form_document'
    ])
  },
  methods:{
    refreshTable(){
      this.$refs.list.refresh()
    },
    submit(){
      let setup = JSON.parse(localStorage.getItem('setup'))
      let data = {
        form_document: this.form_document,
        table_detail: this.table_detail,
        totals: this.totals
      }
      save(data).then(response => {
        // this.$store.dispatch('defaultAll')
      }).catch(error => {
        console.log(error)
      })
    }
  }
}
</script>

<style>

</style>

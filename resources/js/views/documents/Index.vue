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
      <el-dialog
        title="Finalizar venta"
        :visible.sync="modalFP"
        width="30%"
        center>
        <el-tabs type="" tab-position="left">
          <h1>Factura de venta N° <strong>{{ consecutivo }}</strong></h1>
          <hr>
          <el-tab-pane>
            <span slot="label">
              Efectivo
              <icon-aplex name="money-bill-alt" :type="'awesome'"/>
            </span>
            <div class="">
              <el-input placeholder="Valor a pagar" v-model="input">
                <template slot="prepend">
                  <icon-aplex name="dollar-sign" :type="'awesome'"/>
                </template>
              </el-input>
              <hr>
              <el-tag type="info" class="pointer">$ 10.000</el-tag>
              <el-tag type="info" class="pointer">$ 10.000</el-tag>
              <el-tag type="info" class="pointer">$ 10.000</el-tag>
              <el-tag type="info" class="pointer">$ 10.000</el-tag>
              <el-tag type="info" class="pointer">$ 10.000</el-tag>
            </div>
          </el-tab-pane>
          <el-tab-pane label="Tarjeta">
            <span slot="label">
              Tarjeta
              <icon-aplex name="credit-card" :type="'awesome'"/>
            </span>
          </el-tab-pane>
          <el-tab-pane label="Otro">Role</el-tab-pane>
          <el-tab-pane label="Otro">Task</el-tab-pane>
        </el-tabs>
        <span slot="footer" class="dialog-footer">
          <el-button @click="dialogVisible = false">Cerrar</el-button>
          <el-button type="primary" @click="dialogVisible = false">Finalizar</el-button>
        </span>
      </el-dialog>
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
      modalFP: false,
      input: null,
      consecutivo: ''
  	}
  },
  computed:{
    ...mapGetters([
      'totals', 'table_detail', 'form_document', 'wholesale'
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
        totals: this.totals,
        wholesale: this.wholesale
      }
      save(data).then(({data}) => {
        // this.$store.dispatch('defaultAll')
        this.consecutivo = data.consecutivo
        this.modalFP = true
      }).catch(error => {
        console.log(error)
      })
    }
  }
}
</script>

<style>

</style>

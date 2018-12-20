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
        :title="'Factura de venta N° ' + consecutive"
        :visible.sync="modalFP"
        width="40%"
        center>
        <el-tabs type="" tab-position="left">
          <el-row class="">
            <el-col :span="8">
              <div class="text-center text-bold">Total a pagar</div>
            </el-col>
            <el-col :span="8">
              <div class="text-center text-bold">Total recibido</div>
            </el-col>
            <el-col :span="8">
              <div class="text-center text-bold">Devolución</div>
            </el-col>
          </el-row>
          <el-row class="">
            <el-col :span="8">
              <div class="text-center lb-total-p">{{ format(this.totals.neto) }}</div>
            </el-col>
            <el-col :span="8">
              <div class="text-center lb-payment-p">{{ format(this.totals.recibido) }}</div>
            </el-col>
            <el-col :span="8">
              <div class="text-center lb-return-p">{{ format(this.totals.devolucion) }}</div>
            </el-col>
          </el-row>

          <hr>
          <el-tab-pane>
            <span slot="label">
              Efectivo
              <icon-aplex name="money-bill-alt" :type="'awesome'"/>
            </span>
            <el-row class="input-payment_method">
              <el-col :span="24">
              <money class="el-input__inner" placeholder="Valor a pagar" v-model="payment_method" v-bind="money"></money>
              </el-col>
            </el-row>
            <el-row>
              <el-col :span="24">
              <el-button type="info" plain round size="mini" v-for="button in buttons" :key="button" @click="payment_method = button">{{ format(button) }}</el-button>
              </el-col>
            </el-row>
          </el-tab-pane>
          <el-tab-pane label="Tarjeta">
            <span slot="label">
              T. Débito
              <icon-aplex name="credit-card" :type="'awesome'"/>
            </span>
          </el-tab-pane>
          <el-tab-pane>
            <span slot="label">
              T. Crédito
              <icon-aplex name="credit-card" :type="'awesome'"/>
            </span>
          </el-tab-pane>
          <el-tab-pane label="Nota Credito">
            <span slot="label">
              Nota Crédito
              <icon-aplex name="file" :type="'awesome'"/>
            </span>
          </el-tab-pane>
        </el-tabs>
        <span slot="footer" class="dialog-footer">
          <el-button @click="modalFP = false">Cerrar</el-button>
          <el-button type="primary" @click="modalFP = false">Finalizar</el-button>
        </span>
      </el-dialog>
  </div>
</template>

<script>
import FormDocument from './Form'
import Sticky from '@/components/Sticky'
import accounting from 'accounting-js'
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
      consecutive: '24557875',
      payment_method: 0,
      buttons: [],
      apx_base: 10000
  	}
  },
  computed:{
    ...mapGetters([
      'totals', 'table_detail', 'form_document', 'wholesale', 'money'
    ])
  },
  watch:{
    payment_method: function(val){
      this.$store.commit('SET_RECEIVED', val)
      this.$store.commit('SET_RETURN', val - this.totals.neto)
    },
		totals:{
			deep: true,
			handler(val, oldVal){
					this.payment_method = val.neto
			}
		}

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
        // this.consecutive = data.consecutive
        this.modalFP = true
        this.buttonsPayment()
      }).catch(error => {
        console.log(error)
      })
    },
    buttonsPayment(){
      this.buttons = []
      let total = 0
      let cant = Math.round(this.totals.neto / this.apx_base)
      for (var i = 0; i < 4; i++) {
        this.buttons.push((cant * this.apx_base) + total)
        total += this.apx_base
      }
    },
    format(val){
			var options = {
				symbol : "$ ",
				decimal : ",",
				thousand: ".",
				precision : 0,
				format: "%s%v"
			};
			return accounting.formatMoney(val, options)
    },
  }
}
</script>

<style scoped>
  .lb-total-p{
      color: forestgreen;
      font-weight: bold;
      font-size: 20px;
  }
  .lb-payment-p{
    font-weight: bold;
    color: #909399;
    font-size: 20px;
  }
  .lb-return-p{
    font-weight: bold;
    color: #e6a23c;
    font-size: 20px;
  }
  .input-payment_method{
    margin-bottom: 10px;
  }
</style>

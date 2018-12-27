<template lang="html">
  <div>
      <sticky :className="'sub-navbar draft'">
      	<div class="text-right">
          <el-button type="default" size="small" icon="el-icon-tickets" @click="listDocuments">Listar</el-button>
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

      <list-documents></list-documents>

      <el-dialog
        :visible.sync="modalFP"
        width="40%"
        center>
        <span slot="title">
          Factura de venta N° <strong>{{ consecutive }}</strong>
          <br>
          <small>{{ form_document.client_name }}</small>
        </span>
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
              <div class="text-center lb-return-p" :class="(disabled) ? 'text-warning' : 'text-danger'" >{{ format(this.totals.devolucion) }}</div>
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
              <money class="el-input__inner" placeholder="Valor a pagar" v-model="cash.valor" v-bind="money"></money>
              </el-col>
            </el-row>
            <el-row>
              <el-col :span="24">
              <el-button type="info" plain round size="mini" v-for="button in buttons" :key="button" @click="cash.valor = button">{{ format(button) }}</el-button>
              </el-col>
            </el-row>
          </el-tab-pane>
          <el-tab-pane label="Tarjeta">
            <span slot="label">
              T. Débito
              <icon-aplex name="credit-card" :type="'awesome'"/>
            </span>
            <el-row>
              <el-col :span="24">
                <money class="el-input__inner disabled" placeholder="Valor a pagar" v-model="td.valor" v-bind="money"></money>
              </el-col>
            </el-row>
            <br>
            <el-row :gutter="12" class="input-payment_method">
              <el-col :span="18">
                <el-input placeholder="Martercard,Visa, etc" v-model="td.descripcion"></el-input>
              </el-col>
              <el-col :span="6">
                <el-input type="text" placeholder="CDC" v-model="td.descripcion1" minlength="4" maxlength="4"></el-input>
              </el-col>
            </el-row>
          </el-tab-pane>
          <el-tab-pane>
            <span slot="label">
              T. Crédito
              <icon-aplex name="credit-card" :type="'awesome'"/>
            </span>
            <el-row>
              <el-col :span="24">
                <money class="el-input__inner" placeholder="Valor a pagar" v-model="tc.valor" v-bind="money"></money>
              </el-col>
            </el-row>
            <br>
            <el-row :gutter="12" class="input-payment_method">
              <el-col :span="18">
                <el-input placeholder="Martercard,Visa, etc" v-model="tc.descripcion"></el-input>
              </el-col>
              <el-col :span="6">
                <el-input type="text" placeholder="CDC" v-model="tc.descripcion1" minlength="4" maxlength="4"></el-input>
              </el-col>
            </el-row>
          </el-tab-pane>
          <el-tab-pane>
            <span slot="label">
              Nota Crédito
              <icon-aplex name="file" :type="'awesome'"/>
            </span>
            <el-row>
              <el-col :span="24">
                <money class="el-input__inner" placeholder="Valor a pagar" v-model="nc.valor" v-bind="money"></money>
              </el-col>
            </el-row>
            <br>
            <el-row :gutter="12" class="input-payment_method">
              <el-col :span="24">
                <el-input placeholder="Número de nota crédito" v-model="nc.descripcion"></el-input>
              </el-col>
            </el-row>
          </el-tab-pane>
          <el-tab-pane>
            <span slot="label">
              Cheque
              <icon-aplex name="money-check-alt" :type="'awesome'"/>
            </span>
            <el-row>
              <el-col :span="24">
                <money class="el-input__inner" placeholder="Valor a pagar" v-model="check.valor" v-bind="money"></money>
              </el-col>
            </el-row>
            <br>
            <el-row :gutter="12" class="input-payment_method">
              <el-col :span="8">
                <el-input placeholder="Número de cuenta" v-model="check.account"></el-input>
              </el-col>
              <el-col :span="8">
                <el-input placeholder="Banco" v-model="check.banck"></el-input>
              </el-col>
              <el-col :span="8">
                <el-input placeholder="Oficina" v-model="check.office"></el-input>
              </el-col>
            </el-row>
          </el-tab-pane>
          <el-tab-pane>
            <span slot="label">
              Consignación
              <icon-aplex name="university" :type="'awesome'"/>
            </span>
            <el-row>
              <el-col :span="24">
                <money class="el-input__inner" placeholder="Valor a pagar" v-model="consig.valor" v-bind="money"></money>
              </el-col>
            </el-row>
          </el-tab-pane>
          <el-tab-pane>
            <span slot="label">
              Crédito empleados
              <icon-aplex name="user-shield" :type="'awesome'"/>
            </span>
            <el-row>
              <el-col :span="24">
                <money class="el-input__inner" placeholder="Valor a pagar" v-model="ce.valor" v-bind="money"></money>
              </el-col>
            </el-row>
            <br>
            <el-row :gutter="12" class="input-payment_method">
              <el-col :span="24">
                Número de días de crédito
                <br>
                <el-input-number placeholder="Número de días de crédito" v-model="ce.descripcion"></el-input-number>
              </el-col>
            </el-row>
          </el-tab-pane>
          <el-tab-pane>
            <span slot="label">
              Pago online
              <icon-aplex name="globe" :type="'awesome'"/>
            </span>
            <el-row>
              <el-col :span="24">
                <money class="el-input__inner" placeholder="Valor a pagar" v-model="po.valor" v-bind="money"></money>
              </el-col>
            </el-row>
          </el-tab-pane>
        </el-tabs>
        <span slot="footer" class="dialog-footer">
          <el-button @click="modalFP = false">Cerrar</el-button>
          <el-button type="primary" @click="savePaymentMethod()" :disabled="!disabled">Finalizar</el-button>
        </span>
      </el-dialog>
  </div>
</template>

<script>
import FormDocument from './Form'
import ListDocuments from './List'
import Sticky from '@/components/Sticky'
import accounting from 'accounting-js'
import { save, update, savePaymentMethod } from '@/api/document'
import { mapGetters } from 'vuex'
export default {
  components: {
    Sticky, FormDocument, ListDocuments
  },
  data(){
  	return {
      id_document: null,
  		editing: false,
      loading: false,
      modalFP: false,
      input: null,
      consecutive: null,
      buttons: [],
      apx_base: 10000,
      cash:{
        documento_id: null,
        forma_pago_id: 1,
        valor:0
      },
      td : {
        documento_id: null,
        forma_pago_id: 4,
        valor: 0,
        descripcion: '',
        descripcion1: ''
      },
      tc : {
        documento_id: null,
        forma_pago_id: 3,
        valor: 0,
        descripcion: '',
        descripcion1: ''
      },
      nc : {
        documento_id: null,
        forma_pago_id: 5,
        valor: 0,
        descripcion: '',
      },
      check : {
        documento_id: null,
        forma_pago_id: 2,
        valor: 0,
        descripcion: '',
        descripcion1: '',
        descripcion2: ''
      },
      consig: {
        documento_id: null,
        forma_pago_id: 6,
        valor: 0
      },
      ce: {
        documento_id: null,
        forma_pago_id: 7,
        valor: 0,
        descripcion: ''
      },
      po: {
        documento_id: null,
        forma_pago_id: 8,
        valor: 0
      }
  	}
  },
  computed:{
    ...mapGetters([
      'totals', 'table_detail', 'form_document', 'wholesale', 'money'
    ]),
    disabled(){
      if(this.totals.devolucion >= 0){
        return true
      }
      return false
    }
  },
  watch:{
    id_document(val){
      this.cash.documento_id = val;
      this.td.documento_id = val;
      this.tc.documento_id = val;
      this.nc.documento_id = val;
      this.check.documento_id = val;
      this.consig.documento_id = val;
      this.ce.documento_id = val;
      this.po.documento_id = val;
    },
    cash:{
			deep: true,
			handler(val, oldVal){
        this.commit(val.valor)
			}
		},
		td:{
			deep: true,
			handler(val, oldVal){
        this.commit(val.valor)
			}
		},
		tc:{
			deep: true,
			handler(val, oldVal){
        this.commit(val.valor)
			}
		},
		nc:{
			deep: true,
			handler(val, oldVal){
        this.commit(val.valor)
			}
		},
		check:{
			deep: true,
			handler(val, oldVal){
        this.commit(val.valor)
			}
		},
		consig:{
			deep: true,
			handler(val, oldVal){
        this.commit(val.valor)
			}
		},
		ce:{
			deep: true,
			handler(val, oldVal){
        this.commit(val.valor)
			}
		},
		c:{
			deep: true,
			handler(val, oldVal){
        this.commit(val.valor)
			}
		},
		totals:{
			deep: true,
			handler(val, oldVal){
        if (val.neto != oldVal.neto) {
          this.cash.valor = val.neto
        }
			}
		}
	},
  methods:{
    refreshTable(){
      this.$refs.list.refresh()
    },
    listDocuments(){
        this.$store.commit('SET_LIST', true)
    },
    submit(){
      let setup = JSON.parse(localStorage.getItem('setup'))
      let data = {
        form_document: this.form_document,
        table_detail: this.table_detail,
        totals: this.totals,
        wholesale: this.wholesale
      }
      let validate = this.validateForm(data)
      if(validate.code == 200){
        this.actionForm(data)
      }else{
        this.$message.error(validate.data);
      }
    },
    actionForm(data){
      if(!this.editing){
        save(data).then(({data}) => {
          // this.$store.dispatch('defaultAll')
          this.editing = true
          this.id_document = data.id
          this.consecutive = data.consecutive
          this.modalFP = true
          this.$store.commit('SET_TABLE_DETAIL', data.table_detail)
          this.buttonsPayment()
        }).catch(error => {
          console.log(error)
        })
      }else{
        update(data, this.id_document).then(({data}) => {
          this.modalFP = true
          this.buttonsPayment()
        }).catch(error => {
          console.log(error)
        })
      }
    },
    validateForm(data){
      let response = {
        'data': '',
        'code': 200
      };
      if(data.form_document.client_id == null){
        response.data = 'Debe seleccionar un cliente'
        response.code = 600
      }else if(data.form_document.date == null){
          response.data = 'Debe seleccionar una fecha'
          response.code = 600
        }else if(data.form_document.seller_id == null){
        response.data = 'Debe seleccionar un vendedor'
        response.code = 600
      }else if(data.table_detail.length == 0){
        response.data = 'Debe ingresar datos en el detalle'
        response.code = 600
      }
      return response;
    },
    savePaymentMethod(){
      let data = {
        'id_document': this.id_document,
        'cash': this.cash,
        'td': this.td,
        'tc': this.tc,
        'nc': this.nc,
        'check': this.check,
        'consig': this.consig,
        'ce': this.ce,
        'po': this.po,
      }
      savePaymentMethod(data).then(({data}) => {
        console.log('success!!');
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
    commit(val){
      var price = this.cash.valor + this.td.valor + this.tc.valor + this.nc.valor + this.check.valor + this.consig.valor + this.ce.valor + this.po.valor
      this.$store.commit('SET_RECEIVED', price)
      this.$store.commit('SET_RETURN', price - this.totals.neto)
    }
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
    font-size: 20px;
  }
  .input-payment_method{
    margin-bottom: 10px;
  }
</style>

<template>
	<div>
		<el-card class="box-card">
		  <div slot="header" class="clearfix">
		    <span class="name_document">{{ getDescription() }}</span>
		  </div>
		  	<el-row :gutter="24">
		  		<el-col :span="18"  class="br">
		  		<!-- FILA 1 -->
					<el-form ref="form" :model="form">
			  			<el-row :gutter="12">
				  			<el-col :span="10">
								  <el-form-item label="Cliente">
										<el-popover
									    placement="top-start"
									    title="Datos del cliente"
									    width="300"
									    trigger="hover"
									    :content="client.name">
											<ul class="list-data-client" v-show="form.client_id">
								        <li>
							            Documento:
													<span class="fr">
														{{ client.document }}
													</span>
								        </li>
								        <li>
							            Nombre:
													<span class="fr">
														{{ client.name }}
													</span>
								        </li>
								        <li>
							            Dirección:
													<span class="fr">
														{{ client.address }}
													</span>
								        </li>
								        <li>
							            Ciudad:
													<span class="fr">
														{{ client.city }}
													</span>
								        </li>
								        <li>
							            Teléfono:
													<span class="fr">
														{{ client.phone }}
													</span>
								        </li>
								        <li>
							            Correo:
													<span class="fr">
														{{ client.email }}
													</span>
								        </li>
								      </ul>
											<el-autocomplete
													slot="reference"
													class="my-autocomplete"
													v-model="client.name"
													:fetch-suggestions="querySearch"
													:trigger-on-focus="false"
													placeholder="Busca el cliente"
													size="small"
													@select="handleSelect">
													<i
														class="el-icon-search el-input__icon"
														slot="suffix"
														@click="handleIconClick">
													</i>
												<template slot-scope="{ item }">
														<div class="value">
															{{ item.nombre }}
															<small>
																{{ item.documento }}
															</small>
														</div>
														<!-- <span class="link"></span> -->
												</template>
											</el-autocomplete>
										</el-popover>
											<el-button type="success" icon="el-icon-plus" circle size="mini"  @click="dialogFormVisible = true"></el-button>
								  </el-form-item>
								</el-col>
								<el-col :span="5">
								  <el-form-item label="Fecha">
								    <el-date-picker
						              v-model="form.date"
						              type="date"
						              placeholder="Selecciona fecha"
						              class="width-full"
						              size="small">
						            </el-date-picker>
								  </el-form-item>
								</el-col>
								<el-col :span="4">
								  	<el-form-item label="Días de crédito">
											<el-input-number v-model="form.days"
											@change="expirationDate()"
											size="small" :min="0"></el-input-number>
								  	</el-form-item>
								</el-col>
								<el-col :span="5">
									<el-form-item label="Entrega / Vencimiento">
	                  <el-date-picker
	                      v-model="form.date_receip"
	                      type="date"
	                      placeholder="Vencimiento"
	                      class="width-full"
	                      size="small"
												:disabled="true">
	                    </el-date-picker>
								  	</el-form-item>
								</el-col>
						</el-row>
						<!-- FILA 2 -->
						<el-row :gutter="12">
				  		<el-col :span="10">
							  <el-form-item label="Atendido por">
									<el-autocomplete
											class="w100"
											v-model="seller"
											:fetch-suggestions="querySearchSeller"
											:trigger-on-focus="false"
											placeholder="Busca el vendedor"
											size="small"
											@select="handleSelectSeller">
											<i
												class="el-icon-search el-input__icon"
												slot="suffix"
												@click="handleIconClickSeller">
											</i>
										<template slot-scope="{ item }">
												<div class="value">
													{{ item.nombre }}
													<small>
														{{ item.documento }}
													</small>
												</div>
										</template>
									</el-autocomplete>
							  </el-form-item>
							</el-col>
							<el-col :span="14">
							  	<el-form-item label="Observación / Referencia">
							    	<el-input v-model="form.observation" size="small" prefix-icon="el-icon-edit"></el-input>
							  	</el-form-item>
							</el-col>
						</el-row>
						<hr>
          </el-form>
  					<!-- DETALLE -->
            <detail></detail>
		  		</el-col>
			  	<el-col :span="6">
			  		<totals></totals>
			  	</el-col>
		  	</el-row>
		</el-card>
		<el-dialog title="Agregar cliente" :visible.sync="dialogFormVisible" top width="35%">
			<form-module @refresh="" @save="handleSelect($event)"></form-module>
		</el-dialog>
	</div>
</template>

<script>
import Totals from './Totals'
import Detail from './Detail'
import FormModule from '@/views/tercero/Form'
import { searchThird } from '@/api/document'
import { mapGetters } from 'vuex'

export default {
  components: {
    Totals, Detail, FormModule
  },
  data(){
  	return {
  		form: {
  			date: null,
        client_id: null,
        client_name: null,
        days: null,
        date_receip: null,
        seller_id: null,
        observation: null
  		},
			result: [],
			resultSeller: [],
			client: {},
			seller: '',
			dialogFormVisible: false,
  	}
  },
	computed:{
		...mapGetters(['form_document', 'editing_document'])
	},
	watch:{
		form_document:{
			deep: true,
			handler(val, oldVal){
				if(val == null){
					this.resetForm()
				}
			}
		},
		form:{
			deep: true,
			handler(val, oldVal){
				this.$store.commit('SET_FORM_DOCUMENT', val)
			}
		},
		editing_document:{
			deep: true,
			handler(val, oldVal){
				if(val != null){
					this.setDataDocument(val)
				}
			}
		}
	},
	mounted(){
		this.form.date = new Date();
		this.form.date_receip = new Date();
	},
  methods:{
		setDataDocument(data){
			this.$store.commit('SET_WHOLESALE', data.document.pormayor)
			this.$store.commit('SET_TABLE_DETAIL', data.detail)
			let date = new Date(data.document.fecha)
			date.setDate(date.getDate() + 1)
			this.form.date = date
			if(data.client != null){
				this.handleSelect(data.client)
			}
			if(data.seller != null){
				this.handleSelectSeller(data.seller)
			}
			this.form.days = data.document.dias
			let date_r = new Date(data.document.fecha_recibido)
			date_r.setDate(date_r.getDate() - 1)
			this.form.date_receip = date_r
			this.form.observation = data.document.observacion
			this.$store.dispatch('updateSubtotal', { data:data.detail, wholesale: data.document.pormayor})
			this.$store.commit('SET_ANTICIPO', data.document.anticipo)
			this.$store.commit('SET_LIST', false)
		},
		expirationDate(){
			var fecha = new Date(this.form.date);
			var dias = this.form.days; // Número de días a agregar
			if (dias == '') {
					dias = 0;
			}
			fecha.setDate(fecha.getDate() + (parseInt(dias) + 1));
			let res = this.formatDate(fecha)
			this.form.date_receip = res.output;
		},
		formatDate(fecha){
			var d = new Date(fecha);
			var month = d.getMonth() + 1;
			var day = d.getDate();
			var output = d.getFullYear() + '-' +
							(month < 10 ? '0' : '') + month + '-' +
							(day < 10 ? '0' : '') + day;
			return {
				'output': output,
				'day': day,
				'month': month
			}
		},
	 	querySearch(queryString, cb) {
			searchThird(queryString, 'cliente').then(({data}) => {
					cb(data.data);
			}).catch( error => { console.log(error) })
		},
	 	querySearchSeller(queryString, cb) {
			searchThird(queryString, 'vendedor').then(({data}) => {
					cb(data.data);
			}).catch( error => { console.log(error) })
		},
		handleSelect(item) {
			this.client.document = item.documento
			this.client.name = item.nombre
			this.client.email = item.email
			this.client.city = item.ciudad
			this.client.address = item.direccion
			this.client.phone = item.telefono
			this.form.client_id = item.id
			this.form.client_name = item.nombre
		},
		handleIconClick(ev) {
			console.log(ev);
		},
		handleSelectSeller(item) {
			this.seller = item.nombre
			this.form.seller_id = item.id
		},
		handleIconClickSeller(ev) {
			console.log(ev);
		},
		getDescription(){
			var data = JSON.parse(localStorage.getItem('setup'));
			return data.type.descripcion
		},
		resetForm(){
			this.form = {}
			this.result = []
			this.resultSeller = []
			this.client = {}
			this.seller = ''
		}
  }
}
</script>

<style>
	.name_document{
		margin-left: 10px;
	}
	.title_detail{
		text-align: right;
    padding-right: 20px;
    width: 50%;
    float: left;
	}
  .por_mayor{
    text-align: left;
    width: 50%;
    float: left;
  }
	.el-date-editor.el-input, .el-date-editor.el-input__inner{
		width: 100%;
	}
	.my-autocomplete{
		width: 85%;
	}
	.el-form-item__label{
		width: 100%;
		text-align: left;
	}
	.value {
  	display: grid;
		padding: 10px 0px;
		line-height: normal;
  }

</style>

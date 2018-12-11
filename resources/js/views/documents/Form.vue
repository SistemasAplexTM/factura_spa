<template>
	<div>
		<el-card class="box-card">
		  <div slot="header" class="clearfix">
		    <span class="name_document">Factura nombre</span>
		  </div>
		  	<el-row :gutter="24">
		  		<el-col :span="18"  class="br">
		  		<!-- FILA 1 -->
					<el-form ref="form" :model="form">
			  			<el-row :gutter="12">
				  			<el-col :span="6">
								  <el-form-item label="Cliente">
										<el-popover
									    placement="top-start"
									    title="Datos del cliente"
									    width="200"
									    trigger="hover"
									    :content="client">
											<ul class="list-class">
								        <li>
								          <div class="row">
								            {{ client }}
								          </div>
								        </li>
								        <li>
								          <div class="row">
								            {{ client }}
								          </div>
								        </li>
								        <li>
								          <div class="row">
								            {{ client }}
								          </div>
								        </li>
								      </ul>
											<el-autocomplete
													slot="reference"
													popper-class="my-autocomplete"
													v-model="client"
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
								<el-col :span="6">
								  <el-form-item label="Fecha">
								    <el-date-picker
						              v-model="form.fecha"
						              type="date"
						              placeholder="Selecciona fecha"
						              class="width-full"
						              size="small">
						            </el-date-picker>
								  </el-form-item>
								</el-col>
								<el-col :span="6">
								  	<el-form-item label="Dias de credito">
								    	<el-input v-model="form.dias" size="small" type="number" min="0" @change="expirationDate()"></el-input>
								  	</el-form-item>
								</el-col>
								<el-col :span="6">
									<el-form-item label="Entrega / Vencimiento">
	                  <el-date-picker
	                      v-model="form.fecha_recibido"
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
				  		<el-col :span="6">
							  <el-form-item label="Atendido por">
									<el-autocomplete
											popper-class="my-autocomplete"
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
							<el-col :span="6">
						  		<el-form-item label="Documento cruce">
								    <el-input v-model="form.curce" size="small" ></el-input>
								 </el-form-item>
							</el-col>
							<el-col :span="12">
							  	<el-form-item label="Observación / Referencia">
							    	<el-input v-model="form.observacion" size="small" prefix-icon="el-icon-edit"></el-input>
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
			<form-module @refresh=""></form-module>
		</el-dialog>
	</div>
</template>

<script>
import Totals from './Totals'
import Detail from './Detail'
import FormModule from '@/views/tercero/Form'
import { searchThird } from '@/api/document'
export default {
  components: {
    Totals, Detail, FormModule
  },
	mounted(){
		this.form.fecha = new Date();
		this.form.fecha_recibido = new Date();
	},
  data(){
  	return {
  		form: {
  			fecha: null,
        terceros_id: null,
        dias: null,
        fecha_recibido: null,
        vendedor_id: null,
        cruce: null,
        observacion: null,
        pormayor: null,
  		},
			result: [],
			resultSeller: [],
			client: '',
			seller: '',
			dialogFormVisible: false,
  	}
  },
  methods:{
		expirationDate(){
			console.log(this.form.fecha);
			var fecha = new Date(this.form.fecha);
			var dias = this.form.dias; // Número de días a agregar
			if (dias == '') {
					dias = 0;
			}
			fecha.setDate(fecha.getDate() + (parseInt(dias) + 1));

			var d = new Date(fecha);

			var month = d.getMonth() + 1;
			var day = d.getDate();

			var output = d.getFullYear() + '-' +
							(month < 10 ? '0' : '') + month + '-' +
							(day < 10 ? '0' : '') + day;

			this.form.fecha_recibido = output;

			/* CALCULAR DIFERENCIA DE DIAS */
			// var fecha1 = moment();
			// var fecha2 = moment($('#fecha_entrega').val());
			//
			// var dif = fecha2.diff(fecha1, 'days');
			// if (dif < 0) {
			// 		$('#fecha_entrega').css('border-color', '#ed5565');
			// } else {
			// 		$('#fecha_entrega').css('border-color', '');
			// }
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
			this.client = item.nombre
			this.form.terceros_id = item.id
			console.log(item);
		},
		handleIconClick(ev) {
			console.log(ev);
		},
		handleSelectSeller(item) {
			this.seller = item.nombre
			this.form.vendedor_id = item.id
			console.log(item);
		},
		handleIconClickSeller(ev) {
			console.log(ev);
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
	.el-autocomplete{
		width: 80%;
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

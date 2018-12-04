<template>
	<div>
		<el-card class="box-card">
		  <div slot="header" class="clearfix">
		    <span class="name_document">Factura nombre</span>
		  </div>
		  	<el-row :gutter="24">
		  		<el-col :span="18">
		  		<!-- FILA 1 -->
					<el-form ref="form" :model="form">
			  			<el-row :gutter="12">
				  			<el-col :span="6">
							  <el-form-item label="NIT cliente">
							    <el-input size="small" ></el-input>
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
							    	<el-input size="small" type="number" min="0"></el-input>
							  	</el-form-item>
							</el-col>
							<el-col :span="6">
								<el-form-item label="Entrega / Vencimiento">
									<el-input size="small" ></el-input>
							  	</el-form-item>
							</el-col>
						</el-row>
						<!-- FILA 2 -->
						<el-row :gutter="12">
				  			<el-col :span="6">
							  <el-form-item label="Atendido por">
							    <el-input size="small" ></el-input>
							  </el-form-item>
							</el-col>
							<el-col :span="6">
						  		<el-form-item label="Documento cruce">
								    <el-input size="small" ></el-input>
								 </el-form-item>
							</el-col>
							<el-col :span="12">
							  	<el-form-item label="Observación / Referencia">
							    	<el-input size="small" ></el-input>
							  	</el-form-item>
							</el-col>
						</el-row>
					</el-form>

					<div class="title_detail">DETALLE DEL DOCUMENTO - VENTA:</div>

					<el-table :data="tableData" style="width: 100%">
					    <el-table-column prop="item" label="Item" width="80"></el-table-column>
					    <el-table-column prop="producto" label="Producto"></el-table-column>
					    <el-table-column prop="cantidad" label="Cantidad"></el-table-column>
					    <el-table-column prop="precio" label="Precio Unit."></el-table-column>
					    <el-table-column prop="descuento" label="Desto %-$"></el-table-column>
					    <el-table-column prop="iva" label="% IVA"></el-table-column>
					    <el-table-column prop="monto_total" label="Monto Total"></el-table-column>
					    <el-table-column label="Acciones">
					    	<template slot-scope="scope">
						        <el-button
							        @click.native.prevent="deleteRow(scope.$index, tableData4)"
							        type="text"
							        size="small">
							        Eliminar
						        </el-button>
					     	</template>
					    </el-table-column>
				    </el-table>

		  		</el-col>
			  	<el-col :span="6" class="bl">
			  		<totals></totals>
			  	</el-col>
		  	</el-row>
		</el-card>
	</div>
</template>

<script>
import Totals from './Totals'
export default {
  components: {
    Totals
  },
  data(){
  	return {
  		form: {
  			fecha: null
  		},
  		tableData: [{
            item: 1,
            producto: 'camisa',
            cantidad: 2,
            precio: 25000,
            descuento: 9000,
            iva: 7500,
            monto_total: 150000
          }]
  	}
  },
  methods:{
    
  }
}
</script>

<style>
	.name_document{
		margin-left: 10px;
	}
	.title_detail{
		text-align: center;
		padding-bottom: 10px;
	}
</style>
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
							  <el-form-item label="NIT cliente">
							    <el-input v-model="form.terceros_id" size="small"></el-input>
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
							    	<el-input v-model="form.dias" size="small" type="number" min="0"></el-input>
							  	</el-form-item>
							</el-col>
							<el-col :span="6">
								<el-form-item label="Entrega / Vencimiento">
                  <el-date-picker
                      v-model="form.fecha_recibido"
                      type="date"
                      placeholder="Vencimiento"
                      class="width-full"
                      size="small">
                    </el-date-picker>
							  	</el-form-item>
							</el-col>
						</el-row>
						<!-- FILA 2 -->
						<el-row :gutter="12">
				  			<el-col :span="6">
							  <el-form-item label="Atendido por">
							    <el-input v-model="form.vendedor_id" size="small" ></el-input>
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
            <el-form-item class="title_detail">
              DETALLE DEL DOCUMENTO - VENTA:
            </el-form-item>
            <el-form-item class="labelOff por_mayor" prop="pormayor">
              <el-switch v-model="form.pormayor" inactive-text="Normal" active-text="Por mayor"></el-switch>
            </el-form-item>
          </el-form>


  					<!-- DETALLE -->
            <detail></detail>
		  		</el-col>
			  	<el-col :span="6">
			  		<totals></totals>
			  	</el-col>
		  	</el-row>
		</el-card>
	</div>
</template>

<script>
import Totals from './Totals'
import Detail from './Detail'
export default {
  components: {
    Totals, Detail
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
  		}
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
</style>

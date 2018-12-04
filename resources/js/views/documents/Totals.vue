<template>
	<div>
		<sticky :className="'sub-navbar draft'">
			<el-row :gutter="24" class="content-total">
				<el-col :span="24">
					<div class="lb-total">$ 999.999</div>
				</el-col>
			</el-row>
			<el-row :gutter="24" class="value_total">
			  	<el-col :span="12">
			  		Subtotal 1
			  	</el-col>
			  	<el-col :span="12">
			  		$ 999.999.999
			  	</el-col>
			 </el-row>
			 <el-row :gutter="24" class="value_total">
			  	<el-col :span="12">
			  		Descuento 1
			  	</el-col>
			  	<el-col :span="12">
			  		$ 999.999.999
			  	</el-col>
			 </el-row>
			 <el-row :gutter="24" class="value_total">
			  	<el-col :span="12">
			  		Descuento 2
			  	</el-col>
			  	<el-col :span="12">
			  		<el-input placeholder=".00" size="mini"></el-input>
			  	</el-col>
			 </el-row>
			 <el-row :gutter="24" class="value_total">
			  	<el-col :span="12">
			  		Subtotal 2
			  	</el-col>
			  	<el-col :span="12">
			  		$ 999.999.999
			  	</el-col>
			 </el-row>
			 <el-row :gutter="24" class="value_total">
			  	<el-col :span="12">
			  		IVA
			  	</el-col>
			  	<el-col :span="12">
			  		$ 999.999.999
			  	</el-col>
			 </el-row>
			 <el-row :gutter="24" class="value_total">
			  	<el-col :span="12">
			  		Retefuente
			  	</el-col>
			  	<el-col :span="12">
			  		$ 999.999.999
			  	</el-col>
			 </el-row>
			 <el-row :gutter="24" class="value_total">
			  	<el-col :span="12">
			  		Reteica
			  	</el-col>
			  	<el-col :span="12">
			  		$ 999.999.999
			  	</el-col>
			 </el-row>
			 <el-row :gutter="24" class="value_total">
			  	<el-col :span="12">
			  		Total
			  	</el-col>
			  	<el-col :span="12">
			  		$ 999.999.999
			  	</el-col>
			 </el-row>
			 <el-row :gutter="24" class="value_total">
			  	<el-col :span="12">
			  		Anticipo
			  	</el-col>
			  	<el-col :span="12">
			  		<el-input placeholder=".00" size="mini"></el-input>
			  	</el-col>
			 </el-row>
			 <el-row :gutter="24" class="value_total">
			  	<el-col :span="12">
			  		Recibido
			  	</el-col>
			  	<el-col :span="12">
			  		$ 999.999.999
			  	</el-col>
			 </el-row>
			 <el-row :gutter="24" class="value_total">
			  	<el-col :span="12">
			  		Devolución
			  	</el-col>
			  	<el-col :span="12">
			  		$ 999.999.999
			  	</el-col>
			 </el-row>
			 <el-row :gutter="24" class="value_total">
			  	<el-col :span="12">
			  		Cupón
			  	</el-col>
			  	<el-col :span="12">
			  		<el-input placeholder=".00" size="mini"></el-input>
			  	</el-col>
			 </el-row>
		</sticky>
	</div>
</template>

<script>
import Sticky from '@/components/Sticky'
export default {
  components: {
    Sticky
  },
  data(){
  	return {
  		
  	}
  },
  methods:{
    
  }
}
</script>

<style>
	.lb-total{
		text-align: center;
	    font-size: 40px;
	    color: forestgreen;
	    border: 1px solid forestgreen;
	    border-radius: 30px;
	}
	.content-total{
		margin-bottom: 10px;
	}
	.el-form-item__label{
		line-height:15px !important;
	}
	.value_total{
		margin-bottom: 10px;
	}
</style>
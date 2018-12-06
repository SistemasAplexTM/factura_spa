<template>
	<div>
		<sticky :stickyTop="60">
			<el-row :gutter="24" class="content-total">
				<el-col :span="24">
					<div class="lb-total">$ {{ neto }}</div>
				</el-col>
			</el-row>
			<el-row :gutter="24" class="value_total">
			  	<el-col :span="12">
			  		Subtotal 1
			  	</el-col>
			  	<el-col :span="12">
			  		{{ subtotal_1 }}
			  	</el-col>
			 </el-row>
			 <el-row :gutter="24" class="value_total">
			  	<el-col :span="12">
			  		Descuento 1
			  	</el-col>
			  	<el-col :span="12">
			  		{{ descuento_1 }}
			  	</el-col>
			 </el-row>
			 <el-row :gutter="24" class="value_total">
			  	<el-col :span="12">
			  		Descuento 2
			  	</el-col>
			  	<el-col :span="12">
			  		<el-input placeholder=".00" size="mini" v-model="descuento_2"></el-input>
			  	</el-col>
			 </el-row>
			 <el-row :gutter="24" class="value_total">
			  	<el-col :span="12">
			  		Subtotal 2
			  	</el-col>
			  	<el-col :span="12">
			  		{{ subtotal_2 }}
			  	</el-col>
			 </el-row>
			 <el-row :gutter="24" class="value_total">
			  	<el-col :span="12">
			  		IVA
			  	</el-col>
			  	<el-col :span="12">
			  		{{ iva }}
			  	</el-col>
			 </el-row>
			 <el-row :gutter="24" class="value_total">
			  	<el-col :span="12">
			  		Retefuente
			  	</el-col>
			  	<el-col :span="12">
			  		{{ retefuente }}
			  	</el-col>
			 </el-row>
			 <el-row :gutter="24" class="value_total">
			  	<el-col :span="12">
			  		Reteica
			  	</el-col>
			  	<el-col :span="12">
			  		{{ reteica }}
			  	</el-col>
			 </el-row>
			 <el-row :gutter="24" class="value_total">
			  	<el-col :span="12">
			  		Total
			  	</el-col>
			  	<el-col :span="12">
			  		{{ total }}
			  	</el-col>
			 </el-row>
			 <el-row :gutter="24" class="value_total">
			  	<el-col :span="12">
			  		Anticipo
			  	</el-col>
			  	<el-col :span="12">
			  		<el-input placeholder=".00" size="mini" v-model="anticipo"></el-input>
			  	</el-col>
			 </el-row>
			 <el-row :gutter="24" class="value_total">
			  	<el-col :span="12">
			  		Recibido
			  	</el-col>
			  	<el-col :span="12">
			  		{{ recibido }}
			  	</el-col>
			 </el-row>
			 <el-row :gutter="24" class="value_total">
			  	<el-col :span="12">
			  		Devolución
			  	</el-col>
			  	<el-col :span="12">
			  		{{ devolucion }}
			  	</el-col>
			 </el-row>
			 <el-row :gutter="24" class="value_total">
			  	<el-col :span="12">
			  		Cupón
			  	</el-col>
			  	<el-col :span="12">
			  		<el-input placeholder=".00" size="mini" v-model="cupon"></el-input>
			  	</el-col>
			 </el-row>
		</sticky>
	</div>
</template>

<script>
import Sticky from '@/components/Sticky'
import { mapGetters } from 'vuex'

export default {
  components: {
    Sticky
  },
  computed:{
  	...mapGetters([
  		'totals'
  	])
  },
  watch:{
  	totals:{
			deep: true,
  		handler(val, oldVal){
  			this.subtotal_1 	= val.subtotal_1;
  			this.descuento_1 	= val.descuento_1;
  			this.subtotal_2 	= val.subtotal_2;
  			this.iva 			= val.iva;
  			this.total 			= val.total;
  			this.neto 			= val.neto;

  			var vm = this
		    var animationFrame
				function animate (time) {
					TWEEN.update(time)
					animationFrame = requestAnimationFrame(animate)
				}
	      new TWEEN.Tween({ tweeningNumber: oldVal.neto })
	        .easing(TWEEN.Easing.Quadratic.Out)
	        .to({ tweeningNumber: val.neto }, 500)
	        .onUpdate(function () {
	          vm.neto = this.tweeningNumber.toFixed(0)
	        })
	        .onComplete(function () {
	          cancelAnimationFrame(animationFrame)
	        })
	        .start()
	      animationFrame = requestAnimationFrame(animate)
  		}
  	}
  },
  data(){
  	return {
  		animatedNumber: 0,
		subtotal_1: 0,
		descuento_1: 0,
		descuento_2:0,
		subtotal_2:0,
		iva:0,
		retefuente:0,
		reteica:0,
		total:0,
		anticipo:0,
		recibido:0,
		devolucion:0,
		cupon:0,
		neto:0
  	}
  },
  methods:{
		animateNumber(){

		}
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

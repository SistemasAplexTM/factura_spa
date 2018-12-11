<template>
	<div>
		<sticky :stickyTop="60">
			<el-row :gutter="24" class="content-total">
				<el-col :span="24">
					<div class="lb-total">{{ format(neto) }}</div>
				</el-col>
			</el-row>
			<el-row :gutter="24" class="value_total">
			  	<el-col :span="12">
			  		Subtotal 1
			  	</el-col>
			  	<el-col :span="12" class="text-right">
			  		{{ format(subtotal_1) }}
			  	</el-col>
			 </el-row>
			 <el-row :gutter="24" class="value_total">
			  	<el-col :span="12">
			  		Descuento 1
			  	</el-col>
			  	<el-col :span="12" class="text-right">
			  		{{ format(descuento_1) }}
			  	</el-col>
			 </el-row>
			 <el-row :gutter="24" class="value_total">
			  	<el-col :span="12">
			  		Descuento <icon-aplex name="tag" :type="'awesome'" class="icon-menu"/>
						<el-tooltip class="item" effect="dark" content="Borrar descuento" placement="top-start">
							<i class="el-icon-circle-close remove-dcto" @click="removeDcto()" v-show="descuento_2 > 0"></i>
						</el-tooltip>
			  	</el-col>
			  	<el-col :span="12" class="text-right">
						{{ format(descuento_2) }}
			  	</el-col>
			 </el-row>
			 <hr>
			 <el-row :gutter="24" class="value_total">
			  	<el-col :span="12">
			  		Subtotal 2
			  	</el-col>
			  	<el-col :span="12" class="text-right">
			  		{{ format(subtotal_2) }}
			  	</el-col>
			 </el-row>
			 <hr>
			 <el-row :gutter="24" class="value_total">
			  	<el-col :span="12">
			  		IVA
			  	</el-col>
			  	<el-col :span="12" class="text-right">
			  		{{ format(iva) }}
			  	</el-col>
			 </el-row>
			 <el-row :gutter="24" class="value_total">
			  	<el-col :span="12">
			  		Retefuente
			  	</el-col>
			  	<el-col :span="12" class="text-right">
			  		{{ format(retefuente) }}
			  	</el-col>
			 </el-row>
			 <el-row :gutter="24" class="value_total">
			  	<el-col :span="12">
			  		Reteica
			  	</el-col>
			  	<el-col :span="12" class="text-right">
			  		{{ format(reteica) }}
			  	</el-col>
			 </el-row>
			 <hr>
			 <el-row :gutter="24" class="value_total">
			  	<el-col :span="12">
			  		Total
			  	</el-col>
			  	<el-col :span="12" class="text-right" style="font-weight: bold;">
			  		{{ format(total) }}
			  	</el-col>
			 </el-row>
			 <el-row :gutter="24" class="value_total">
			  	<el-col :span="12">
			  		Anticipo
			  	</el-col>
			  	<el-col :span="12" class="text-right">
			  		<el-input placeholder=".00" size="mini" v-model="anticipo" @change="calculateTotals()"></el-input>
			  	</el-col>
			 </el-row>
			 <el-row :gutter="24" class="value_total">
			  	<el-col :span="12">
			  		Recibido
			  	</el-col>
			  	<el-col :span="12" class="text-right">
			  		{{ format(recibido) }}
			  	</el-col>
			 </el-row>
			 <el-row :gutter="24" class="value_total">
			  	<el-col :span="12">
			  		Devolución
			  	</el-col>
			  	<el-col :span="12" class="text-right">
			  		{{ format(devolucion) }}
			  	</el-col>
			 </el-row>
			 <el-row :gutter="24" class="value_total">
			  	<el-col :span="12">
			  		Cupón de
			  	</el-col>
			  	<el-col :span="12" class="text-right">
			  		<el-input placeholder="Buscar" size="mini" v-model="cupon">
							<el-button slot="append" size="mini" type="danger" @click="searchCupon()" :disabled="!cupon">
								<icon-aplex name="tag" :type="'awesome'" class="icon-menu"/>
							</el-button>
						</el-input>
			  	</el-col>
			 </el-row>
		</sticky>
	</div>
</template>

<script>
import Sticky from '@/components/Sticky'
import accounting from 'accounting-js';
import { mapGetters } from 'vuex'
import { getCupon } from '@/api/document'

export default {
  components: {Sticky}, 
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
  			this.descuento_2 	= val.descuento_2;
  			this.subtotal_2 	= val.subtotal_2;
  			this.iva 					= val.iva;
  			this.total 				= val.total;
  			this.neto 				= val.neto;

				this.animateNumber(val.neto, oldVal.neto, 'neto')
				this.animateNumber(val.subtotal_1, oldVal.subtotal_1, 'subtotal_1')
				this.animateNumber(val.descuento_1, oldVal.descuento_1, 'descuento_1')
				this.animateNumber(val.descuento_2, oldVal.descuento_2, 'descuento_2')
				this.animateNumber(val.subtotal_2, oldVal.subtotal_2, 'subtotal_2')
				this.animateNumber(val.iva, oldVal.iva, 'iva')
				this.animateNumber(val.total, oldVal.total, 'total')
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
			cupon:null,
			neto:0,
  	}
  },
  methods:{
		calculateTotals(){
			this.$store.commit('SET_ANTICIPO', this.anticipo)
			this.$store.commit('SET_DESCUENTO_2', this.descuento_2)
			this.$store.dispatch('updateSubtotal', null)
		},
		searchCupon(){
			getCupon(this.cupon).then(({data}) => {
				if(data.code == 200){
					this.$confirm(data.msg, 'Perfecto!', {
						confirmButtonText: 'Aplicar!',
						cancelButtonText: 'Cancelar',
						type: 'success',
						center: true,
						dangerouslyUseHTMLString: true
					}).then(() => {
						this.$message({
							type: 'success',
							message: 'Descuento aplicado'
						});
						this.$store.commit('SET_DESCUENTO_2', data.data.descuento)
						this.$store.dispatch('updateSubtotal', null)
					}).catch(() => {
						this.$message({
							type: 'info',
							message: 'Operación cancelada'
						});
					});
				}else{
					this.$message({
						showClose: true,
						message: data.msg,
						type: 'error',
						duration: 5000
					});
				}
			}).catch(error => {
					console.log(error)
			});
		},
		animateNumber(val, oldVal, name){
			var vm = this
			var animationFrame
			function animate (time) {
				TWEEN.update(time)
				animationFrame = requestAnimationFrame(animate)
			}
			new TWEEN.Tween({ tweeningNumber: oldVal })
				.easing(TWEEN.Easing.Quadratic.Out)
				.to({ tweeningNumber: val }, 500)
				.onUpdate(function () {
					switch (name) {
						case 'neto':
								vm.neto = this.tweeningNumber.toFixed(0)
							break;
						case 'subtotal_1':
								vm.subtotal_1 = this.tweeningNumber.toFixed(0)
							break;
						case 'descuento_1':
								vm.descuento_1 = this.tweeningNumber.toFixed(0)
							break;
						case 'descuento_2':
							 vm.descuento_2 = this.tweeningNumber.toFixed(0)
						 break;
						case 'subtotal_2':
								vm.subtotal_2 = this.tweeningNumber.toFixed(0)
							break;
						case 'iva':
								vm.iva = this.tweeningNumber.toFixed(0)
							break;
						case 'total':
								vm.total = this.tweeningNumber.toFixed(0)
							break;
						default:
					}
				})
				.onComplete(function () {
					cancelAnimationFrame(animationFrame)
				})
				.start()
			animationFrame = requestAnimationFrame(animate)
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
		removeDcto(){
			this.$store.commit('SET_DESCUENTO_2', 0)
			this.$store.dispatch('updateSubtotal', null)
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
			font-weight: bold;
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
	.el-input-group__append, .el-input-group__prepend{
		padding: 0 5px;
	}
	.remove-dcto{
		color:#f56c6c;
		cursor: pointer;
	}
	.remove-dcto:hover{
		color: #ec3d3d;
	}
</style>

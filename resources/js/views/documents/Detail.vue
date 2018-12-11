<template>
	<div>
		<el-row :gutter="24">
			<el-col :span="18">
				<el-input type="search" placeholder="Ingresar código" size="small" style="width:400px" v-model="bar_code" @keyup.enter.native="getData(bar_code)">
					<el-button slot="append" type="primary" icon="el-icon-search" @click="">
					</el-button>
				</el-input>
			</el-col>
			<el-col :span="6" class="labelOff">
					<el-switch v-model="pormayor" inactive-text="Normal" active-text="Por mayor" @change="updateValueDetail()"></el-switch>
			</el-col>
		</el-row>

		<el-table :data="tableData" style="width: 100%">
		    <el-table-column prop="producto" label="Producto" width="250"></el-table-column>
		    <el-table-column prop="cantidad" label="Cantidad" width="150">
		    	<template slot-scope="scope">
						<el-input-number v-model="scope.row.cantidad"
						@change="calculateMonto(scope.$index, scope.row.cantidad)"
						size="small" :min="1"></el-input-number>
		    	</template>
		    </el-table-column>
		    <el-table-column prop="precio" label="Precio Unit.">
					<template slot-scope="scope">
						{{ (pormayor) ? format(scope.row.precio_pormayor) : format(scope.row.precio) }}
					</template>
				</el-table-column>
		    <el-table-column prop="descuento" label="Dcto.">
					<template slot-scope="scope">
						{{ scope.row.descuento }}
					</template>
				</el-table-column>
		    <el-table-column prop="iva" label="IVA">
		    	<template slot-scope="scope">
		    		{{ format(scope.row.iva) }} <el-button size="mini" round>{{ scope.row.porcentaje_iva }}%</el-button>
		    	</template>
		    </el-table-column>
		    <el-table-column prop="monto_total" label="Monto Total" width="110">
					<template slot-scope="scope">
						{{ format(scope.row.monto_total) }}
					</template>
				</el-table-column>
		    <el-table-column align="center" width="50">
		    	<template slot-scope="scope">
		    		<el-dropdown class="avatar-container right-menu-item">
				        <el-button type="text" size="mini">
		    				<icon-aplex name="ellipsis-v" :type="'awesome'"/>
		    			</el-button>
				        <el-dropdown-menu slot="dropdown" class="user-dropdown">
				          	<el-dropdown-item>
				          		<span @click="deleteRow(scope.$index, tableData)" class="text-danger">
												<i class="el-icon-close"></i>
												Eliminar
											</span>
				          	</el-dropdown-item>
				        </el-dropdown-menu>
				    </el-dropdown>
		     	</template>
		    </el-table-column>
		    <template slot="empty">
		    	Es que no pensas meter datos o que!!
		    </template>
	    </el-table>
	</div>
</template>

<script>
	import accounting from 'accounting-js';
	import { getProductByCode } from '@/api/document'
	export default {
		components: {

		},
		data(){
		  	return {
		  		tableData: [],
		  		total_monto: 0,
					pormayor: 0,
					bar_code: null
		  	}
		},
		methods:{
			getData(code){
				getProductByCode(code, this.pormayor).then(({data}) => {
					if(data.data.length > 0){
						let datos = this.tableData;
						let position_search = datos.findIndex( buscar => buscar.id === data.data[0].id );
						if(position_search < 0){
	            this.tableData.push(data.data[0])
	            this.generateTotals(this.tableData);
							this.bar_code = null;
						}else{
							this.tableData[position_search].cantidad = parseInt(this.tableData[position_search].cantidad) + 1;
							this.calculateMonto(position_search, parseInt(this.tableData[position_search].cantidad));
							this.bar_code = null;
						};
					}else{
						this.$message({
							type: 'warning',
							message: 'No existe un producto con ese código!'
						});
					}
        }).catch(error => {
          	console.log(error)
        });
			},
			calculateMonto(index, cantidad){
				let precio = this.tableData[index].precio;
				if(this.pormayor == true){
					precio = this.tableData[index].precio_pormayor;
				}
				this.tableData[index].iva = Math.round((precio * cantidad) * this.tableData[index].porcentaje_iva / 100, 0)
				this.tableData[index].monto_total = (precio * cantidad) - parseFloat(this.tableData[index].descuento) + parseFloat(this.tableData[index].iva)
				this.generateTotals(this.tableData);
			},
			generateTotals(datos){
				this.$store.dispatch('updateSubtotal', { data:datos, pormayor: this.pormayor})
			},
			updateValueDetail(){
				let me = this;
				if(this.tableData.length > 0){
					this.tableData.forEach( function(value, index, array) {
					    me.calculateMonto(index, value.cantidad)
					});
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
			deleteRow(index, rows) {
		        rows.splice(index, 1);
						if(this.tableData.length <= 0){
							this.$store.dispatch('defaultTotals')
						}
		        this.generateTotals(this.tableData);
		    },

		}
	}
</script>

<style>

</style>

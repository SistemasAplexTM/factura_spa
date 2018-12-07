<template>
	<div>
		<el-button size="small" type="primary" icon="el-icon-edit-outline" @click="getData(254)">
            agregar
         </el-button>
		<el-table :data="tableData" style="width: 100%">
		    <el-table-column prop="producto" label="Producto"></el-table-column>
		    <el-table-column prop="cantidad" label="Cantidad">
		    	<template slot-scope="scope">
						<el-input-number v-model="scope.row.cantidad"
						@change="calculateMonto(scope.$index, scope.row.cantidad)"
						size="small" :min="1" :max="10"></el-input-number>
		    	</template>
		    </el-table-column>
		    <el-table-column prop="precio" label="Precio Unit."></el-table-column>
		    <el-table-column prop="descuento" label="Desto %-$"></el-table-column>
		    <el-table-column prop="iva" label="IVA">
		    	<template slot-scope="scope">
		    		{{ scope.row.iva }} <el-button size="mini" round>{{ scope.row.porcentaje_iva }}%</el-button>
		    	</template>
		    </el-table-column>
		    <el-table-column prop="monto_total" label="Monto Total" width="110"></el-table-column>
		    <el-table-column align="center" width="50">
		    	<template slot-scope="scope">
		    		<el-dropdown class="avatar-container right-menu-item" trigger="click">
				        <el-button type="text" size="mini">
		    				<icon-aplex name="ellipsis-v" :type="'awesome'"/>
		    			</el-button>
				        <el-dropdown-menu slot="dropdown" class="user-dropdown">
				          	<el-dropdown-item>
				          		<span @click="deleteRow(scope.$index, tableData)">Eliminar</span>
				          	</el-dropdown-item>
				          	<el-dropdown-item divided>
				            	<span>Resetear</span>
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
	import { getProductByCode } from '@/api/document'
	export default {
		components: {

		},
		data(){
		  	return {
		  		tableData: [],
		  		total_monto: 0
		  	}
		},
		methods:{
			getData(code){
				getProductByCode(code).then(({data}) => {
		            this.tableData.push(data.data[0])
		            this.generateTotals(this.tableData);
	          	}).catch(error => {
	            	console.log(error)
	          	});
			},
			calculateMonto(index, cantidad){
				this.tableData[index].monto_total = (this.tableData[index].precio * cantidad) - parseFloat(this.tableData[index].descuento) + parseFloat(this.tableData[index].iva)
				this.tableData[index].iva = Math.round((this.tableData[index].precio * cantidad) * this.tableData[index].porcentaje_iva / 100, 0)
				this.generateTotals(this.tableData);
			},
			generateTotals(data){
				this.$store.dispatch('updateSubtotal', data)
			},
			deleteRow(index, rows) {
		        rows.splice(index, 1);
		        this.generateTotals(this.tableData);
		    },

		}
	}
</script>

<style>

</style>

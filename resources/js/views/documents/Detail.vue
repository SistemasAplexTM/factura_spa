<template>
	<div>
		<el-button size="small" type="primary" icon="el-icon-edit-outline" @click="getData(254)">
            agregar
         </el-button>
		<el-table :data="tableData" style="width: 100%">
		    <el-table-column prop="producto" label="Producto"></el-table-column>
		    <el-table-column prop="cantidad" label="Cantidad">
		    	<template slot-scope="scope">
		    		<el-input type="number" v-model="scope.row.cantidad" size="small" min="1" 
		    		@change="calculateMonto(scope.$index, scope.row.cantidad)"></el-input>
		    	</template>
		    </el-table-column>
		    <el-table-column prop="precio" label="Precio Unit."></el-table-column>
		    <el-table-column prop="descuento" label="Desto %-$"></el-table-column>
		    <el-table-column prop="iva" label="% IVA"></el-table-column>
		    <el-table-column prop="monto_total" label="Monto Total"></el-table-column>
		    <el-table-column label="Acciones">
		    	<template slot-scope="scope">
		    		<el-tooltip class="item" effect="dark" content="Eliminar" placement="top">
		    			<el-button type="danger" icon="el-icon-delete" circle
		    			@click.native.prevent="deleteRow(scope.$index, tableData)"
		    			size="mini">
		    			</el-button>
		    		</el-tooltip>
		     	</template>
		    </el-table-column>
	    </el-table>
	    <div>{{ total_monto }}</div>
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
				this.generateTotals(this.tableData);
			},
			generateTotals(data){
				this.$store.dispatch('updateSubtotal', data)
			},
			deleteRow(index, rows) {
		        rows.splice(index, 1);
		    },

		}
	}
</script>

<style>
	
</style>


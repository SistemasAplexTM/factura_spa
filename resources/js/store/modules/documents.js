const documents = {
	state: {
		totals:{
			subtotal_1: 0,
			descuento_1: 0,
			descuento_2: 0,
			subtotal_2:0,
			iva:0,
			retefuente:0,
			reteica:0,
			total:0,
			recibido:0,
			devolucion:0,
			neto:0
  	}
	},
	mutations:{
		SET_TOTALS:(state, obj) => {
			state.totals  = obj
		},
		SET_DESCUENTO_2:(state, descuento_2) => {
			console.log(descuento_2);
			state.totals.descuento_2  = descuento_2
		}
	},
	actions:{
		updateSubtotal({ commit, state }, data){
			let subtotal_1 	= 0;
			let descuento_1 = 0;
			let iva 				= 0;
			let retefuente 	= 0;
			let reteica 		= 0;

			if(data == null){
				subtotal_1 	= state.totals.subtotal_1
				descuento_1 = state.totals.descuento_1
				iva 				= state.totals.iva
				retefuente 	= state.totals.retefuente
				reteica 		= state.totals.reteica
			}else{
				for (var value in data.data) {
					subtotal_1 	+= parseFloat(data.data[value].cantidad) * ((data.pormayor) ? parseFloat(data.data[value].precio_pormayor) : parseFloat(data.data[value].precio))
					descuento_1 += parseFloat(data.data[value].descuento)
					// iva 				+= parseFloat(data[value].iva)
				}
			}
			let subtotal_2 	= parseFloat(subtotal_1 - descuento_1 - parseFloat(state.totals.descuento_2))
			subtotal_2 			= (subtotal_2 <= 0) ? 0 : subtotal_2
			// EL 19 DE IVA DEBE SER UNA VARIABLE QUE ESTE EN LA CONFIGURACION DEL DOCUMENTO
			// iva 						= ((data == null || data == 'null') ? (Math.round(subtotal_2 * (19 / 100))) : iva)
			iva 						= (Math.round(subtotal_2 * (19 / 100)))
			let total 			= parseFloat(subtotal_2 + iva + retefuente + reteica)
			let neto 				= parseFloat(total)
			var obj = {
				subtotal_1: subtotal_1,
				descuento_1: descuento_1,
				descuento_2: parseFloat(state.totals.descuento_2),
				subtotal_2: subtotal_2,
				iva: iva,
				retefuente:0,
				reteica:0,
				total: total,
				recibido:0,
				devolucion:0,
				neto: neto
	  	}
			commit('SET_TOTALS', obj)
		},
		defaultTotals({ commit }){
			var obj = {
				subtotal_1: 0,
				descuento_1: 0,
				descuento_2: 0,
				subtotal_2: 0,
				iva: 0,
				retefuente:0,
				reteica:0,
				total: 0,
				recibido:0,
				devolucion:0,
				neto: 0
	  	}
			commit('SET_TOTALS', obj)
		}
	}
}

export default documents

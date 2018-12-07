const documents = {
	state: {
		totals:{
			subtotal_1: 0,
			descuento_1: 0,
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
		}
	},
	actions:{
		updateSubtotal({ commit }, data){
			let subtotal_1 	= 0;
			let descuento_1 = 0;
			let iva 		= 0;
			let subtotal_2 	= 0;
			let total 		= 0;
			let neto 		= 0;
			for (var value in data) {
				subtotal_1 	+= parseFloat(data[value].cantidad) * parseFloat(data[value].precio)
				descuento_1 += parseFloat(data[value].descuento)
				iva 		+= parseFloat(data[value].iva)
			}
			subtotal_2 	= parseFloat(subtotal_1 - descuento_1)
			total 			= parseFloat(subtotal_2)
			neto 				= parseFloat(total)
			var obj = {
				subtotal_1: subtotal_1,
				descuento_1: descuento_1,
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
		}
	}
}

export default documents

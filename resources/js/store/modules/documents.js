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
		SET_SUBTOTAL_1:(state, subtotal_1) => {
			state.totals.subtotal_1 = subtotal_1
		},
		SET_DESCUENTO_1:(state, descuento_1) => {
			state.totals.descuento_1 = descuento_1
		},
		SET_IVA:(state, iva) => {
			state.totals.iva = iva
		},
		SET_SUBTOTAL_2:(state, subtotal_2) => {
			state.totals.subtotal_2 = subtotal_2
		},
		SET_TOTAL:(state, total) => {
			state.totals.total = total
		},
		SET_NETO:(state, neto) => {
			state.totals.neto = neto
		},
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
			total 		= parseFloat(subtotal_2)
			neto 		= parseFloat(total)

			commit('SET_SUBTOTAL_1', subtotal_1)
			commit('SET_DESCUENTO_1', descuento_1)
			commit('SET_IVA', iva)
			commit('SET_SUBTOTAL_2', subtotal_2)
			commit('SET_TOTAL', total)
			commit('SET_NETO', neto)
		}
	}
}

export default documents

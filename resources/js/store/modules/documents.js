const documents = {
	state: {
		totals_l:{
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
		SET_MONTO_TOTAL:(state, monto_total) => {
			state.totals_1.neto = monto_total
		}
	},
	actions:{
		updateSubtotal({ commit }, data){
			let montoTotal = 0;
			for (var value in data) {
				montoTotal += parseFloat(data[value].monto_total)
			}
			commit('SET_MONTO_TOTAL', montoTotal)
		}
	}
}

export default documents

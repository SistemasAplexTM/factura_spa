import { documentById } from '@/api/document'

const documents = {
	state: {
		editing_document: {},
		totals:{
			subtotal_1: 0,
			descuento_1: 0,
			descuento_2: 0,
			subtotal_2:0,
			iva:0,
			retefuente:0,
			reteica:0,
			total:0,
			anticipo:0,
			recibido:0,
			devolucion:0,
			neto:0
  	},
		wholesale: false,
		form_document: {},
		table_detail: [],
		list: false,
	},
	mutations:{
		SET_EDITING: (state, editing_document) => {
      state.editing_document = editing_document
    },
		SET_TOTALS:(state, obj) => {
			state.totals  = obj
		},
		SET_DESCUENTO_2:(state, descuento_2) => {
			state.totals.descuento_2  = descuento_2
		},
		SET_ANTICIPO:(state, anticipo) => {
			state.totals.anticipo  = (anticipo == '') ? 0 : Math.round(anticipo, 0)
		},
		SET_WHOLESALE:(state, wholesale) => {
			state.wholesale = wholesale
		},
		SET_TABLE_DETAIL:(state, tableData) => {
			state.table_detail = tableData
		},
		SET_FORM_DOCUMENT:(state, form) => {
			state.form_document = form
		},
		SET_RECEIVED:(state, val) => {
			state.totals.recibido = val
		},
		SET_RETURN:(state, val) => {
			state.totals.devolucion = val
		},
		SET_LIST:(state, val) => {
			state.list = val
		},
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
					subtotal_1 	+= parseFloat(data.data[value].cantidad) * ((data.wholesale) ? parseFloat(data.data[value].precio_pormayor) : parseFloat(data.data[value].precio))
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
			let neto 				= parseFloat(total) - parseFloat(state.totals.anticipo)
			var obj = {
				subtotal_1: subtotal_1,
				descuento_1: descuento_1,
				descuento_2: parseFloat(state.totals.descuento_2),
				subtotal_2: subtotal_2,
				iva: iva,
				retefuente:0,
				reteica:0,
				total: total,
				anticipo: parseFloat(state.totals.anticipo),
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
				anticipo:0,
				recibido:0,
				devolucion:0,
				neto: 0
	  	}
			commit('SET_TOTALS', obj)
		},
		defaultAll({ commit, dispatch  }){
			commit('SET_TABLE_DETAIL', [])
			commit('SET_FORM_DOCUMENT', null)
			dispatch('defaultTotals')

		},
		editing_document({ commit }, id){
      if (!id) {
        commit('SET_EDITING', '')
        return false
      }else{
        return new Promise((resolve, reject) => {
          documentById(id).then(response => {
            if (!response.data) {
              reject('error')
            }
            commit('SET_EDITING', response.data)
          }).catch(error => {
            reject(error)
          })
        })
      }
    }
	}
}

export default documents

const getters = {
  sidebar: 			    state => state.app.sidebar,
  payment_editing: 	state => state.payment.payment_editing,
  tercero_editing: 	state => state.terceros.tercero_editing,
  cupons_editing: 	state => state.cupons.cupons_editing,
  // documentos
  totals: 			  state => state.documents.totals,
  wholesale:      state => state.documents.wholesale,
  form_document:  state => state.documents.form_document,
  table_detail:   state => state.documents.table_detail,
}
export default getters

const getters = {
  sidebar: 			    state => state.app.sidebar,
  money:            state => state.app.money,
  payment_editing: 	state => state.payment.payment_editing,
  tercero_editing: 	state => state.terceros.tercero_editing,
  cupons_editing: 	state => state.cupons.cupons_editing,
  // documentos
  totals: 			    state => state.documents.totals,
  wholesale:        state => state.documents.wholesale,
  form_document:    state => state.documents.form_document,
  table_detail:     state => state.documents.table_detail,
  list:             state => state.documents.list,
  editing_document: state => state.documents.editing_document,
}
export default getters

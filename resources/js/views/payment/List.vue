<template lang="html">
  	<vue-table class="box" path="api/payments/init" id="payments" ref="tblPayment" @updateCell="updateForm"></vue-table>
</template>

<script>
import VueTable from '@/components/enso/vuedatatable/VueTable.vue';
import { update } from '@/api/payment'

export default {
  components: {
    VueTable
  },
  methods: {
  	refresh(){
  		this.$refs.tblPayment.getData()
  	},
  	updateForm(value){
  		var data = {
  			id : value.row.dtRowId,
  			descripcion : value.data,
  		}
  		update(data).then(({ data }) => {
          if(data.code == 200){
          	this.refresh()
            this.$message({
              showClose: true,
              message: 'Actualización exitosa.',
              type: 'success'
            });
          }else{
            this.$message({
              showClose: true,
              message: 'Error: '+ data.error.errorInfo,
              type: 'error'
            });
          }
        }).catch(error => {
          this.$message({
            showClose: true,
            message: 'Error.',
            type: 'error'
          });
        })
  	}
  }
}
</script>

<style>

</style>

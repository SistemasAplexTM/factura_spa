<template lang="html">
  	<vue-table class="box" path="api/cupons/init" id="cupons" ref="tblCupons" @updateCell="updateForm" @destroy="deleteForm" @edit="editForm"></vue-table>
</template>

<script>
import VueTable from '@/components/enso/vuedatatable/VueTable.vue';
import { update, deleteRow } from '@/api/cupons'

export default {
  components: {
    VueTable
  },
  methods: {
  	refresh(){
  		this.$refs.tblCupons.getData()
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
  	},
  	editForm(value){
  		this.$store.dispatch('cuponsEditing', value.dtRowId)
  	},
  	deleteForm(value){
  		deleteRow({'id':value.dtRowId}).then(({ data }) => {
          if(data.code == 200){
          	this.refresh()
            this.$message({
              showClose: true,
              message: 'Eliminación exitosa.',
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

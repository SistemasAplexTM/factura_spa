<template lang="html">
  <div class="container">
    <el-dialog title="Facturas registradas" :visible.sync="dialogTableVisible" @close="closeDialog" width="70%" top="10px">
      <vue-table class="" path="api/document/init" id="documents" ref="tblDocuments" @destroy="deleteDocument" @edit="editDocument">
        <div slot="total_payment" slot-scope="props">
          {{ validatePayment(props.row) }}
        </div>
      </vue-table>
    </el-dialog>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import VueTable from '@/components/enso/vuedatatable/VueTable.vue';
export default {
  components: {
    VueTable
  },
  data() {
      return {
        textColor: '',
        dialogTableVisible: false,
      };
    },
    computed:{
      ...mapGetters([
        'list'
      ]),
    },
    watch:{
      list(val){
        this.dialogTableVisible = val
      }
    },
    methods:{
      validatePayment(row){
        this.textColor = null;
        let total_payment = row.total_payment;
        let total_sale = row.total_sale;
        if(parseFloat(total_payment) < parseFloat(total_sale)){
          this.textColor = 'text-danger';
        }
        return total_payment;
      },
      closeDialog(){
        this.$store.commit('SET_LIST', false)
      },
      editDocument(val){
        this.$store.dispatch('editing_document', val.dtRowId)
      },
      deleteDocument(val){
        console.log(val.dtRowId);
      }
    }
}
</script>

<style lang="css">
</style>

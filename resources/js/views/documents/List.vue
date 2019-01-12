<template lang="html">
  <div class="container">
    <el-dialog title="Facturas registradas" :visible.sync="dialogTableVisible" @close="closeDialog" width="70%">
      <vue-table class="box" path="api/document/init" id="documents" ref="tblDocuments">
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
        // if(total_payment  === null){
        //   total_payment = 0;
        // }
        // if(total_sale  === null){
        //   total_sale = 0;
        // }

        if(parseFloat(total_payment) < parseFloat(total_sale)){
          this.textColor = 'text-danger';
        }
        return total_payment;
      },
      closeDialog(){
        this.$store.commit('SET_LIST', false)
      },
    }

}
</script>

<style lang="css">
</style>

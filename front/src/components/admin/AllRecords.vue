<template>
  <div>
    <v-data-table :data="recordsData" :columns="recordsCol"></v-data-table>
  </div>
</template>

<script>
  export default {
    name: 'all-records',
    data () {
      return {
        recordsCol: [
          {
            title: '科室名',
            field: 'dpId'
          }, {
            title: '医生名',
            field: 'dId'
          }, {
            title: '开始出诊时间',
            field: 'beginTime'
          }, {
            title: '结束出诊时间',
            field: 'endTime'
          }, {
            title: '手机号码',
            field: 'pPhoneNumber'
          }, {
            title: '就诊卡号',
            field: 'pMcNumber'
          }
        ]
      }
    },
    methods: {
      recordsData () {
        return this.$http.get('/api/mc/get/all').then(response => ({
          result: response.data
        }))
      }
    }
  }
</script>

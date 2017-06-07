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
            field: 'dpName'
          }, {
            title: '手机号码',
            field: 'phoneNumber'
          }, {
            title: '就诊卡号',
            field: 'mcNumber'
          }
        ]
      }
    },
    methods: {
      recordsData () {
        return this.$http.get('/api/mc/get/normal').then(response => ({
          result: response.data
        }))
      }
    }
  }
</script>

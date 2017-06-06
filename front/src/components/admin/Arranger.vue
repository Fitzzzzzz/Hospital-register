<template>
  <div>
    <v-date-picker range show-time v-model="rangeTime" clearable></v-date-picker>
    <v-button type="primary" icon="user-add">安排出诊</v-button>
    <v-button type="error" icon="user-delete">删除记录</v-button>
    <v-data-table check-type="checkbox" :data="doctorData" :columns="doctorCol" @clickrow="clickRow"></v-data-table>
  </div>
</template>

<script>
  export default {
    name: 'arranger',
    data () {
      return {
        rangeTime: ['2017-06-07 23:12', '2016-06-07 23:12'],
        doctorCol: [
          {
            title: '医生姓名',
            field: 'dName'
          }, {
            title: '职称',
            field: 'pfTitle'
          }, {
            title: '科室',
            field: 'dpName'
          }, {
            title: '开始出诊时间',
            field: 'beginTime'
          }, {
            title: '结束就诊时间',
            field: 'endTime'
          }, {
            title: '剩余接收人数',
            field: 'patientNum'
          }
        ]
      }
    },
    methods: {
      doctorData () {
        return this.$http.get('/api/doctor/get/all').then(response => ({
          result: response.data
        }))
      },
      clickRow (obj) {
        console.log(obj)
      }
    }
  }
</script>

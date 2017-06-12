<template>
  <div>
    
    <v-button type="primary" icon="user-add" @click="openDia">安排出诊</v-button>
    <v-button type="error" icon="user-delete" @click="delDoc">删除记录</v-button>
    <v-modal title="安排出诊" :visible="dialogVis" @ok="mOk" @cancel="mCancel" ok-text="确认" cancel-text="取消">
      <v-date-picker range show-time v-model="rangeTime" clearable></v-date-picker>
      <v-input size="large" placeholder="姓名" style="width:100%;display:inline-block;margin-top:20px;" v-model="dName"></v-input>
      <v-input size="large" placeholder="职称" style="width:100%;display:inline-block;margin-top:20px;" v-model="pfName"></v-input>
      <v-input size="large" placeholder="人数" style="width:100%;display:inline-block;margin-top:20px;" v-model="patientNum"></v-input>
      <v-select placeholder="请选择科室" style="width: 100%;display:inline-block;;margin-top:20px;" :data="options" @change="change"></v-select>
    </v-modal>
    <v-data-table ref="datatable" check-type="checkbox" :data="doctorData" :columns="doctorCol" @clickrow="clickRow"></v-data-table>
  </div>
</template>

<script>
  export default {
    name: 'arranger',
    data () {
      return {
        rangeTime: ['2017-06-13 14:00', '2016-06-13 18:00'],
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
        ],
        dialogVis: false,
        options: [
          {
            value: 1,
            label: '口腔科'
          }, {
            value: 2,
            label: '沙河内科'
          }, {
            value: 3,
            label: '外科'
          }, {
            value: 4,
            label: '妇科'
          }, {
            value: 5,
            label: '清水河中医康复科'
          }, {
            value: 6,
            label: '检验科'
          }, {
            value: 7,
            label: '清水河内科'
          }, {
            value: 8,
            label: '体检科'
          }, {
            value: 9,
            label: '医学影像科'
          }, {
            value: 10,
            label: '神经科'
          }, {
            value: 11,
            label: '急症科'
          }
        ],
        dName: null,
        pfName: null,
        patientNum: null,
        dpId: null,
        deleteId: []
      }
    },
    methods: {
      doctorData () {
        return this.$http.get('/api/doctor/get/all').then(response => ({
          result: response.data
        }))
      },
      clickRow (obj) {
        if (obj.checked) {
          this.deleteId.push(obj.row.did)
        } else {
          for (let i = 0; i < this.deleteId.length; i++) {
            if (this.deleteId[i] === obj.row.did) {
              this.deleteId.splice(i, 1)
              break
            }
          }
        }
      },
      mOk () {
        this.$http.post('/api/doctor/post/add', {
          dName: this.dName,
          pfName: this.pfName,
          patientNum: this.patientNum,
          beginTime: this.rangeTime[0],
          endTime: this.rangeTime[1],
          dpId: this.dpId,
          dpName: this.options[this.dpId - 1].label
        }, {
          emulateJSON: true
        }).then(response => {
          console.log(response)
        })
        this.$refs.datatable.reload()
        this.dialogVis = !this.dialogVis
      },
      mCancel () {
        this.dialogVis = !this.dialogVis
      },
      openDia () {
        this.dialogVis = !this.dialogVis
      },
      change (val) {
        console.log(val)
        this.dpId = val
        console.log(this.rangeTime)
      },
      delDoc () {
        this.$http.post('/api/doctor/post/del', {
          delId: this.deleteId
        }, {
          emulateJSON: true
        }).then(response => {
          console.log(response)
        })
        this.$refs.datatable.reload()
      }
    }
  }
</script>

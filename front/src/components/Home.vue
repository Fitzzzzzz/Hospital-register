<template>
  <div id="components-layout-demo-top-side">
    <v-layout>
      <v-header>
        <div class="container">
          <div class="logo"></div>
          <v-menu id="login" theme="dark" mode="horizontal" :data="menuData1" :style="{lineHeight: '64px'}" @item-click="openLogin"></v-menu>
        </div>
      </v-header>
      <div class="container">
        <v-content :style="{ padding: '0 50px' }">
          <v-breadcrumb :style="{ margin: '12px 0' }">
            <v-breadcrumb-item>首页</v-breadcrumb-item>
            <v-breadcrumb-item>预约挂号</v-breadcrumb-item>
            <v-breadcrumb-item>{{here}}</v-breadcrumb-item>
          </v-breadcrumb>
          <v-layout style="background: #fff; padding: 24px 0;">
            <v-sider :width="200" style="background: #fff">
              <v-menu mode="inline" :data="menuData2" @item-click="itemClick"></v-menu>
            </v-sider>
            <v-content :style="{padding:'0 24px', minHeight: 280}">
              <TimePicker></TimePicker>
              <v-data-table ref="datatable" :data="tableValues" :columns="tableCol" @clickrow="selectDoc"></v-data-table>
            </v-content>
          </v-layout>
        </v-content>
        <v-footer></v-footer>
      </div>
    </v-layout>
    <v-modal title="请输入信息" :visible="dialogVis" @ok="mOk" @cancel="mCancel" ok-text="确认" cancel-text="取消">
      <v-input size="large" placeholder="就诊卡号" style="width:100%;display:inline-block"></v-input>
      <v-input size="large" placeholder="手机号" style="width:100%;display:inline-block;margin-top:20px;"></v-input>
    </v-modal>
    <v-modal title="登录" :visible="dialogLogin" @ok="logIn" @cancel="mCancelLogin" ok-text="确定" cancel-text="取消">
      <v-input size="large" placeholder="帐号" style="width:100%;display:inline-block"></v-input>
      <v-input size="large" placeholder="密码" style="width:100%;display:inline-block;margin-top:20px;"></v-input>
    </v-modal>
  </div>
</template>

<script>
  import TimePicker from '@/components/TimePicker'
  export default {
    name: 'home',
    components: {TimePicker},
    data () {
      return {
        menuData1: [
          {
            name: '挂号系统',
            selected: true
          }, {
            name: '后台登录'
          }, {
            name: '联系我们'
          }
        ],
        menuData2: [
          {
            id: 1,
            name: '特色专科',
            icon: 'smile-o',
            expand: true,
            children: [
              {
                id: 1,
                name: '口腔科'
              }, {
                id: 5,
                name: '清水河中医康复科'
              }, {
                id: 10,
                name: '神经科'
              }
            ]
          }, {
            id: 2,
            name: '所有科室',
            icon: 'menu-fold',
            expand: true,
            children: [
              {
                id: 1,
                name: '口腔科'
              }, {
                id: 2,
                name: '沙河内科'
              }, {
                id: 3,
                name: '外科'
              }, {
                id: 4,
                name: '妇科'
              }, {
                id: 5,
                name: '清水河中医康复科'
              }, {
                id: 6,
                name: '检验科'
              }, {
                id: 7,
                name: '清水河内科'
              }, {
                id: 8,
                name: '体检科'
              }, {
                id: 9,
                name: '医学影像科'
              }, {
                id: 10,
                name: '神经科'
              }, {
                id: 11,
                name: '急症科'
              }
            ]
          }
        ],
        here: '口腔科',
        dpid: 1,
        tableCol: [
          {
            title: '姓名',
            field: 'dName'
          }, {
            title: '开始出诊时间',
            field: 'beginTime'
          }, {
            title: '结束出诊时间',
            field: 'endTime'
          }, {
            title: '职称',
            field: 'pfTitle'
          }, {
            title: '剩余人数',
            field: 'patientNum'
          }
        ],
        dialogVis: false,
        dialogLogin: false
      }
    },
    itemId: 1,
    methods: {
      itemClick (val) {
        this.here = val[1].name
        this.itemId = val[1].id
        this.$refs.datatable.reload()
      },
      tableValues () {
        return this.$http.get('/api/doctor/get/dp/' + this.itemId).then(response => ({
          result: response.data
        }))
      },
      selectDoc (a, b, c) {
        console.log(a, b, c)
        this.dialogVis = !this.dialogVis
      },
      mOk () {
        this.dialogVis = !this.dialogVis
        this.openTypeMessage('success')
      },
      mCancel () {
        this.dialogVis = !this.dialogVis
      },
      openTypeMessage (type) {
        this.$message[type]('挂号成功^.^')
      },
      logIn () {
        this.dialogLogin = !this.dialogLogin
        this.openTypeMessage('success')
      },
      mCancelLogin () {
        this.dialogLogin = !this.dialogLogin
      },
      openLogin (val) {
        if (val[0].name === '后台登录') {
          this.dialogLogin = !this.dialogLogin
        }
      }
    }
  }
</script>

<style>
  #components-layout-demo-top-side .logo {
    width: 120px;
    height: 31px;
    background: #333;
    border-radius: 6px;
    margin: 16px 28px 16px 50px;
    overflow: hidden;
    float: left;
  }
  #components-layout-demo-top-side #login {
    float: right;
  }
</style>

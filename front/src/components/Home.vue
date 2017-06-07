<template>
  <div id="components-layout-demo-top-side">
    <v-layout>
      <v-header>
        <div class="container">
          <div class="logo">在线挂号系统</div>
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
              <v-date-picker v-model="todayDate" clearable size="lg"></v-date-picker>
              <v-button type="primary" @click="selectDoc">普通号</v-button>
              <v-data-table ref="datatable" :data="tableValues" :columns="tableCol" @clickrow="selectDoc"></v-data-table>
            </v-content>
          </v-layout>
        </v-content>
        <v-footer></v-footer>
      </div>
    </v-layout>
    <v-modal title="请输入信息" :visible="dialogVis" @ok="mOk" @cancel="mCancel" ok-text="确认" cancel-text="取消">
      <v-input size="large" placeholder="就诊卡号" style="width:100%;display:inline-block" v-model="mcNum"></v-input>
      <v-input size="large" placeholder="手机号" style="width:100%;display:inline-block;margin-top:20px;" v-model="phoneNum"></v-input>
    </v-modal>
    <v-modal title="登录" :visible="dialogLogin" @ok="logIn" @cancel="mCancelLogin" ok-text="确定" cancel-text="取消">
      <v-input size="large" placeholder="帐号" style="width:100%;display:inline-block" v-model="username"></v-input>
      <v-input size="large" placeholder="密码" type="password" style="width:100%;display:inline-block;margin-top:20px;" v-model="password"></v-input>
    </v-modal>
  </div>
</template>

<script>
  export default {
    name: 'home',
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
        dialogLogin: false,
        itemId: 1,
        todayDate: '2017-06-01',
        doctors: [],
        mcNum: null,
        phoneNum: null,
        did: null,
        admin: {
          adminName: 'admin',
          adminPassword: 'admin'
        },
        username: null,
        password: null,
        isPf: false
      }
    },
    methods: {
      itemClick (val) {
        this.here = val[1].name
        this.itemId = val[1].id
        this.$refs.datatable.reload()
        this.$http.post('/api/doctor/post/dp', {
          dpId: this.itemId,
          date: this.todayDate
        }, {
          emulateJSON: true
        }).then(response => {
          this.doctors = response.data
        })
      },
      tableValues () {
        return this.$http.post('/api/doctor/post/dp', {
          dpId: this.itemId,
          date: this.todayDate
        }, {emulateJSON: true}).then(response => ({
          result: response.data
        }))
      },
      selectDoc (val) {
        if (val.row.patientNum <= 0) {
          alert('人满了！')
        } else {
          this.dialogVis = !this.dialogVis
          this.did = val.row.did
          this.isPf = !this.isPf
        }
      },
      addNormal () {
        this.dialogVis = !this.dialogVis
      },
      mOk () {
        if (this.isPf) {
          this.$http.post('/api/mc/post/in', {
            dpId: this.doctors[0].dpId,
            dId: this.did,
            beginTime: this.doctors[0].beginTime,
            endTime: this.doctors[0].endTime,
            phoneNum: this.phoneNum,
            mcNum: this.mcNum
          }, {
            emulateJSON: true
          }).then(response => {
            this.openTypeMessage('success', '挂号')
          })
          this.$refs.datatable.reload()
          this.isPf = !this.isPf
        } else {
          this.$http.post('/api/mc/post/normal', {
            dpId: this.itemId,
            dpName: this.here,
            mcNumber: this.mcNum,
            phoneNumber: this.phoneNum
          }, {
            emulateJSON: true
          }).then(response => {
            console.log(response)
          })
        }

        this.dialogVis = !this.dialogVis
      },
      mCancel () {
        this.dialogVis = !this.dialogVis
      },
      openTypeMessage (type, message) {
        this.$message[type](message + '成功^.^')
      },
      logIn () {
        if (this.username === this.admin.adminName && this.password === this.admin.adminPassword) {
          sessionStorage.setItem('isLogin', true)
          this.dialogLogin = !this.dialogLogin
          this.openTypeMessage('success', '登陆')
          this.$router.push('/admin')
        }
      },
      mCancelLogin () {
        this.dialogLogin = !this.dialogLogin
      },
      openLogin (val) {
        if (val[0].name === '后台登录') {
          if (sessionStorage.getItem('isLogin')) {
            this.$router.push('/admin')
          } else {
            this.dialogLogin = !this.dialogLogin
          }
        }
      }
    }
  }
</script>

<style>
  #components-layout-demo-top-side .logo {
    line-height: 30px;
    color: white;
    text-align: center;
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

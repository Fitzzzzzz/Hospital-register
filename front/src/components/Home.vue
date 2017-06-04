<template>
  <div id="components-layout-demo-top-side">
    <v-layout>
      <v-header>
        <div class="container">
          <div class="logo"></div>
          <v-menu id="login" theme="dark" mode="horizontal" :data="menuData1" :style="{lineHeight: '64px'}"></v-menu>
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
            </v-content>
          </v-layout>
        </v-content>
        <v-footer></v-footer>
      </div>
    </v-layout>
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
            name: 'nav 1'
          }, {
            name: 'nav 2',
            selected: true
          }, {
            name: 'nav 3'
          }
        ],
        menuData2: [
          {
            name: '特色专科',
            icon: 'smile-o',
            expand: true,
            children: [
              {
                id: 1,
                name: '口腔科',
                selected: true
              }, {
                id: 5,
                name: '清水河中医康复科'
              }, {
                id: 10,
                name: '神经科'
              }
            ]
          }, {
            name: '所有科室',
            icon: 'menu-fold',
            children: [
              {
                id: 1,
                name: '口腔科',
                selected: true
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
        here: '口腔科'
      }
    },
    methods: {
      itemClick (val) {
        this.here = val[1].name
        console.log(val)
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

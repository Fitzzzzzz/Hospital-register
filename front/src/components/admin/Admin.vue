<template>
  <div id="components-layout-demo-custom-trigger">
    <v-layout>
      <v-sider collapsible :collapsed="customCollapsed" :trigger="false" :collapsed-width="64">
        <div class="logo"></div>
        <v-menu theme="dark" mode="inline" :data="menuData4" @item-click="changeItem">
          <template scope="{data}">
            <i v-if="data.icon" :class="'anticon anticon-' + data.icon"></i>
            <span class="nav-text">{{data.name}}</span>
          </template>
        </v-menu>
      </v-sider>
      <v-layout>
        <v-header :style="{ background: '#fff', padding: 0 }">
          <v-icon class="trigger" :type="this.customCollapsed ? 'menu-unfold' : 'menu-fold'" @click.native="toggle"></v-icon>
        </v-header>
        <v-content :style="{ padding: '0 50px' }">
          <v-breadcrumb :style="{ margin: '12px 0' }">
            <v-breadcrumb-item>管理系统</v-breadcrumb-item>
            <v-breadcrumb-item>Home</v-breadcrumb-item>
          </v-breadcrumb>
          <div style="padding: 24px; background: #fff; min-height: 800px;">
            <router-view></router-view>
          </div>
        </v-content>
        <v-footer :style="{ textAlign: 'center' }"></v-footer>
      </v-layout>
    </v-layout>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        customCollapsed: false,
        menuData4: [{
          name: '安排出诊',
          icon: 'user',
          selected: true
        }, {
          name: '查看预约记录',
          icon: 'area-chart'
        }]
      }
    },
    methods: {
      toggle () {
        this.customCollapsed = !this.customCollapsed
      },
      changeItem (m) {
        if (m[0].name === '安排出诊') {
          console.log(66)
        } else {
          console.log(44)
        }
      }
    }
  }
</script>

<style lang="css">
#components-layout-demo-custom-trigger .trigger {
  font-size: 18px;
  line-height: 64px;
  padding: 0 16px;
  cursor: pointer;
  transition: color .3s;
}
#components-layout-demo-custom-trigger .trigger:hover {
  color: #108ee9;
}
#components-layout-demo-custom-trigger .logo {
  height: 32px;
  background: #333;
  border-radius: 6px;
  margin: 16px;
}
#components-layout-demo-custom-trigger .ant-layout-sider-collapsed .anticon {
  font-size: 16px;
}
#components-layout-demo-custom-trigger .ant-layout-sider-collapsed .nav-text {
  display: none;
}
</style>


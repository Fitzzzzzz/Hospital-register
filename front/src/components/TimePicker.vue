<template>
  <div>
    <v-date-picker v-model="date1" clearable @change="change" size="lg"></v-date-picker>
  </div>
</template>

<script>
export default {
  data () {
    return {
      date1: '2017-06-04'
    }
  },
  watch: {
    data1 (val) {
      console.log(val)
    }
  },
  methods: {
    change (item) {
      console.log('change ' + item)
    }
  }
}
</script>

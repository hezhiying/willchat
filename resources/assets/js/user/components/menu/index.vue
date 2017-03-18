<template>
  <div class="right-main">
    <h1>hello</h1>
    <div class="test">

    </div>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        menus: []
      }
    },

    mounted () {
      this.getMenus();
    },

    methods: {
      getMenus () {
        this.axios.get('menu/lists').then((response) => {
          this.menus = response.data.menus;
        }).catch((error) => {
          this.$message({
            message: error.response.data,
            type: 'error'
          });
        })
      }
    }
  }
</script>

<style scoped lang="scss">
  .test {

  }
</style>
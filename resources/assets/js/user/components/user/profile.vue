<template>
  <div class="main main-with-padding">
    {{ user }}

  </div>
</template>

<script>
  export default {
    data () {
      return {
        user: {}
      };
    },

    mounted () {
//      this.axios.get('user/profile').then((response) => {
//        this.user = response.data.user;
//      });
    },

    methods: {
      toManage (id) {
        window.localStorage.setItem('willchat_account_id', id);

        this.$router.push(`manage/${id}`);
      }
    }
  }
</script>

<style scoped lang="scss">

</style>

<template>
  <div class="main main-with-padding">
    <el-row :gutter="20">
      <el-col :span="8">
        <router-link to="/avatar">
          <img src="" class="avatar" alt=""/>
        </router-link>
      </el-col>
      <el-col :span="24">
        <div class="user-profile">
          <div class="header"></div>
        </div>
      </el-col>
    </el-row>
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
  .avatar {
    display: block;
    width: 80%;
    height: 200px;
    overflow: hidden;
    background-color: red;
  }
</style>

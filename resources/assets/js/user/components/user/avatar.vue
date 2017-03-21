<template>
  <div class="main main-with-padding">
    <el-row :gutter="20" type="flex" justify="center">
      <el-col :span="8">
        <el-upload
                class="avatar-uploader"
                :multiple="false"
                action="/api/user/avatar-upload"
                :headers="headers"
                name="avatar"
                :show-file-list="false"
                :on-success="handleAvatarScucess"
                :before-upload="beforeAvatarUpload">
          <img v-if="imageUrl" :src="imageUrl" class="avatar">
          <i v-else class="el-icon-plus avatar-uploader-icon"></i>
        </el-upload>

        <router-link to="/user/avatar">

        </router-link>
      </el-col>
    </el-row>
  </div>
</template>

<script>
  import userConfig from '../../config';

  export default {
    data () {
      return {
        imageUrl: '',
        headers: ''
      };
    },

    mounted () {
      this.headers = {
        Authorization: 'bearer ' + window.localStorage.getItem(userConfig.jwtTokenKey)
      };
    },

    methods: {
      handleAvatarScucess (res, file) {
        this.imageUrl = URL.createObjectURL(file.raw);
      },

      beforeAvatarUpload (file) {
        const isJPG = file.type === 'image/jpeg';
        const isLt2M = file.size / 1024 / 1024 < 2;

        if (!isJPG) {
          this.$message.error('上传头像图片只能是 JPG 格式!');
        }
        if (!isLt2M) {
          this.$message.error('上传头像图片大小不能超过 2MB!');
        }
        return isJPG && isLt2M;
      }
    }
  }
</script>

<style scoped lang="scss">
  .avatar-uploader .el-upload {
    border: 1px dashed #d9d9d9;
    border-radius: 6px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
  }
  .avatar-uploader .el-upload:hover {
    border-color: #20a0ff;
  }
  .avatar-uploader-icon {
    font-size: 28px;
    color: #8c939d;
    width: 178px;
    height: 178px;
    line-height: 178px;
    text-align: center;
  }
  .avatar {
    width: 178px;
    height: 178px;
    display: block;
  }
</style>

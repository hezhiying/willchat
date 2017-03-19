<template>
  <div class="right-main">
    <!--<el-button @click.native="syncMenu">同步</el-button>-->

    {{ menus }}
    <el-row :gutter="30">
      <el-col :span="8">
        <div class="menu-preview">
          <div class="header">
            <div class="account-name">公众号名</div>
          </div>
          <div class="footer">1234</div>
        </div>
      </el-col>
      <el-col :span="16">
        <div class="edit-panel">
          <div class="header">
            <span class="menu-name">菜单名称</span>
            <el-button class="btn-delete-menu">删除菜单</el-button>
          </div>
          <div class="body">
            <el-form ref="form" :model="menu" label-width="90px">
              <el-form-item label="菜单名称">
                <el-input v-model="menu.name" placeholder="字数不超过4个汉字或8个字母"></el-input>
              </el-form-item>
              <el-form-item label="菜单内容">
                <el-select v-model="menu.type" placeholder="">
                  <el-option label="点击推事件" value="click"></el-option>
                  <el-option label="跳转链接" value="view"></el-option>
                  <el-option label="扫码推事件" value="scancode_push"></el-option>
                  <el-option label="扫码推事件且提示" value="scancode_waitmsg"></el-option>
                  <el-option label="弹出系统拍照发图" value="pic_sysphoto"></el-option>
                  <el-option label="弹出拍照或相册发图" value="pic_photo_or_album"></el-option>
                  <el-option label="弹出微信相册发图" value="pic_weixin"></el-option>
                  <el-option label="弹出地理位置选择器" value="location_slect"></el-option>
                  <el-option label="发送消息" value="media_id"></el-option>
                  <el-option label="跳转图文消息 URL" value="view_limited"></el-option>
                </el-select>
              </el-form-item>
              <el-form-item label="关键词" v-show="menu.type === 'click'">
                <el-input v-model="menu.key" placeholder=""></el-input>
              </el-form-item>
              <el-form-item label="页面地址" v-show="menu.type === 'view'">
                <el-input v-model="menu.url" placeholder=""></el-input>
              </el-form-item>

            </el-form>
          </div>
        </div>
      </el-col>
    </el-row>
    <el-row type="flex" justify="center" class="buttons">
      <el-col :span="6">
        <el-button type="primary" @click.native="storeAndPublish">保存并发布</el-button>
        <el-button type="default">预览</el-button>
      </el-col>
    </el-row>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        menus: [],
        menu: {
          name: '',
          type: 'click',
          key: ''
        }
      }
    },

    mounted () {
      this.getMenus();
    },

    methods: {
      getMenus () {
        this.axios.get('menu/lists').then((response) => {
          this.menus = response.data.menus;
        });
      },

      // 保存并发布
      storeAndPublish () {
        this.axios.post('menu/store', this.menu).then((response) => {
          console.log(response);

//          this.menus = response.data.menus;
        });
      },

      syncMenu () {
        this.axios.post('menu/sync').then((response) => {
          this.menus = response.data.menus;
        });
      }
    }
  }
</script>

<style scoped lang="scss">
  .right-main {
    background-color: #fff;
  }

  .menu-preview {
    display: block;
    overflow: hidden;
    position: relative;
    width: 320px;
    height: 500px;
    background-color: #fff;
    margin: 0 auto;
    border: 1px solid #ddd;
    
    .header {
      display: flex;
      position: absolute;
      width: 100%;
      height: 80px;
      background-image: url(../../../../img/bg_mobile_head.png);
      -webkit-background-size: 100%;
      background-size: 100%;
      background-repeat: no-repeat;
      justify-content: center;

      .account-name {
        display: flex;
        align-content: center;
        justify-content: center;
        color: #fff;
      }
    }

    .footer {
      display: block;
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 50px;
      background-image: url(../../../../img/bg_mobile_foot.png);
      -webkit-background-size: 100%;
      background-size: 100%;
      background-repeat: no-repeat;


    }
  }
  
  .edit-panel {
    display: block;
    overflow: hidden;
    background-color: #e7e7e7;
    width: 100%;
    padding: 1rem;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    border: 1px solid #eee;
    
    .header {
      padding-bottom: 1rem;
      border-bottom: 1px solid #d5d5d5;

      .btn-delete-menu {
        float: right;
      }
    }

    .body {
      padding: 1rem;
    }
  }

  .buttons {
    margin-top: 30px;
  }
</style>
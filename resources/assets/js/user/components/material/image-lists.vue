<template>
  <div class="right-main">
    <div class="table-tools">
      <el-form :inline="true" :model="searchForm" class="demo-form-inline">
        <el-form-item>
          <el-input v-model="searchForm.keyword" placeholder="按昵称搜索" @keyup.enter.native="loadData"></el-input>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" icon="search" @click="search">搜索</el-button>
          <el-button type="primary" icon="plus" @click="dialogFormVisible = true">上传视频素材</el-button>
          <el-button type="primary" icon="upload" @click="syncvideo">同步视频素材</el-button>
        </el-form-item>
      </el-form>
    </div>

    <el-table :data="fans.data" border style="width: 100%">
      <!-- <el-table-column type="selection" width="55"></el-table-column>-->
      <el-table-column prop="media_id" label="MEDIA_ID" align="center" width="400">
      </el-table-column>
      <el-table-column prop="name" label="标题" align="center">
      </el-table-column>
      <el-table-column prop="description" label="描述" align="center">
      </el-table-column>
      <el-table-column prop="created_at" label="创建时间" align="center" width="170">
      </el-table-column>
      <el-table-column prop="updated_at" label="更新时间" align="center" width="170">
      </el-table-column>
      <el-table-column label="操作" inline-template align="center" width="120">
        <div>
          <el-button size="small" type="danger" @click.native="deleteMaterial(row)">删除</el-button>
        </div>
      </el-table-column>
    </el-table>

    <div class="paginator">
      <el-pagination
              @current-change="handleCurrentChange"
              :current-page="fans.current_page"
              :page-size="fans.per_page"
              layout="total, prev, pager, next, jumper"
              :total="fans.tatal">
      </el-pagination>
    </div>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        fans: [],
        searchForm: {
          name: '',
          sex: 'all'
        }
      }
    },

    mounted () {
      this.loadData();
    },

    methods: {
      loadData (page = 1) {
        this.axios.get('fans/lists', {
          params: {
            keyword: this.searchForm.keyword,
            sex: this.searchForm.sex,
            page: page
          }
        }).then((response) => {
          this.fans = response.data.fans;
        });
      },

      syncWechatFans () {
        // TODO: 同步粉丝数据
        console.log('sync');
      },

      // 搜索
      search () {
        this.loadData(1);
      },

      handleCurrentChange (page) {
        this.loadData(page);
      }
    }
  }
</script>

<style scoped lang="scss">
  .avatar {
    display: block;
    overflow: hidden;
    margin: 10px 0;
    width: 80px;
    height: 80px;
  }
</style>
const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

const path = require('path');
require('shelljs/global');
const webpack = require('webpack');

// 此项保证 webpack 能正常加载静态图片等资源
mix.setResourceRoot('/js/');

// 为了解决 element-ui 一些问题，需要修改 webpack 配置
mix.webpackConfig({
  module: {
    rules: [
      {
        enforce: 'pre',
        test: /\.js$/,
        exclude: /(node_modules|bower_components)/,
        loader: 'eslint-loader'
      },
      {
        test: /\.scss$/,
        exclude: /(node_modules|bower_components)/,
        use: ['style-loader', 'css-loader', 'sass-loader']
      }
    ]
  },
  entry: {
    user: './resources/assets/js/user/index.js',
    vendor: ['vue', 'vuex', 'vue-router', 'axios', 'vue-axios', 'element-ui']
  },
  output: {
    path: path.resolve(__dirname, 'public/js'),
    publicPath: '/js/',
    filename: '[name].entry.js',
    chunkFilename: process.env.NODE_ENV === 'production' ? '[name].[chunkhash].js' :'[name].js'
  },
  plugins: [
    new webpack.optimize.CommonsChunkPlugin({
      name: 'vendor',
      filename: 'vendor.js'
    })
  ]
});

if (process.env.NODE_ENV === 'production') {
  // 删除原构建的文件
  rm('-rf', path.join(__dirname, 'public/js'));

  mix.version([
    'public/js/vendor.js',
    'public/js/user.entry.js'
  ]);
}

mix.browserSync({
  proxy: 'localhost:8020/user',
  files: [
    'app/**/*.php',
    'resources/views/**/*.php',
    'public/js/**/*.js',
    'public/css/**/*.css',
  ]
});

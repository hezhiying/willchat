webpackJsonp([2],{

/***/ 201:
/***/ (function(module, exports, __webpack_require__) {


/* styles */
__webpack_require__(285)

var Component = __webpack_require__(47)(
  /* script */
  __webpack_require__(219),
  /* template */
  __webpack_require__(267),
  /* scopeId */
  "data-v-6729d4bc",
  /* cssModules */
  null
)
Component.options.__file = "D:\\UPUPW\\vhosts\\willchat\\resources\\assets\\js\\user\\components\\auth\\login.vue"
if (Component.esModule && Object.keys(Component.esModule).some(function (key) {return key !== "default" && key !== "__esModule"})) {console.error("named exports are not supported in *.vue files.")}
if (Component.options.functional) {console.error("[vue-loader] login.vue: functional components are not supported with templates, they should use render functions.")}

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-6729d4bc", Component.options)
  } else {
    hotAPI.reload("data-v-6729d4bc", Component.options)
  }
})()}

module.exports = Component.exports


/***/ }),

/***/ 219:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


Object.defineProperty(exports, "__esModule", {
  value: true
});

var _extends2 = __webpack_require__(28);

var _extends3 = _interopRequireDefault(_extends2);

var _config = __webpack_require__(14);

var _config2 = _interopRequireDefault(_config);

var _vuex = __webpack_require__(9);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

exports.default = {
  data: function data() {
    return {
      formData: {
        name: '',
        password: ''
      }
    };
  },


  methods: (0, _extends3.default)({}, (0, _vuex.mapActions)(['storeUserToLocal']), {
    login: function login() {
      var _this = this;

      this.axios.post('login', this.formData).then(function (response) {
        localStorage.setItem(_config2.default.jwtTokenKey, response.data.token);

        _this.storeUserToLocal(response.data.user);

        _this.$router.push('/');
      }).catch(function (error) {
        _this.$message({
          message: error.response.data,
          type: 'error'
        });
      });
    }
  })
};

/***/ }),

/***/ 246:
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(13)();
exports.push([module.i, "\n#login[data-v-6729d4bc] {\n  position: fixed;\n  display: -webkit-box;\n  display: -ms-flexbox;\n  display: flex;\n  left: 0;\n  right: 0;\n  top: 0;\n  bottom: 0;\n  -webkit-box-pack: center;\n      -ms-flex-pack: center;\n          justify-content: center;\n  -webkit-box-align: center;\n      -ms-flex-align: center;\n          align-items: center;\n  background-image: url("+__webpack_require__(256)+");\n  background-size: cover;\n}\n#login .login-form[data-v-6729d4bc] {\n    display: block;\n    width: 360px;\n    background-color: #e0e6ed;\n    padding: 40px;\n    border-radius: 10px;\n}\n#login .login-form .title[data-v-6729d4bc] {\n      font-size: 2rem;\n      line-height: 2rem;\n      color: #4e4e4e;\n      text-align: center;\n      font-family: 'Microsoft Yahei';\n      font-weight: 400;\n}\n#login .login-form .el-input[data-v-6729d4bc] {\n      display: block;\n      margin: 1rem 0;\n}\n#login .login-form .btn-submit[data-v-6729d4bc] {\n      display: block;\n      overflow: hidden;\n      width: 100%;\n      margin-top: 3rem;\n}\n", ""]);

/***/ }),

/***/ 256:
/***/ (function(module, exports) {

module.exports = "/js/images/login-bg.jpg?90666d610bd3dd8f34a42d472f9b52f4";

/***/ }),

/***/ 267:
/***/ (function(module, exports, __webpack_require__) {

module.exports={render:function (){var _vm=this;var _h=_vm.$createElement;var _c=_vm._self._c||_h;
  return _c('div', {
    attrs: {
      "id": "login"
    }
  }, [_c('div', {
    staticClass: "login-form"
  }, [_c('h1', {
    staticClass: "title"
  }, [_vm._v("WillChat")]), _vm._v(" "), _c('el-input', {
    attrs: {
      "type": "text",
      "placeholder": "请输入用户名"
    },
    nativeOn: {
      "keyup": function($event) {
        if (!('button' in $event) && _vm._k($event.keyCode, "enter", 13)) { return null; }
        _vm.login($event)
      }
    },
    model: {
      value: (_vm.formData.name),
      callback: function($$v) {
        _vm.formData.name = $$v
      },
      expression: "formData.name"
    }
  }), _vm._v(" "), _c('el-input', {
    attrs: {
      "type": "password",
      "placeholder": "请输入登录密码"
    },
    nativeOn: {
      "keyup": function($event) {
        if (!('button' in $event) && _vm._k($event.keyCode, "enter", 13)) { return null; }
        _vm.login($event)
      }
    },
    model: {
      value: (_vm.formData.password),
      callback: function($$v) {
        _vm.formData.password = $$v
      },
      expression: "formData.password"
    }
  }), _vm._v(" "), _c('el-button', {
    staticClass: "btn-submit",
    attrs: {
      "type": "primary",
      "disabled": false
    },
    nativeOn: {
      "click": function($event) {
        _vm.login($event)
      }
    }
  }, [_vm._v("登录")])], 1)])
},staticRenderFns: []}
module.exports.render._withStripped = true
if (false) {
  module.hot.accept()
  if (module.hot.data) {
     require("vue-hot-reload-api").rerender("data-v-6729d4bc", module.exports)
  }
}

/***/ }),

/***/ 285:
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(246);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(48)("1ba8ce96", content, false);
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-rewriter.js?id=data-v-6729d4bc&scoped=true!../../../../../../node_modules/sass-loader/lib/loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./login.vue", function() {
     var newContent = require("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-rewriter.js?id=data-v-6729d4bc&scoped=true!../../../../../../node_modules/sass-loader/lib/loader.js!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./login.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ })

});
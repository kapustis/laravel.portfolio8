(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[0],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Replies.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Replies.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _mixins_Collection__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../mixins/Collection */ "./resources/js/mixins/Collection.js");
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  name: "Replies",
  components: {
    Reply: function Reply() {
      return Promise.all(/*! import() */[__webpack_require__.e(2), __webpack_require__.e(7)]).then(__webpack_require__.bind(null, /*! ./Reply.vue */ "./resources/js/components/Reply.vue"));
    },
    NewReply: function NewReply() {
      return Promise.all(/*! import() */[__webpack_require__.e(6), __webpack_require__.e(4)]).then(__webpack_require__.bind(null, /*! ./NewReply.vue */ "./resources/js/components/NewReply.vue"));
    }
  },
  mixins: [_mixins_Collection__WEBPACK_IMPORTED_MODULE_0__["default"]],
  data: function data() {
    return {
      dataSet: false
    };
  },
  created: function created() {
    this.fetch();
  },
  methods: {
    fetch: function fetch(page) {
      axios.get(this.url(page)).then(this.refresh);
    },
    url: function url(page) {
      if (!page) {
        var query = location.search.match(/page=(\d+)/);
        page = query ? query[1] : 1;
      }

      return "".concat(location.pathname, "/replies?page=").concat(page);
    },
    refresh: function refresh(_ref) {
      var data = _ref.data;
      this.dataSet = data;
      this.items = data.data;
      window.scrollTo(0, 0);
    }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Replies.vue?vue&type=style&index=0&lang=css&":
/*!*************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Replies.vue?vue&type=style&index=0&lang=css& ***!
  \*************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\na {\r\n  color: #03658c;\r\n  text-decoration: none;\n}\nul {\r\n  list-style-type: none;\n}\nbody {\r\n  font-family: 'Roboto', Arial, Helvetica, Sans-serif, Verdana, serif;\r\n  background: #dee1e3;\n}\r\n\r\n/** ====================\r\n * Lista de Comentarios\r\n =======================*/\n.comments-container {\r\n  margin: 0 auto 15px;\r\n  width: 768px;\n}\n.comments-container h1 {\r\n  font-size: 36px;\r\n  color: #283035;\r\n  font-weight: 400;\n}\n.comments-container h1 a {\r\n  font-size: 18px;\r\n  font-weight: 700;\n}\n.comments-list {\r\n  margin-top: 30px;\r\n  position: relative;\n}\r\n\r\n/**\r\n * Lineas / Detalles\r\n -----------------------*/\n.comments-list:before {\r\n  content: '';\r\n  width: 2px;\r\n  height: 100%;\r\n  background: #c7cacb;\r\n  position: absolute;\r\n  left: 32px;\r\n  top: 0;\n}\n.comments-list:after {\r\n  content: '';\r\n  position: absolute;\r\n  background: #c7cacb;\r\n  bottom: 0;\r\n  left: 27px;\r\n  width: 7px;\r\n  height: 7px;\r\n  border: 3px solid #dee1e3;\r\n  border-radius: 50%;\n}\n.reply-list li:before {\r\n  content: '';\r\n  width: 60px;\r\n  height: 2px;\r\n  background: #c7cacb;\r\n  position: absolute;\r\n  top: 25px;\r\n  left: -55px;\n}\n.comments-list li {\r\n  margin-bottom: 15px;\r\n  display: block;\r\n  position: relative;\n}\n.comments-list li:after {\r\n  content: '';\r\n  display: block;\r\n  clear: both;\r\n  height: 0;\r\n  width: 0;\n}\r\n\r\n/**\r\n * Avatar\r\n ---------------------------*/\n.comments-list .comment-avatar {\r\n  width: 65px;\r\n  height: 65px;\r\n  position: relative;\r\n  z-index: 99;\r\n  float: left;\r\n  border: 3px solid #FFF;\r\n  border-radius: 4px;\r\n  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);\r\n  overflow: hidden;\n}\n.comments-list .comment-avatar img {\r\n  width: 100%;\r\n  height: 100%;\n}\n.reply-list .comment-avatar {\r\n  width: 50px;\r\n  height: 50px;\n}\r\n\r\n/**\r\n * Caja del Comentario\r\n ---------------------------*/\n.comments-list .comment-box {\r\n  width: 680px;\r\n  float: right;\r\n  position: relative;\r\n  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.15);\n}\n.comments-list .comment-box:before, .comments-list .comment-box:after {\r\n  content: '';\r\n  height: 0;\r\n  width: 0;\r\n  position: absolute;\r\n  display: block;\r\n  border-width: 10px 12px 10px 0;\r\n  border-style: solid;\r\n  border-color: transparent #FCFCFC;\r\n  top: 8px;\r\n  left: -11px;\n}\n.comments-list .comment-box:before {\r\n  border-width: 11px 13px 11px 0;\r\n  border-color: transparent rgba(0, 0, 0, 0.05);\r\n  left: -12px;\n}\n.reply-list .comment-box {\r\n  width: 610px;\n}\n.comment-box .comment-head {\r\n  background: #FCFCFC;\r\n  padding: 10px 12px;\r\n  border-bottom: 1px solid #E5E5E5;\r\n  overflow: hidden;\r\n  border-radius: 4px 4px 0 0;\n}\n.comment-box .comment-head i {\r\n  float: right;\r\n  margin-left: 14px;\r\n  position: relative;\r\n  top: 2px;\r\n  color: #A6A6A6;\r\n  cursor: pointer;\r\n  transition: color 0.3s ease;\n}\n.comment-box .comment-head i:hover {\r\n  color: #03658c;\n}\n.comment-box .comment-name {\r\n  color: #283035;\r\n  font-size: 14px;\r\n  font-weight: 700;\r\n  float: left;\r\n  margin-right: 10px;\n}\n.comment-box .comment-name a {\r\n  color: #283035;\n}\n.comment-box .comment-head span {\r\n  float: left;\r\n  color: #999;\r\n  font-size: 13px;\r\n  position: relative;\r\n  top: 1px;\n}\n.comment-box .comment-content {\r\n  background: #FFF;\r\n  padding: 12px;\r\n  font-size: 15px;\r\n  color: #595959;\r\n  border-radius: 0 0 4px 4px;\n}\n.comment-box .comment-name.by-author, .comment-box .comment-name.by-author a {\r\n  color: #03658c;\n}\n.comment-box .comment-name.by-author:after {\r\n  content: 'autor';\r\n  background: #03658c;\r\n  color: #FFF;\r\n  font-size: 12px;\r\n  padding: 3px 5px;\r\n  font-weight: 700;\r\n  margin-left: 10px;\r\n  border-radius: 3px;\n}\r\n\r\n/** =====================\r\n * Responsive\r\n ========================*/\n@media only screen and (max-width: 766px) {\n.comments-container {\r\n    width: 480px;\n}\n.comments-list .comment-box {\r\n    width: 390px;\n}\n.reply-list .comment-box {\r\n    width: 320px;\n}\n}\r\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Replies.vue?vue&type=style&index=0&lang=css&":
/*!*****************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Replies.vue?vue&type=style&index=0&lang=css& ***!
  \*****************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../node_modules/css-loader??ref--6-1!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--6-2!../../../node_modules/vue-loader/lib??vue-loader-options!./Replies.vue?vue&type=style&index=0&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Replies.vue?vue&type=style&index=0&lang=css&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Replies.vue?vue&type=template&id=c6fb9326&":
/*!**********************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/Replies.vue?vue&type=template&id=c6fb9326& ***!
  \**********************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c("div", { staticClass: "comments-container" }, [
        _c(
          "ul",
          { staticClass: "comments-list", attrs: { id: "comments-list" } },
          _vm._l(_vm.items, function(reply, index) {
            return _c(
              "li",
              { key: reply.id },
              [
                _c("reply", {
                  attrs: { data: reply },
                  on: {
                    deleted: function($event) {
                      return _vm.remove(index)
                    }
                  }
                })
              ],
              1
            )
          }),
          0
        )
      ]),
      _vm._v(" "),
      _c("paginator", {
        attrs: { dataSet: _vm.dataSet },
        on: { changed: _vm.fetch }
      }),
      _vm._v(" "),
      _vm.signedIn
        ? _c(
            "div",
            [
              _vm.$parent.locked
                ? _c("p", [
                    _vm._v(
                      "This thread has been locked. No more replies are allowed."
                    )
                  ])
                : _c("new-reply", { on: { created: _vm.add } })
            ],
            1
          )
        : _c("p", { staticClass: "text-center" }, [
            _vm._v("Пожалуйста "),
            _c("a", { attrs: { href: "/login" } }, [_vm._v("авторизируйтесь")]),
            _vm._v(" , чтобы принять участие в обсуждении.")
          ])
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/Replies.vue":
/*!*********************************************!*\
  !*** ./resources/js/components/Replies.vue ***!
  \*********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Replies_vue_vue_type_template_id_c6fb9326___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Replies.vue?vue&type=template&id=c6fb9326& */ "./resources/js/components/Replies.vue?vue&type=template&id=c6fb9326&");
/* harmony import */ var _Replies_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Replies.vue?vue&type=script&lang=js& */ "./resources/js/components/Replies.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _Replies_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Replies.vue?vue&type=style&index=0&lang=css& */ "./resources/js/components/Replies.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _Replies_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Replies_vue_vue_type_template_id_c6fb9326___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Replies_vue_vue_type_template_id_c6fb9326___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/Replies.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/Replies.vue?vue&type=script&lang=js&":
/*!**********************************************************************!*\
  !*** ./resources/js/components/Replies.vue?vue&type=script&lang=js& ***!
  \**********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Replies_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./Replies.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Replies.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Replies_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/Replies.vue?vue&type=style&index=0&lang=css&":
/*!******************************************************************************!*\
  !*** ./resources/js/components/Replies.vue?vue&type=style&index=0&lang=css& ***!
  \******************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Replies_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/style-loader!../../../node_modules/css-loader??ref--6-1!../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../node_modules/postcss-loader/src??ref--6-2!../../../node_modules/vue-loader/lib??vue-loader-options!./Replies.vue?vue&type=style&index=0&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Replies.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Replies_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Replies_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Replies_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(["default"].indexOf(__WEBPACK_IMPORT_KEY__) < 0) (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Replies_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));


/***/ }),

/***/ "./resources/js/components/Replies.vue?vue&type=template&id=c6fb9326&":
/*!****************************************************************************!*\
  !*** ./resources/js/components/Replies.vue?vue&type=template&id=c6fb9326& ***!
  \****************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Replies_vue_vue_type_template_id_c6fb9326___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./Replies.vue?vue&type=template&id=c6fb9326& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/Replies.vue?vue&type=template&id=c6fb9326&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Replies_vue_vue_type_template_id_c6fb9326___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Replies_vue_vue_type_template_id_c6fb9326___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/mixins/Collection.js":
/*!*******************************************!*\
  !*** ./resources/js/mixins/Collection.js ***!
  \*******************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      items: []
    };
  },
  methods: {
    add: function add(item) {
      this.items.push(item);
      this.$emit('added');
    },
    remove: function remove(index) {
      this.items.splice(index, 1);
      this.$emit('removed'); // flash('Reply deleted!');
    }
  }
});

/***/ })

}]);
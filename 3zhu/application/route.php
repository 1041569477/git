<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    // '__pattern__' => [
    //     'name' => '\w+',
    // ],
    // '[hello]'     => [
    //     ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
    //     ':name' => ['index/hello', ['method' => 'post']],
    // ],
    /*-----------------登陆---------------------*/
   "index_index"=>"index/Index/index", //登陆页面
   "index_register"=>"index/Index/register",//注册页面
   "dome_index"=>"index/Dome/index",//首页面
   "ptype_index"=>"index/Ptype/index",//产品分类显示页面
   "ptype_add"=>"index/Ptype/add",//产品分类添加页面
   "ptype_search"=>"index/Ptype/search",//产品分类搜索页面
   "ptype_del"=>"index/Ptype/del",//产品分类删除
   "ptype_delAll"=>"index/Ptype/delAll",//产品分类批量删除


    //用户信息
    "user_list"=>"index/Indexuser/index", //用户信息展示
    "user_authstatus"=>"index/Indexuser/authstatus", //未实名
    "user_details"=>"index/Indexuser/details", //用户详情
    "user_email"=>"index/Indexuser/email", //发邮件
    "user_tel"=>"index/Indexuser/code", //发短信
    "user_message"=>"index/Indexuser/message", //发站内信


];

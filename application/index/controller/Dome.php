<?php
/*
*后台首页
 */
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;

class Dome   extends \think\Controller{ 
  
  //首页面
    public function index()
    {   
      return view("page");
     
    }
  
}

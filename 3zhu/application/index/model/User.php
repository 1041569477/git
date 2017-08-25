<?php
namespace app\index\model;
use think\Model;
use think\Db;
class User extends Model{
	//添加
   public function add($data){
<<<<<<< HEAD
      $info=Db::table('user')->insert($data);
=======

      $info=Db::table('admin_user')->insert($data);

>>>>>>> 691e27a859459d5ee769cf19c98cf8179acf68fd
      return $info;
   }
   	//查询用户账号密码
   public function select($username,$password){
      $info=Db::query("select * from admin_user where username='$username' and password = '$password'");
      return $info;
   }
}
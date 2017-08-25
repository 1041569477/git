<?php
namespace app\index\model;
use think\Model;
use think\Db;
class User extends Model{
	//添加
   public function add($data){

      $info=Db::table('admin_user')->insert($data);

      return $info;
   }
   	//查询用户账号密码
   public function select($username,$password){
      $info=Db::query("select * from admin_user where username='$username' and password = '$password'");
      return $info;
   }
}
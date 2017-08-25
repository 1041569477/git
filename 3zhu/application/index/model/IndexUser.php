<?php
namespace app\index\model;
use think\Model;
use think\Db;
class IndexUser extends Model{
    //用户列表
    public function userinfo_list(){

        return DB::table('userinfo')->field('realname,username,email,authstatus,now_time,telephone,userid')->select();

    }
    //用户详情
    public function userinfo_details($userid){

        return DB::table('userinfo')->field('password,userimg,status,pay_pwd,last_time,errortimes,Level',true)->where(['userid'=>$userid])->select();

    }
    public function userinfo_authstatus()
    {
        return DB::table('userinfo')->field('userid,username,telephone,email')->where(['authstatus'=>0])->select();
    }
    public function message($data)
    {
        return DB::table('message')->insert($data);
    }
}
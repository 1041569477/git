<?php
namespace app\index\model;
use think\Model;
use think\Db;
class Protype extends Model{
	//获取分类下的id和名称
   public function info(){
       $info=Db::query('select pro_t_id,pro_t_name from protype ');
      return $info;
   }
   //添加
   public function add($data){
       $info=Db::table('protype')->insert($data);
      return $info;
      
   }
   //搜索分类信息
   public function search($search){
       $info=Db::query("select * from protype where pro_t_name like '%$search%'");
      return $info;
   }
    //获取分类所有信息
   public function select(){
       $info=Db::query('select count(*) as sum from protype ');
       $list = Db::table('protype')->paginate(2,$info[0]['sum']);
      return $list;
   }
     //删除
   public function del($pro_t_id){
      $list = Db::table('protype')->delete($pro_t_id);
      return $list;
   }
      //批量删除
   public function delAll($pro_t_id){
      $list = Db::table('protype')->delete($pro_t_id);
      return $list;
   }
}
<?php
namespace app\index\model;
use think\Model;
use think\Db;
class CouponModel extends Model
{
    //查看产品
   public function sel($parentid)
   {
      $protype=Db::table('protype')->field('pro_t_name,pro_t_id')->where('parentid','=',$parentid)->select();
      return $protype;
   }
   //添加优惠券
   public function add($data)
   {
	   $arr['coupon_name'] = $data['coupon_name'];
	   $arr['start_time'] = strtotime($data['start_time']);
	   $arr['end_time'] = strtotime($data['end_time']);
	   $arr['money'] = $data['money'];
	   $arr['is_ok'] = $data['is_ok'];
	   
	   $info = Db::table('coupon')->insertGetId($arr);
	   if(isset($data['month']))
	   {
		   $where['date_month'] = implode(",",$data['month']);
	   }
	   $where['protype_id'] = $data['protype_id'];
	   $where['coupon_id'] = $info;
	   $coupon_where = Db::table('coupon_where')->insert($where);
	   
	   return $coupon_where;
   }
  
   public function coupon()
   {
	   $coupon = Db::table('coupon')->select();
    	
    	foreach ($coupon as $k => $v) {
    		$coupon[$k]['where'] = Db::table('coupon_where')->where(['coupon_id'=>$v['coupon_id']])->select();
    		
    	}
    	//print_r($coupon);die;
    	foreach ($coupon as $k => $v) {
    		foreach($v['where'] as $k2=>$v2){
    			
    				$id = $v2['protype_id'];
	    			$sql = "select pro_t_id,pro_t_name from `protype` where `pro_t_id` = $id";
	    			
		    		$coupon[$k]['name'][] = Db::table('protype')->field('pro_t_id,pro_t_name')->where('pro_t_id','=',$id)->select();

		    		if(!empty($v2['date_month'])){
		    			$id = $v2['date_month'];
		    			$sql = "select pro_t_id,pro_t_name from `protype` where `pro_t_id` in ($id)";
			    		$coupon[$k]['name'][$k2]['q'] = Db::table('protype')->field('pro_t_id,pro_t_name')->wherein('pro_t_id',$id)->select();
		    		}else{
		    			$coupon[$k]['name'][$k2]['q'] = "";
		    		}
	    		
    		}
    	}
    	 //print_r($coupon);die;
    	foreach ($coupon as $k => $v) {
 
    		foreach ($v['name'] as $k2 => $v2) {
    			if(is_array($v2['q'])){
    				foreach ($v2['q'] as $key => $value) {
	    				$coupon[$k]['name'][$k2][$k2]['month'][] = $value['pro_t_name'];
	    			}
    			}
    			
    			unset($coupon[$k]['name'][$k2]['q']);
    		}
    		unset($coupon[$k]['where']);
    			
		}
		//print_r($coupon);die;
		foreach ($coupon as $k => $v) {
			foreach ($v['name'] as $k2 => $v2) {
				foreach ($v2 as $key => $value) {
					
					if(isset($value['month'])){
						
						$coupon[$k]['name'][$k2][$key]['y'] = implode("/",$value['month']);
					}
					unset($coupon[$k]['name'][$k2][$key]['month']);
				}
				
			}
		}
		foreach ($coupon as $k => $v) {
			foreach ($v['name'] as $k2 => $v2) {
				foreach ($v2 as $key => $value) {
					
					$coupon[$k]['name'][$k2] = $value;
					
				}
				
			}
		}
		return $coupon;
   }
   
}

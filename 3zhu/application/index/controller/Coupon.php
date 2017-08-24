<?php
/**
 * 优惠券
 */
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;
use app\index\model\CouponModel;
header('content-type:text/html;charset=utf-8');
class Coupon  extends \think\Controller{ 
  
	//添加页面
    public function add()
    {		
	    $model = new CouponModel();
		$protype = $model->sel(0);
		
		$this->assign("data",$protype);
    	return view('add');
     
    }
	//添加优惠券
	public function add_do()
    {		
	    $model = new CouponModel();
		$data = Request::instance()->post();
		$coupon = $model->add($data);
		if($coupon)
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
		//print_r($data);
     
    }
	//已有优惠券展示
	public function lists()
	{
		$model = new CouponModel();
		$coupon = $model->coupon();
		//print_r($coupon);die;
		$this->assign("data",$coupon);
		return view('list');
	}
	//查询产品期数
	public function protype_sel()
	{
		$pid = Request::instance()->post("pid");
        $model = new CouponModel();
		$protype = $model->sel($pid);
		if(empty($protype))
		{
			echo 0;
		}
		else
		{
			echo json_encode($protype);
		}
			
	}
 
}

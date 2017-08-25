<?php
/**
 * 登陆
 */
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;
use app\index\model\User;
class Index  extends \think\Controller{ 
  
	//登陆页面
    public function index()
    {   
    	if(Request::instance()->post()){

    	   $data=Request::instance()->post();

         if(!captcha_check($data['code'])){
             return view("login");
          };
          
           $username=$data['username'];
           $password=$data['password'];
                
            
         
           $user=new User();
           $info=$user->select($username,$password);
          
           if($info){
              //return redirect(request()->domain().'/20170821/public/dome_index');
              return $this->redirect('index/Ptype/add');
           }else{
              return view("login");
           }
           
    	}else{
    		   return view('login');
    	}
     
    }
 
}

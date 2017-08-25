<?php
/**
 * 产品分类
 */
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;
use app\index\model\Protype;
class Ptype  extends \think\Controller{ 
	//添加及添加页面
     public function add(){
     	if(Request::instance()->post()){

    	   $data=Request::instance()->post();

           $protype=new Protype();
           $info=$protype->add($data);
          
           if($info){
              return view("index");
           }else{
              return view("add");
           }
           
    	}else{
                $protype=new Protype();
                $data=$protype->info();
                $this->assign("data",$data);
               
    		   return view('add');
    	 }
     
     }
     //分类展示页面
     public function index(){
     	
                $protype=new Protype();
                $data=$protype->select();

               // 获取分页显示4
               $page = $data->render();

              
                $this->assign("data",$data);
                $this->assign("page",$page);
               
               
    		     return view('index');
    	
     
     }
      //分类搜索页面
     public function search(){
     	
             $search=Request::instance()->get("search");   
    	       $protype=new Protype();
             $data=$protype->search($search);

             echo json_encode($data);
     
     }
       //分类删除
     public function del(){
      
             $pro_t_id=Request::instance()->get("pro_t_id");   
             $protype=new Protype();
             $data=$protype->del($pro_t_id);

             echo $data;
     
     }
       //分类批量删除
     public function delAll(){
      
             $id=Request::instance()->post(); 

             $pro_t_id="";
             foreach ($id['id'] as $key => $value) {
                $pro_t_id.=",".$value;
             };
             $pro_t_id=substr($pro_t_id,1);

             $protype=new Protype();
             $data=$protype->delAll($pro_t_id);
   
             if($data){
               return $this->redirect('index/Ptype/index');
             }else{
               return $this->redirect('index/Ptype/index');
             }
             
     
     }
} 
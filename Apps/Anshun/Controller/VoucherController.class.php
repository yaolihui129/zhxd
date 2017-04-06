<?php
namespace Anshun\Controller;
class VoucherController extends WebInfoController {
    
    public function _empty(){   
        $this->display('index');
    }      
    public function index(){        
        WebInfoController::getWebInfo();   //获取页面信息    
        $m=D('as_voucher');
        $where=array("state"=>"发布");
        $arr=$m->where($where)->order('end desc')->select();
        $this->assign('arr',$arr);

        $id=!empty($_GET['id']) ? $_GET['id'] : $arr[0]['id'];
        $data=$m->where($where)->find($id);
        $this->assign('data',$data);
        $this->display();
    }

    public function choujiang(){
        $m=D('as_tickets');
        $where=array("voucherid"=>$_GET['id']);
        $arr=$m->where($where)->field("id")->select();
        $count=$m->where($where)->count();
        $d=rand(0,$count-1);
        $set['id']=$arr[$d]['id'];
        echo  $set['id'].';';
        $_SESSION['ticketsid']=$set['id'];
        $set[ip]=$_SESSION['ip'];
        $set['moder']='客户';
        $set['state']='抽奖';
        $set['chouj']=1;
        $isSet=$m->save($set);
        if ($isSet){
            $this->redirect('/Anshun/Voucher/tickets');
        }else{
            $this->error("失败！");
        }
    }
}
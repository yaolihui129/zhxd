<?php
namespace Xinda\Controller;
use Think\Controller;
class HrController extends WebInfoController {
    
    public function index(){
    
        //获取页面信息
        WebInfoController::getWebInfo();

        $m=D('tp_hr');
        $where['prodid']=6;
        $where['istuij']=0;
        $where['state']='招聘中';
        $data=$m->where($where)->order('sn,id')->select();
        $this->assign('data',$data);
    
        $this->display();
    }
 
    public function wodtuijian(){
        
        $where['tuij']=$_GET['phone'];
        $m=D('tp_applicant');       
        
        $data=$m->where($where)->select();
        $this->assign('data',$data);

        $this->display();
    }
    
    
    public function tuijhr(){
        //获取页面信息
        WebInfoController::getWebInfo();
        $_SESSION['Xiuli']['web']='临城秀丽广告-招聘';        
    
        $m=D('tp_hr');
        $where['prodid']=1;
        $where['istuij']=1;
        $where['state']='招聘中';
        $data=$m->where($where)->order('sn,id')->select();
        $this->assign('data',$data);
    
        $this->display();
    }
    
    public  function baom(){
         //获取页面信息
        WebInfoController::getWebInfo();
        $_SESSION['Xiuli']['web']='临城秀丽广告-招聘';   
                
        $m=D('tp_hr');
        $arr=$m->find($_GET['id']);
        $this->assign('arr',$arr);
        
        $this->display();
         
    }
    
    public function tuij(){
         //获取页面信息
        WebInfoController::getWebInfo();
        $_SESSION['Xiuli']['web']='临城秀丽广告-招聘';   
    
        $m=D('tp_hr');
        $arr=$m->find($_GET['id']);
        $this->assign('arr',$arr);
        
        $this->display();
    
    }
    
    public function insert(){
        $m=D('tp_applicant');
        $_POST['state']='报名';
        $where['phone']=$_POST['phone'];
        $where['hrid']=$_POST['hrid'];
        $date=$m->where($where)->select();
        if($date){
            $this->error("对不起！这个职位".$_POST['phone']."已经报过名了。");
        }else {
            $map['tuij']=$_POST['tuij'];
            $map['hrid']=$_POST['hrid'];
            $c=$m->where($map)->count();
            if($c >=15){
                $this->error("对不起！这个职位您已经推荐超过15人了，留些机会给其他人吧");
            }else{
                if(!$m->create()){
                    $this->error($m->getError());
                }
                $lastId=$m->add();
                if($lastId){
                    $this->success("报名成功");
                }else{
                    $this->error("报名失败");
                }
            }
        }
    
    }
    
    
    public function _empty(){
    
        $this->display('index');
    }
    
}
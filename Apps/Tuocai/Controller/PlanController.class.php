<?php
namespace Tuocai\Controller;
use Think\Controller;
class PlanController extends Controller {
    
    public function index(){
        /* 实例化模型*/
        $m=D('product');
        $data=$m->field('web,adress,desc,phone,tel,qq,qz,url,record,path,img')->find(2);
        $_SESSION['Tuocai']=$data;
        $_SESSION['Tuocai']['img']=$data['path'].$data['img'];
        $_SESSION['ip']=get_client_ip();
        $_SESSION['browser']=GetBrowser();
        $_SESSION['os']=GetOs();
        
        $p=date("Y-m-d",time());
        $this->assign("p",$p);
        /* 实例化模型*/
        $m=D('tc_date');
        $where['riqi']=array('egt',date("Y-m-d",time()));
        $arr=$m->where($where)->order('riqi,sn')->limit(35)->select();
        $this->assign('arr',$arr);
        
        $_SESSION['courseid']=$_GET['courseid'];
        
        
        $this->display();
    }
    
    
    
    public function search(){
        /* 接收参数*/         
        $map['riqi']=$_POST['riqi'];    
        /* 实例化模型*/
        $m=D('dict');
        $where['type']="sktime";
        $where['state']="正常";
        $data=$m->field('k,v')->where($where)->select();
        $m=M('tc_date');
        $arr=$m->where($map)->order('sn')->select();
        if(!$arr){
            foreach ($data as $d){
                $_POST['xingqi']=wk($_POST['riqi']);
                $_POST['sn']=$d['k'];
                $_POST['sktime']=$d['v'];
                if(!$m->create()){
                    $this->error($m->getError());
                }
                $m->add();
            }    
        }
        $map['riqi']=array('egt',$_POST['riqi']);
        $arr=$m->where($map)->order('riqi,sn')->limit(35)->select();
        $this->assign('arr',$arr);
        $where=$_POST['riqi'];
        $this->assign('p',$where);   
         
        $this->display('index');       
    }
   
    public function add(){
        
        
        $this->display('index');
    }
    
}
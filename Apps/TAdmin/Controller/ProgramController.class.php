<?php
namespace TAdmin\Controller;
class ProgramController extends CommonController {
    public function index(){
        $_SESSION['testgp']=I('testgp',$_SESSION['testgp']);
        $data=M('dict')->where(array("type"=>"testgp","state"=>"正常"))->field("id,k,v,state")->select();
        $this->assign('data',$data);
        $this->assign('search',I('search'));

        $map['testgp']=$_SESSION['testgp'];
        $map['name|code']=array('like','%'.I('search').'%');
        $map['acl']='private';
        $map['deleted']='0';        
        $arr=M('project')->where($map)->order("end desc")->field("id,name,code,status")->select();
        $this->assign('arr',$arr);       

	    $this->display();
    }

   
}
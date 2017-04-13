<?php
namespace Tpyjd\Controller;
class AccountController extends WebInfoController {
    public function index(){
        /* 接收参数*/
        $search=!empty($_POST['search']) ? $_POST['search'] : $_GET['search'];
        $page=!empty($_GET['page']) ? $_GET['page'] : 1;
        $this->assign('search',$search);
        $maxPageNum=10;
        /* 实例化模型*/
        $m=M('account');
        $where['AccountName|QuickCode']=array('like','%'.$search.'%');
        $data=$m->where($where)->page($page,$maxPageNum)->select();
        $this->assign('data',$data);
        $count=$m->where($where)-count();
        $Num=ceil($count/$maxPageNum);
        $this->display();
    }
    public function add(){
    
        $this->display();
    }
    
    public function insert(){
        /* 实例化模型*/
        $m=D('account');
        do {//如果该ID在库中存在，则重新获取
            $id=getRandCode(40);
            $arr=$m->find($id);
        } while ($arr);
    
        $_POST['AccountId']=$id;
        if(!$m->create()){
            $this->error($m->getError());
        }
        $lastId=$m->add();
        if($lastId){
            $this->success("成功",U('index'));
        }else{
            $this->error("失败");
        }
    
    }
    
    public function mod(){
        /* 接收参数*/
        $id = $_GET['id'];
        /* 实例化模型*/
        $m= D("account");
        $data=$m->find($id);
        dump($date);
        $this->assign("data",$data);
    
        $this->display();
    }
    
    public function update(){
        /* 实例化模型*/
        $db=D('account');
        $_POST['VersionNumber']=intval($_POST['VersionNumber'])+1;
        if ($db->save($_POST)){
            $this->success("成功！",U('index'));
        }else{
            $this->error("失败！");
        }
    }
    
    public function order(){
        /* 实例化模型*/
        $db = D('account');
        $num = 0;
        foreach($_POST['sn'] as $id => $sn) {
            $num += $db->save(array("id"=>$id, "sn"=>$sn));
        }
        if($num) {
            $this->success("排序成功!");
        }else{
            $this->error("排序失败...");
        }
    }
    
    public function del(){
        /* 接收参数*/
        $id = $_GET['id'];
        /* 实例化模型*/
        $m=M('account');
        $count =$m->delete($id);
        if ($count>0) {
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    
    }
    
    //新增用户CRM
    function apiinsert(){
       $url=PublicController::getUrl();
       //封装接口地址
       $url=$url."/distributor.action";
       $cuserArr=array(
          "loginname"=>"ltytest@163.com",
          "name"=>"ltytest",
          "ename"=>"ltytest",
          "employeenum"=>"",
          "title"=>"test",
          "mobile"=>"13227185823",
          "qq"=>"",
          "wxzh"=>"",
          "email"=>"ltytest@163.com",
          "region"=>"huadong",
          "beizhu"=>"xinceng"
       );
      $cuserJson='['.json_encode($cuserArr).']';
      $insertArr=array(
          "serviceName"=>"insert",
          "objectApiName"=>"ccuser",
          "data"=>$cuserJson,
          "binding"=>$_SESSION['binding']
       );
       $insertJson=json_encode($insertArr);
       dump($insertArr);
        //发送新增客户请求
//        $res= httpPost($url, $insertJson);
      
       $this->ajaxReturn($res);
     }
    
       
}
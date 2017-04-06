<?php
namespace Xinda\Controller;
use Think\Controller;
class CustomerController extends WebInfoController {

	public function index(){
	     //获取页面信息
        WebInfoController::getWebInfo();
             
	    $this->display();
    }
    
    public function checked(){
        if($_POST['phone']){
            $m=D('tp_customer');
            $where['phone']=$_POST['phone'];
            $data=$m->where($where)->select();
            if($data){
                $this->error("这个号码已经注册，无需重复注册");
            }else{
                $this->redirect('/Xinda/Customer/register/phone/'.$_POST['phone']);
            }
        }else{
            $this->error("您没有填写手机号");
        }
        
    }
    
    public function register(){   
         //获取页面信息
        WebInfoController::getWebInfo();
    
        $phone=$_GET['phone'];
        $this->assign('phone',$phone);
    
        $this->display();
    }
    

    public function insert(){
        $m=D('tp_customer');
        $_POST['password']=md5(123456);
        $_POST['ctime']=time();
        if(!$m->create()){
            $this->error($m->getError());
        }
        $lastId=$m->add();
        if($lastId){
            $this->success("注册成功",U('Xinda/Index'));
        }else{
            $this->error("注册失败");
        }
    
    }

    public function mod(){
        /* 接收参数*/
        $id =  $_SESSION['userid'];
        /* 实例化模型*/
        $m=M('tp_customer');
        $arr=$m->find($id);
        $this->assign('arr',$arr);
    
        $this->display();
    }
   
 public function setpass(){
        /* 接收参数*/
        $id =  $_SESSION['userid'];
        /* 实例化模型*/
        $m=M('tp_customer');        
        $user=$m->find($id);
        $this->assign('user',$user);

        $this->display();
    }

 public function set(){
       /* 接收参数*/
       $id = !empty($_POST['id']) ? $_POST['id'] : $_GET['id'];
       $pass1= $_POST['pass1'];
       $pass2= $_POST['pass2'];
       $pass3= $_POST['pass3'];
       /* 实例化模型*/
        $m=M('tp_customer');
        
        $user=$m->find($id);
        if (md5($pass1)==$user['password']) {
            if ($pass2==$pass3) {
                $arr['id']=$id;
                $arr['password']=md5($pass2);
                $arr['moder']=$_SESSION['realname'];
                if ($m->save($arr)){
                   $this->success("密码修改成功！",U('Tuocai/Index/index'));
                }else{
                   $this->error("密码修改失败！");
                }

            }else{
                $this->error('新密码和确认面不一致');
            }
        }else{
            $this->error('原密码错误');
        }
 }


public function personal(){
        //获取页面信息
        WebInfoController::getWebInfo();
        //微信公众号免登陆
        $appid  = $_GET['wxAppId'];
        $openid = $_GET['wxOpenId'];
        WebInfoController::weiXinLogin($appid, $openid);
        if($_SESSION['openid']){
            $where['openid']=$_SESSION['openid'];
        }elseif ($appid){
            
        }else {
            $where['id'] =  $_SESSION['userid'];
        }    
        /* 实例化模型*/
        $m=M('tp_customer');
        $arr=$m->where($where)->select();
        $this->assign('arr',$arr);

        $this->display();
    }
    
    public function _empty(){
    
        $this->display('index');
    }


}
 



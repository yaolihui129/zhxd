<?php
namespace Anshun\Controller;
class CustomerController extends WebInfoController {   
   
    public function index(){             
        getWebInfo(C('PRODUCT'));//获取网页信息          
        $this->display();
    }    
    public function checked(){        
        if($_POST['phone']){          
            $where=array('phone'=>$_POST['phone']);
            $data=M('tp_customer')->where($where)->select();
            if($data){            
                $this->error("这个号码已经注册，无需重复注册");
            }else{
                $this->redirect('/Xiuli/Customer/register/phone/'.$_POST['phone']);
            }
        }else{
            $this->error("您没有填写手机号");
        }                
    }   
    public function register(){
        getWebInfo(C('PRODUCT'));//获取网页信息      
        $this->assign('phone',$_GET['phone']);    
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
            $this->success("注册成功",U('Anshun/Index'));
        }else{
            $this->error("注册失败");
        }   
    } 
    public function setpass(){
        $user=M('tp_customer')->find($_SESSION['id']);
        $this->assign('user',$user);  
        $this->display();
    }        
    public function setp(){
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
                $arr=array('id'=>$id,'password'=>md5($pass2),'moder'=>$_SESSION['realname']);
                if ($m->save($arr)){
                    $this->success("密码修改成功！");
                }else{
                    $this->error("密码修改失败！");
                }
            }else{
                $this->error('新密码和确认密码不一致');
            }
        }else{
            $this->error('原密码错误');
        }
    }
    
    public function mod(){
        $arr=M('tp_customer')->find($_GET['id']);
        $this->assign('arr',$arr);       
        $this->display();
    }
    
    public function update(){
        $_POST['moder']=$_SESSION['realname'];
        if (M('tp_customer')->save($_POST)){
            $this->success("修改成功！");
        }else{
            $this->error("修改失败！");
        }
    }
    
    public function personal(){
       getWebInfo(C('PRODUCT'));//获取网页信息      
        $appid  = $_GET['wxAppId'];
        $openid = $_GET['wxOpenId'];
        wxLogin(C('PRODUCT',C('DBQZ'),$appid,$openid));//微信公众号免登陆
        if($_SESSION['openid']){            
            $where=array('openid'=>$_SESSION['openid']);
        }elseif ($openid){
            $map=array('wxOpenId'=>$openid);
            $date=M('as_customer')->where($map)->select();
            $where=array('id'=>$date[0]['tpid']);
        }else {            
            $where=array('id'=>$_SESSION['userid']);
        }
        $arr=M('tp_customer')->where($where)->select();
        $this->assign('arr',$arr);
        $this->display();
    } 
       
    public function yuyue() {
        $appid  = $_GET['wxAppId'];
        $openid = $_GET['wxOpenId'];
        wxLogin(C('PRODUCT',C('DBQZ'),$appid,$openid));//微信公众号免登陆
        if($_SESSION['openid']){            
            $where=array('openid'=>$_SESSION['openid']);
        }elseif ($openid){
            $map=array('wxOpenId'=>$openid);
            $date=M('as_customer')->where($map)->select();
            $where=array('id'=>$date[0]['tpid']);
        }else {            
            $where=array('id'=>$_SESSION['userid']);
        }
        $arr=M('tp_customer')->where($where)->select();
        $map=array(['phone']=>$arr[0]['phone']);
        $data=M('order_serviccar')->where($map)->select();
        $this->assign('data',$data);       
        $this->display();
    }

}
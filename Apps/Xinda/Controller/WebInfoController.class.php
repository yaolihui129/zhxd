<?php
namespace Xinda\Controller;
use Think\Controller;
class WebInfoController extends Controller {
    //获取ProdId
    public static function getProdId(){
        $proid=6;
        return $proid;
    }
    function getWxid(){//配置wxId
        return 4;
    }
    //获取页面信息
    public static function getWebInfo(){
        $m=D('product');
        $data=$m->field('web,adress,desc,phone,tel,qq,qz,url,record,path,img')->find(self::getProdId());
        $_SESSION['Xinda']=$data;
        $_SESSION['Xinda']['img']=$data['path'].$data['img'];
        $_SESSION['ip']=get_client_ip();
        $_SESSION['browser']=GetBrowser();
        $_SESSION['os']=GetOs();       
    }
    //微信公众账号免登陆
    public static function weiXinLogin($appid,$openid){
        if($openid){//如果有$_GET['wxOpenId']就直接登录
            $map=array('wxopenid'=>$openid);
            $m=D('xd_customer');
            $arr=$m->where($map)->select();
            if($arr){//如果用户表有值，直接登录
                $_SESSION['userid']   = $arr[0]['tpid'];
                $_SESSION['isCLogin'] = 'Xinda';
                if($arr[0]['tpid']==0){//如果绑定手机号
                    $_SESSION['realname'] = '未留手机';
                }else{//如果未绑定手机号
                    $_SESSION['uphone']   = getCusPhone($arr[0]['tpid']);
                    $_SESSION['realname'] = getCusName($arr[0]['tpid']);
                }
            }else{//如果用户表没有值，向用户表插入数据
                $_POST['wxopenid']=$_GET['wxOpenId'];
                $_POST['wxappid']=$appid;
                $_POST['adder']=$appid;
                $_POST['moder']=$appid;
                $_POST['ctime']=time();
                if(!$m->create()){
                    $this->error($m->getError());
                }
                $lastId=$m->add();
                $arr=$m->where($map)->select();
                $_SESSION['userid']   = $arr[0]['tpid'];
                $_SESSION['isCLogin'] = 'Xinda';
                $_SESSION['realname'] = '未留手机';
            }
        
        }
        
    }
}
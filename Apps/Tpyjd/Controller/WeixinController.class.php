<?php
namespace Tpyjd\Controller;
class WeixinController extends WebInfoController {    
    public function index(){//验证消息接口
        $token      = "123weixin";
        $echostr    = $_GET['echostr'];
        $array = array();
        sort(array($_GET['nonce'],$_GET['timestamp'],$token));  //按字典排序            
        $str =sha1(implode($array));                            //拼接成字符串，sha1加密,然后与signature进行校验
        if($str == $_GET['signature'] && $echostr){             //第一次接入Weixin api 接口的时候            
            echo $echostr;
            exit;
        }else{
            $this->reponseMsg();
        }
    }     
    
    
    public function reponseMsg(){   //接收事件推送并回复    
        $postArr  = $GLOBALS['HTTP_RAW_POST_DATA'];                                  //1.获取到微信推送过来的post数据（xml格式）       
        $postObj  = simplexml_load_string( $postArr );                               //2.处理消息类型，并设置回复类型和内容
        $toUser   = $postObj->FromUserName;
        $fromUser = $postObj->ToUserName;               
        if(strtolower($postObj->MsgType) == 'event'){                                //判断该数据包是否是订阅的事件推送          
            if(strtolower($postObj->Event) == 'subscribe' ){                         //如果是关注subscrine事件
               $arr = array(//回复单图文消息
                   array(
                     'title'=>'北京智慧信达网络服务',
                     'description'=>"北京智慧信达商贸有限公司",
                     'picUrl'=>'http://www.zhihuixinda.com/Upload/Xinda/Product/2017-03-04/58ba72d2a8ee0.jpg',
                     'url'=>'http://www.zhihuixinda.com/index.php/Xinda/Index/index/wxOpenId/'.$toUser.'/wxAppId/'.$fromUser,
                   ),
                );
               wxReplyNews($toUser,$fromUser,$arr);
            }            
            if(strtolower($postObj->Event) == 'click' ){//自定义菜单“推”事件                             
                if(strtolower($postObj->EventKey) == 'item1' ){
                    $content   = '这是item1菜单的事件推送';
                    wxReplyText($toUser,$fromUser,$content);
                }
                if(strtolower($postObj->EventKey) == 'songs' ){
                    $content   = '这是歌曲菜单的事件推送';
                    wxReplyText($toUser,$fromUser,$content);
                }
            }            
            if(strtolower($postObj->Event) == 'view' ){//自定义菜单跳转
                $content   = '跳转链接是：'.$postObj->EventKey;
                wxReplyText($toUser,$fromUser,$content);
            }           
//             if(strtolower($postObj->Event) == 'location'){//上传地理位置
                    //地理位置处理
//             }           
            if(strtolower($postObj->Event) == 'link'){ //上传链接                
                $Title   = $postObj->Title;                
                $Url     = $postObj->Url;
                $content = "<a href='". $Url."'>".$Title."</a>";  //回复用户消息(纯文本格式)
                wxReplyText($toUser,$fromUser,$content);   
            }                     
            if(strtolower($postObj->Event) == 'scan'){ //重扫二维码              
                if($postObj->EventKey == 200){ //临时二维码的参数值为200                   
                    $arr = array(
                        array(
                            'title'=>'北京智慧信达网络服务200',
                            'description'=>"北京智慧信达商贸有限公司",
                            'picUrl'=>'http://www.zhihuixinda.com/Upload/Xinda/Product/2017-03-04/58ba72d2a8ee0.jpg',
                            'url'=>'http://www.zhihuixinda.com/index.php/Xinda/Index/index/openid/'.$toUser,
                        ),
                    );
                    wxReplyNews($toUser,$fromUser,$arr);    //回复单图文消息
                }elseif($postObj->EventKey == 300){ //用久二维码的参数值为300                                    
                    $arr = array(
                        array(
                            'title'=>'北京智慧信达网络服务300',
                            'description'=>"北京智慧信达商贸有限公司",
                            'picUrl'=>'http://www.zhihuixinda.com/Upload/Xinda/Product/2017-03-04/58ba72d2a8ee0.jpg',
                            'url'=>'http://www.zhihuixinda.com/index.php/Xinda/Index/index/openid/'.$toUser,
                        ),
                    );
                    wxReplyNews($toUser,$fromUser,$arr);  //回复单图文消息
                }else {
                    //回复单图文消息
                    $arr = array(
                        array(
                            'title'=>'北京智慧信达网络服务',
                            'description'=>"北京智慧信达商贸有限公司",
                            'picUrl'=>'http://www.zhihuixinda.com/Upload/Xinda/Product/2017-03-04/58ba72d2a8ee0.jpg',
                            'url'=>'http://www.zhihuixinda.com/index.php/Xinda/Index/index/openid/'.$toUser,
                        ),
                    );
                    wxReplyNews($toUser,$fromUser,$arr);
                }                
            }
        }
              
        if(strtolower($postObj->MsgType) == 'voice'){  //语音回复                         
                $text=rtrim($postObj->Recognition,'。');//截取最后的“。”
                //图文的形式回复
                $m=M('tp_product');
                $map['name']=array('like','%'.$text.'%');
                $data=$m->where($map)->order('sn')->limit(10)->select();
                if($data){
                    foreach ($data as $st){
                        $arr[$key]['title']=$st.name;
                        $arr[$key]['description']=$st.name;
                        $arr[$key]['picUrl']=$st.name;
                        $arr[$key]['url']=$st.name;
                    }
                }else{//没找到你要的商品或服务
                    $arr = array(
                        array(
                            'title'=>'没有找到与“'.$text.'”相关的商品或服务',
                            'description'=>"北京智慧信达商贸有限公司",
                            'picUrl'=>'http://www.zhihuixinda.com/Upload/Xinda/Product/2017-03-04/58ba72d2a8ee0.jpg',
                            'url'=>'http://www.zhihuixinda.com/index.php/Xinda/Index/index/wxOpenId/'.$toUser.'/wxAppId/'.$fromUser,
                        ),
                    );
                }
                
                wxReplyNews($toUser,$fromUser,$arr);
                //回复用户消息(纯文本格式)
                $content   = "您说的是：“".$text."”MediaId:".$postObj->MediaId;               
                wxReplyText($toUser,$fromUser,$content);
                //回复用户语音消息（语音）
//                 $mediaId = $postObj->MediaId; 
//                 wxReplyVoice($toUser,$fromUser,$mediaId);
        }
               
        if(strtolower($postObj->MsgType) == 'image'){ //图片消息回复
           //图片回复
//             $mediaId=$postObj->MediaId;
//             wxReplyPicText($toUser,$fromUser,$mediaId);
            $arr = array(
                array(
                    'title'=>'图片上传成功',
                    'description'=>"MediaId:".$postObj->MediaId,
                    'picUrl'=>$postObj->PicUrl,
                    'url'=>'http://www.zhihuixinda.com',
                ),
            );
            wxReplyNews($toUser,$fromUser,$arr);
        }
                
        if(strtolower($postObj->MsgType) == 'video'){       //视频消息回复    
            $arr = array(
                array(
                    'title'=>'视频上传成功',
                    'description'=>"MediaId:".$postObj->MediaId,
                    'picUrl'=>$postObj->ThumbMediaId,
                    'url'=>'http://www.zhihuixinda.com',
                ),
            );
            wxReplyNews($toUser,$fromUser,$arr);
        }        
        
        
        
        if ( strtolower($postObj->MsgType) == 'text'){    //关键字回复           
            $text=trim($postObj->Content);          
            if($text=='活动名称'){//从活动表查找相关
                $map['name']=array('like','%'.$text.'%');
                $map['proid']=C(PRODID);
                $data=M('tp_page')->where($map)->order('sn')->limit(10)->select();
                if($data){
                    foreach ($data as $st){
                        $arr[$key]['title']=$st.name;
                        $arr[$key]['description']=$st.name;
                        $arr[$key]['picUrl']=$st.name;
                        $arr[$key]['url']=$st.name;
                    }
                }
            }else {//从产品表查找相关
                $map['name']=array('like','%'.$text.'%');
                $map['proid']=C(PRODID);
                $data=M('tp_product')->where($map)->order('sn')->limit(10)->select();
                if($data){
                    foreach ($data as $st){
                        $arr[$key]['title']=$st.name;
                        $arr[$key]['description']=$st.name;
                        $arr[$key]['picUrl']=$st.name;
                        $arr[$key]['url']=$st.name;
                    }
                }else{//没找到你要的商品或服务
                    $arr = array(
                        array(
                            'title'=>'没有找到与“'.$text.'”相关的商品或服务',
                            'description'=>"北京智慧信达商贸有限公司",
                            'picUrl'=>'http://www.zhihuixinda.com/Upload/Xinda/Product/2017-03-04/58ba72d2a8ee0.jpg',
                            'url'=>'http://www.zhihuixinda.com/index.php/Xinda/Index/index/wxOpenId/'.$toUser.'/wxAppId/'.$fromUser,
                        ),
                    );
                } 
            }
            wxReplyNews($toUser,$fromUser,$arr);
                                           
    }
}       
   //创建自定义菜单
   function memuCreat() {      
       $postArr = array(  //组装数组                                     
           'button'=>array(
               array(//第一个一级菜单
                   'name' => urlencode('移民官网'),
                   'type' => 'view',
                   'url'  => 'http://gupeng.tunnel.qydev.com/',
               ),
               array(//第二个一级菜单
                    'name'=>urlencode('项目活动'),
                    'sub_button'=>array(
                        array(//第一个二级菜单
                            'name' => urlencode('专享活动'),
                            'type' => 'view',
                            'url'  => 'http://gupeng.tunnel.qydev.com/exclusive',
                        ),
                        array(//第二个二级菜单
                            'name' => urlencode('移民项目'),
                            'type' => 'view',
                            'url'  => 'http://gupeng.tunnel.qydev.com/project',
                        ),
                    ),
               ),
               array(//第三个一级菜单
                   'name' => urlencode('专属服务'),
                   'sub_button'=>array(
                       array(//第1个二级菜单
                           'name' => urlencode('定制方案'),
                           'type' => 'view',
                           'url'  => 'http://gupeng.tunnel.qydev.com/estimate',
                       ),
                       array(//第2个二级菜单
                           'name' => urlencode('生活体验'),
                           'type' => 'view',
                           'url'  => 'http://gupeng.tunnel.qydev.com/lifeExperience',
                       ),
                       array(//第3个二级菜单
                           'name' => urlencode('商务合作1'),
                           'type' => 'view',
                           'url'  => 'http://gupeng.tunnel.qydev.com/business-personal',
                       ),
                       array(//第4个二级菜单
                           'name' => urlencode('公司名片'),
                           'type' => 'view',
                           'url'  => 'http://open.weixin.qq.com/connect/oauth2/authorize?appid=wx0ed91c537a52303b&redirect_uri=http://gupeng.tunnel.qydev.com/card/oath&response_type=code&scope=snsapi_base&state=wx#wechat_redirect',
                       ),
                       array(//第5个二级菜单
                           'name' => urlencode('个人中心'),
                           'type' => 'view',
                           'url'  => 'http://gupeng.tunnel.qydev.com/person',
                       ),
                   ),
               ),
           ),           
       );
       
       $res = wxMenuCreat($this->getAccessToken(),$postArr);      
       $this->ajaxReturn($res);     
   }
   
   function memu(){
       dump(wxGetMenu($this->getAccessToken()));
       $this->assign('arr',wxGetMenu($this->getAccessToken())); 
       $this->display();
   }
   //拉取用户信息
   function getUsers(){
       $res = wxGetUsers(C(WX_APPID));
       $this->ajaxReturn($res);
   }
   

   function qrCodeTime($id,$day=30){//getTimeQrCode($wxId,$scene_id,$expire=30)            
       $url=getTimeQrCode($this->getAccessToken(),$id,$day); 
       dump($url);
       echo "临时二维码";
       echo "<img src='".$url."'/>";      
   }
   
   function qrCodeForever($id){//getForeverQrCode($wxId,$scene_id);       
       $url=getForeverQrCode($this->getAccessToken(),$id);            
       echo "用久二维码";
       echo "<img src='".$url."'/>";  
   }
   
   function sendTemplateMsg(){
       $touser='oZQWOxPB-cAH37NlpBsB3CuRIwYU';
       $template_id='H5Xu84_YhAT0-IpaYdzWcNFAKb2V6P7-7f0EMA2TYcI';
       $call_url='http://www.zhihuixinda.com';
       $data=array(
              'name'=>array('value'=>'微信号申请','color'=>"#173177"),
              'money'=>array('value'=>100,'color'=>"#173177"),
              'date'=>array('value'=>date('Y-m-d H:i:s')),'color'=>"#173177"       
            );
       $res = wxSendTemplateMsg($this->getAccessToken(),$touser,$template_id,$call_url,$data);
       $this->ajaxReturn($res);      
   }
   
   //获取用户的openid
   function getBaseInfo(){
       $appid = C(WX_APPID);
       $redirect_uri = urlencode("http://www.zhihuixinda.com/index.php/Xinda/Weixin/getUserOpenid");
       $url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appid."&redirect_uri=".$redirect_uri."&response_type=code&scope=snsapi_base&state=123#wechat_redirect";
       header('Location:'.$url);
       
   }
   function getUserOpenid(){
       $appid     = C(WX_APPID);
       $appsecret = C(WX_APPSECRET);
       $code = $_GET['code'];
       $url= 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant_type=authorization_code';
       $res = httpGet($url);
       $arr = json_decode($res,true);
       dump($arr);
   }
   function getUserDetail(){      
       $appid        = C(WX_APPID);            
       $redirect_uri = urlencode("http://www.zhihuixinda.com/index.php/Xinda/Weixin/getUserInfo");
       $url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appid."&redirect_uri=".$redirect_uri."&response_type=code&scope=snsapi_userinfo&state=123#wechat_redirect";
       header('Location:'.$url);
       dump($url);
   }
   //获取用户的openid
   function getUserInfo(){
       $appid     = C(WX_APPID);
       $appsecret = C(WX_APPSECRET);
       $code      = $_GET['code'];
       $url= 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$appid.'&secret='.$appsecret.'&code='.$code.'&grant_type=authorization_code';
       $res = httpGet($url);
       $arr = json_decode($res,true);
       $token = $arr['access_token'];
       $openid = $arr['openid'];
       $url = 'https://api.weixin.qq.com/sns/userinfo?access_token='.$token.'&openid='.$openid.'&lang=zh_CN';
       $res = httpGet($url); 
       
   }
   //群发接口
   function sendMsgAll(){           
      $array=array(//纯文本
          'touser'=>'oZQWOxElRgLz2KOBa6EAuDusWr1w',
          'text'=>array('content'=>urlencode('锻炼出来了吗？不用回复，我收不到的【腰】')),
          'msgtype'=>'text',
      );     
//       $array=array(//单图文
//           'touser'=>'oZQWOxElRgLz2KOBa6EAuDusWr1w',
//           'mpnews'=>array('media_id'=>''),
//           'msgtype'=>'mpnews',
//       );      
     $res = wxSendMsgAll($this->getAccessToken(),$array);//生产环境群发$type='send'
     $this->ajaxReturn($res);
   }
   
   //获取微信AccessToken
   function getAccessToken(){
       $m=D('wx_wechat');
       $var=$m->where(array('appid'=>C(WX_APPID)))->find();
       if(time()>$var['otime']){//如果access_token过期，重新获取
           $appid     = C(WX_APPID);
           $appsecret = C(WX_APPSECRET);
           $url       = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$appid.'&secret='.$appsecret;
           $arr       = json_decode(httpGet($url), true);
           $data      = array('id'=> $var['id'],'access_token' => $arr['access_token'],'otime'=> (time()+7000));
           $m->save($data);//更新AccessToken
           return $arr['access_token'];           
       }else {//如果access_token没有过期，直接从数据库中取值
           return $var['access_token'];          
       }            
   }
   

   
   //拉取用户信息（认证后才可用）
   function getWXUsers(){
       $token= $this->getAccessToken();
       $m=D('wx_wechat');
       $var=$m->where(array('appid'=>C(WX_APPID)))->find();
       $nextOpenid = $data['next_openid'];
       $url        = 'https://api.weixin.qq.com/cgi-bin/user/get?access_token='.$token.'&next_openid='.$nextOpenid;
       $res        = httpGet($url);
       $arr        = json_decode($res,true);
       $data       = array('id'=>$var['id'],'total'=>$arr['total'],'count'=>$arr['count'],'next_openid',$arr['next_openid']);
       $m->save($data);//更新数据
   }

   
   public function jssdk(){             
       $this->assign('appid',C(WX_APPID));       
       $timestamp=time();
       $this->assign('timestamp',$timestamp);
       $nonceStr=getRandCode(16);//生成16位的随机数
       $this->assign('nonceStr',$nonceStr);
       $jsapi_ticket=$this->getJsApiTicket();//获取全局票据
       $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
       $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
       $signature = "jsapi_ticket=".$jsapi_ticket."&noncestr=".$nonceStr."&timestamp=".$timestamp."&url=".$url;
       $signature = sha1($signature);         
       $this->assign('signature',$signature);
        
       $this->display();
   }
    
}
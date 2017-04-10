<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<header>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="baidu-site-verification" content="6L4Zs1G6f0" />
    <title><?php echo ($_SESSION['Xinda']['web']); ?></title>
	<meta name="keywords" content="<?php echo ($_SESSION['keywords']); ?>" />	
    <link rel="stylesheet" type="text/css" href="/Xinda/Public/css/xd_home.css" />	
    <link rel="stylesheet" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" media="screen" href="https://fonts.googleapis.com/css?family=Montserrat:400,700" />
    <link rel="stylesheet" media="screen" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" />

   
   
   <script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');	
	  ga('create', 'UA-86975455-1', 'auto');
	  ga('send', 'pageview');
	</script> 
	
	<script>
	  (function(h,o,t,j,a,r){
	    h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
	    h._hjSettings={hjid:382318,hjsv:5};
	    a=o.getElementsByTagName('head')[0];
	    r=o.createElement('script');r.async=1;
	    r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
	    a.appendChild(r);
	  })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
	</script>
	
	<script>
	//百度统计代码
		var _hmt = _hmt || [];
		(function() {
		  var hm = document.createElement("script");
		  hm.src = "https://hm.baidu.com/hm.js?4c790a1cf093e3632a695d5e82587605";
		  var s = document.getElementsByTagName("script")[0]; 
		  s.parentNode.insertBefore(hm, s);
		})();
	</script>
  
</header>

<body id="home_controller" class="index_action">
    <div class="wrapper">
      <nav class="navbar navbar-toggleable-sm header-area">
		  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
		    &#9776;
		  </button>
		
		  <a class="navbar-brand" href="/Xinda/index.php/Xinda"><?php echo ($_SESSION['Xinda']['web']); ?></a>
		  <div class="collapse navbar-collapse" id="navbar-collapse">
		    <ul class="navbar-nav ml-auto">
		      <li class="nav-item active"><a class="nav-link" href="/Xinda/index.php/Xinda/Servicelist"><span class="glyphicon glyphicon-th-list"> 主营业务</span></a></li>
		      <li class="nav-item active"><a class="nav-link" href="/Xinda/index.php/Xinda/Login/qq_login"><span class="glyphicon glyphicon-user"> 诚聘人才</span></a></li>
		      
		      <?php if(empty($_SESSION['isCLogin'])): ?><li class="nav-item"><a data-toggle="modal" href="#Login" class="nav-link">登录</a></li>
		      <?php else: ?>
			      <li class="nav-item"><a href="/Xinda/index.php/Xinda/Customer/personal" class="nav-link"> <span class="glyphicon glyphicon-user"> <?php echo ($_SESSION['realname']); ?></span></a></li><?php endif; ?>
		    </ul>
		  </div>
	  </nav>



	
<div id="home">
	<div id="items">
		<div class="cont-area">
		      <div class="container banner-area">
		        <ul class="slides clearfix">
		          <li>
		            <h1><?php echo ($_SESSION['Xinda']['web']); ?></h1>
		            <h5>主营业务：
		            	<a href="/Xinda/index.php/Xinda/Servicelist/Xinda/Servicelist/index/cate/22" title="计算机硬件及外围设备" target="_blank">计算机硬件及外围设备</a>
		            	<a href="/Xinda/index.php/Xinda/Servicelist/Xinda/Servicelist/index/cate/21" title="通讯器材及配件" target="_blank">通讯器材及配件、</a><br><br>
		            	<a href="/Xinda/index.php/Xinda/Servicelist/index/cate/20" title="中小企业软件解决方案" target="_blank">中小企业软件解决方案</a>
		            	<a href="/Xinda/index.php/Xinda/Servicelist/index/cate/7" title="中小企业软件解决方案" target="_blank">微信公众号+微站宣传与服务方案</a>
		            	<a href="/Xinda/index.php/Xinda/Servicelist/index/cate/7" title="中小企业软件解决方案" target="_blank">阿里钉钉+微网站企业管理方案</a>
		            </h5>
		            <br><br>
		            <div>
		              <a class="large-button" href="/Xinda/index.php/Xinda/Servicelist">更多详细</a>
		            </div>
		            <br><br>
		          </li>
		        </ul>
		      </div>
		 </div>
		 <div class="banner-btm-img"><img src="/Xinda/Public/images/Xinda/buildings-0.png" alt="Buildings" /></div>
	</div>
</div>


<div class="about-area text-center">
  	<div class="section-spacing about-top-area">
    	<div class="container">
      		<div class="top-float-img">
       		 	<div class="image-container">
       		 		<img src="/Xinda/Public/images/Xinda/rocket-a.png" alt="Rocket" />
       		 	</div>
      		</div>
       </div>
   </div>
</div>


<div class="slogan-area text-center">
  	<div class="section-spacing">
    	<div class="container">
      		<div style="margin-top: -7rem">
       			 <h1>主营业务</h1>
        			<h5>业务描述<a href="#" title="Amazon SES" target="_blank">软硬件服务</a></h5>
        			<h5>为中小型企业提供教育最优，服务最好的解决方案</h5>
      		</div>
      		<div class="divider_line"></div>
    	</div>
  	</div>
</div>

<div class="features-area text-center">
  <div class="section-spacing">
    <div class="container">
      <h1 class="text-center mb-5">推荐产品</h1>
    </div>
	<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "没有数据" ;else: foreach($__LIST__ as $key=>$ar): $mod = ($i % 2 );++$i; if($key%2 == 0 ): ?><div class="container feature-section">
		      <div class="row align-items-center">
		        <div class="col-lg-5">
		          <h4><?php echo ($ar["name"]); ?></h4>
		          <p class="text-center my-span" title="<?php echo ($ar["content"]); ?>"><?php echo ($ar["content"]); ?></p>
		        </div>
		        <div class="col-lg-7">
		          <a href="/Xinda/index.php/Xinda/Service/index/id/<?php echo ($ar["id"]); ?>"><img class="img-fluid" src="/Xinda/Upload/Xinda<?php echo ($ar["path"]); echo ($ar["img"]); ?>" alt="List" /></a>
		        </div>
		      </div>
		      <div class="divider_line"></div>
		    </div>
		
		<?php else: ?> 
			<div class="container feature-section">
		      <div class="row align-items-center">
		        <div class="col-lg-5 push-lg-7">
		          <h4><?php echo ($ar["name"]); ?></h4>
		          <p class="text-center"><?php echo ($ar["content"]); ?></p>
		        </div>
		        <div class="col-lg-7 pull-lg-5">
		          <a href="/Xinda/index.php/Xinda/Service/index/id/<?php echo ($ar["id"]); ?>"><img class="img-fluid" src="/Xinda/Upload/Xinda<?php echo ($ar["path"]); echo ($ar["img"]); ?>" alt="Campaign" /></a>
		        </div>
		      </div>
		      <div class="divider_line"></div>
		    </div><?php endif; endforeach; endif; else: echo "没有数据" ;endif; ?>
    

   
	<div class="signup-area text-center">
	  <div class="section-spacing">
	    <div class="container feature-section">
	      <div class="row align-items-center">
	        <div class="col-lg-12">
	          <a class="btn btn-primary btn-lg " href="tel:18801043607">马上预约</a>
	          <p class="text-muted"><br>我们完成的不只是一项需求，而是实实在在的解决您困扰的问题</p>          
	        </div>
	        
	      </div>
	    </div>
	  </div>
	</div>
	<div class="push"></div>
  </div>





<div class="footer">
   <footer class="footer-area">
		  <div class="container text-center">
		    <p class="links">Copyright <span class="num">&copy;</span> 2016-2017
		      |
		      <a target="_blank" href="http://www.xiuliguanggao.com/index.php/Xinda"><b>北京-智慧信达</b></a> 版权所有
		      |
		      	备案号：<?php echo ($_SESSION['Xinda']['record']); ?>
		      |
		      <?php echo ($_SESSION['ip']); ?>;<?php echo ($_SESSION['os']); ?>-<?php echo ($_SESSION['browser']); ?>
		      |
		      	咨询热线：<?php echo ($_SESSION['Xinda']['phone']); ?>
		    </p>				    
		  </div>
   </footer>
</div>

    
    <script type="text/javascript" src="/Xinda/Public/js/xd.js"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script src="http://v2.jiathis.com/code/jia.js" charset="utf-8"></script>
    <script type="text/javascript">
	    $(document).scroll(function() {
	      if ($(document).scrollTop() >= 1) {
	        $('.header-area').addClass('navbar-fixed-top');
	      } else {
	        $('.header-area').removeClass('navbar-fixed-top');
	      }
	    });
 	</script>
  
  
	<!-- 添加-模态框 -->
	<div class="modal fade " id="Login" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	    	<div class="modal-header">	        
		        <h4 class="modal-title pull-left" id="myModalLabel">登录</h4>
		    </div>
		    <div class="modal-body">
		      	<form action="/Xinda/index.php/Xinda/Login/login" method="post" class="form-horizontal" role="form" >	      	
					<input type="text" class="form-control" name="phone" value="" placeholder="用户名">
					<input type="password" class="form-control" name="password" value="" placeholder="密码">						
			</div>
			<div class="modal-footer">
			     <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
			     <button type="submit" class="btn btn-primary">登录</button></form>
			</div>
	    </div>
	  </div>
	</div>
  </body>
</html>
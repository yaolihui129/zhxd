<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
	<head>
	  <meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <meta name="viewport" content="width=device-width, initial-scale=1">	  
	  <title>网站后台</title> 
	  <meta name="keywords" content="#" />
	  <meta name="description" content="#" />	  
	  <link rel="stylesheet" type="text/css" href="/Xinda/Public/css/mac/bootstrap.css" />
	  <link rel="stylesheet" type="text/css" href="/Xinda/Public/css/mac/font-awesome.css" />
	  <link rel="stylesheet" type="text/css" href="/Xinda/Public/css/mac/style.css" />		 
	  <link rel="shortcut icon" href="img/favicon/favicon.png">
	</head>

	<body>
	<div class="admin-form">
	  <div class="container">	
	    <div class="row">
	      <div class="col-md-12">	        
	            <div class="widget worange">	              
	              <div class="widget-head"><i class="icon-lock"></i> 网站后台登录 </div>	
	              <div class="widget-content">
	                <div class="padd">	                  
	                  <form class="form-horizontal" method="post" action="/Xinda/index.php/Admin/Login/login">	                    
	                    <div class="form-group">
	                      <label class="control-label col-lg-3" for="inputEmail">用户名：</label>
	                      <div class="col-lg-9">
	                        <input type="text" class="form-control" name="username" placeholder="Username">
	                      </div>
	                    </div>	                    
	                    <div class="form-group">
	                      <label class="control-label col-lg-3" for="inputPassword">密码：</label>
	                      <div class="col-lg-9">
	                        <input type="password" class="form-control" name="password" placeholder="Password">
	                      </div>
	                    </div>	                   
	                   <!-- <div class="form-group">
						 <div class="col-lg-9 col-lg-offset-3">
	                      	<div class="checkbox">
	                        	<label><input type="checkbox"> Remember me</label>
							</div>
						</div>  
						</div> -->
	                        <div class="col-lg-9 col-lg-offset-2">
								<button type="submit" class="btn btn-danger btn-lg">登录</button>
								<button type="reset" class="btn btn-default btn-lg">重置</button>
							</div>
	                    <br />
	                  </form>
					  
					</div>
	                </div>
	            </div>  
	      </div>
	    </div>
	  </div> 
	</div>
	
	<script type="text/javascript" src="/Xinda/Public/js/mac/jquery.js"></script>
	<script type="text/javascript" src="/Xinda/Public/js/mac/bootstrap.js"></script>
	</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title>reset Password | <?php echo config("WebSiteName"); ?></title>
	<meta charset="utf-8">
    
    <base href="//<?php echo $_SERVER['HTTP_HOST']; ?>">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
	
	<meta name="apple-mobile-web-app-title" content="<?php echo config("WebSiteName"); ?>">
	
	<!-- WebApp Icon -->
	<link rel="apple-touch-icon" href="img/touch-icon-iphone.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/touch-icon-ipad.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon" sizes="167x167" href="img/touch-icon-ipad-retina.png">

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
	body{
  margin: 0;
}
.container{
   background: #dddddd;
	 width: 100%;
	 display: flex;
	 height: 100vh;
	 justify-content: center;
}

.item{
   background-color:#ffffff;
  
	 align-self: center;
   border:0px solid red;
   width:450px;
   box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
.login-input{
	margin-top:20px;
}
.login-submit{
	margin-top:25px;
}
	</style>
</head>
<body>
  <div class="container">
	<div class="panel panel-primary item">
		<div class="panel-heading"><b style="font-size:22pt;"> <?php if(config("WebSiteFontIcon")){ echo config("WebSiteFontIcon")." "; } echo config("WebSiteName"); ?></b></div>
		<div class="panel-body" >
			<span style="font-size:18pt;">reset Password</span><br>
			reset Password of your <?php echo config("WebSiteName"); ?> Account
			<?php if(isset($LoginError) && $LoginError){ ?>
					
					<div class="login-input alert alert-danger fade in">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>ERROR!</strong> <?php echo"$LoginError"; ?>
					</div>
					<?php } ?>
			<form class="form-horizontal" method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
						
						<div class="login-input ">
							<label for="email_address" class="cols-sm-2 control-label">E-Mail address</label>
							
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
									<input type="text" class="form-control input-lg" name='WebResetPasswordEmail'   placeholder="Enter your E-Mail"  required="required"/>
								</div>
						</div>	
						
						
						

						<div class="login-submit " >
							<input type='hidden' name='returnurl' value=''>
							<input type='hidden' name='okeurl' value='?'>
							<button type="button"  class="btn  btn-lg" style="background: #dddddd !important;">reset Password</button>
							<button type="submit" name="Script" value="ResetPassword"  class="btn btn-primary btn-lg pull-right">reset Password</button>
						</div>
						
						
					</form>
		
	  </div>
	  <div class="hidden" style="border:1px solid yellow;">
		bottom
	  </div>
    </div>
  </div>
</body>
</html>
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html class="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.flaty.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/animate.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/app-style.css" />
	<title>Login Page</title>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
  	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="login-body">

	<div class="container">
		<div class="row row-no-padding">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="row">
					<div class="login-logo-section">
						<div class="col-xs-offset-2 col-xs-8">
							<div class="row">
								<a href="<?php echo base_url(); ?>">
									<img class="login-logo-img img-responsive" src="<?php echo base_url(); ?>assets/img/logo.png" alt="logo">
								</a>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="login-form-section">
						<div class="col-xs-12 col-sm-4 col-sm-offset-4 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4">
							<?php
								///echo validation_errors("<div class='row'><div class='alert alert-danger animated shake'>", "</div></div>"); 
								if(isset($login_status)){
									echo "<div class='row'><div class='alert alert-danger animated shake'>Entered username and password not match.</div></div>";
								}							
							?>
							<div class="row">
								<form id="login_form" action="<?= base_url().'login/verify'; ?>" method="post" autocomplete="off">
								<div class="form-group <?php if(strlen(form_error('username')) != 0) echo 'has-error'; ?>">
										<label class="control-label label-required">Username</label>
										<input type="text" class="form-control" name="username" value="<?= set_value('username'); ?>" placeholder="Enter your username" data-parsley-minlength="5" data-parsley-maxlength="20" data-parsley-pattern="/^[a-z0-9_-]+$/" data-parsley-required="true" required/>
										<?php echo form_error('username', '<p class="text-danger">', '</p>'); ?>
									</div>
									<div class="form-group <?php if(strlen(form_error('password')) != 0) echo 'has-error'; ?>">
										<label class="control-label label-required">Password</label>
										<input type="password" class="form-control" name="password" placeholder="Enter your password" data-parsley-minlength="6" data-parsley-maxlength="30" data-parsley-required="true" required/>
										<?php echo form_error('password', '<p class="text-danger">', '</p>'); ?>
									</div>
									<div class="form-group">
										<input type="submit" class="btn btn-primary btn-block" value="Login" />
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js" /></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" /></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/parsley.min.js" /></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/app-script.js" /></script>	
</body>

</html>
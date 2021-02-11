<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/login_style.css">
</head>
<body>

	<!-- Navbar-->
	<header class="header">
	    <nav class="navbar navbar-expand-lg navbar-light py-3">
	        <div class="container">
	            <!-- Navbar Brand -->
	            <a href="#" class="navbar-brand">
	                <img src="<?=base_url()?>assets/image/tagline.svg" alt="" width="150">
	            </a>
	        </div>
	    </nav>
	</header>

	<div class="container">
	    <div class="row py-5 mt-4 align-items-center">
	        <!-- For Demo Purpose -->
	        <div class="col-md-5 pr-lg-5 mb-5 mb-md-0">
	            <img src="<?=base_url()?>assets/image/logo.jpg" alt="logo" class="img-fluid mb-3 d-none d-md-block">
	        </div>

	        <div class="col-md-7 col-lg-6 ml-auto">
	            <form action="<?=base_url()?>auth/submit_login" method="post">
	                <div class="row">

                        <?=$this->session->flashdata('message')?>

	                    <div class="input-group col-lg-12 mb-4">
	                        <div class="input-group-prepend">
	                            <span class="input-group-text bg-white px-4 border-md border-right-0">
	                                <i class="fa fa-envelope text-muted"></i>
	                            </span>
	                        </div>
	                        <input id="email" type="email" name="email" placeholder="Email Address" class="form-control bg-white border-left-0 border-md" required>
	                    </div>

	                    <!-- Password -->
	                    <div class="input-group col-lg-12 mb-4">
	                        <div class="input-group-prepend">
	                            <span class="input-group-text bg-white px-4 border-md border-right-0">
	                                <i class="fa fa-lock text-muted"></i>
	                            </span>
	                        </div>
	                        <input id="password" type="password" name="password" placeholder="Password" class="form-control bg-white border-left-0 border-md" required>
	                    </div>

	                    <!-- Submit Button -->
	                    <div class="form-group col-lg-12 mx-auto mb-0">
	                        <button type="submit" class="btn btn-primary btn-block py-2">
	                            <span class="font-weight-bold">Login</span>
	                        </button>
	                    </div>

	                    <div class="form-group col-lg-12 mx-auto mb-0 text-right">
	                    	<a href="#" class="py-2 font-weight-bold">
	                    		Forgot Password ?
	                        </a>
	                    </div>

	                    <!-- Divider Text -->
	                    <div class="form-group col-lg-12 mx-auto d-flex align-items-center my-4">
	                        <div class="border-bottom w-100 ml-5"></div>
	                        <span class="px-2 small text-muted font-weight-bold text-muted"></span>
	                        <div class="border-bottom w-100 mr-5"></div>
	                    </div>

	                    <!-- Already Registered -->
	                    <div class="text-center w-100">
	                        <p class="text-muted font-weight-bold">don't have an account yet ?<a href="<?=base_url()?>landing" class="text-primary ml-2">Register</a></p>
	                    </div>

	                </div>
	            </form>
	        </div>
	    </div>
	</div>

</body>

<script type="text/javascript" src="<?=base_url()?>bootstrap/js/jquery-3.4.1.js"></script>
<script type="text/javascript" src="<?=base_url()?>bootstrap/js/bootstrap.min.js"></script>
<!--script type="text/javascript" src="<?=base_url()?>assets/js/login_script.js"></script-->

</html>
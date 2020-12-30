<!DOCTYPE html>
<html>
<head>
	<title>Landing Page</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/login_style.css">
</head>
<body>

	<!-- Navbar-->
	<header class="header">
	    <nav class="navbar navbar-expand-lg navbar-light py-3">
	        <div class="container">
	            <!-- Navbar Brand -->
	            <a href="#" class="navbar-brand">
	                <img src="assets/image/tagline.svg" alt="" width="150">
	            </a>
	        </div>
	    </nav>
	</header>

	<div class="container">
	    <div class="row py-5 mt-4 align-items-center">
	        <!-- For Demo Purpose -->
	        <div class="col-md-5 pr-lg-5 mb-5 mb-md-0">
	            <img src="assets/image/icon_reg.svg" alt="logo" class="img-fluid mb-3 d-none d-md-block">
	            <!--h2>Registrasi Akun Baru</h2>
	            <p class="font-italic text-muted mb-0">Create a minimal registeration page using Bootstrap 4 HTML form elements.</p>
	            <p class="font-italic text-muted">Snippet By <a href="https://bootstrapious.com" class="text-muted">
	                <u>Bootstrapious</u></a>
	            </p-->
	        </div>

	        <!-- Registeration Form -->
	        <div class="col-md-7 col-lg-6 ml-auto">
	            <form action="<?=base_url()?>auth/register" method="post" id="form_reg">
	                <div class="row">

	                    <!-- First Name -->
	                    <div class="input-group col-lg-6 mb-4">
	                        <div class="input-group-prepend">
	                            <span class="input-group-text bg-white px-4 border-md border-right-0">
	                                <i class="fa fa-user text-muted"></i>
	                            </span>
	                        </div>
	                        <input id="first_name" type="text" name="first_name" placeholder="First Name" class="form-control bg-white border-left-0 border-md" required>
	                    </div>

	                    <!-- Last Name -->
	                    <div class="input-group col-lg-6 mb-4">
	                        <div class="input-group-prepend">
	                            <span class="input-group-text bg-white px-4 border-md border-right-0">
	                                <i class="fa fa-user text-muted"></i>
	                            </span>
	                        </div>
	                        <input id="last_name" type="text" name="last_name" placeholder="Last Name" class="form-control bg-white border-left-0 border-md" required>
	                    </div>

	                    <!-- Email Address -->
	                    <div class="input-group col-lg-12 mb-4">
	                        <div class="input-group-prepend">
	                            <span class="input-group-text bg-white px-4 border-md border-right-0">
	                                <i class="fa fa-envelope text-muted"></i>
	                            </span>
	                        </div>
	                        <input id="email" type="email" name="email" placeholder="Email Address" class="form-control bg-white border-left-0 border-md" required>
	                    </div>

	                    <!-- Phone Number -->
	                    <!--div class="input-group col-lg-12 mb-4">
	                        <div class="input-group-prepend">
	                            <span class="input-group-text bg-white px-4 border-md border-right-0">
	                                <i class="fa fa-phone-square text-muted"></i>
	                            </span>
	                        </div>
	                        <select id="countryCode" name="countryCode" style="max-width: 80px" class="custom-select form-control bg-white border-left-0 border-md h-100 font-weight-bold text-muted">
	                            <option value="">+62</option>
	                        </select>
	                        <input id="phoneNumber" type="tel" name="phone" placeholder="Phone Number" class="form-control bg-white border-md border-left-0 pl-3" required>
	                    </div-->

	                    <!-- Password -->
	                    <div class="input-group col-lg-6 mb-4">
	                        <div class="input-group-prepend">
	                            <span class="input-group-text bg-white px-4 border-md border-right-0">
	                                <i class="fa fa-lock text-muted"></i>
	                            </span>
	                        </div>
	                        <input id="password" type="password" name="password" placeholder="Password" class="form-control bg-white border-left-0 border-md" required>
	                    </div>

	                    <!-- Password Confirmation -->
	                    <div class="input-group col-lg-6 mb-4">
	                        <div class="input-group-prepend">
	                            <span class="input-group-text bg-white px-4 border-md border-right-0">
	                                <i class="fa fa-lock text-muted"></i>
	                            </span>
	                        </div>
	                        <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control bg-white border-left-0 border-md" required>
	                    </div>

	                    <div class="input-group col-lg-12 mb-4">
	                    	<p style="color:red;font-style: oblique;" id="notif_password"></p>
                    	</div>

	                    <!-- Submit Button -->
	                    <div class="form-group col-lg-12 mx-auto mb-0">
	                        <button type="submit" class="btn btn-primary btn-block py-2">
	                            <span class="font-weight-bold">Create your account</span>
	                        </button>
	                    </div>

	                    <!-- Divider Text -->
	                    <div class="form-group col-lg-12 mx-auto d-flex align-items-center my-4">
	                        <div class="border-bottom w-100 ml-5"></div>
	                        <span class="px-2 small text-muted font-weight-bold text-muted">OR</span>
	                        <div class="border-bottom w-100 mr-5"></div>
	                    </div>

	                    <!-- Social Login -->
	                    <!--div class="form-group col-lg-12 mx-auto">
	                        <a href="#" class="btn btn-primary btn-block py-2 btn-facebook">
	                            <i class="fa fa-facebook-f mr-2"></i>
	                            <span class="font-weight-bold">Continue with Facebook</span>
	                        </a>
	                        <a href="#" class="btn btn-primary btn-block py-2 btn-twitter">
	                            <i class="fa fa-twitter mr-2"></i>
	                            <span class="font-weight-bold">Continue with Twitter</span>
	                        </a>
	                    </div-->

	                    <!-- Already Registered -->
	                    <div class="text-center w-100">
	                        <p class="text-muted font-weight-bold">Already Registered ? <a href="<?=base_url()?>auth/login" class="text-primary ml-2">Login</a></p>
	                    </div>

	                </div>
	            </form>
	        </div>
	    </div>
	</div>

</body>

<script type="text/javascript" src="bootstrap/js/jquery-3.4.1.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/landing_script.js"></script>

</html>
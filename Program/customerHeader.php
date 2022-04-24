<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="customerAssets/css/bootstrap.min.css" rel="stylesheet">
    <link href="customerAssets/css/font-awesome.min.css" rel="stylesheet">
    <link href="customerAssets/css/prettyPhoto.css" rel="stylesheet">
    <link href="customerAssets/css/price-range.css" rel="stylesheet">
    <link href="customerAssets/css/animate.css" rel="stylesheet">
	<link href="customerAssets/css/main.css" rel="stylesheet">
	<link href="customerAssets/css/responsive.css" rel="stylesheet">       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <script src="customerAssets/js/jquery.js"></script>
	<script src="customerAssets/js/bootstrap.min.js"></script>
	<script src="customerAssets/js/jquery.scrollUp.min.js"></script>
	<script src="customerAssets/js/price-range.js"></script>
    <script src="customerAssets/js/jquery.prettyPhoto.js"></script>
    <script src="customerAssets/js/main.js"></script>

    <style type="text/css">
    	.logo a
    	{
    		margin-top: 5px;
    		font-size: 28px;
    		text-decoration: none;
    		color: #fe980f;
    	}
    	body
		{
			min-height: 100%;
			display: grid;
			grid-template-rows: auto 1fr auto;
		}
    </style>
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +95 248 908 334</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> HomelyFurn@gmail.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="https://www.facebook.com"><i class="fa fa-facebook"></i></a></li>
								<li><a href="https://www.twitter.com"><i class="fa fa-twitter"></i></a></li>
								<li><a href="https://www.googleplus.com"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo">
							<a href="#">HOMELY FURN
							</a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="customerProfile.php" id="customerProfile"><i class="fa fa-user"></i> Account</a></li>
								<li><a href="checkOut.php" id="checkout"><i class="fa fa-crosshairs"></i> Checkout</a></li>
								<li><a href="shoppingCart.php" id="cart"><i class="fa fa-shopping-cart"></i> Cart</a></li>
								<?php 
									if(isset($_SESSION['CID']))
									{
										echo "<li><a href='customerLogout.php'><i class='fa fa-sign-out'></i> Logout</a></li>";
									}
									else
									{
										echo "<li><a href='customerLogin.php'><i class='fa fa-lock'></i> Login/Register</a></li>";
									}
								 ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="furnitureDisplay.php" id="Home" class="active">Home</a></li>
								<li><a href="aboutUs.php" id="About">About us</a></li>		
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
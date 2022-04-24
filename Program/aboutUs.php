<?php 
include('customerHeader.php');
 ?>
 <style type="text/css">
 	.aboutUs
 	{
 		color: white;
 		background: linear-gradient(#9d7a5e, grey);
 		margin-bottom: 50px;
 	}
 	.parent
 	{ 
 		padding: 0;
 		position: relative;
 		border: 10px solid white;
 	}
 	.title
 	{ 
 		font-weight: bold;
 		color: white;
 		box-shadow: 2px 2px grey;
 		transform: translateX(-50%);
 		border-radius: 30%; 
 		width: 200px; 
 		height: 50px; 
 		position: absolute;
 		top: -10%;
 		left: 50%;
 		padding: 12px 0;
 		background: rgba(245, 152, 15);

 	}
 	.content
 	{
 		z-index: -1;
 		width: 100%;
 		padding-top: 15px;
 		background: rgba(128, 128, 128, 0.3);
 	}
 	.content p
 	{
 		color: grey;
 		opacity: 1;
 	}
 	.textDetail
 	{
 		margin-top: 30px;
 	}
 	.textDetail>li 
 	{
 		list-style-type: disc !important;
 		padding: 5px;
 	}
 	footer
 	{
 		margin-top: 30px;
 		margin-bottom: 10px;
 	}
 	@media screen and (min-width: 400px)
 	{
 		#sofaImg
 		{
 			width: 300px;
 			margin: 0;
 		}
 		.content
 		{
 			width: 90%;
 			margin: 0 auto;
 			height: 220px;
 			margin-bottom: 50px;
 		}
 	}
 	@media screen and (min-width: 600px)
 	{
 		#sofaImg
 		{
 			width: 400px;
 			margin: 50px 0;
 		}
 		.content
 		{
 			width: 98%;
 			height: 250px;
 			margin: 0 auto;
 			margin-bottom: 50px;
 		}
 	}
 	@media screen and (min-width: 800px)
 	{
 		#sofaImg
 		{
 			width: 500px;
 			margin: 0;
 		}
 		.content
 		{
 			height: 250px;
 			width: 100%;
 			margin-bottom: 0px;
 		}
 	}
 	@media screen and (min-width: 1000px)
 	{
 		#sofaImg
 		{
 			width: 500px;
 			margin: 0;
 		}
 		.content
 		{
 			height: 185px;
 			width: 100%;
 			margin-bottom: 0px;
 		}
 	}
 </style>
 <script type="text/javascript">
 	document.getElementById('Home').classList.remove('active');
 	document.getElementById('About').classList.add('active');
 </script>
<div class="container">
	<div class="row aboutUs" align="center">
	 	<div class="col-sm-5">
	 		<h2 style="text-decoration: underline; margin: 50px;">ABOUT US</h2>
		 	<p style="line-height: 30px;">
		 		Homely Furn business was established in Yangon on 20th October, 1990. The shop has a total of 10 suppliers from China, Italy and the US. Over the last few years, the business is extended and 10 branch shops have been opened in other divisions and states in Myanmar like Mandalay, Kayin, and Kachin.
			</p>
		</div>
	 	<div class="col-sm-7">
			<img src="images/website/Megan sofa with BoxT cushions.jpg" id="sofaImg" style="padding: 10px;">
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 parent">
			<div class="title" align="center">
				Available Furniture
			</div>
			<div class="content">
				<ul class="textDetail">
					<li>Bedroom furniture</li>
					<li>Living room furniture</li>
					<li>Dining room furniture</li>
					<li>Kitchen furniture</li>
				</ul>
			</div>
		</div>
		<div class="col-sm-4 parent">
			<div class="title" align="center">
				Fast Delivery
			</div>
			<div class="content">
				<ul class="textDetail">
					<li>Deliver a quality product to home</li>
					<li>Delivery estimate: 15 days after purchasing</li>
					<li>Guarantee no furniture breakage</li>
					<li>Customer care</li>
				</ul>
			</div>
		</div>
		<div class="col-sm-4 parent">
			<div class="title" align="center">
				Flexible Payment
			</div>
			<div class="content">
				<ul class="textDetail">
					<li>Credit card: Master Card/ Visa/ American Express</li>
					<li>KBZ Pay/Wave Pay</li>
					<li>Cash on Delivery</li>
					<li>Online invoice email for online payment</li>
				</ul>
			</div>
		</div>
	</div>
	<footer>Contact us: No.(89), MaKyeeKyee Road, Myaynigone Township, Yangon</footer>
</div>
</body>
</html>
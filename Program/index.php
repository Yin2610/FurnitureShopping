<?php 
include('connect.php');
include('shoppingCartFunctions.php');
include('customerHeader.php');
if(isset($_GET['add']))
{
	$id = $_GET['id'];
	$price = $_GET['price'];
	$bqty = $_GET['bqty'];
	$aqty = $_GET['aqty'];
	AddFurniture($id, $price, $bqty, $aqty);
}
$Category = "";
if(isset($_GET['Category']))
{
	$Category = $_GET['Category'];
	$Brand = "";
}
$Brand = "";
if(isset($_GET['Brand']))
{
	$Brand = $_GET['Brand'];
	$Category = "";
}
?>
<style type="text/css">
	.shop:hover
	{
		color: white;
		background: #FE980F;
	}
	.single-products
	{
		border:1px solid #e2e2e2;
	}
	.buttons
	{
		margin-bottom: 10px;
	}
	#advertisement
	{
		border: 1px solid #e2e2e2;
	}
	html
	{
		scroll-behavior: smooth;
	}
	.start-shopping-link
	{
		color: white;
	}
</style>
<title>Furniture Display</title>
<section id="slider"><!--slider-->
		<div class="container">
			<div class="row" id="advertisement">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner">
							<div class="item active">
								<div class="col-sm-6">
									<h1><span>HOMELY FURN</span></h1>
									<h2>Furniture online sale</h2>
									<p>Please enjoy a sound investment in quality and style of your household furniture to improve your living standards.</p>
									<button type="button" class="btn btn-default get"><a href="#display" class="start-shopping-link">Start shopping</a></button>
								</div>
								<div class="col-sm-6">
									<img src="images/website/0116_beige_furniture.jpg" width="500px" height="400px" style="padding: 50px" alt="Furniture image" />
								</div>
							</div>
							<div class="item">
								<div class="col-sm-6">
									<h1><span>HOMELY FURN</span></h1>
									<h2>Furniture online sale</h2>
									<p>Please enjoy a sound investment in quality and style of your household furniture to improve your living standards.</p>
									<button type="button" class="btn btn-default get"><a href="#display" class="start-shopping-link">Start shopping</a></button>
								</div>
								<div class="col-sm-6">
									<img src="images/website/77231d8b4083da0fa926547ef77de97a.jpg" width="500px" height="400px" style="padding: 50px" alt="Furniture image" />
								</div>
							</div>
							
							<div class="item">
								<div class="col-sm-6">
									<h1><span>HOMELY FURN</span></h1>
									<h2>Furniture online sale</h2>
									<p>Please enjoy a sound investment in quality and style of your household furniture to improve your living standards.</p>
									<button type="button" class="btn btn-default get start-shopping-link"><a href="#display" class="start-shopping-link">Start shopping</a></button>
								</div>
								<div class="col-sm-6">
									<img src="images/website/Buying_Furniture.webp" width="500px" height="400px" style="padding: 50px" alt="Furniture image" />
								</div>
							</div>
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
				</div>
			</div>
		</div>
	</div>
</section><!--/slider-->
<section style="margin-bottom: 30px">
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<div class="left-sidebar">
					<h2>Category</h2>
					<div class="panel-group category-products" id="accordian"><!--category-productsr-->
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordian" href="#bedroom">
										<span class="badge pull-right"><i class="fa fa-plus"></i></span>
										Bedroom 
									</a>
								</h4>
							</div>
							<div id="bedroom" class="panel-collapse collapse">
								<div class="panel-body">
									<ul>
										<li><a href="furnitureDisplay.php?Category=Bed">Bed </a></li>
										<li><a href="furnitureDisplay.php?Category=Dressing table">Dressing table</a></li>
										<li><a href="furnitureDisplay.php?Category=Wardrobe">Wardrobe </a></li>
										<li><a href="furnitureDisplay.php?Category=Bedside table">Bedside table </a></li>
										<li><a href="furnitureDisplay.php?Category=Bedside lamp">Bedside lamp </a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordian" href="#living">
										<span class="badge pull-right"><i class="fa fa-plus"></i></span>
										Living room 
									</a>
								</h4>
							</div>
							<div id="living" class="panel-collapse collapse">
								<div class="panel-body">
									<ul>
										<li><a href="furnitureDisplay.php?Category=Sofa">Sofa</a></li>
										<li><a href="furnitureDisplay.php?Category=Coffee table">Coffee table</a></li>
										<li><a href="furnitureDisplay.php?Category=Bookcase">Bookcase</a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordian" href="#kitchen">
									<span class="badge pull-right"><i class="fa fa-plus"></i></span>
									Kitchen 
									</a>
								</h4>
							</div>
							<div id="kitchen" class="panel-collapse collapse">
								<div class="panel-body">
									<ul>
										<li><a href="furnitureDisplay.php?Category=Cabinet">Cabinet</a></li>
										<li><a href="furnitureDisplay.php?Category=Counter">Counter</a></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordian" href="#dining">
										<span class="badge pull-right"><i class="fa fa-plus"></i></span>
										Dining room 
									</a>
								</h4>
							</div>
							<div id="dining" class="panel-collapse collapse">
								<div class="panel-body">
									<ul>
										<li><a href="furnitureDisplay.php?Category=Dining table">Dining table</a></li>
										<li><a href="furnitureDisplay.php?Category=Dining chair">Dining chair</a></li>
									</ul>
								</div>
							</div>
						</div>
					</div><!--/category-products-->
					
					<div class="brands_products"><!--brands_products-->
						<h2>Brands</h2>
						<div class="brands-name">
							<ul class="nav nav-pills nav-stacked">
								<?php 
								$query = "SELECT * FROM Brand";
								$ret = mysqli_query($connection, $query);
								$count = mysqli_num_rows($ret);
								for ($i=0; $i < $count; $i++) 
								{ 
									$row = mysqli_fetch_array($ret);
									$BrandName = $row['BrandName'];
									echo "<li><a href='furnitureDisplay.php?Brand=$BrandName'><b>$BrandName</b></a></li>";
								}
								 ?>
							</ul>
						</div>
					</div><!--/brands_products-->
					<div class="shipping text-center">
						<img src="images/Website/interiorDesign.jpg" width="100%" style="margin-top: -20px" alt="Interior design tips image" />
						<a href="https://www.decoraid.com/blog/best-impression-interior-design-tips/" target="_blank">Click to learn interior design tips. <i class="fa fa-external-link"></i></a>
					</div>	
				</div>
			</div>
			<div class="col-sm-9 padding-right">
				<div class="features_items"><!--features_items-->
					<h2 class="title text-center">Furniture display</h2>
					<form action="furnitureDisplay.php" method="post">
					<fieldset>
					<table width="100%">
						<tr>
							<td align="right">
								<input type="text" name="txtData" placeholder="Search furniture" style="color: black; width: 200px; height: 34px; " />
								<input type="submit" name="btnSearch" value="Search" class="btn btn-default"></input>
								<tr>
									<td>
									<?php 
										if($Category != "" && $Brand=="")
										{
											echo "<a class='btn btn-default' href='furnitureDisplay.php' style='background:#ECECEC'><span style='color:red;'><i class='fa fa-times'></i> </span> $Category</a>";
										}
										if($Brand != "" && $Category=="")
										{
											echo "<a class='btn btn-default' href='furnitureDisplay.php' style='background:#ECECEC'><span style='color:red;'><i class='fa fa-times'></i> </span> $Brand</a>";
										}
									?>
									</td>
								</tr>
							</td>
						</tr>
					</table>
					<hr/>

<?php  

if(isset($_POST['btnSearch'])) 
{
	$txtData=$_POST['txtData'];
	$query1="SELECT * FROM Furniture
			 WHERE FurnitureName LIKE '%$txtData%'
			 OR Price='$txtData'
			 ";
	$ret1=mysqli_query($connection,$query1);
	$count1=mysqli_num_rows($ret1);

	for($i=0;$i<$count1;$i++) 
	{ 
		$row=mysqli_fetch_array($ret1);
		$FurnitureID=$row['FurnitureID'];
		$FurnitureName=$row['FurnitureName'];
		$Price=$row['Price'];
		$FurnitureImage1=$row['FurnitureImage1'];
		$Quantity = $row['Quantity'];
		?>
		<div class='col-sm-4'>
			<div class='product-image-wrapper'>
				<div class='single-products'>
					<div class='productinfo text-center'>
						<img src='<?php echo $FurnitureImage1 ?>' width='100px' height='180px' style='padding: 8px'><br>
						<b><?php echo $FurnitureName ?></b><br>
						<p><?php echo $Price ?> MMK</p>
						<p><?php echo $Quantity; ?> instock</p>
						<div class='buttons'>
						<a href='furnitureDisplay.php?id=<?php echo $FurnitureID ?>&price=<?php echo $Price ?>&bqty=1&aqty=<?php echo $Quantity ?>&add' class='btn btn-default shop'><i class='fa fa-shopping-cart'></i> Add to cart</a>
						<a href='furnitureDetails.php?FurnitureID=<?php echo $FurnitureID ?>' class='btn btn-default'></i>Details</a>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php 
	} 
}
else
{
	$query1 = "";
	if($Category == "" && $Brand == "")
	{
		$query1="SELECT * FROM Furniture f WHERE f.Quantity <> 0";
	}
	else if($Brand != "" && $Category == "")
	{
		$query1 = "SELECT * FROM Furniture f, Brand b WHERE f.BrandID = b.BrandID AND b.BrandName='$Brand' AND f.Quantity <> 0";
	}
	else if($Category != "" && $Brand == "")
	{
		$query1 = "SELECT * FROM Furniture f, FurnitureType ft WHERE f.FurnitureTypeID = ft.FurnitureTypeID AND ft.FurnitureType = '$Category' AND f.Quantity <> 0";
	}
	$ret1=mysqli_query($connection,$query1);
	$count1=mysqli_num_rows($ret1);
	for($i=0;$i<$count1;$i++) 
	{ 
			$row=mysqli_fetch_array($ret1);
			$FurnitureID=$row['FurnitureID'];
			$FurnitureName=$row['FurnitureName'];
			$Price=$row['Price'];
			$Quantity = $row['Quantity'];
			$FurnitureImage1=$row['FurnitureImage1'];

		?>
			<div class="col-sm-4" id="display">
				<div class="product-image-wrapper">
					<div class="single-products">
						<div class="productinfo text-center">
							<img src="<?php echo $FurnitureImage1 ?>" width="100px" height="180px" style="padding: 8px"><br>
							<b><?php echo $FurnitureName ?></b><br>
							<p><?php echo $Price ?> MMK</p>
							<p><?php echo $Quantity; ?> instock</p>
							<div class="buttons">
							<a href="furnitureDisplay.php?id=<?php echo $FurnitureID ?>&price=<?php echo $Price ?>&bqty=1&aqty=<?php echo $Quantity ?>&add" class="btn btn-default shop"><i class="fa fa-shopping-cart"></i> Add to cart</a>
							<a href="furnitureDetails.php?FurnitureID=<?php echo $FurnitureID ?>" class="btn btn-default"></i>Details</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php
	}
}

?>

</fieldset>	
</form>
</div>
</div>
</div>
</div>
</section>
</body>

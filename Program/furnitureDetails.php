<?php 
include('connect.php');
include('shoppingCartFunctions.php');
include('customerHeader.php');

if(isset($_POST['btnAddtoCart']))
{
	$txtFurnitureID = $_POST['txtFurnitureID'];
	$txtBuyingQuantity = $_POST['txtBuyingQuantity'];
	$txtPrice = $_POST['txtPrice'];
	$txtAvailQuantity = $_POST['txtAvailQuantity'];
	AddFurniture($txtFurnitureID, $txtPrice, $txtBuyingQuantity, $txtAvailQuantity);
}

//Get Furniture Information------------------------------------------------
$FurnitureID=$_GET['FurnitureID'];

$query="SELECT f.*, b.BrandID,b.BrandName, m.Material, ft.FurnitureTypeID, ft.FurnitureType
		FROM furniture f, brand b, furnituretype ft, material m
		WHERE f.FurnitureID='$FurnitureID'
		and f.MaterialID = m.MaterialID
		AND f.BrandID=b.BrandID
		AND f.FurnitureTypeID=ft.FurnitureTypeID
		";
$ret=mysqli_query($connection,$query);
$row=mysqli_fetch_array($ret);

$FurnitureImage1=$row['FurnitureImage1'];
$FurnitureImage2=$row['FurnitureImage2'];
$FurnitureImage3=$row['FurnitureImage3'];

//----------------------------------------------------------------------
?>

<style type="text/css">
	.product-info
	{
		padding-left: 50px;
	}
	#PImage, .furnImg
	{
		border: 1px solid #E2E2E2;
	}
	#PImage
	{
		padding: 8px;
	}
	.furnImg
	{
		padding: 10px 10px;
	}
	.furnImg:hover
	{
		border-color: #B3B3B3;
	}
	#btnAddtoCart
	{
		font-family: 'Roboto', sans-serif;
		color: white;
		background: #fe980f;
	}
</style>
<title>Furniture details | Homely Furn</title>
<body>
	<div class="container">
		<h3>Furniture details</h3>
	<hr>
		<div class="col-sm-12">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img id="PImage" src="<?php echo $FurnitureImage1 ?>"/>
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
										<div class="col-sm-12">
										<a href="#">
											<img width="100px" height="100px" class="furnImg col-sm-4" src="<?php echo $FurnitureImage1 ?>" onClick="document.getElementById('PImage').src='<?php echo $FurnitureImage1 ?>'" alt="A furniture image">
										</a>
										<a href="#">
											<img width="100px" height="100px" class="furnImg col-sm-4" src="<?php echo $FurnitureImage2 ?>" onClick="document.getElementById('PImage').src='<?php echo $FurnitureImage2 ?>'" alt="A furniture image">
										</a>
										<a href="#">
											<img width="100px" height="100px" class="furnImg col-sm-4" src="<?php echo $FurnitureImage3 ?>" onClick="document.getElementById('PImage').src='<?php echo $FurnitureImage3 ?>'" alt="A furniture image">
										</a>
										</div>
									</div>
							</div>
						</div>
						<div class="col-sm-7">
							<div class="product-info"><!--/product-information-->
								<form action="furnitureDetails.php" method="POST">
								<table cellpadding="5px">
									<tr>
										<td colspan="2">
											<h4><?php echo $row['FurnitureName'] ?></h4>
										</td>
									</tr>
									<tr>
										<td><b>Brand </b></td>
										<td>: <?php echo $row['BrandName'] ?></td>
									</tr>
									<tr>
										<td><b>Material</b></td>
										<td>: <?php echo $row['Material'] ?></td>
									</tr>
									<tr>
										<td><b>Furniture type</b></td>
										<td>: <?php echo $row['FurnitureType'] ?></td>
									</tr>	
									<tr>
										<td><b>Price</b></td>
										<td>: <?php $price = $row['Price']; echo $price; ?> MMK</td>
										<input type="hidden" name="txtPrice" value="<?php echo $price?>">
									</tr>		
									<tr>
										<td><b>Available Quantity</b></td>
										<td>: <?php $availquantity = $row['Quantity']; echo $availquantity; ?> pcs</td>
										<input type="hidden" name="txtAvailQuantity" value="<?php echo $availquantity ?>">
									</tr>
									<tr>
										<td><b>Buying Quantity</b></td>
										<td>
										<input type="hidden" name="txtFurnitureID" value="<?php echo $row['FurnitureID'] ?>" />
										: <input type="number" name="txtBuyingQuantity" value="1" max="<?php echo $availquantity ?>" size="5" /> pcs
										</td>
									</tr>
									<tr>
										<td colspan="2">
											<b>Description</b>
											<br>
											<?php echo $row['Description'] ?>
										</td>
									</tr>	
									<tr>
									<td>
									<button type="submit" class="btn btn-default cart" name="btnAddtoCart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
									</td>
								</tr>	
								</table>
								</form>		
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					</div>
				</div>
</body>
</html>
<?php 
include('connect.php');
include('shoppingCartFunctions.php');
include('customerHeader.php');

if(isset($_GET['action']))
{
	$action = $_GET['action'];
	if($action == 'remove')
	{
		$FurnitureID = $_GET['FurnitureID'];
		RemoveFurniture($FurnitureID);
	}
	elseif($action == 'clearall')
	{
		ClearAll();
	}
}
?>
<title>Shopping cart | Homely Furn</title>
<style type="text/css">
	button a
	{
		text-decoration: none;
		color: black;
	}
</style>
<script type="text/javascript">
	function activeTab()
	{
		document.getElementById('cart').classList.add("active");
	}
</script>
<body onload="activeTab()">
	<section id="cart_items">
		<div class="container">
			<h3>Shopping cart</h3>
			<hr>
			<div class="table-responsive cart_info">
				<form>
					<?php  
					if(!isset($_SESSION['ShoppingCart_Functions'])) 
					{
						echo "<h3>Empty Cart.</h3>";
						echo "<button><a href='FurnitureDisplay.php'>Back to shopping</a></button>";
						exit();
					}
					elseif(count($_SESSION['ShoppingCart_Functions']) == 0)
					{
						echo "<h3>No item in shopping cart.</h3>";
						echo "<button><a href='FurnitureDisplay.php'>Back to shopping</a></button>";
						exit();
					}
					else
					{
					?>
				<table class="table table-condensed" style="width: 100%">
					<thead>
						<tr class="cart_menu" align="center">
							<td class="image">Image</td>
							<td class="description">Furniture name</td>
							<td class="price">Price</td>
							<td class="quantity">Buying quantity</td>
							<td class="total">Sub total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>

					<?php 
						$size=count($_SESSION['ShoppingCart_Functions']);
						for ($i=0;$i<$size;$i++) 
						{ 
							$FurnitureImage1=$_SESSION['ShoppingCart_Functions'][$i]['FurnitureImage1'];
							$FurnitureID=$_SESSION['ShoppingCart_Functions'][$i]['FurnitureID'];
				
							echo "<tr  align='center'>";
							echo "<td class='cart_product'> 
									<img src='$FurnitureImage1' width='100px' height='120px'/> 
								</td>
								<td class='cart_description'><h4><a>". $_SESSION['ShoppingCart_Functions'][$i]['FurnitureName'] ."</a></h4>
									<p>Furniture ID: ". $_SESSION['ShoppingCart_Functions'][$i]['FurnitureID'] ."</p></td>
								<td class='cart_price'><p>". $_SESSION['ShoppingCart_Functions'][$i]['Price'] ." MMK</p></td>";
							$BuyQuantity = $_SESSION['ShoppingCart_Functions'][$i]['BuyQuantity'];
							$AvailQuantity = $_SESSION['ShoppingCart_Functions'][$i]['AvailQuantity'];
							if($BuyQuantity > $AvailQuantity)
							{
								echo "<script>window.alert('Your buying quantity exceeds available quantity. So, it has been reduced to available quantity.');</script>";
								$_SESSION['ShoppingCart_Functions'][$i]['BuyQuantity'] = $AvailQuantity;
								echo "<td class='cart_price'>
										<p>".$AvailQuantity."</p>
									</td>
									<td class='cart_price' id='subTotal'>
										<p>". $_SESSION['ShoppingCart_Functions'][$i]['Price'] * $AvailQuantity ." MMK</p>
									</td>";
							}
							else
							{
								echo "<td class='cart_price'>
										<p>".$BuyQuantity."</p>
									</td>
									<td class='cart_price' id='subTotal'>
										<p>". $_SESSION['ShoppingCart_Functions'][$i]['Price'] * $BuyQuantity ." MMK</p>
									</td>";
							}
							echo "<td class='cart_delete'>
									<a class='cart_quantity_delete' href='shoppingCart.php?FurnitureID=$FurnitureID&action=remove'><i class='fa fa-times'></i></a>
									</td>";
								echo "</tr>";
						}
						?>
						</tbody>
					</table>
					<?php 
				}
				 ?>
			</form>
			</div>
			<div align="right">
				<a class="btn btn-default" href="furnitureDisplay.php?" style="margin-right: 20px;">Continue shopping</a>
				<a class="btn btn-default" href="shoppingCart.php?action=clearall">Clear all</a>
				<a class="btn btn-default check_out" href="checkOut.php" style="margin-bottom: 19px">Proceed to checkout</a>
			</div>
		</div>
	</section>	<!--/#cart_items-->
</body>
</html>
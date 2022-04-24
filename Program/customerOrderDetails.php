<?php
include('connect.php'); 
session_start();
include('customerHeader.php');
if(isset($_SESSION['CID']))
{
	if(isset($_GET['OrderID']))
	{
		$OrderID = $_GET['OrderID'];
		$Query="SELECT o.*, fo.*, f.FurnitureName, f.FurnitureImage1
		FROM Orders o, FurnitureOrder fo, Furniture f
		WHERE o.OrderID='$OrderID'
		AND o.OrderID=fo.OrderID
		AND fo.FurnitureID=f.FurnitureID
		";
		$ret=mysqli_query($connection,$Query);
		$count=mysqli_num_rows($ret);
	}
}
else
{
	echo "<script>window.alert('Please login first.')</script>";
	echo "<script>window.location='customerLogin.php'</script>";
} 
 ?>
<title>Order Details | Homely Furn</title>
<section id="cart_items">
	<div class="container">
		<h3>Order Details</h3>
		<hr>
		<div class="table-responsive cart_info">
			<table class="table table-condensed">
				<thead>
					<tr class="cart_menu" align="center">
						<td>No</td>
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

						for ($i=0;$i<$count;$i++) 
						{ 
							$row=mysqli_fetch_array($ret);

							echo "<tr style='text-align: center;'>";
								echo "<td>" . ($i+1) . "</td>";
								$FurnitureImage1 = $row['FurnitureImage1'];
								echo "<td><img src='$FurnitureImage1' width='80px' height='80px'></td>";
								echo "<td>". $row['FurnitureName'] ."</td>";
								echo "<td>". $row['OrderSubPrice'] ." mmk</td>";
								echo "<td>". $row['OrderSubQuantity'] ."</td>";
								echo "<td>". $row['OrderSubQuantity'] * $row['OrderSubPrice'] ."</td>";
							echo "</tr>";
						}
					?>						
				</tbody>
			</table>
		</div>
		<a href='customerProfile.php'>Go back to customer profile.</a>
	</div>
</section>
</body>
</html>
<?php 
session_start();
include('connect.php');
include('staffHeader.php');
if (isset($_SESSION['SID'])) 
{
	$showFurniture="SELECT f.*, b.BrandName,
					m.Material, ft.FurnitureType
					FROM Furniture f, Brand b,
					Material m, FurnitureType ft
					WHERE f.BrandID = b.BrandID
					AND f.MaterialID = m.MaterialID
					AND f.FurnitureTypeID = ft.FurnitureTypeID";
	$showRun = mysqli_query($connection, $showFurniture);
	$countShowFurniture = mysqli_num_rows($showRun);
	if($countShowFurniture<1)
	{
		echo "<div class='container' style='margin-top: 20px'><h3>Furniture list</h3>";
		echo "<p>No furniture is registered yet.</p>";
		echo "<a href='registerFurniture.php'>Click to register furniture.</a></div>";
		exit();
	}
}
else
{
	echo "<script>window.alert('Please login first.')</script>";
	echo "<script>window.location='staffLogin.php'</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Furniture list</title>
	<style type="text/css">
		#furnitureList, #furnitureList td,  #furnitureList th
		{
			border: 1px solid #B9B9B9;
			border-collapse: collapse;
			padding: 10px 15px;
		}
		.updateBtn a:hover, .deleteBtn a:hover
		{
			color: white;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="style.css">
	
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="DataTables/jQuery-3.6.0/jquery-3.6.0.js"></script>
	<link rel="stylesheet" type="text/css" href="DataTables/datatables.css" />
	<script type="text/javascript" src="DataTables/datatables.js"></script>
	<script type="text/javascript">
		$(document).ready(function()
			{
				$('#furnitureList').DataTable();
			});
	</script>
</head>
<body>
	<fieldset style="padding: 20px">
		<legend>Furniture List</legend>
		<div class="table-responsive">
			<table width="100%" class="display" id='furnitureList'>
				<thead>
					<tr align="center">
						<th>No.</th>
						<th>Furniture Name</th>
						<th>Furniture Image1</th>
						<th>Furniture Image2</th>
						<th>Furniture Image3</th>
						<th>Furniture Type</th>
						<th>Furniture Place</th>
						<th>Brand Name</th>
						<th>Price(MMK)</th>
						<th>Quantity</th>
						<th>Update Action</th>
						<th>Delete Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						for ($i=0; $i < $countShowFurniture; $i++) 
						{ 
							$FArray = mysqli_fetch_array($showRun);
							$FID = $FArray['FurnitureID'];
							$FName = $FArray['FurnitureName'];
							$FPrice = $FArray['Price'];
							$FQuantity = $FArray['Quantity'];
							$FUsePlace = $FArray['UsePlace'];
							$FImage1 = $FArray['FurnitureImage1'];
							$FImage2 = $FArray['FurnitureImage2'];
							$FImage3 = $FArray['FurnitureImage3'];
							$BrandName = $FArray['BrandName'];
							$FurnitureType =$FArray['FurnitureType'];

							echo "<tr align='center'>";
							echo "<td>".($i+1)."</td>";
							echo "<td>$FName</td>";
							echo "<td><img src=".$FImage1." width=50px height=50px></img></td>";
							echo "<td><img src=".$FImage2." width=50px height=50px></img></td>";
							echo "<td><img src=".$FImage3." width=50px height=50px></img></td>";
							echo "<td>$FurnitureType</td>";
							echo "<td>$FUsePlace</td>";
							echo "<td>$BrandName</td>";
							echo "<td>$FPrice</td>";
							echo "<td>$FQuantity</td>";
							echo "<td>
							<button class='updateBtn'>
							<a href='updateFurniture.php?FurnitureID=$FID'>Update</a>
							</button>
							</td>";
							echo "<td>
							<button class='deleteBtn'>
							<a href='deleteFurniture.php?FurnitureID=$FID'>Delete</a>
							</button>
							</td>";
							echo "</tr>";
						}
					 ?>
				</tbody>
			</table>
			</div>
			<a href="staffHome.php">Go back to staff home page.</a>
		</fieldset>
</body>
</html>
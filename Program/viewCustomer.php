<?php 
session_start();
include('connect.php');
include('staffHeader.php');
if(isset($_SESSION['SID']))
{
	$showCustomer="SELECT * FROM Customer";
	$showRun = mysqli_query($connection, $showCustomer);
	$countShowCustomer = mysqli_num_rows($showRun);
	if($countShowCustomer < 1)
	{
		echo "<h1>Customer list</h1>";
		echo "<p>No customer has registered yet.</p>";
		exit();
	}
}
else
{
	echo "<script>window.alert('Please login first.')</script>";
	echo "<script>window.location='updateCustomer.php'</script>";
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Customer list</title>
	<style type="text/css">
		#customerList, #customerList td,  #customerList th
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
			$('#customerList').DataTable();
		});
	</script>
</head>
<body>
	<fieldset style="padding: 20px">
		<legend>Customer list</legend>
		<div class="table-responsive">
			<table width="100%" id='customerList'>
				<thead>
					<tr>
						<th>No.</th>
						<th>Customer name</th>
						<th>Customer gender</th>
						<th>Customer email</th>
						<th>Customer phone</th>
						<th>Customer address</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						for ($i=0; $i < $countShowCustomer; $i++) 
						{ 
							$CArray = mysqli_fetch_array($showRun);
							$CID = $CArray['CustomerID'];
							$CName = $CArray['CustomerName'];
							$CGender = $CArray['CustomerGender'];
							$CEmail = $CArray['CustomerEmail'];
							$CPhone = $CArray['CustomerPhone'];
							$CAddress = $CArray['CustomerAddress'];

							echo "<tr>";
							echo "<td>".($i+1)."</td>";
							echo "<td>$CName</td>";
							echo "<td>$CGender</td>";
							echo "<td>$CEmail</td>";
							echo "<td>$CPhone</td>";
							echo "<td>$CAddress</td>";
							echo "</tr>";
						}
					 ?>
				</tbody>
			</table>
		</div>
		<a href="staffHome.php">Go back to staff home.</a>
	</fieldset>	
</body>
</html>
<?php 
include('connect.php'); 
session_start();
include('customerHeader.php');
if(isset($_SESSION['CID']))
{
	$CustomerID = $_SESSION['CID'];
	$selectCustomer = "SELECT * FROM Customer WHERE CustomerID = '$CustomerID'";
	$selectCustomerRun = mysqli_query($connection, $selectCustomer);
	$CustomerArr = mysqli_fetch_array($selectCustomerRun);
}
else
{
	echo "<script>window.alert('Please login first.')</script>";
	echo "<script>window.location='customerLogin.php'</script>";
}
?>
	<title>Customer Profile | Home Furn</title>
	<style type="text/css">
		#update
		{
			text-decoration: none;
			color: black;
			background: #fe980f;
			border: 1px solid #fe980f;
			padding: 8px;
		}
		#customerInfo td
		{
			padding: 10px;
		}
		#orderList, #orderList td,  #orderList th
		{
			border: 1px solid #B9B9B9;
			border-collapse: collapse;
			padding: 10px 15px;
		}
	</style>
	<script type="text/javascript">
		$(document).ready(function()
		{
			$('#orderList').DataTable();
		});
	</script>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="DataTables/jQuery-3.6.0/jquery-3.6.0.js"></script>
	<link rel="stylesheet" type="text/css" href="DataTables/datatables.css" />
	<script type="text/javascript" src="DataTables/datatables.js"></script>

	<div class="container">
		<h3>Customer profile</h3>
		<hr>
		<table align="center" id="customerInfo">
			<tr>
				<td><b>Customer name:</b></td>
				<td><?php echo $CustomerArr['CustomerName'] ?></td>
			</tr>
			<tr>
				<td><b>Customer gender:</b></td>
				<td><?php echo $CustomerArr['CustomerGender'] ?></td>
			</tr>
			<tr>
				<td><b>Customer phone:</b></td>
				<td><?php echo $CustomerArr['CustomerPhone'] ?></td>
			</tr>
			<tr>
				<td><b>Customer email:</b></td>
				<td><?php echo $CustomerArr['CustomerEmail'] ?></td>
			</tr>
			<tr>
				<td><b>Customer address:</b></td>
				<td><?php echo $CustomerArr['CustomerAddress'] ?></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<button id="update">
						<a href="updateCustomer.php">Update customer information</a>
					</button>
				</td>
			</tr>
		</table>
		<a href="furnitureDisplay.php?">Go back to furniture display page.</a>
	</div>

	<div class="table-responsive" style="padding: 20px">
		<h3>Order List</h3>
		<hr>
		<table id="orderList" class="display" style="width: 100%;">
			<thead>
				<tr>
					<th>Order ID</th>
					<th>Order Date</th>
					<th>Receiver Name</th>
					<th>Receiver Phone</th>
					<th>Receiver Email</th>
					<th>Receiver Address</th>
					<th>Delivery Estimate</th>
					<th>Payment Type</th>
					<th>Order Status</th>
					<th>Delivery Status</th>
					<th>Payment Status</th>
					<th>Order Details</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$query = "SELECT o.*, p.PaymentType, p.PaymentStatus FROM Orders o, Payment p 
					WHERE o.PaymentID = p.PaymentID AND o.CustomerID='$CustomerID'";
				$ret = mysqli_query($connection, $query);
				$count = mysqli_num_rows($ret);
				for ($i=0; $i < $count; $i++) 
				{ 
					$row = mysqli_fetch_array($ret);
					echo "<tr>";
					$OrderID = $row['OrderID'];
					echo "<td>".$row['OrderID']."</td>";
					echo "<td>".$row['OrderDate']."</td>";
					echo "<td>".$row['ReceiverName']."</td>";
					echo "<td>".$row['ReceiverPhone']."</td>";
					echo "<td>".$row['ReceiverEmail']."</td>";
					echo "<td>".$row['ReceiverAddress']."</td>";
					echo "<td>".$row['DeliveryEstimate']."</td>";
					echo "<td>".$row['PaymentType']."</td>";
					$OrderStatus = $row['OrderStatus'];
					$DeliStatus = $row['DeliveryStatus'];
					$PayStatus = $row['PaymentStatus'];
					if($OrderStatus == "CONFIRMED")
					{
						echo "<td style='color:green'><b>".$OrderStatus."</b></td>";
					}
					else
					{
						echo "<td style='color:red'><b>".$OrderStatus."</b></td>";
					}
					if($DeliStatus == "DONE")
					{
						echo "<td style='color:green'><b>".$DeliStatus."</b></td>";
					}
					else
					{
						echo "<td style='color:red'><b>".$DeliStatus."</b></td>";
					}
					if($PayStatus == "PAID")
					{
						echo "<td style='color:green'><b>".$PayStatus."</b></td>";
					}
					else
					{
						echo "<td style='color:red'><b>".$PayStatus."</b></td>";
					}
					echo "<td><a href='customerOrderDetails.php?OrderID=$OrderID'>Details</a>";
					echo "</tr>";
				}
			 ?>
			</tbody>
		</table>
	</div>
</body>
</html>
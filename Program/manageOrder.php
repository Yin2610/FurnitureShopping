<?php 
include('connect.php');
include('AutoID_Functions.php');
include('shoppingCartFunctions.php');
include('staffHeader.php');
if (!isset($_SESSION['SID'])) 
{
	echo "<script>window.alert('Please login first.')</script>";
	echo "<script>window.location='staffLogin.php'</script>";
}
if(isset($_POST['btnSearch'])) 
{
	$rdoSearchType=$_POST['rdoSearchType'];

	if($rdoSearchType == 1) 
	{
		$cboOrderID=$_POST['cboOrderID'];

		$query = "SELECT o.*, p.PaymentType, p.PaymentStatus 
		FROM Orders o, Payment p 
		WHERE o.PaymentID = p.PaymentID
		AND o.OrderID = '$cboOrderID'";
		$ret=mysqli_query($connection,$query);
	}
	else
	{
		$From=date('Y-m-d',strtotime($_POST['txtFrom']));
		$To=date('Y-m-d',strtotime($_POST['txtTo']));

		$query = "SELECT o.*, p.PaymentType, p.PaymentStatus 
		FROM Orders o, Payment p 
		WHERE o.PaymentID = p.PaymentID
		AND o.OrderDate BETWEEN '$From' AND '$To'";
		$ret=mysqli_query($connection,$query);
	}
}
elseif (isset($_POST['btnShowall'])) 
{
	$query = "SELECT o.*, p.PaymentType, p.PaymentStatus FROM Orders o, Payment p 
				WHERE o.PaymentID = p.PaymentID";
	$ret = mysqli_query($connection, $query);
}
else
{
	$Today=date('Y-m-d');

	$query = "SELECT o.*, p.PaymentType, p.PaymentStatus 
				FROM Orders o, Payment p 
				WHERE o.PaymentID = p.PaymentID
				AND o.OrderDate = '$Today'";
	$ret=mysqli_query($connection,$query);
}

?>
<style type="text/css">
	#orderList, #orderList td,  #orderList th
	{
		border: 1px solid #B9B9B9;
		padding: 10px 15px;
		border-collapse: collapse;
	}
	#searchOptions td
	{
		padding: 20px;
	}
</style>
<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/jQuery-3.6.0/jquery-3.6.0.js"></script>
<script type="text/javascript" src="DatePicker/datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="DatePicker/datepicker.css">
<link rel="stylesheet" type="text/css" href="DataTables/datatables.css" />
<script type="text/javascript" src="DataTables/datatables.js"></script>
<script type="text/javascript">
	$(document).ready(function()
	{
		$('#orderList').DataTable();
	});
</script>

<title>Order Management</title>
<div style="padding: 20px">
	<form action="manageOrder.php" method="post">
	<fieldset>
	<h3>Order List</h3>
	<hr>
	<table id="searchOptions">
	<tr>
		<td>
			<input type="radio" name="rdoSearchType" value="1" checked> Search by ID: 
			<select name="cboOrderID">
				<option>--Choose OID--</option>
				<?php  
				$O_query="SELECT * FROM Orders";
				$O_ret=mysqli_query($connection, $O_query);
				$O_count=mysqli_num_rows($O_ret);
				for ($i=0;$i<$O_count;$i++) 
				{ 
					$O_arr=mysqli_fetch_array($O_ret);
					$OrderID=$O_arr['OrderID'];
					echo "<option value='$OrderID' >$OrderID</option>";
				}
				?>
			</select>
			</td>
		</tr>
		<tr>
			<td>
			<input type="radio" name="rdoSearchType" value="2"> Search by Date: 
			From <input type="text" name="txtFrom" value="<?php echo date('Y-m-d') ?>" onClick="showCalender(calender,this)">
			to <input type="text" name="txtTo" value="<?php echo date('Y-m-d') ?>" onClick="showCalender(calender,this)">
		</td>
	</tr>
	</table>
	<div style="margin-bottom: 2px">
	<input type="submit" name="btnSearch" value="Search" style="margin: 0 20px">
	<input type="submit" name="btnShowall" value="Show All">
	</div>
	<br>
	<a href="staffHome.php">Go back to staff home page.</a>
</form>
<hr>
<?php 
$count = mysqli_num_rows($ret);

if($count < 1) 
{
	echo "<p>No Record Found for today.</p>";
}
else
{
 ?>
<div class="table-responsive">
	<table id="orderList" class="display" style="width: 100%;">
		<thead>
			<hr>
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
				echo "<td><a href='orderDetails.php?OrderID=$OrderID'>Details</a>";
				echo "</tr>";
			}
		}
	?>
		</tbody>
	</table>
</div>
</div>
</body>
</html>
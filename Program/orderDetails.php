<?php  
include('connect.php');
include('AutoID_Functions.php');
include('shoppingCartFunctions.php');
include('staffHeader.php');

$OrderID=$_GET['OrderID'];

$StatusCol = "";
$StatusVal = "";

if(isset($_POST['btnOrderConfirm'])) 
{
	$StatusCol = "OrderStatus";
	$StatusVal = "CONFIRMED";
}
if(isset($_POST['btnDeliConfirm'])) 
{
	$StatusCol = "DeliveryStatus";
	$StatusVal = "DONE";
}
if(isset($_POST['btnPayConfirm']))
{
	$StatusCol = "PaymentStatus";
	$StatusVal = "PAID";
	$UpdateStatus="UPDATE Payment
				   SET PaymentStatus='PAID'
				   WHERE OrderID='$OrderID' 
				  ";
	$ret=mysqli_query($connection,$UpdateStatus);
	if($ret) 
	{
		echo "<script>window.alert('Status updated!')</script>";
	}
	else
	{
		echo "<p>Something went wrong in OrderDetails :" . mysqli_error($connection) . "</p>";
	}
}
if(isset($_POST['btnOrderConfirm']) OR isset($_POST['btnDeliConfirm']))
{
	$UpdateStatus="UPDATE Orders
			   SET $StatusCol='$StatusVal'
			   WHERE OrderID='$OrderID'
			  ";
	$ret=mysqli_query($connection,$UpdateStatus);
	if($ret) 
	{
		echo "<script>window.alert('Status updated!')</script>";
	}
	else
	{
		echo "<p>Something went wrong in OrderDetails :" . mysqli_error($connection) . "</p>";
	}
}

//Query 1 Single Data -----------------------------------------------------------------
$Query1="SELECT o.*,c.CustomerID,c.CustomerName, p.*
		 FROM Orders o,Customer c, Payment p
		 WHERE o.OrderID='$OrderID'
		 AND o.CustomerID=c.CustomerID
		 AND o.PaymentID = p.PaymentID
		";
$ret1=mysqli_query($connection,$Query1);
$row1=mysqli_fetch_array($ret1);

//print_r($row1);

//Query 2 Repeat Data -----------------------------------------------------------------
$Query2="SELECT o.*, fo.*, f.FurnitureID,f.FurnitureName
		 FROM Orders o, FurnitureOrder fo, Furniture f
		 WHERE o.OrderID='$OrderID'
		 AND o.OrderID=fo.OrderID
		 AND fo.FurnitureID=f.FurnitureID
		";
$ret2=mysqli_query($connection,$Query2);
$count=mysqli_num_rows($ret2);		
//-------------------------------------------------------------------------------------
?>
<title>Order Details</title>
<style type="text/css">
	.borderTable, .borderTable td, .borderTable th
	{
		border: 2px solid #e2e2e2;
		padding: 5px;
	}
	.bgTableHead
	{
		background: #4f81be; 
		color: white;
		text-align: center;
	}
	@media screen and (min-width: 400px)
	{
		#deliverytable 
		{
			margin-left: 15px !important;
		}
	}
	@media screen and (min-width: 1400px)
	{
		#deliverytable 
		{
			margin-left: 100px !important;
		}
	}
</style>
<link rel="stylesheet" type="text/css" href="style.css">
<div class="container" style="padding: 0 50px;">
<form action="orderDetails.php" method="post" class="form-margin-top">
	<h3>Order details for : <?php echo $OrderID ?></h3>
	<hr>
	<table style="width: 100%" class="borderTable">
		<thead align="center" class="bgTableHead">
		<th>Order date</th>
		<th>Buyer name</th>
		<th>Order status</th>
		<th>Delivery status</th>
		<th>Payment status</th>
		</thead>
		<tbody align="center">
		<td><?php echo $row1['OrderDate'] ?></td>
		<td><?php echo $row1['CustomerName'] ?></td>
		<?php 
		$OrderStatus = $row1['OrderStatus'];
		$DeliStatus = $row1['DeliveryStatus'];
		$PayStatus = $row1['PaymentStatus'];
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
	?>
		</tbody>
	</table>		
	<div class="row justify-content-center" style="margin-top: 40px; padding: 10px;">
	<table class="col-sm-4 borderTable" cellpadding="5px">
		<th colspan="2" class="bgTableHead">Receiver information</th>
		<tr>
			<td>Receiver name</td>
			<td>
			<?php echo $row1['ReceiverName']; ?></b>
			</td>
		</tr>
		<tr>
			<td>Receiver phone</td>
			<td>
			<?php echo $row1['ReceiverPhone']; ?></b>
			</td>
		</tr>
		<tr>
			<td>Receiver email</td>
			<td>
			<?php echo $row1['ReceiverEmail']; ?></b> 
			</td>
		</tr>
		<tr>
			<td>Receiver address</td>
			<td>
			<?php echo $row1['ReceiverAddress'] ?></b>		
			</td>
		</tr>
	</table>
	<table class="col-sm-4 borderTable" id="deliverytable" cellpadding="5px">
		<th colspan="2" align="center" class="bgTableHead">Delivery & Payment information</th>
		<tr>
			<td>Delivery estimate</td>
			<td>
			<?php echo $row1['DeliveryEstimate']; ?></b>
			</td>
		</tr>
		<tr>
			<td>Payment type</td>
			<td>
			<?php echo $row1['PaymentType']; ?></b>
			</td>
		</tr>
		<?php 
		$PaymentType = $row1['PaymentType'];
		if($PaymentType == "CARD")
		{
			echo "<tr>
					<td>Credit card type</td>
					<td>
					".$row1['CreditCardType']."
					</td>
				</tr>
				<tr>
					<td>Credit card no</td>
					<td>
					". $row1['CreditCardNo']."
					</td>
				</tr>";
		}
		elseif($PaymentType == "KPAY" || $PaymentType == "WAVEPAY")
		{
			echo "<tr>
					<td>Pay phone no</td>
					<td>
					". $row1['PayPhoneNo']."
					</td>
				</tr>
				<tr>
					<td>Transaction no</td>
					<td>
					". $row1['TransactionNo']."
					</td>
				</tr>";
		}
		?>
	</table>
	</div>
</table>
	<table style="width: 100%;" cellpadding="5px" class="borderTable">
	<h4 style=" margin-top: 70px">Ordered furniture</h4>
	<tr style="text-align: center;" class="bgTableHead">
		<th>No</th>
		<th>FurnitureID</th>
		<th>FurnitureName</th>
		<th>Quantity (pcs)</th>
		<th>Price (mmk)</th>
		<th>Sub-Total (mmk)</th>
	</tr>
	<?php  

		for ($i=0;$i<$count;$i++) 
		{ 
			$row2=mysqli_fetch_array($ret2);

			echo "<tr style='text-align: center;'>";
				echo "<td>" . ($i+1) . "</td>";
				echo "<td>". $row2['FurnitureID'] ."</td>";
				echo "<td>". $row2['FurnitureName'] ."</td>";
				echo "<td>". $row2['OrderSubQuantity'] ."</td>";
				echo "<td>". $row2['OrderSubPrice'] ."</td>";
				echo "<td>". $row2['OrderSubQuantity'] * $row2['OrderSubPrice'] ."</td>";
			echo "</tr>";
		}
	?>
	</table>

<table style="width: 100%; margin-bottom: 30px" cellpadding="5px">
<tr>
	<td colspan="4" align="right">
		Total quantity :  <?php echo $row1['TotalQuantity'] ?> pcs</b>
		<br>
		Grand total :  <?php echo $row1['GrandTotal'] ?> mmk</b>
		<br>
		VAT (5%) :  <?php echo $row1['VAT'] ?> mmk</b>
		<br>
		<br>
		<?php  
		if($row1['OrderStatus'] == "CONFIRMED") 
		{
			echo "<input type='submit' name='btnOrderConfirm' class='btnOrderConfirm' value='Order confirmed' disabled />";
		}
		else
		{
			echo "<input type='submit' name='btnOrderConfirm' class='btnOrderConfirm' value='Confirm pending order' formaction='orderDetails.php?OrderID=$OrderID'/>";
		}
		if($row1['DeliveryStatus'] == "DONE") 
		{
			echo "<input type='submit' name='btnDeliConfirm' class='btnDeliConfirm' value='Delivery finished' style='margin-left: 20px'  disabled />";
		}
		else
		{
			echo "<input type='submit' name='btnDeliConfirm' class='btnDeliConfirm' value='Confirm finished delivery' style='margin-left: 20px'  formaction='orderDetails.php?OrderID=$OrderID'/>";
		}
		if($row1['PaymentStatus'] == "PAID") 
		{
			echo "<input type='submit' name='btnPayConfirm' class='btnPayConfirm' value='Payment finished' style='margin-left: 20px' disabled/>";
		}
		else
		{
			echo "<input type='submit' name='btnPayConfirm' class='btnPayConfirm' value='Confirm finished payment' style='margin-left: 20px' formaction='orderDetails.php?OrderID=$OrderID'/>";
		}
		?>
		<div align="left"><a href="manageOrder.php">Go back to order list.</div>
	</td>
</tr>
</table>
</form>
</div>
</body>
</html>
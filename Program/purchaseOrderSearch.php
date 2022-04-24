<?php  
session_start();
include('connect.php');
include('staffHeader.php');
include('AutoID_Functions.php');
include('purchaseFunctions.php');

if(isset($_POST['btnSearch'])) 
{
	$rdoSearchType=$_POST['rdoSearchType'];

	if($rdoSearchType == 1) 
	{
		$cboPurchaseID=$_POST['cboPurchaseID'];

		$query="SELECT p.*, s.SupplierID,s.SupplierName
				FROM purchase p, supplier s
				WHERE purchaseID='$cboPurchaseID'
				AND p.SupplierID=s.SupplierID 
				";
		$ret=mysqli_query($connection,$query);
	}
	else
	{
		$From=date('Y-m-d',strtotime($_POST['txtFrom']));
		$To=date('Y-m-d',strtotime($_POST['txtTo']));

		$query="SELECT p.*, s.SupplierID,s.SupplierName
				FROM purchase p, supplier s
				WHERE purchaseDate BETWEEN '$From' AND '$To'
				AND p.SupplierID=s.SupplierID 
				";
		$ret=mysqli_query($connection,$query);
	}
}
elseif (isset($_POST['btnShowall'])) 
{
	$query="SELECT p.*, s.SupplierID,s.SupplierName
			FROM purchase p, supplier s
			WHERE p.SupplierID=s.SupplierID 
			";
	$ret=mysqli_query($connection,$query);
}
else
{
	$Today=date('Y-m-d');

	$query="SELECT p.*, s.SupplierID,s.SupplierName
			FROM Purchase p, Supplier s
			WHERE p.PurchaseDate='$Today'
			AND p.SupplierID=s.SupplierID 
			";
	$ret=mysqli_query($connection,$query);
}
?>


<title>Purchase Search</title>
<style type="text/css">
	#searchOptions td
	{
		padding: 20px;
	}
	#purchaseList, #purchaseList td,  #purchaseList th
	{
		border: 1px solid #B9B9B9;
		border-collapse: collapse;
		padding: 10px 15px;
	}
</style>
<script type="text/javascript" src="DatePicker/datepicker.js"></script>
<link rel="stylesheet" type="text/css" href="DatePicker/datepicker.css">
<form action="purchaseOrderSearch.php" method="post">
<fieldset style="padding: 20px">
<h3>Purchase Order Search</h3>
<hr>
<table id="searchOptions">
<tr>
	<td>
		<input type="radio" name="rdoSearchType" value="1" checked> Search by ID: 
		<select name="cboPurchaseID">
			<option>--Choose PID--</option>
			<?php  
			$P_query="SELECT * FROM purchase";
			$P_ret=mysqli_query($connection,$P_query);
			$P_count=mysqli_num_rows($P_ret);

			for ($i=0;$i<$P_count;$i++) 
			{ 
				$P_arr=mysqli_fetch_array($P_ret);
				$PurchaseID=$P_arr['PurchaseID'];
				echo "<option value='$PurchaseID' >$PurchaseID</option>";
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
$count=mysqli_num_rows($ret);

if($count < 1) 
{
	echo "<p>No Record Found for today.</p>";
}
else
{
?>
<div class="table-responsive">
	<table border="1" style="border-collapse: collapse;" width="100%" id="purchaseList">
		<tr>
			<th>No.</th>
			<th>PID</th>
			<th>Purchase Date</th>
			<th>SupplierName</th>
			<th>Total Amount</th>
			<th>Total Quantity</th>
			<th>VAT</th>
			<th>Grand Total</th>
			<th>Action</th>
		</tr>
		<?php 
		for($i=0;$i<$count;$i++) 
		{ 
			$row=mysqli_fetch_array($ret);
			$PID=$row['PurchaseID'];

			echo "<tr>";
				echo "<td>" . ($i+1) . "</td>";
				echo "<td>". $PID ."</td>";
				echo "<td>". $row['PurchaseDate'] ."</td>";
				echo "<td>". $row['SupplierName'] ."</td>";
				echo "<td>". $row['TotalAmount'] ."</td>";
				echo "<td>". $row['TotalQuantity'] ."</td>";
				echo "<td>$". $row['TaxAmount'] ."</td>";
				echo "<td>$". $row['GrandTotal'] ."</td>";
				echo "<td> 
						<a href='purchaseOrderDetails.php?PID=$PID'>Details</a> 
					  </td>";
			echo "</tr>";
		}
		?>
	</table>
</div>	
<?php
}
?>
<hr/>
</fieldset>
</body>
</html>
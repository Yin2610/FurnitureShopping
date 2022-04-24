<?php  
session_start();
include('connect.php');
include('AutoID_Functions.php');
include('purchaseFunctions.php');
include('staffHeader.php');
if(isset($_POST['btnConfirm'])) 
{	
	$txtPurchaseID=$_POST['txtPurchaseID'];

	$result=mysqli_query($connection,"SELECT * FROM furniturepurchase WHERE PurchaseID='$txtPurchaseID'");

	while($arr=mysqli_fetch_array($result)) 
	{
		$FurnitureID=$arr['FurnitureID'];
		$PurchaseSubQuantity=$arr['PurchaseSubQuantity'];

		$UpdateQuantity="UPDATE Furniture
						 SET Quantity = Quantity + '$PurchaseSubQuantity' 
						 WHERE FurnitureID='$FurnitureID'
						";
		$ret=mysqli_query($connection,$UpdateQuantity);
	}

	$UpdateStatus="UPDATE purchase
				   SET PurchaseStatus='CONFIRMED'
				   WHERE PurchaseID='$txtPurchaseID' 
				  ";
	$ret=mysqli_query($connection,$UpdateStatus);

	if($ret) 
	{
		echo "<script>window.alert('Purchase Order Successfully Confirmed!')</script>";
		echo "<script>window.location='purchaseOrderDetails.php?PID=$txtPurchaseID'</script>";
	}
	else
	{
		echo "<p>Something went wrong in purchase order details :" . mysqli_error($connection) . "</p>";
	}
}

$PurchaseID=$_GET['PID'];

//Query 1 Single Data -----------------------------------------------------------------
$Query1="SELECT pur.*,s.SupplierID,s.SupplierName,st.StaffID,st.StaffName
		 FROM purchase pur,supplier s,staff st
		 WHERE pur.PurchaseID='$PurchaseID'
		 AND pur.SupplierID=s.SupplierID
		 AND pur.StaffID=st.StaffID	
		";
$ret1=mysqli_query($connection,$Query1);
$row1=mysqli_fetch_array($ret1);

//Query 2 Repeat Data -----------------------------------------------------------------
$Query2="SELECT pur.*, fp.*, f.FurnitureID, f.FurnitureName
		 FROM purchase pur, furniturepurchase fp, furniture f
		 WHERE pur.PurchaseID='$PurchaseID'
		 AND pur.PurchaseID=fp.PurchaseID
		 AND fp.FurnitureID=f.FurnitureID
		";
$ret2=mysqli_query($connection,$Query2);
$count=mysqli_num_rows($ret2);		
//-------------------------------------------------------------------------------------
?>
<title>Purchase Order Details</title>
<style type="text/css">
	.purchaseTable, .furnitureTable
	{
		margin-bottom: 20px;
	}
	.purchaseTable td, .furnitureTable, .furnitureTable th, .furnitureTable td
	{
		border: 1px solid #e2e2e2;
	}
	.purchaseTable tr td:nth-child(odd), .furnitureTable th
	{
		background: #4f81be;
		color: white;
		font-weight: bold;
	}
</style>
<link rel="stylesheet" type="text/css" href="style.css">
<div class="container"> 
	<form action="purchaseOrderDetails.php" method="post" class="form-margin-top">
	<h3>Purchase Order Details for : <?php echo $PurchaseID ?></h3>
	<hr>
	<table width="100%" cellpadding="10px" align="center" class="purchaseTable">
		<tr>
			<td>Purchase ID :</td>
			<td>
				<?php echo $row1['PurchaseID'] ?>
			</td>
			<td>Purchase Status :</td>
			<?php 
			$PurchaseStatus = $row1['PurchaseStatus'];
			if($PurchaseStatus == "CONFIRMED")
			{
				echo "<td style='color: green'><b>".$PurchaseStatus."</b></td>";
			}
			else
			{
				echo "<td style='color: red'><b>".$PurchaseStatus."</b></td>";
			}
			 ?>
		</tr>
		<tr>
			<td>Purchase Date :</td>
			<td>
				<?php echo $row1['PurchaseDate'] ?>		
			</td>
			<td>Report Date :</td>
			<td>
				<?php echo date('Y-m-d') ?>
			</td>
		</tr>
		<tr>
			<td>Supplier Info :</td>
			<td>
				<?php echo $row1['SupplierName'] ?>		
			</td>
			<td>Staff Info :</td>
			<td>
				<?php echo $row1['StaffName'] ?>
			</td>
		</tr>
	</table>
	<table>
		<table width="100%" style="border-collapse:collapse;" cellpadding="10px" class="furnitureTable">
		<tr>
			<th>No.</th>
			<th>Furniture ID</th>
			<th>Furniture Name</th>
			<th>Sub Price</th>
			<th>Sub Quantity</th>
			<th>Sub Total</th>
		</tr>
		<?php  

			for ($i=0;$i<$count;$i++) 
			{ 
				$row2=mysqli_fetch_array($ret2);

				echo "<tr>";
					echo "<td>" . ($i+1) . "</td>";
					echo "<td>". $row2['FurnitureID'] ."</td>";
					echo "<td>". $row2['FurnitureName'] ."</td>";
					echo "<td>". $row2['PurchaseSubPrice'] ."</td>";
					echo "<td>". $row2['PurchaseSubQuantity'] ."</td>";
					echo "<td>". $row2['PurchaseSubPrice'] * $row2['PurchaseSubQuantity'] ."</td>";
				echo "</tr>";
			}
		?>
		</table>
		<table align="right" width="300px" cellpadding="5px">
			<tr align="right">
				<td>Total Quantity : </td>
				<td><?php echo $row1['TotalQuantity'] ?> pcs</td>
			</tr>
			<tr align="right">
				<td>
					Total Amount : $
				</td>
				<td><?php echo $row1['TotalAmount'] ?></td>
			</tr>
			<tr align="right">
		 		<td>VAT (5%) : $</td>
		 		<td><?php echo $row1['TaxAmount'] ?></td>
			</tr>
			<tr align="right">
				<td>Grand Total : $</td>
				<td><?php echo $row1['GrandTotal'] ?></td>
			</tr>
			
			<input type="hidden" name="txtPurchaseID" value="<?php echo $row1['PurchaseID'] ?>"/>
			<tr align="right">
				<td colspan="2">
					<?php  
					if($row1['PurchaseStatus'] !== 'PENDING') 
					{
						echo "<input type='submit' name='btnConfirm' value='Confirmed purchase' disabled />";
					}
					else
					{
						echo "<input type='submit' name='btnConfirm' value='Confirm Purchase' />";
					}
					?>
				</td>
			</tr>
		</table>
		<div style="clear: both"><a href="PurchaseOrderSearch.php">Go back to purchase order search.</a></div>
	</form>
</div>
</body>
</html>
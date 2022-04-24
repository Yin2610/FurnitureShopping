<?php 
session_start();
include('connect.php');
include('purchaseFunctions.php');
include('AutoID_Functions.php');
include('staffHeader.php');
if (isset($_SESSION['SID'])) 
{
	$StaffID = $_SESSION['SID'];
}
else
{
	echo "<script>window.alert('Please login first.')</script>";
	echo "<script>window.location='staffLogin.php'</script>";
}
if (isset($_POST['btnAdd'])) 
{
	$FurnitureID = $_POST['cboFurniture'];
	$PurchasePrice = $_POST['txtPrice'];
	$PurchaseQuantity = $_POST['txtQuantity'];
	AddFurniture($FurnitureID, $PurchasePrice, $PurchaseQuantity);
}
if(isset($_GET['action']))
{
	$action = $_GET['action'];
	if($action === 'remove')
	{
		$FurnitureID = $_GET['FurnitureID'];
		RemoveProduct($FurnitureID);
	}
	elseif ($action === 'clearall') 
	{
		ClearAll();
	}
}

if(isset($_POST['btnPurchase'])) 
{
	$txtPID=$_POST['txtPID'];
	$txtPDate= date("Y-m-d", strtotime($_POST['txtPDate']));
	$txtTotalAmount=$_POST['txtTotalAmount'];
	$txtTotalQuantity=$_POST['txtTotalQuantity'];
	$txtVAT=$_POST['txtVAT'];
	$txtGrandTotal=$_POST['txtGrandTotal'];
	$cboSupplierID=$_POST['cboSupplier'];
	if($txtPDate == "1970-01-01")
	{
		echo "<script>alert('Please enter purchase date.')</script>";
	}
	elseif($cboSupplierID == "Choose supplier")
	{
		echo "<script>alert('Please choose supplier.')</script>";
	}
	else
	{
		$StaffID=$_SESSION['SID'];

		//Insert Purchase (1)
		$insertPurchase="INSERT INTO purchase VALUES
						('$txtPID','$txtPDate','$txtTotalAmount','$txtTotalQuantity','$txtVAT','$txtGrandTotal', 'PENDING', '$cboSupplierID','$StaffID')
		 				";
		$ret=mysqli_query($connection,$insertPurchase);

		//Insert furniturePurchase (*)
		$size=count($_SESSION['Purchase_Functions']);

		for ($i=0;$i<$size;$i++) 
		{ 
			$FurnitureID=$_SESSION['Purchase_Functions'][$i]['FurnitureID'];
			$PurchaseQuantity=$_SESSION['Purchase_Functions'][$i]['PurchaseQuantity'];
			$PurchasePrice=$_SESSION['Purchase_Functions'][$i]['PurchasePrice'];

			$InsertPDetails="INSERT INTO `furniturePurchase`
							(`PurchaseID`, `FurnitureID`, `PurchaseSubQuantity`, `PurchaseSubPrice`) 
							VALUES
							('$txtPID','$FurnitureID','$PurchaseQuantity','$PurchasePrice')
							";
			$ret=mysqli_query($connection,$InsertPDetails);			
		}

		if($ret) 
		{
			echo "<script>window.alert('Purchase order successfully saved!')</script>";
			unset($_SESSION['Purchase_Functions']);
			echo "<script>window.location='purchaseOrder.php'</script>";
		}
		else
		{
			echo "<p>Something went wrong in purchasing order :" . mysqli_error($connection) . "</p>";
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Order Furniture</title>
	<style type="text/css">
		.firstTable
		{
			float: right;
			border: 1px solid black; 
			padding: 20px;  
		}
		.firstTable td, .secondTable td
		{
			padding: 2px 5px;
		}
		.secondTable
		{
			clear: both;
			margin-top: 100px;
		}
		.lastTable
		{
			margin-bottom: 30px;
		}
		.lastTable td
		{
			padding: 2px 10px;
		}
		.btnPurchase
		{
			margin: 0 10px;
		}
		#purchaseList, #purchaseList td,  #purchaseList th
		{
			border: 1px solid #B9B9B9;
			padding: 10px 15px;
			border-collapse: collapse;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="DatePicker/datepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="DatePicker/datepicker.css">
	<script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>
	<div class="container">
	<form action="purchaseOrder.php" method="POST" class="addForm form-margin-top">
	<h3>Purchase From Suppliers</h3>
	<hr>
		<table align="right">
			<tr>
				<td>Purchase ID:</td>
				<td>
					<input type="text" name="txtPID" value="<?php echo AutoID('FurniturePurchase', 'PurchaseID', 'PF-', 5)?>" class="form-control" readonly/>
				</td>
			</tr>
			<tr>
				<td>Staff name:</td>
				<td>
					<input type="text" name="txtStaff" value="<?php echo $_SESSION['SName'] ?>" class="form-control" readonly>
				</td>
			</tr>
		</table>
				<table class="secondTable">
			<tr>
				<td>Furniture name:</td>
				<td>
					<select name="cboFurniture" class="form-control" required="required">
						<option>Choose furniture</option>
						<?php 
							$selectFurniture = "SELECT * FROM Furniture";
							$selectFurnitureRun = mysqli_query($connection, $selectFurniture);
							$countSelectFurniture = mysqli_num_rows($selectFurnitureRun);
							for ($i=0; $i < $countSelectFurniture; $i++) 
							{ 
								$Farr = mysqli_fetch_array($selectFurnitureRun);
								$Furniture_ID = $Farr['FurnitureID'];
								$Furniture_Name = $Farr['FurnitureName'];
								echo "<option value='$Furniture_ID'>$Furniture_Name</option>";
							}
						 ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Purchase quantity (pcs):</td>
				<td>
					<input type="number" name="txtQuantity" class="form-control">
				</td>
				
			</tr>
			<tr>
				<td>Unit price ($):</td>
				<td><input type="number" name="txtPrice" class="form-control"></td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input type="submit" name="btnAdd" value="Add to list" class="form-button">
				</td>
			</tr>
		</table>
		<a href="staffHome.php">Go back to staff home page.</a>
	</div>
	<hr>
	<fieldset style="padding: 20px">
	<?php 
	if(!isset($_SESSION['Purchase_Functions']))
	{
		echo "<p>No purchase record found.</p>";
		exit();
	}
	elseif(count($_SESSION['Purchase_Functions']) == 0)
	{
		echo "<p>No purchase record found.</p>";
		exit();
	}
	else
	{
	 ?>
	<div class="table-responsive">
	<table id="purchaseList" class="display" border="1px" style="width: 100%">
		<thead>
			<h3>Purchase list</h3>
		<tr>
			<th>Furniture ID</th>
			<th>Furniture name</th>
			<th>Furniture image</th>
			<th>Unit price</th>
			<th>Quantity</th>
			<th>Subtotal</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php 
	 		$size = count($_SESSION['Purchase_Functions']);
	 		for ($i=0; $i < $size; $i++)
	 		{ 
	 			$FurnitureImage1 = $_SESSION['Purchase_Functions'][$i]['FurnitureImage1'];
	 			$FurnitureID = $_SESSION['Purchase_Functions'][$i]['FurnitureID'];
	 			echo "<tr>";
	 			echo "<td>".$_SESSION['Purchase_Functions'][$i]['FurnitureID']."</td>";
	 			echo "<td>".$_SESSION['Purchase_Functions'][$i]['FurnitureName']."</td>";
	 			echo "<td><img src='$FurnitureImage1' width='80px' height='80px'/></td>";
	 			echo "<td>$".$_SESSION['Purchase_Functions'][$i]['PurchasePrice']."</td>";
	 			echo "<td>".$_SESSION['Purchase_Functions'][$i]['PurchaseQuantity']." pcs</td>";
	 			echo "<td>$".$_SESSION['Purchase_Functions'][$i]['PurchasePrice']*$_SESSION['Purchase_Functions'][$i]['PurchaseQuantity']."</td>";
	 			echo "<td>
	 			<a href='purchaseOrder.php?FurnitureID=$FurnitureID&action=remove'>Remove</a>
	 			</td>";
	 			echo "</tr>";
	 		}
 	 ?>
	</tbody>
	</table>
	</div>
	</fieldset>
	<?php 
	}
	 ?>
	<hr>
	<table align="right" class="lastTable">
		<tr>
			<td>Total quantity (pcs):</td>
			<td><input type="text" name="txtTotalQuantity" value="<?php echo CalculateTotalQuantity() ?>" class="form-control" readonly /></td>		
			</tr>
		<tr>
			<td>Total amount ($):</td>
			<td>
			<input type="text" name="txtTotalAmount" value="<?php echo CalculateTotalAmount() ?>" class="form-control" readonly /></td>
		</tr>
		<tr>
			<td>VAT (5%):</td>
			<td>
				<input type="text" name="txtVAT" value="<?php echo CalculateTotalAmount() * 0.05 ?>" class="form-control" readonly />
			</td>
		</tr>
		<tr>
			<td>Grand total ($):</td>
			<td>
				<input type="text" name="txtGrandTotal" value="<?php echo CalculateTotalAmount() * 0.05 + CalculateTotalAmount() ?>" class="form-control" readonly />
			</td>
		</tr>
		<tr>
			<td>Choose purchase date:</td>
			<td>
				<input type="text" name="txtPDate" onClick="showCalender(calender,this)" placeholder="dd-mmm-yyyy" class="form-control">
			</td>	
		</tr>
		<tr>
			<td>Supplier name:</td>
			<td>
				<select name="cboSupplier" class="form-control">
				<option>Choose supplier</option>
				<?php 
					$selectSupplier = "SELECT * FROM Supplier";
					$runSelectSupplier = mysqli_query($connection, $selectSupplier);
					$countSupplier = mysqli_num_rows($runSelectSupplier);
					for ($i=0; $i < $countSupplier; $i++) 
					{ 
						$Sarray = mysqli_fetch_array($runSelectSupplier);
						$SupplierID = $Sarray['SupplierID'];
						$SupplierName = $Sarray['SupplierName'];
						echo "<option value='$SupplierID'>  $SupplierName ";
					}
				 ?>
			</select>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<button><a href="purchaseOrder.php?action=clearall" style="color: black; text-decoration: none;">
				Clear all
			</a></button>
				<input type="submit" class="btnPurchase form-button" name="btnPurchase" value="Purchase">
			</td>
		</tr>
	</table>
</form>
</body>
</html>
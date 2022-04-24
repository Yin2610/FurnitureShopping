<?php 
session_start();
include('connect.php');
include('staffHeader.php');
if(isset($_SESSION['SID']))
{
	if(isset($_POST['btnSubmit']))
	{
		$SupplierName = $_POST['txtSupplierName'];
		$SupplierEmail = $_POST['txtEmail'];
		$SupplierPhone = $_POST['txtPhone'];
		$SupplierAddress = $_POST['txtAddress'];
		$selectSupplier = "SELECT * FROM Supplier WHERE SupplierEmail = '$SupplierEmail'";
		$selectRun = mysqli_query($connection, $selectSupplier);
		$count = mysqli_num_rows($selectRun);
		if($count > 0)
		{
			echo "<script>window.alert('There is a supplier already registered with this email. Try another one.')</script>";
			echo "<script>window.location='supplierRegister.php'</script>";
		}
		else
		{
			$insertSupplier = "INSERT INTO Supplier(SupplierName, SupplierEmail, SupplierPhone,  SupplierAddress) VALUES('$SupplierName', '$SupplierEmail', '$SupplierPhone', '$SupplierAddress')";
			if($insertRun)
			{
				echo "<script>window.alert('Supplier registration successful.')</script>";
				echo "<script>window.location='supplierRegister.php'</script>";
			}
			else
			{
				echo "<script>window.alert('Supplier registration unsuccessful.')</script>";
				echo "<script>window.location='supplierRegister.php'</script>";
			}
		}
	}
}
 ?>
<title>Supplier Register</title>
<style type="text/css">
	#supplierList
	{
		border: 1px solid #B9B9B9;
		border-collapse: collapse;
	} 
	#supplierList td,  #supplierList th
	{
		border: 1px solid #B9B9B9;
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
		$('#supplierList').DataTable();
	});
</script>
<div class="container">
	<form action="supplierRegister.php" method="POST" class="form-margin-top">
		<h3>Supplier registration</h3>
		<hr>
		<table cellpadding="5px">
			<tr>
				<td>Supplier name: </td>
				<td><input type="text" name="txtSupplierName" class="form-control" required="required"></td>
			</tr>
			<tr>
				<td>Email: </td>
				<td><input type="email" name="txtEmail" required="required" class="form-control"></td>
			</tr>
			<tr>
				<td>Phone number: </td>
				<td><input type="text" name="txtPhone" required="required" class="form-control"></td>
			</tr>
			<tr>
				<td>Address: </td>
				<td>
					<textarea rows="5" cols="25" style="resize: none;" name="txtAddress" class="form-control" required="required"></textarea>
				</td>
			</tr>
			<tr>
				<td align="center" colspan="2"><input type="submit" name="btnSubmit" value="Submit" class="form-button"></td>
			</tr>
		</table>
		<a href="staffHome.php">Go back to staff home page.</a>
	</form>
</div>
<hr>
<fieldset style="padding: 20px">
	<legend>Supplier List</legend>
	<?php 
		$selectSupplier = "SELECT * FROM Supplier";
		$selectRun = mysqli_query($connection, $selectSupplier);
		$count = mysqli_num_rows($selectRun);
		if($count < 1)
		{
			echo "There is no supplier registered.";
		}
		else
		{
			echo "<div class='table-responsive'>";
			echo "<table id='supplierList' class='display' style='width: 100%;'>";
			echo "<thead>";
			echo "<tr style='text-align: center;'>";
			echo "<th>No.</th>";
			echo "<th>Supplier name</th>";
			echo "<th>Email</th>";
			echo "<th>Phone number</th>";
			echo "<th>Address</th>";
			echo "<th>Update Action</th>";
			echo "<th>Delete Action</th>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
		}
		for ($i=0; $i < $count ; $i++) 
		{ 
			$arr = mysqli_fetch_array($selectRun);
			$SupplierID = $arr['SupplierID'];
			$SupplierName = $arr['SupplierName'];
			$Email = $arr['SupplierEmail'];
			$PhoneNumber = $arr['SupplierPhone'];
			$Address = $arr['SupplierAddress'];
			echo "<tr align='center'>";
			echo "<td>".($i+1)."</td>";
			echo "<td>$SupplierName</td>";
			echo "<td>$Email</td>";
			echo "<td>$PhoneNumber</td>";
			echo "<td>$Address</td>";
			echo "<td>
			<button class='updateBtn'>
			<a href='updateSupplier.php?SupplierID=$SupplierID'>Update</a>
			</button>
			</td><td>
			<button class='deleteBtn'>
			<a href='deleteSupplier.php?SupplierID=$SupplierID'>Delete</a>
			</button>
			</td>";
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
	echo "</div>";
 ?>
</fieldset>
</body>
</html>
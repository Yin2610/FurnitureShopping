<?php 
session_start();
include('connect.php');
include('staffHeader.php');
if(isset($_SESSION['SID']))
{
	if(isset($_GET['SupplierID']))
	{
		$SupplierID = $_GET['SupplierID'];
		$selectSupplier = "SELECT s.* FROM Supplier s WHERE s.SupplierID = '$SupplierID'";
		$runSelectSupplier = mysqli_query($connection, $selectSupplier);
		$countSupplier = mysqli_num_rows($runSelectSupplier);
		$Sarr = mysqli_fetch_array($runSelectSupplier);
		if($countSupplier < 1)
		{
			echo "<script>window.alert('There is no supplier registered.')</script>";
			echo "<script>window.location='supplierRegister.php'</script>";
		}
	}
}
else
{
	echo "<script>window.alert('Please login first.')</script>";
	echo "<script>window.location='staffLogin.php'</script>";
}
if(isset($_POST['btnUpdate']))
{
	$SupplierID = $_POST['txtSupplierID'];
	$SupplierName = $_POST['txtSupplierName'];
	$SupplierEmail = $_POST['txtEmail'];
	$SupplierPhone = $_POST['txtPhone'];
	$SupplierAddress = $_POST['txtAddress'];
	$updateSupplier = "UPDATE Supplier 
					SET
					SupplierName = '$SupplierName',
					SupplierEmail = '$SupplierEmail',
					SupplierPhone = '$SupplierPhone',
					SupplierAddress = '$SupplierAddress'
					WHERE SupplierID = '$SupplierID'";
	$runUpdateSupplier = mysqli_query($connection, $updateSupplier);
	if($runUpdateSupplier)
	{
		echo "<script>window.alert('Supplier information updated successfully.')</script>";
		echo "<script>window.location='supplierRegister.php'</script>";
	}
	else
	{
		echo mysqli_error($connection);
		echo "<script>window.location='supplierRegister.php'</script>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Supplier</title>
	<script type="text/javascript">
		function setAddress()
		{
			var address = "<?php echo $Sarr['SupplierAddress'] ?>";
			document.getElementById('txtAddress').value = address;
		}
	</script>
</head>
<body onload="setAddress()">
<form action="updateSupplier.php" method="POST">
	<h1>Update supplier</h1>
	<table align="center">
		<tr>
			<td>Supplier name: </td>
			<input type="hidden" name="txtSupplierID" value="<?php echo $Sarr['SupplierID'] ?>">
			<td><input type="text" name="txtSupplierName" required="required" value="<?php echo $Sarr['SupplierName'] ?>"></td>
		</tr>
		<tr>
			<td>Email: </td>
			<td><input type="email" name="txtEmail" required="required" value="<?php echo $Sarr['SupplierEmail'] ?>"></td>
		</tr>
		<tr>
			<td>Phone number: </td>
			<td><input type="text" name="txtPhone" required="required" value="<?php echo $Sarr['SupplierPhone'] ?>"></td>
		</tr>
		<tr>
			<td>Address: </td>
			<td>
				<textarea rows="5" cols="25" style="resize: none;" id="txtAddress" name="txtAddress"  required="required"></textarea>
			</td>
		</tr>
		<tr>
			<td align="center" colspan="2"><input type="submit" name="btnUpdate" value="Submit"></td>
		</tr>
	</table>
</form>
<a href="supplierRegister.php">Go back to supplier registration.</a>
</body>
</html>
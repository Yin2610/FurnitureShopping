<?php 
include('connect.php');
if(isset($_GET['SupplierID']))
{
	$SupplierID = $_GET['SupplierID'];
	$deleteSupplier = "DELETE FROM Supplier WHERE SupplierID = '$SupplierID'";
	$runDeleteSupplier = mysqli_query($connection, $deleteSupplier);
	if($runDeleteSupplier)
	{
		echo "<script>window.alert('Supplier information deleted.')</script>";
		echo "<script>window.location='supplierRegister.php'</script>";
	}
	else
	{
		echo mysqli_error($connection);
		echo "<script>window.location='supplierRegister.php'</script>";
	}
}
else
{
	echo "<script>window.alert('Please login first.')</script>";
	echo "<script>window.location='staffLogin.php'</script>";
}
?>
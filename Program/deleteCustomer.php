<?php 
include('connect.php');
if(isset($_GET['CustomerID']))
{
	$CustomerID = $_GET['CustomerID'];
	$deleteCustomer = "DELETE FROM Customer WHERE CustomerID = '$CustomerID'";
	$runDeleteCustomer = mysqli_query($connection, $deleteCustomer);
	if($runDeleteCustomer)
	{
		echo "<script>window.alert('Customer information deleted.')</script>";
		echo "<script>window.location='viewCustomer.php'</script>";
	}
	else
	{
		echo mysqli_error($connection);
		echo "<script>window.location='viewCustomer.php'</script>";
	}
}
else
{
	echo "<script>window.alert('Please login first.')</script>";
	echo "<script>window.location='staffLogin.php'</script>";
}
?>
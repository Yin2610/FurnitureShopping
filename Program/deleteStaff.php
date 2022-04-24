<?php 
include('connect.php');
if(isset($_GET['StaffID']))
{
	$StaffID = $_GET['StaffID'];
	$deleteStaff = "DELETE FROM Staff WHERE StaffID = '$StaffID'";
	$runDeleteStaff = mysqli_query($connection, $deleteStaff);
	if($runDeleteStaff)
	{
		echo "<script>window.alert('Staff information deleted.')</script>";
		echo "<script>window.location='viewStaff.php'</script>";
	}
	else
	{
		echo mysqli_error($connection);
		echo "<script>window.location='viewStaff.php'</script>";
	}
}
else
{
	echo "<script>window.alert('Please login first.')</script>";
	echo "<script>window.location='staffLogin.php'</script>";
}
?>
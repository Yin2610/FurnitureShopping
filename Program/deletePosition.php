<?php 
include('connect.php');
if(isset($_GET['PositionID']))
{
	$PositionID = $_GET['PositionID'];
	$deletePosition = "DELETE FROM StaffPosition WHERE PositionID = '$PositionID'";
	$runDeletePosition = mysqli_query($connection, $deletePosition);
	if($runDeletePosition)
	{
		echo "<script>window.alert('Staff position deleted.')</script>";
		echo "<script>window.location='registerPosition.php'</script>";
	}
	else
	{
		echo mysqli_error($connection);
		echo "<script>window.location='registerPosition.php'</script>";
	}
}
else
{
	echo "<script>window.alert('Please login first.')</script>";
	echo "<script>window.location='staffLogin.php'</script>";
}
?>
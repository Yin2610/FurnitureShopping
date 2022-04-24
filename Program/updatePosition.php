<?php 
session_start();
include('connect.php');
include('staffHeader.php');
if(isset($_GET['PositionID']))
{
	if(isset($_GET['PositionName']))
	{
		$PositionID = $_GET['PositionID'];
		$PositionName = $_GET['PositionName'];
		$updatePosition = "UPDATE StaffPosition
						SET PositionName = '$PositionName'
						WHERE PositionID = '$PositionID'";
		$updateRun = mysqli_query($connection, $updatePosition);
		if($updateRun)
		{
			echo "<script>window.alert('Staff position information updated successfully.')</script>";
			echo "<script>window.location='registerPosition.php'</script>";
		}
		else
		{
			echo mysqli_error($connection);
			echo "<script>window.location='registerPosition.php'</script>";
		}
	}
}
else
{
	echo "<script>window.alert('Please login first.')</script>";
	echo "<script>window.location='staffLogin.php'</script>";
}
?>
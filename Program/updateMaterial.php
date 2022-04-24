<?php 
session_start();
include('connect.php');
include('staffHeader.php');
if(isset($_GET['MaterialID']))
{
	if(isset($_GET['MaterialName']))
	{
		$MaterialID = $_GET['MaterialID'];
		$MaterialName = $_GET['MaterialName'];
		$updateMaterial = "UPDATE Material
							SET Material = '$MaterialName'
							WHERE MaterialID = '$MaterialID'";
		$updateRun = mysqli_query($connection, $updateMaterial);
		if($updateRun)
		{
			echo "<script>window.alert('Material information updated successfully.')</script>";
			echo "<script>window.location='registerMaterial.php'</script>";
		}
		else
		{
			echo mysqli_error($connection);
			echo "<script>window.location='registerMaterial.php'</script>";
		}
	}
}
else
{
	echo "<script>window.alert('Please login first.')</script>";
	echo "<script>window.location='staffLogin.php'</script>";
}
 ?>
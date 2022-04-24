<?php 
session_start();
include('connect.php');
include('staffHeader.php');
if(isset($_GET['FurnitureTypeID']))
{
	if(isset($_GET['FurnitureTypeName']))
	{
		$FurnitureTypeID = $_GET['FurnitureTypeID'];
		$FurnitureTypeName = $_GET['FurnitureTypeName'];
		$updateFurnitureType = "UPDATE FurnitureType
							SET FurnitureType = '$FurnitureTypeName'
							WHERE FurnitureTypeID = '$FurnitureTypeID'";
		$updateRun = mysqli_query($connection, $updateFurnitureType);
		if($updateRun)
		{
			echo "<script>window.alert('Furniture type updated successfully.')</script>";
			echo "<script>window.location='registerFurnType.php'</script>";
		}
		else
		{
			echo mysqli_error($connection);
			echo "<script>window.location='registerFurnType.php'</script>";
		}
	}
}
else
{
	echo "<script>window.alert('Please login first.')</script>";
	echo "<script>window.location='staffLogin.php'</script>";
}
 ?>
<?php 
include('connect.php');
if(isset($_GET['FurnitureTypeID']))
{
	$FurnitureTypeID = $_GET['FurnitureTypeID'];
	$deleteFurnitureType = "DELETE FROM FurnitureType WHERE FurnitureTypeID = '$FurnitureTypeID'";
	$runDeleteFurnitureType = mysqli_query($connection, $deleteFurnitureType);
	if($runDeleteFurnitureType)
	{
		echo "<script>window.alert('Furniture type deleted.')</script>";
		echo "<script>window.location='registerFurnType.php'</script>";
	}
	else
	{
		echo mysqli_error($connection);
		echo "<script>window.location='registerFurnType.php'</script>";
	}
}
else
{
	echo "<script>window.alert('Please login first.')</script>";
	echo "<script>window.location='staffLogin.php'</script>";
}
?>
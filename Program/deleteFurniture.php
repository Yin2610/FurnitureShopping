<?php 
include('connect.php');
if(isset($_GET['FurnitureID']))
{
	$FurnitureID = $_GET['FurnitureID'];
	$deleteFurniture = "DELETE FROM Furniture WHERE FurnitureID = '$FurnitureID'";
	$runDeleteFurniture = mysqli_query($connection, $deleteFurniture);
	if($runDeleteFurniture)
	{
		echo "<script>window.alert('Furniture information deleted.')</script>";
		echo "<script>window.location='viewFurniture.php'</script>";
	}
	else
	{
		echo mysqli_error($connection);
		echo "<script>window.location='viewFurniture.php'</script>";
	}
}
else
{
	echo "<script>window.alert('Please login first.')</script>";
	echo "<script>window.location='staffLogin.php'</script>";
}
?>
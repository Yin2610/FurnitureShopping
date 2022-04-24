<?php 
include('connect.php');
if(isset($_GET['BrandID']))
{
	$BrandID = $_GET['BrandID'];
	$deleteBrand = "DELETE FROM Brand WHERE BrandID = '$BrandID'";
	$runDeleteBrand = mysqli_query($connection, $deleteBrand);
	if($runDeleteBrand)
	{
		echo "<script>window.alert('Brand deleted.')</script>";
		echo "<script>window.location='registerBrand.php'</script>";
	}
	else
	{
		echo mysqli_error($connection);
		echo "<script>window.location='registerBrand.php'</script>";
	}
}
else
{
	echo "<script>window.alert('Please login first.')</script>";
	echo "<script>window.location='staffLogin.php'</script>";
}
?>
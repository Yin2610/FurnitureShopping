<?php 
include('connect.php');
if(isset($_GET['BrandID']))
{
	if(isset($_GET['BrandName']))
	{
		$BrandID = $_GET['BrandID'];
		$BrandName = $_GET['BrandName'];
		$updateBrand = "UPDATE Brand
						SET BrandName = '$BrandName'
						WHERE BrandID = '$BrandID'";
		$updateRun = mysqli_query($connection, $updateBrand);
		if($updateRun)
		{
			echo "<script>window.alert('Brand information updated successfully.')</script>";
			echo "<script>window.location='registerBrand.php'</script>";
		}
		else
		{
			echo mysqli_error($connection);
			echo "<script>window.location='registerBrand.php'</script>";
		}
	}
}
else
{
	echo "<script>window.alert('Please login first.')</script>";
	echo "<script>window.location='staffLogin.php'</script>";
}
?>
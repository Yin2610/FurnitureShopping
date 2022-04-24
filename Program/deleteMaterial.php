<?php 
include('connect.php');
if(isset($_GET['MaterialID']))
{
	$MaterialID = $_GET['MaterialID'];
	$deleteMaterial = "DELETE FROM Material WHERE MaterialID = '$MaterialID'";
	$runDeleteMaterial = mysqli_query($connection, $deleteMaterial);
	if($runDeleteMaterial)
	{
		echo "<script>window.alert('Material information deleted.')</script>";
		echo "<script>window.location='registerMaterial.php'</script>";
	}
	else
	{
		echo mysqli_error($connection);
		echo "<script>window.location='registerMaterial.php'</script>";
	}
}
else
{
	echo "<script>window.alert('Please login first.')</script>";
	echo "<script>window.location='staffLogin.php'</script>";
}
?>
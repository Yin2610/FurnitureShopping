<?php 
include('connect.php');
session_start();
include('staffHeader.php');
if(isset($_SESSION['SID']))
{
	$StaffID = $_SESSION['SID'];
	$selectStaff = "SELECT s.*, sp.PositionName FROM Staff s, StaffPosition sp WHERE s.StaffID = '$StaffID' AND sp.PositionID = s.PositionID";
	$selectStaffRun = mysqli_query($connection, $selectStaff);
	$StaffArr = mysqli_fetch_array($selectStaffRun);
}
else
{
	echo "<script>window.alert('Please login first.')</script>";
	echo "<script>window.location='staffLogin.php'</script>";
}
?>

<title>Staff Profile</title>
<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript">
	document.getElementById("home").classList.remove("active");
	document.getElementById("profile").classList.add("active");
</script>
<div class="container form-margin-top">
	<h3>Staff profile</h3>
	<hr>
	<table align="center" cellpadding="5px">
		<tr>
			<td><b>Staff name:</b></td>
			<td><?php echo $StaffArr['StaffName'] ?></td>
		</tr>
		<tr>
			<td><b>Staff gender:</b></td>
			<td><?php echo $StaffArr['StaffGender'] ?></td>
		</tr>
		<tr>
			<td><b>Staff position:</b></td>
			<td><?php echo $StaffArr['PositionName'] ?></td>
		</tr>
		<tr>
			<td><b>Staff email:</b></td>
			<td><?php echo $StaffArr['StaffEmail'] ?></td>
		</tr>
		<tr>
			<td><b>Staff phone:</b></td>
			<td><?php echo $StaffArr['StaffPhone'] ?></td>
		</tr>
		<tr>
			<td><b>Staff address:</b></td>
			<td><?php echo $StaffArr['StaffAddress'] ?></td>
		</tr>
	</table>
	<a href="staffHome.php">Go back to staff home page.</a>
</div>
</body>
</html>
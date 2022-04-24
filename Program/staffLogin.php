<?php 
session_start();
include('connect.php');
if(isset($_POST['btnLogin']))
{
	$Email = $_POST['txtEmail'];
	$Password = $_POST['txtPassword'];
	$PositionID = $_POST['positions'];
	$selectStaff = "SELECT s.*, sp.PositionName FROM Staff s, StaffPosition sp
					WHERE s.StaffEmail = '$Email'
					AND s.StaffPassword='$Password'
					AND s.PositionID = '$PositionID'
					AND s.PositionID = sp.PositionID";
	$selectRun = mysqli_query($connection, $selectStaff);
	$selectStaffCount = mysqli_num_rows($selectRun);
	$staffArray = mysqli_fetch_array($selectRun);
	if($selectStaffCount < 1)
	{
		echo "<script>window.alert('Email or password or position is incorrect. Please try again.')</script>";
		echo "<script>window.location='staffLogin.php'</script>";
	}
	else
	{
		$_SESSION['SID'] = $staffArray['StaffID'];
		$_SESSION['SName'] = $staffArray['StaffName'];
		$_SESSION['SPosition'] = $staffArray['PositionName'];
		echo "<script>window.alert('Staff login successful.')</script>";
		echo "<script>window.location='staffHome.php'</script>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Staff Login</title>
	<style type="text/css">
		#login
		{
			background: #106eea;
			color: white;
			padding: 10px;
			margin-bottom: 20px;
			border-radius: 10px 10px 0 0;
		}
	</style>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="staffAssets/css/Style.css">
	<link href="staffAssets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="grandParentContainer">
		<div class="parentContainer">
			<form action="StaffLogin.php" method="POST" class="centerForm">
				<table align="center" class="paddingTable">
					<div id="login">
						<h2 align="center">Staff Login</h2>
					</div>
					<tr>
						<td>Email: </td>
						<td><input type="email" name="txtEmail" class="form-control" required></td>
					</tr>
					<tr>
						<td>Password: </td>
						<td><input type="Password" name="txtPassword" class="form-control" required></td>
					</tr>
					<tr>
						<td>Position: </td>
						<td>
							<select name="positions" class="form-control" required="required">
								<?php 
									$selectPosition = "SELECT * FROM StaffPosition";
									$selectRun = mysqli_query($connection, $selectPosition);
									$selectRunCount = mysqli_num_rows($selectRun);
									for ($i=0; $i < $selectRunCount; $i++)
									{ 
										$PositionArray = mysqli_fetch_array($selectRun);
										$PositionID = $PositionArray['PositionID'];
										$PositionName = $PositionArray['PositionName'];
										echo "<option value='$PositionID'>$PositionName</option>";
									}
								 ?>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<input type="submit" name="btnLogin" id="margin-bottom" class="form-button" value="Login">
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</body>
</html>
<?php 
session_start();
include('connect.php');
include('staffHeader.php');
if(isset($_SESSION['SID']))
{
	if(isset($_POST['btnSubmit']))
	{
		$StaffName = $_POST['txtStaffName'];
		$StaffGender = $_POST['rdoGender'];
		$PositionID = $_POST['positions'];
		$StaffEmail = $_POST['txtEmail'];
		$StaffPhone = $_POST['txtPhone'];
		$StaffAddress = $_POST['txtAddress'];
		$StaffPassword = $_POST['txtPassword'];
		$selectStaff = "SELECT * FROM Staff WHERE StaffEmail = '$StaffEmail' OR StaffPassword = '$StaffPassword'";
		$selectRun = mysqli_query($connection, $selectStaff);
		$count = mysqli_num_rows($selectRun);
		if($count > 0)
		{
			echo "<script>window.alert('There is a staff account already registered with this email or password. Please try another one.')</script>";
			echo "<script>window.location='staffHome.php'</script>";
		}
		else
		{
			$insertStaff = "INSERT INTO Staff(StaffName, PositionID, StaffEmail, StaffPhone, StaffPassword, StaffGender,  StaffAddress) VALUES('$StaffName', '$PositionID', '$StaffEmail', '$StaffPhone', '$StaffPassword', '$StaffGender', '$StaffAddress')";
			$insertRun = mysqli_query($connection, $insertStaff);
			if($insertRun)
			{
				echo "<script>window.alert('Staff account registration successful.')</script>";
				echo "<script>window.location='viewStaff.php'</script>";
			}
			else
			{
				echo "<script>window.alert('Staff account registration unsuccessful.')</script>";
				echo "<script>window.location='staffRegister.php'</script>";
			}
		}
	}
}
else
{
	echo "<script>window.alert('Please login first.')</script>";
	echo "<script>window.location='staffLogin.php'</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Staff Register</title>
</head>
<link rel="stylesheet" type="text/css" href="style.css">
<body>
	<div class="container">
	<form action="staffRegister.php" method="POST">
	<h3 class="form-margin-top">Staff registration</h3>
	<table align="center" class="paddingTable">
		<tr>
			<td>Staff name: </td>
			<td><input type="text" name="txtStaffName" class="form-control" required="required"></td>
		</tr>
		<tr>
			<td>Gender: </td>
			<td>
				<input type="radio" name="rdoGender" value="Male" checked="checked"> Male 
				<input type="radio" name="rdoGender" value="Female"> Female
			</td>
		</tr>
		<tr>
			<td>Position: </td>
			<td>
				<select name="positions" required="required" class="form-control">
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
			<td>Email: </td>
			<td><input type="email" name="txtEmail" class="form-control" required="required"></td>
		</tr>
		<tr>
			<td>Phone number: </td>
			<td><input type="text" name="txtPhone" class="form-control" required="required"></td>
		</tr>
		<tr>
			<td>Address: </td>
			<td>
				<textarea rows="5" cols="25" style="resize: none;" name="txtAddress" class="form-control" required="required"></textarea>
			</td>
		</tr>
		<tr>
			<td>Password: </td>
			<td><input type="Password" name="txtPassword" class="form-control" required="required"></td>
		</tr>
		<tr>
			<td align="center" colspan="2"><input type="submit" name="btnSubmit" class="form-button" value="Register"></td>
		</tr>
	</table>
	<a href="staffHome.php">Go back to staff home page.</a>
	</form>
	</div>
</body>
</html>
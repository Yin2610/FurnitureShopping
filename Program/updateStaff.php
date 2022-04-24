<?php 
session_start();
include('connect.php');
if(isset($_SESSION['SID']))
{
	$StaffID = $_SESSION['SID'];
	$selectStaff = "SELECT s.*, sp.* FROM Staff s, StaffPosition sp WHERE s.StaffID = '$StaffID' AND s.PositionID = sp.PositionID";
	$runSelectStaff = mysqli_query($connection, $selectStaff);
	$countStaff = mysqli_num_rows($runSelectStaff);
	$Sarr = mysqli_fetch_array($runSelectStaff);
	if($countStaff < 1)
	{
		echo "<script>window.alert('There is no staff registered.')</script>";
		echo "<script>window.location='staffRegister.php'</script>";
	}
}
else
{
	echo "<script>window.alert('Please login first.')</script>";
	echo "<script>window.location='staffLogin.php'</script>";
}
if(isset($_POST['btnUpdate']))
{
	$StaffID = $_POST['txtStaffID'];
	$StaffName = $_POST['txtStaffName'];
	$StaffGender = $_POST['rdoGender'];
	$StaffPositionID = $_POST['positions'];
	$StaffEmail = $_POST['txtEmail'];
	$StaffPhone = $_POST['txtPhone'];
	$StaffAddress = $_POST['txtAddress'];
	$updateStaff = "UPDATE Staff 
					SET
					StaffName = '$StaffName',
					StaffGender = '$StaffGender',
					PositionID = '$StaffPositionID',
					StaffEmail = '$StaffEmail',
					StaffPhone = '$StaffPhone',
					StaffAddress = '$StaffAddress'
					WHERE StaffID = '$StaffID'";
	$runUpdateStaff = mysqli_query($connection, $updateStaff);
	if($runUpdateStaff)
	{
		echo "<script>window.alert('Staff information updated successfully.')</script>";
		echo "<script>window.location='viewStaff.php'</script>";
	}
	else
	{
		echo mysqli_error($connection);
		echo "<script>window.location='viewStaff.php'</script>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update staff</title>
	<script type="text/javascript">
		function setValues()
		{
			//set gender to 'rdoGender' radio button in form
			var gender = "<?php echo $Sarr['StaffGender'] ?>";
			if(gender == "Male")
			{
				document.getElementById('rdoMale').checked = true;
			}
			else
			{
				document.getElementById('rdoFemale').checked = true;
			}
			//-------------------------------------------------------------------

			//set position to 'positions' combo box in form
			var positionName = "<?php echo $Sarr['PositionName'] ?>";
			document.getElementById(positionName).selected = true;
			//-------------------------------------------------------------------

			//set address to 'txtAddress' textarea in form
			var address = "<?php echo $Sarr['StaffAddress'] ?>";
			document.getElementById('txtAddress').value = address;
			//-------------------------------------------------------------------
		}
	</script>
</head>
<body onload="setValues()">
	<form action="updateStaff.php" method="POST">
		<h2>Update staff</h2>
		<table align="center">
		<tr>
			<input type="hidden" name="txtStaffID" value="<?php echo $Sarr['StaffID']?>">
			<td>Staff name: </td>
			<td><input type="text" name="txtStaffName" value="<?php echo $Sarr['StaffName'] ?>" required="required"></td>
		</tr>
		<tr>
			<td>Gender: </td>
			<td>
				<input type="radio" name="rdoGender" value="Male" id="rdoMale" required="required">Male
				<input type="radio" name="rdoGender" value="Female" id="rdoFemale" required="required">Female
			</td>
		</tr>
		<tr>
			<td>Position: </td>
			<td>
				<select name="positions" required="required">
					 <?php 
						$selectPosition = "SELECT * FROM StaffPosition";
						$selectRun = mysqli_query($connection, $selectPosition);
						$selectRunCount = mysqli_num_rows($selectRun);
						for ($i=0; $i < $selectRunCount; $i++)
						{ 
							$PositionArray = mysqli_fetch_array($selectRun);
							$PositionID = $PositionArray['PositionID'];
							$PositionName = $PositionArray['PositionName'];
							echo "<option value='$PositionID' id='$PositionName'>$PositionName</option>";
						}
					 ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Email: </td>
			<td><input type="email" name="txtEmail" required="required" value="<?php echo $Sarr['StaffEmail'] ?>"></td>
		</tr>
		<tr>
			<td>Phone number: </td>
			<td><input type="text" name="txtPhone" required="required" value="<?php echo $Sarr['StaffPhone'] ?>"></td>
		</tr>
		<tr>
			<td>Address: </td>
			<td>
				<textarea rows="5" cols="25" style="resize: none;" name="txtAddress" id="txtAddress" required="required"></textarea>
			</td>
		</tr>
		<tr>
			<td align="center" colspan="2"><input type="submit" name="btnUpdate" value="Update"></td>
		</tr>
	</table>
	</form>
	<a href="viewStaff.php">Go back to staff list.</a>
</body>
</html>
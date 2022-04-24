<?php 
session_start();
include('connect.php');
include('staffHeader.php');
if(isset($_SESSION['CID']))
{
	$CustomerID = $_SESSION['CID'];
	$selectCustomer = "SELECT * FROM Customer WHERE CustomerID = '$CustomerID'";
	$runSelectCustomer = mysqli_query($connection, $selectCustomer);
	$countCustomer = mysqli_num_rows($runSelectCustomer);
	$Carr = mysqli_fetch_array($runSelectCustomer);
	if($countCustomer < 1)
	{
		echo "<script>window.alert('There is no customer registered.')</script>";
		echo "<script>window.location='customerRegister.php'</script>";
	}
}
else
{
	echo "<script>window.alert('Please login first.')</script>";
	echo "<script>window.location='customerLogin.php'</script>";
}
if(isset($_POST['btnUpdate']))
{
	$CustomerID = $_POST['txtCustomerID'];
	$CustomerName = $_POST['txtCustomerName'];
	$CustomerGender = $_POST['rdoGender'];
	$CustomerEmail = $_POST['txtEmail'];
	$CustomerPhone = $_POST['txtPhone'];
	$CustomerAddress = $_POST['txtAddress'];
	$updateCustomer = "UPDATE Customer 
					SET
					CustomerName = '$CustomerName',
					CustomerGender = '$CustomerGender',
					CustomerEmail = '$CustomerEmail',
					CustomerPhone = '$CustomerPhone',
					CustomerAddress = '$CustomerAddress'
					WHERE CustomerID = '$CustomerID'";
	$runUpdateCustomer = mysqli_query($connection, $updateCustomer);
	if($runUpdateCustomer)
	{
		echo "<script>window.alert('Customer information updated successfully.')</script>";
		echo "<script>window.location='customerProfile.php'</script>";
	}
	else
	{
		echo mysqli_error($connection);
		echo "<script>window.location='customerProfile.php'</script>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Update customer</title>
	<script type="text/javascript">
		function setValues()
		{
			//set gender to 'rdoGender' radio button in form
			var gender = "<?php echo $Carr['CustomerGender'] ?>";
			if(gender == "Male")
			{
				document.getElementById('rdoMale').checked = true;
			}
			else
			{
				document.getElementById('rdoFemale').checked = true;
			}
			//-------------------------------------------------------------------

			//set address to 'txtAddress' textarea in form
			var address = "<?php echo $Carr['CustomerAddress'] ?>";
			document.getElementById("txtAddress").value = address;
			//-------------------------------------------------------------------
		}
	</script>
</head>
<body onload="setValues()">
	<form action="updateCustomer.php" method="POST">
		<h2>Update customer</h2>
		<table align="center">
		<tr>
			<td>User name: </td>
			<td>
				<input type="hidden" name="txtCustomerID" value="<?php echo $CustomerID ?>">
				<input type="text" name="txtCustomerName" required="required" value="<?php echo $Carr['CustomerName'] ?>">
			</td>
		</tr>
		<tr>
			<td>Gender: </td>
			<td>
				<input type="radio" name="rdoGender" value="Male" required="required" id="rdoMale">Male
				<input type="radio" name="rdoGender" value="Female" required="required" id="rdoFemale">Female
			</td>
		</tr>
		<tr>
			<td>Email: </td>
			<td><input type="email" name="txtEmail" required="required" value="<?php echo $Carr['CustomerEmail'] ?>"></td>
		</tr>
		<tr>
			<td>Phone number: </td>
			<td><input type="text" name="txtPhone" required="required" value="<?php echo $Carr['CustomerPhone'] ?>"></td>
		</tr>
		<tr>
			<td>Address: </td>
			<td>
				<textarea rows="5" cols="25" style="resize: none;" id="txtAddress" name="txtAddress" required="required"></textarea>
			</td>
		</tr>
		<tr>
			<td align="center" colspan="2">
				<input type="submit" name="btnUpdate" value="Update">
			</td>
		</tr>
	</table>
	</form>
	<a href="customerProfile.php">Go back to customer profile.</a>
</body>
</html>
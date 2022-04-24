<?php 
	session_start();
	include('connect.php');
	if(isset($_POST['btnLogin']))
	{
		$Email = $_POST['txtEmail'];
		$Password = $_POST['txtPassword'];
		$selectCustomer = "SELECT * FROM Customer 
							WHERE CustomerEmail = '$Email'
							AND CustomerPassword = '$Password'";
		$selectRun = mysqli_query($connection, $selectCustomer);
		$selectCustomerCount = mysqli_num_rows($selectRun);
		$customerArray = mysqli_fetch_array($selectRun);
		if($selectCustomerCount > 0)
		{
			$_SESSION['CID'] = $customerArray['CustomerID'];
			$_SESSION['CName'] = $customerArray['CustomerName'];
			$_SESSION['CPhone'] = $customerArray['CustomerPhone'];
			$_SESSION['CAddress'] = $customerArray['CustomerAddress'];
			$_SESSION['CEmail'] = $customerArray['CustomerEmail'];
			echo "<script>window.alert('Welcome to Homely Furn, " . $_SESSION['CName'] . ".');</script>";
			echo "<script>window.location='furnitureDisplay.php'</script>";
		}
		else
		{
			echo "<script>window.alert('Email or password is incorrect.')</script>";
			echo "<script>window.location='customerLogin.php'</script>";
		}
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Customer Login</title>
	<style type="text/css">
		#login
		{
			background: #fe980f;
			color: white;
			padding: 10px;
			margin-bottom: 20px;
			border-radius: 10px 10px 0 0;
		}
		#btnLogin
		{
			cursor: pointer;
			background: #fe980f;
			color: white;
			padding: 5px 15px;
			border-color: #fe980f;
			border-radius: 10%;
		}
	</style>
	<link href="customerAssets/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="grandParentContainer">
		<div class="parentContainer">
			<form action="customerLogin.php" method="POST" class="centerForm">
				<table align="center" class="paddingTable">
					<div id="login">
						<h2 align="center">Customer Login</h2>
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
						<td align="center" colspan="2">
							<input type="submit" name="btnLogin" id="btnLogin" value="Login">
						</td>
					</tr>
					<tr>
						<td colspan="2"
						>
							<a href="customerRegister.php">Don't have a user account?</a>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</body>
</html>
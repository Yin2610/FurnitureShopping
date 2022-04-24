<?php 
include('connect.php');
	if(isset($_POST['btnRegister']))
	{
		$CustomerName = $_POST['txtUserName'];
		$CustomerGender = $_POST['rdoGender'];
		$CreditCard = $_POST['txtCredit'];
		$CVC = $_POST['txtCVC'];
		$ExpDate = $_POST['txtExp'];
		$CustomerEmail = $_POST['txtEmail'];
		$CustomerPhone = $_POST['txtPhone'];
		$CustomerAddress = $_POST['txtAddress'];
		$CustomerPassword = $_POST['txtPassword'];
		$selectCustomer = "SELECT * FROM Customer WHERE CustomerEmail = '$CustomerEmail'";
		$selectRun = mysqli_query($connection, $selectCustomer);
		$count = mysqli_num_rows($selectRun);
		if($count > 0)
		{
			echo "<script>window.alert('There is a user account already registered with this email. Try another one.')</script>";
			echo "<script>window.location='customerRegister.php'</script>";
		}
		else
		{
			$insertCustomer = "INSERT INTO Customer(CustomerName, CustomerEmail, CustomerPhone, CustomerPassword, CustomerGender,  CustomerAddress, CustomerCreditCard, CVC, ExpirationDate) VALUES('$CustomerName', '$CustomerEmail', '$CustomerPhone', '$CustomerPassword', '$CustomerGender', '$CustomerAddress', '$CreditCard', '$CVC', '$ExpDate')";
			$insertRun = mysqli_query($connection, $insertCustomer);
			if($insertRun)
			{
				echo "<script>window.alert('User account registration successful.')</script>";
				echo "<script>window.location='furnitureDisplay.php'</script>";
			}
			else
			{
				echo "<script>window.alert('User account registration unsuccessful.')</script>";
				echo "<script>window.location='staffRegister.php'</script>";
			}
		}
	}
 ?>
<title>Customer Register</title>
<style type="text/css">
	#register
	{
		background: #fe980f;
		color: white;
		padding: 10px;
		margin-bottom: 20px;
		border-radius: 10px 10px 0 0;
	}
	#btnReg
	{
		cursor: pointer;
		background: #fe980f;
		color: white;
		padding: 5px 15px;
		border-color: #fe980f;
		border-radius: 10%;
	}
	table td
	{
		padding: 5px 40px; 
	}
</style>
<link href="customerAssets/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="style.css">
	<div class="grandParentContainer">
		<div class="parentContainer">
			<form action="customerRegister.php" method="POST" class="centerForm">
				<table align="center">
					<div id="register">
						<h2 align="center">Customer Registration</h2>
					</div>
					<tr>
						<td>User name: </td>
						<td><input type="text" class="form-control" name="txtUserName" required="required"></td>
					</tr>
					<tr>
						<td>Gender: </td>
						<td>
							<input type="radio" name="rdoGender" value="Male" required="required" checked="checked"> Male 
							<input type="radio" name="rdoGender" value="Female" required="required"> Female
						</td>
					</tr>
					<tr>
						<td>Credit card number: </td>
						<td>
							<input type="tel" name="txtCredit" required="required" maxlength="20" pattern="[0-9]{4} [0-9]{4} [0-9]{4} [0-9]{4}"  class="form-control" placeholder="1234 1234 1234 1234">
						</td>
					</tr>
					<tr>
						<td>CVC: </td>
						<td>
							<input type="tel" name="txtCVC" required="required" maxlength="3"  class="form-control" pattern="\d*" placeholder="123">
						</td>
					</tr>
					<tr>
						<td>Expiration date: </td>
						<td>
							<input type="tel" name="txtExp" required="required" maxlength="7" pattern="[0-9]{2}/[0-9]{4}"  class="form-control" placeholder="mm/yyyy">
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
							<textarea rows="5" cols="25" style="resize: none;" name="txtAddress" class="form-control"required="required"></textarea>
						</td>
					</tr>
					<tr>
						<td>Password: </td>
						<td><input type="Password" name="txtPassword"  class="form-control" required="required"></td>
					</tr>
					<tr>
						<td align="center" colspan="2">
							<input type="submit" name="btnRegister" id="btnReg" value="Register">
						</td>
					</tr>
					<tr>
						<td colspan="2"><a href="customerLogin.php">Already have a user account?</a></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</body>
</html>
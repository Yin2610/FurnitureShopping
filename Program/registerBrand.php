<?php 
session_start();
include('connect.php');
include('staffHeader.php');
if(isset($_SESSION['SID']))
{
	if(isset($_POST['btnSubmitBrand']))
	{
		$BrandName = $_POST['txtBrandName'];
		$selectBrand = "SELECT * FROM Brand
							WHERE BrandName = '$BrandName'";
		$selectRun = mysqli_query($connection, $selectBrand);
		$selectCount = mysqli_num_rows($selectRun);
		if($selectCount > 0)
		{
			echo "<script>window.alert('Brand Name already registerd.')</script>";
			echo "<script>window.location='registerBrand.php'</script>";
		}
		else
		{
			$insertBrand = "INSERT INTO Brand(BrandName) VALUES('$BrandName')";
			$insertRun = mysqli_query($connection, $insertBrand);
			if($insertRun)
			{
				echo "<script>window.alert('Brand registration successful.')</script>";
				echo "<script>window.location='registerBrand.php'</script>";
			}
			else
			{
				echo "<p>Something went wrong in brand registration:".mysqli_error($connection)."</p>";
				echo "<script>window.location='registerBrand.php'</script>";
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
<title>Brand Registration</title>
<style type="text/css">
	#brandList
	{
		border: 1px solid #B9B9B9;
		border-collapse: collapse;
	}
	#brandList th, #brandList td
	{
		border: 1px solid #B9B9B9;
		padding: 10px 15px;
	}
	.updateBtn a:hover, .deleteBtn a:hover
	{
		color: white;
	}
</style>
<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="DataTables/jQuery-3.6.0/jquery-3.6.0.js"></script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.css" />
<script type="text/javascript" src="DataTables/datatables.js"></script>
<script type="text/javascript">
	function update(brandID, iterator)
	{
		var txtUpdates = document.getElementsByClassName('txtUpdate');
		var brand = txtUpdates[iterator].value;
		var linkUpdates = document.getElementsByClassName('updateLink');
		linkUpdates[iterator].setAttribute("href", "updateBrand.php?BrandID="+brandID+"&BrandName="+brand);
	}
	$(document).ready(function()
	{
		$('#brandList').DataTable();
	});
</script>
</head>
<body>
	<div class="container">
	<form action="registerBrand.php" method="POST" class="form-margin-top">
		<h3>Brand Registration</h3>
		<hr>
		<table cellpadding="5px">
			<tr>
				<td>Brand name: </td>
				<td><input type="text" name="txtBrandName" class="form-control" required="required"></td>
			</tr>
			<tr>
				<td align="center" colspan="2">
					<input type="submit" class="form-button" name="btnSubmitBrand" value="Submit">
				</td>
			</tr>
		</table>
		<a href="staffHome.php">Go back to staff home page.</a>
	</form>
</div>
<hr>
<fieldset style="padding: 20px">
	<legend>Brand List</legend>
	<div class="table-responsive">
<?php 
		$selectBrand = "SELECT * FROM Brand";
		$selectRun = mysqli_query($connection, $selectBrand);
		$count = mysqli_num_rows($selectRun);
		if($count < 1)
		{
			echo "There is no brand name registered.";
		}
		else
		{
			echo "<div class='table-responsive'>";
			echo "<table style='width: 100%;' class='display' id='brandList'>";
			echo "<thead>";
			echo "<tr align='center'>";
			echo "<th>No.</th>";
			echo "<th>Brand name</th>";
			echo "<th>Update action</th>";
			echo "<th>Delete action";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
		}
	 
		for ($i=0; $i < $count ; $i++) { 
			$arr = mysqli_fetch_array($selectRun);
			$BrandID = $arr['BrandID'];
			$BrandName = $arr['BrandName'];
			echo "<tr align='center'>";
			echo "<td>".($i+1)."</td>";
			echo "<td>$BrandName</td>";
			echo "<td>
			Update brand name: 
			<input type='text' class='txtUpdate'></input>
			<button class='updateBtn'>
			<a onclick='update($BrandID, $i)' class='updateLink'>Update</a>
			</button>
			</td>";
			echo "<td><button class='deleteBtn'><a href='deleteBrand.php?BrandID=$BrandID'>Delete</a></button></td>";
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
	?>
	</fieldset>
</body>
</html>
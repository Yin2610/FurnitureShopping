<?php 
session_start();
include('connect.php');
include('staffHeader.php');
if(isset($_SESSION['SID']))
{
	if(isset($_POST['btnSubmitType']))
	{
		$FurnitureType = $_POST['txtFurnitureType'];
		$selectFurnType = "SELECT * FROM FurnitureType
							WHERE FurnitureType = '$FurnitureType'";
		$selectRun = mysqli_query($connection, $selectFurnType);
		$selectCount = mysqli_num_rows($selectRun);
		if($selectCount > 0)
		{
			echo "<script>window.alert('Furniture type already registerd.')</script>";
			echo "<script>window.location='registerFurnType.php'</script>";
		}
		else
		{
			$insertFurnitureType = "INSERT INTO FurnitureType(FurnitureType) VALUES('$FurnitureType')";
			$insertRun = mysqli_query($connection, $insertFurnitureType);
			if($insertRun)
			{
				echo "<script>window.alert('Furniture type registration successful.')</script>";
				echo "<script>window.location='registerFurnType.php'</script>";
			}
			else
			{
				echo "<p>Something went wrong in furniture type registration:".mysqli_error($connection)."</p>";
				echo "<script>window.location='registerFurnType.php'</script>";
			}
		}
	}
}
else
{
	echo "<script>window.alert('Please login first.')</script>";
	echo "<scritp>window.location='staffLogin.php'</script>";
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Furniture type registration</title>
	<style type="text/css">
		#FurnTypeList
		{
			border: 1px solid #B9B9B9;
			border-collapse: collapse;
		}
		#FurnTypeList td,  #FurnTypeList th
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
		function update(furnTypeID, iterator)
		{
			var txtUpdates = document.getElementsByClassName('txtUpdate');
			var furnitureType = txtUpdates[iterator].value;
			var linkUpdates = document.getElementsByClassName('updateLink');
			linkUpdates[iterator].setAttribute("href", "updateFurnType.php?FurnitureTypeID="+furnTypeID+"&FurnitureTypeName="+furnitureType);
		}
		$(document).ready(function()
		{
			$('#furnTypeList').DataTable();
		});
	</script>
</head>
<body>
	<div class="container">	
		<form action="registerFurnType.php" method="POST" class="form-margin-top">
			<h3>Furniture type registration</h3>
			<hr>
			<table cellpadding="5px">
				<tr>
					<td>Furniture type: </td>
					<td>
						<input type="text" name="txtFurnitureType" class="form-control" required="required">
					</td>
				</tr>
				<tr>
					<td align="center" colspan="2">
						<input type="submit" name="btnSubmitType" value="Submit" class="form-button">
					</td>
				</tr>
			</table>
			<a href="staffHome.php">Go back to staff home page.</a>
		</form>
	</div>
	<hr>
	<fieldset style="padding: 20px">
	<legend>Furniture Type List</legend>
<?php 
		$selectFurnitureType = "SELECT * FROM FurnitureType";
		$selectRun = mysqli_query($connection, $selectFurnitureType);
		$count = mysqli_num_rows($selectRun);
		if($count < 1)
		{
			echo "There is no furniture type registered.";
		}
		else
		{
			echo "<div class='table-responsive'>";
			echo "<table style='width:100%' class='display' id='furnTypeList'>";
			echo "<thead>";
			echo "<tr align='center'>";
			echo "<th>No.</th>";
			echo "<th>Furniture Type</th>";
			echo "<th>Update Action</th>";
			echo "<th>Delete Action</th>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
		}
	 
		for ($i=0; $i < $count ; $i++) { 
			$arr = mysqli_fetch_array($selectRun);
			$FurnitureTypeID = $arr['FurnitureTypeID'];
			$FurnitureType = $arr['FurnitureType'];
			echo "<tr align='center'>";
			echo "<td>".($i+1)."</td>";
			echo "<td>$FurnitureType</td>";
			echo "<td>
			Update furniture type: 
			<input type='text' class='txtUpdate'></input>
			<button class='updateBtn'>
			<a onclick='update($FurnitureTypeID, $i)' class='updateLink'>Update</a>
			</button>
			</td>";
			echo "<td><button class='deleteBtn'><a href='deleteFurnType.php?FurnitureTypeID=$FurnitureTypeID'>Delete</a></button></td>";
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
	?>
	</fieldset>
</body>
</html>
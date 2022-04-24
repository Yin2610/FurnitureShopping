<?php 
session_start();
include('connect.php');
include('staffHeader.php');
if(isset($_SESSION['SID']))
{
	if(isset($_POST['btnSubmitMat']))
	{
		$MaterialName = $_POST['txtMaterialName'];
		$selectMaterial = "SELECT * FROM Material
							WHERE Material = '$MaterialName'";
		$selectRun = mysqli_query($connection, $selectMaterial);
		$selectCount = mysqli_num_rows($selectRun);
		if($selectCount > 0)
		{
			echo "<script>window.alert('Material already registered.')</script>";
			echo "<script>window.location='registerMaterial.php'</script>";
		}
		else
		{
			$insertMaterial = "INSERT INTO Material(Material) VALUES('$MaterialName')";
			$insertRun = mysqli_query($connection, $insertMaterial);
			if($insertRun)
			{
				echo "<script>window.alert('Material registration successful.')</script>";
				echo "<script>window.location='registerMaterial.php'</script>";
			}
			else
			{
				echo "<p>Something went wrong in material registration:".mysqli_error($connection)."</p>";
				echo "<script>window.location='registerMaterial.php'</script>";
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
	<title>Material registration</title>
	<style type="text/css">
		#materialList
		{
			border: 1px solid #B9B9B9;
			border-collapse: collapse;
		}
		#materialList th, #materialList td
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
		function update(materialID, iterator)
		{
			var txtUpdates = document.getElementsByClassName('txtUpdate');
			var material = txtUpdates[iterator].value;
			var linkUpdates = document.getElementsByClassName('updateLink');
			linkUpdates[iterator].setAttribute("href", "updateMaterial.php?MaterialID="+materialID+"&MaterialName="+material);
		}
		$(document).ready(function()
		{
			$('#materialList').DataTable();
		});
	</script>
</head>
<body>
	<div class="container">
		<form action="registerMaterial.php" method="POST" class="form-margin-top">
			<h3>Material registration</h3>
			<hr>
			<table cellpadding="5px">
				<tr>
					<td>Material name: </td>
					<td>
						<input type="text" name="txtMaterialName" class="form-control" required="required">
					</td>
				</tr>
				<tr>
					<td align="center" colspan="2">
						<input type="submit" name="btnSubmitMat" value="Submit" class="form-button">
					</td>
				</tr>
			</table>
			<a href="staffHome.php">Go back to staff home page.</a>
		</form>
	</div>
	<hr>
	<fieldset style="padding: 20px">
	<legend>Material List</legend>
<?php 
		$selectMaterial = "SELECT * FROM Material";
		$selectRun = mysqli_query($connection, $selectMaterial);
		$count = mysqli_num_rows($selectRun);
		if($count < 1)
		{
			echo "There is no material registered.";
		}
		else
		{
			echo "<div class='table-responsive'>";
			echo "<table id='materialList' class='display' style='width:100%''>";
			echo "<thead>";
			echo "<tr align='center'>";
			echo "<th>No.</th>";
			echo "<th>Material Name</th>";
			echo "<th>Update Action</th>";
			echo "<th>Delete Action</th>";
			echo "</tr>";
			echo "</thead>";
			echo "<tbody>";
		}
	 
		for ($i=0; $i < $count ; $i++) 
		{ 
			$arr = mysqli_fetch_array($selectRun);
			$MaterialID = $arr['MaterialID'];
			$Material = $arr['Material'];
			echo "<tr align='center'>";
			echo "<td>".($i+1)."</td>";
			echo "<td>$Material</td>";
			echo "<td>
			Update material name: 
			<input type='text' class='txtUpdate'></input>
			<button class='updateBtn'>
			<a onclick='update($MaterialID, $i)' class='updateLink'>Update</a>
			</button>
			</td>";
			echo "<td>
			<button class='deleteBtn'>
			<a href='deleteMaterial.php?MaterialID=$MaterialID'>Delete</a>
			</button>
			</td>";
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
		echo "</div>";
	?>
	</fieldset>
</body>
</html>
<?php 
session_start();
include('connect.php');
include('staffHeader.php');
if(isset($_SESSION['SID']))
{
	if(isset($_POST['btnSubmitPosition']))
	{
		$Position = $_POST['txtPosition'];
		$selectPosition = "SELECT * FROM StaffPosition
							WHERE PositionName = '$Position'";
		$selectRun = mysqli_query($connection, $selectPosition);
		$selectCount = mysqli_num_rows($selectRun);
		if($selectCount > 0)
		{
			echo "<script>window.alert('Staff position already registerd.')</script>";
			echo "<script>window.location='registerPosition.php'</script>";
		}
		else
		{
			$insertPosition = "INSERT INTO StaffPosition(PositionName) VALUES('$Position')";
			$insertRun = mysqli_query($connection, $insertPosition);
			if($insertRun)
			{
				echo "<script>window.alert('Staff position registration successful.')</script>";
				echo "<script>window.location='registerPosition.php'</script>";
			}
			else
			{
				echo "<p>Something went wrong in staff position registration:".mysqli_error($connection)."</p>";
				echo "<script>window.location='registerPosition.php'</script>";
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
<title>Staff Position Registration</title>
<style type="text/css">
	#positionList, #positionList td,  #positionList th
	{
		border: 1px solid #B9B9B9;
		padding: 10px 15px;
		border-collapse: collapse;
	}
	.updateLink:hover, .deleteLink:hover
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
	function update(positionID, iterator)
	{
		var txtUpdates = document.getElementsByClassName('txtUpdate');
		var position = txtUpdates[iterator].value;
		var linkUpdates = document.getElementsByClassName('updateLink');
		linkUpdates[iterator].setAttribute("href", "updatePosition.php?PositionID="+positionID+"&PositionName="+position);
	}

	$(document).ready(function()
	{
		$('#positionList').DataTable();
	});
</script>
<body>
	<div class="container">
		<form action="registerPosition.php" method="POST" class="form-margin-top">
			<h3>Staff Position Registration</h3>
			<hr>
			<table cellpadding="5px">
				<tr>
					<td>Staff position: </td>
					<td> <input type="text" name="txtPosition" class="form-control" required="required"></td>
				</tr>
				<tr>
					<td align="center" colspan="2">
						<input type="submit" value="Submit" name="btnSubmitPosition" class="form-button">
					</td>
				</tr>
			</table>
		</form>
		<a href="staffHome.php">Go back to staff home page.</a>
	</div>
	<hr>
		<fieldset style="padding: 20px">
			<legend>Staff Position List</legend>
			<div class="table-responsive">
		<?php 
				$selectPosition = "SELECT * FROM StaffPosition";
				$selectRun = mysqli_query($connection, $selectPosition);
				$count = mysqli_num_rows($selectRun);
				if($count < 1)
				{
					echo "There is no staff position registered.";
				}
				else
				{
					echo "<table id='positionList' style='width=100%'>";
					echo "<thead>";
					echo "<tr style='text-align: center;'>";
					echo "<th>No.</th>";
					echo "<th>Staff position</th>";
					echo "<th>Update action</th>";
					echo "<th>Delete action</th>";
					echo "</tr>";
					echo "</thead>";
					echo "<tbody>";
				}
			 
				for ($i=0; $i < $count ; $i++) { 
					$arr = mysqli_fetch_array($selectRun);
					$PositionID = $arr['PositionID'];
					$PositionName = $arr['PositionName'];
					echo "<tr align='center'>";
					echo "<td>".($i+1)."</td>";
					echo "<td>$PositionName</td>";
					echo "<td>
					Update position: 
					<input type='text' class='txtUpdate' ></input>
					<button class='updateBtn'>
					<a onclick='update($PositionID, $i)' class='updateLink'>Update</a>
					</button> 
					</td>
					<td>
					<button class='deleteBtn'>
					<a href='deletePosition.php?PositionID=$PositionID' class='deleteLink'>Delete</a>
					</button>
					</td>";
					echo "</tr>";
				}
				echo "</tbody>";
				echo "</table>";
			?>
		</div>
	</fieldset>
</body>
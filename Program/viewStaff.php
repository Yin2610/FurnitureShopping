<?php 
session_start();
include('connect.php');
include('staffHeader.php');
if(isset($_SESSION['SID']))
{
	$showStaff="SELECT s.*, sp.PositionName FROM Staff s, StaffPosition sp WHERE s.PositionID = sp.PositionID";
	$showRun = mysqli_query($connection, $showStaff);
	$countShowStaff = mysqli_num_rows($showRun);
	if($countShowStaff < 1)
	{
		echo "<h1>Staff list</h1>";
		echo "<p>No staff is registered yet.</p>";
		echo "<a href='staffRegister.php'>Click to register staff.</a>";
		exit();
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
	<title>Staff list</title>
	<style type="text/css">
		#staffList, #staffList td,  #staffList th
		{
			border: 1px solid #B9B9B9;
			border-collapse: collapse;
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
		$(document).ready(function()
		{
			$('#staffList').DataTable();
		});
	</script>
</head>
<body>
	<fieldset style="padding: 20px">
		<legend>Staff List</legend>
		<div class="table-responsive">
			<table width="100%" class="display" id='staffList'>
				<thead>
				<tr>
					<th>No.</th>
					<th>Staff Name</th>
					<th>Staff Position</th>
					<th>Staff Gender</th>
					<th>Staff Email</th>
					<th>Staff Phone</th>
					<th>Staff Address</th>
					<th>Update Action</th>
					<th>Delete Action</th>
				</tr>
				</thead>
				<tbody>
					<?php 
						for ($i=0; $i < $countShowStaff; $i++) 
						{ 
							$SArray = mysqli_fetch_array($showRun);
							$SID = $SArray['StaffID'];
							$SName = $SArray['StaffName'];
							$SGender = $SArray['StaffGender'];
							$SPosition = $SArray['PositionName'];
							$SEmail = $SArray['StaffEmail'];
							$SPhone = $SArray['StaffPhone'];
							$SAddress = $SArray['StaffAddress'];

							echo "<tr>";
							echo "<td>".($i+1)."</td>";
							echo "<td>$SName</td>";
							echo "<td>$SPosition</td>";
							echo "<td>$SGender</td>";
							echo "<td>$SEmail</td>";
							echo "<td>$SPhone</td>";
							echo "<td>$SAddress</td>";
							echo "<td align='center'><button class='updateBtn'>
							<a href='updateStaff.php?StaffID=$SID'>Update</a>
							</button>
							</td>";
							echo "<td align='center'><button class='deleteBtn'>
							<a href='deleteStaff.php?StaffID=$SID'>Delete</a>
							</button>
							</td>";
							echo "</tr>";
						}
					 ?>
				</tbody>
			</table>
		</div>
		<a href="staffHome.php">Go back to staff home page.</a>
	</fieldset>
</body>
</html>
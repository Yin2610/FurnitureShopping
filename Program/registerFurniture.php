<?php 
session_start();
include('connect.php');
include('AutoID_Functions.php');
include('staffHeader.php');
if (isset($_SESSION['SID'])) 
{
	if (isset($_POST['btnRegister'])) 
	{
		$FurnitureID = $_POST['txtFurnitureID'];
		$FurnitureName = $_POST['txtFurnitureName'];
		$Price = $_POST['txtPrice'];
		$Quantity = $_POST['txtQuantity'];
		$UsePlace = $_POST['cboFurnPlace'];
		$Description = $_POST['txtDescription'];
		$BrandID = $_POST['cboBrand'];
		$MaterialID = $_POST['cboMaterial'];
		$FurnitureTypeID = $_POST['cboFurnType'];

		$FurnitureImage1 = $_FILES['fImage1']['name'];
		$Folder = "FurnitureImage/";
		if($FurnitureImage1)
		{
			$FileName1 = $Folder."_".$FurnitureImage1;
			$Copy = copy($_FILES['fImage1']['tmp_name'], $FileName1);
			if(!$Copy)
			{
				echo "<p>The first furniture image cannot be uploaded.</p>";
				exit();
			}
		}

		$FurnitureImage2 = $_FILES['fImage2']['name'];
		if($FurnitureImage2)
		{
			$FileName2 = $Folder."_".$FurnitureImage2;
			$Copy = copy($_FILES['fImage2']['tmp_name'], $FileName2);
			if(!$Copy)
			{
				echo "<p>The second furniture image cannot be uploaded.</p>";
				exit();
			}
		}

		$FurnitureImage3 = $_FILES['fImage3']['name'];
		if($FurnitureImage3)
		{
			$FileName3 = $Folder."_".$FurnitureImage3;
			$Copy = copy($_FILES['fImage3']['tmp_name'], $FileName3);
			if(!$Copy)
			{
				echo "<p>The third furniture image cannot be uploaded.</p>";
				exit();
			}
		}

		$selectFurniture = "SELECT * FROM Furniture
							WHERE FurnitureName = '$FurnitureName'";
		$selectFurnitureRun = mysqli_query($connection, $selectFurniture);
		$countFurniture = mysqli_num_rows($selectFurnitureRun);
		if($countFurniture>0)
		{
			echo "<script>window.alert('This furniture already added.')</script>";
			echo "<script>window.location='registerFurniture.php'</script>";
		}
		else
		{
			$insertFurniture = "INSERT INTO Furniture (FurnitureID, FurnitureName, Price, Quantity, UsePlace, Description, FurnitureImage1, FurnitureImage2, FurnitureImage3, BrandID, MaterialID, FurnitureTypeID) VALUES('$FurnitureID', '$FurnitureName', '$Price', '$Quantity', '$UsePlace', '$Description', '$FileName1', '$FileName2', '$FileName3', '$BrandID', '$MaterialID', '$FurnitureTypeID')";
			$insertRun = mysqli_query($connection, $insertFurniture);
			if($insertRun)
			{
				echo "<script>window.alert('Furniture added successfully.')</script>";
				echo "<script>window.location='registerFurniture.php'</script>";
			}
			else
			{
				echo "<p>Something went wrong in registering furniture:".mysqli_error($connection)."</p>";
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
	<title>Furniture Registration</title>
	<style type="text/css">
		#FurnitureList, #FurnitureList td,  #FurnitureList th
		{
			border: 1px solid #B9B9B9;
			padding: 10px 15px;
			border-collapse: collapse;
		}
		.borderTable
		{
			border: 1px solid #E2E2E2;
		}
		@media screen and (min-width: 400px)
		{
			#tbl1, #tbl2
			{
				margin-left: 10px !important;
			}
		}
		@media screen and (min-width: 1400px)
		{
			#tbl2
			{
				margin-left: 180px !important;
			}
		}
	</style>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="container">
		<form method="POST" action="registerFurniture.php" enctype="multipart/form-data" class="form-margin-top">
			<h3>Furniture registration</h3>
			<hr>
			<div class="row justify-content-center">
				<table class="col-sm-5 borderTable" id="tbl1" cellpadding="5px">
					<tr>
						<td>Furniture ID:</td>
						<td><input type="text" name="txtFurnitureID" value="<?php echo AutoID('Furniture', 'FurnitureID', 'F-', 5) ?>" readonly></td>
					</tr>
					<tr>
						<td>Furniture name:</td>
						<td><input type="text" name="txtFurnitureName" required="required"></td>
					</tr>
					<tr>
						<td>Brand name: </td>
						<td>
							<select name="cboBrand" size="5" required="required">
							<?php 
								$selectBrand = "SELECT * FROM Brand";
								$selectRun = mysqli_query($connection, $selectBrand);	
								$selectRunCount = mysqli_num_rows($selectRun);
								for ($i=0; $i < $selectRunCount; $i++)
								{ 
									$BrandArray = mysqli_fetch_array($selectRun);
									$BrandID = $BrandArray['BrandID'];
									$BrandName = $BrandArray['BrandName'];
									echo "<option value='$BrandID'>$BrandName</option>";
								}
							 ?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Material name: </td>
						<td>
							<select name="cboMaterial" size="5" required="required" >
								<?php 
								$selectMaterial = "SELECT * FROM Material";
								$selectRun = mysqli_query($connection, $selectMaterial);	
								$selectRunCount = mysqli_num_rows($selectRun);
								for ($i=0; $i < $selectRunCount; $i++)
								{ 
									$MaterialArray = mysqli_fetch_array($selectRun);
									$MaterialID = $MaterialArray['MaterialID'];
									$Material = $MaterialArray['Material'];
									echo "<option value='$MaterialID'>$Material</option>";
								}
							 ?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Furniture type: </td>
						<td>
							<select name="cboFurnType" size="5" required="required">
								<?php 
								$selectFurnType = "SELECT * FROM FurnitureType";
								$selectRun = mysqli_query($connection, $selectFurnType);
								$selectRunCount = mysqli_num_rows($selectRun);
								for ($i=0; $i < $selectRunCount; $i++) 
								{ 
									$FurnTypeArray = mysqli_fetch_array($selectRun);
									$FurnitureTypeID = $FurnTypeArray['FurnitureTypeID'];
									$FurnitureType = $FurnTypeArray['FurnitureType'];
									echo "<option value='$FurnitureTypeID'>$FurnitureType</option>";
								}
							 ?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Furniture place:</td>
						<td>
							<select name="cboFurnPlace">
								<option>Bedroom</option>
								<option>Dining room</option>
								<option>Living room</option>
								<option>Kitchen</option>
							</select>
						</td>
					</tr>
				</table>
				<table class="col-sm-5 borderTable" id="tbl2" cellpadding="5px">
					<tr>
						<td>Price:</td>
						<td><input type="text" name="txtPrice" required="required"> MMK</td>
					</tr>
					<tr>
						<td>Quantity:</td>
						<td><input type="number" name="txtQuantity" required="required"></td>
					</tr>
					<tr>
						<td>Furniture image1:</td>
						<td><input type="file" name="fImage1" required="required"></td>
					</tr>
					<tr>
						<td>Furniture image2:</td>
						<td><input type="file" name="fImage2" required="required"></td>
					</tr>
					<tr>
						<td>Furniture image3:</td>
						<td><input type="file" name="fImage3" required="required"></td>
					</tr>
					<tr>
						<td>Furniture description: </td>
						<td><textarea name="txtDescription" rows="10" cols="20" style="resize: none;"></textarea></td>
					</tr>
				</table>
			</div>

			<input type="submit" name="btnRegister" value="Register" class="form-button text-align" style="width: 100px; display: block; margin: 0 auto">
			<br>
			<a href="staffHome.php">Go back to staff home page.</a>
		</form>
	</div>
	<hr>
	<fieldset style="margin-top: 20px; padding: 20px">
		<legend>Furniture List</legend>
		<?php 
			$showFurniture="SELECT f.*, b.BrandName,
							m.Material, ft.FurnitureType
							FROM Furniture f, Brand b,
							Material m, FurnitureType ft
							WHERE f.BrandID = b.BrandID
							AND f.MaterialID = m.MaterialID
							AND f.FurnitureTypeID = ft.FurnitureTypeID";
			$showRun = mysqli_query($connection, $showFurniture);
			$countShowFurniture = mysqli_num_rows($showRun);
			if($countShowFurniture<1)
			{
				echo "<p>No furniture is registered yet.</p>";
				exit();
			}
		 ?>
		 <div class="table-responsive">
			<table width="100%" id='FurnitureList'>
				<tr>
					<th>No.</th>
					<th>Furniture name</th>
					<th>Furniture image1</th>
					<th>Furniture image2</th>
					<th>Furniture image3</th>
					<th>Furniture type</th>
					<th>Furniture place</th>
					<th>Brand name</th>
					<th>Price(MMK)</th>
					<th>Quantity</th>
				</tr>
					<?php 
						for ($i=0; $i < $countShowFurniture; $i++) 
						{ 
							$FArray = mysqli_fetch_array($showRun);
							$FID = $FArray['FurnitureID'];
							$FName = $FArray['FurnitureName'];
							$FPrice = $FArray['Price'];
							$FQuantity = $FArray['Quantity'];
							$FUsePlace = $FArray['UsePlace'];
							$FImage1 = $FArray['FurnitureImage1'];
							$FImage2 = $FArray['FurnitureImage2'];
							$FImage3 = $FArray['FurnitureImage3'];
							$BrandName = $FArray['BrandName'];
							$FurnitureType =$FArray['FurnitureType'];

							echo "<tr>";
							echo "<td>".($i+1)."</td>";
							echo "<td>$FName</td>";
							echo "<td><img src=".$FImage1." width=50px height=50px></img></td>";
							echo "<td><img src=".$FImage2." width=50px height=50px></img></td>";
							echo "<td><img src=".$FImage3." width=50px height=50px></img></td>";
							echo "<td>$FurnitureType</td>";
							echo "<td>$FUsePlace</td>";
							echo "<td>$BrandName</td>";
							echo "<td>$FPrice</td>";
							echo "<td>$FQuantity</td>";
							echo "</tr>";
						}
					 ?>
				</table>
			</div>
	</fieldset>
</body>
</html>



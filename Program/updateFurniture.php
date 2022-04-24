<?php 
session_start();
include('connect.php');
include('staffHeader.php');
if (isset($_SESSION['SID'])) 
{
	if(isset($_POST['btnUpdate']))
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

		$updateFurniture = "UPDATE Furniture 
							SET
							FurnitureID = '$FurnitureID',
							FurnitureName = '$FurnitureName',
							Price = '$Price',
							Quantity = '$Quantity',
							UsePlace = '$UsePlace',
							Description = '$Description',
							BrandID = '$BrandID',
							MaterialID = '$MaterialID',
							FurnitureTypeID = '$FurnitureTypeID',
							FurnitureImage1 = '$FileName1',
							FurnitureImage2 = '$FileName2',
							FurnitureImage3 = '$FileName3'
							WHERE FurnitureID = '$FurnitureID'";
		$updateRun = mysqli_query($connection, $updateFurniture);
		if($updateRun)
		{
			echo "<script>window.alert('Furniture information updated.')</script>";
			echo "<script>window.location='viewFurniture.php'</script>";
		}
	}
	if(isset($_GET['FurnitureID'])) 
	{
		$FurnitureID = $_GET['FurnitureID'];
		$selectFurniture = "SELECT f.*, b.BrandName, ft.FurnitureType, m.Material FROM Furniture f, Brand b, FurnitureType ft, Material m 
		WHERE f.FurnitureID='$FurnitureID' 
		AND f.BrandID = b.BrandID
		AND f.FurnitureTypeID = ft.FurnitureTypeID
		AND f.MaterialID = m.MaterialID";
		$selectFurnitureRun = mysqli_query($connection, $selectFurniture);
		$countFurniture = mysqli_num_rows($selectFurnitureRun);
		$Farr = mysqli_fetch_array($selectFurnitureRun);
		if ($countFurniture < 1) 
		{
			echo "<script>window.alert('Furniture information not found.')</script>";
			echo "<script>window.location='registerFurniture.php'</script>";
		}
	}
}
else
{
	echo "<script>window.alert('Please login first.')</script>";
	echo "<script>window.location='staffLogin.php'</script>";
}
?>
<title>Update furniture</title>
<script type="text/javascript">
	document.getElementById("cboFurnType").onload = function() {
		alert('x');
		var furnPlace = "<?php $Farr['FurniturePlace'] ?>";
		alert(furnPlace);
	};
</script>
<link rel="stylesheet" type="text/css" href="style.css">
<div class="container">
<form action="updateFurniture.php" method="POST" enctype="multipart/form-data" class="form-margin-top margin-bottom" style="margin-left: 20px">
	<h2>Update furniture</h2>
	<table align="center">	
		<tr>
			<td><input type="hidden" name="txtFurnitureID" value="<?php echo $Farr['FurnitureID'] ?>"></td>
		</tr>	
		<tr>
			<td>Furniture name:</td>
			<td><input type="text" name="txtFurnitureName" required="required" value="<?php echo $Farr['FurnitureName'] ?>">
			</td>
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
						if($BrandName == $Farr['BrandName'])
						{
							echo "<option value='$BrandID' selected>$BrandName</option>";
						}
						else
						{
							echo "<option value='$BrandID'>$BrandName</option>";
						}
						
					}
				 ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Material name: </td>
			<td>
				<select name="cboMaterial" id="cboMaterial" size="5" required="required" >
					<?php 
					$selectMaterial = "SELECT * FROM Material";
					$selectRun = mysqli_query($connection, $selectMaterial);	
					$selectRunCount = mysqli_num_rows($selectRun);
					for ($i=0; $i < $selectRunCount; $i++)
					{ 
						$MaterialArray = mysqli_fetch_array($selectRun);
						$MaterialID = $MaterialArray['MaterialID'];
						$Material = $MaterialArray['Material'];
						if($Material == $Farr['Material'])
						{
							echo "<option value='$MaterialID' selected>$Material</option>";
						}
						else
						{
							echo "<option value='$MaterialID'>$Material</option>";
						}
					}
				 ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Furniture type: </td>
			<td>
				<select name="cboFurnType" id="cboFurnType" size="5" required="required">
					<?php 
					$selectFurnType = "SELECT * FROM FurnitureType";
					$selectRun = mysqli_query($connection, $selectFurnType);
					$selectRunCount = mysqli_num_rows($selectRun);
					for ($i=0; $i < $selectRunCount; $i++) 
					{ 
						$FurnTypeArray = mysqli_fetch_array($selectRun);
						$FurnitureTypeID = $FurnTypeArray['FurnitureTypeID'];
						$FurnitureType = $FurnTypeArray['FurnitureType'];
						if($FurnitureType == $Farr['FurnitureType'])
						{
							echo "<option value='$FurnitureTypeID' selected>$FurnitureType</option>";
						}
						else
						{
							echo "<option value='$FurnitureTypeID'>$FurnitureType</option>";
						}
					}
				 ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Furniture place:</td>
			<td>
				<select name="cboFurnPlace" id="cboFurnPlace">
					<?php 
						$farray = array("Bedroom", "Dining room", "Living room", "Kitchen", "Kids");
						for($i=0; $i<count($farray); $i++)
						{
							if($farray[$i] == $Farr['UsePlace'])
							{
								echo '<option value="'.$farray[$i].'" id="'.$farray[$i].'" selected>'.$farray[$i].'</option>';
							}
							else
							{
								echo '<option value="'.$farray[$i].'" id="'.$farray[$i].'">'.$farray[$i].'</option>';
							}
							
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Price:</td>
			<td><input type="text" name="txtPrice" required="required" value=" <?php echo $Farr['Price'] ?>"> MMK</td>
		</tr>
		<tr>
			<td>Quantity:</td>
			<td><input type="number" name="txtQuantity" required="required" value="<?php echo $Farr['Quantity'] ?>"></td>
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
			<td><textarea name="txtDescription" id="txtDescription" rows="10" cols="35" style="resize: none;"><?php echo $Farr['Description']; ?></textarea></td>
		</tr>
		<tr>
		<tr>
			<td align='center' colspan="2">
				<input type="submit" name="btnUpdate" value="Update">
			</td>
		</tr>
	</table>
	<a href="viewFurniture.php">Go back to furniture list.</a>
</form>
</div>
</body>
</html>
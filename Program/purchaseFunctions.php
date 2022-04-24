<?php  
function AddFurniture($FurnitureID,$PurchasePrice,$PurchaseQuantity)
{
	include('connect.php');

	$query="SELECT * FROM Furniture
		 	WHERE FurnitureID='$FurnitureID'";
	$ret=mysqli_query($connection,$query);
	$count=mysqli_num_rows($ret);
	$rows=mysqli_fetch_array($ret);

	if($count < 1) 
	{
		echo "<div style='padding: 20px'>";
		echo "<p>No Furniture Information Found!</p>";
		echo "<a href='purchaseOrder.php'>Go back to purchase order page.</a>";
		echo "</div>";
		exit();
	}

	if($PurchaseQuantity < 1) 
	{
		echo "<script>window.alert('Please enter correct quantity to purchase!');
		window.location='purchaseOrder.php';</script>";
		exit();
	}

	if($PurchasePrice < 1) 
	{
		echo "<script>window.alert('Please enter correct price for furniture!');
		window.location='purchaseOrder.php';</script>";
		exit();
	}

	if(isset($_SESSION['Purchase_Functions']))
	{
		//Condition 2 & 3
		$index = IndexOf($FurnitureID);
		
		if($index == -1)
		{
			$count = count($_SESSION['Purchase_Functions']);
			$_SESSION['Purchase_Functions'][$count]['FurnitureID'] = $FurnitureID;
			$_SESSION['Purchase_Functions'][$count]['PurchasePrice'] = $PurchasePrice;
			$_SESSION['Purchase_Functions'][$count]['PurchaseQuantity'] = $PurchaseQuantity;
			$_SESSION['Purchase_Functions'][$count]['FurnitureName'] = $rows['FurnitureName'];
			$_SESSION['Purchase_Functions'][$count]['FurnitureImage1'] = $rows['FurnitureImage1'];
		}
		else
		{
			$_SESSION['Purchase_Functions'][$index]['PurchaseQuantity'] += $PurchaseQuantity;
		}
	}
	else
	{
		//Condition 1
		$_SESSION['Purchase_Functions'] = array(); //Create session array
		$_SESSION['Purchase_Functions'][0]['FurnitureID'] = $FurnitureID;
		$_SESSION['Purchase_Functions'][0]['PurchasePrice'] = $PurchasePrice;
		$_SESSION['Purchase_Functions'][0]['PurchaseQuantity'] = $PurchaseQuantity;

		$_SESSION['Purchase_Functions'][0]['FurnitureName'] = $rows['FurnitureName'];
		$_SESSION['Purchase_Functions'][0]['FurnitureImage1'] = $rows['FurnitureImage1'];
	}
	echo "<script>window.location='purchaseOrder.php'</script>";
}

function RemoveProduct($FurnitureID)
{
	$index = IndexOf($FurnitureID);
	unset($_SESSION['Purchase_Functions'][$index]);
	$_SESSION['Purchase_Functions'] = array_values($_SESSION['Purchase_Functions']);
	echo "<script>window.location='purchaseOrder.php'</script>";
}

function ClearAll()
{
	unset($_SESSION['Purchase_Functions']);
	echo "<script>window.location='purchaseOrder.php'</script>";
}

function calculateTotalAmount()
{
	$TotalAmount=0;
	$size=count($_SESSION['Purchase_Functions']);
	for($i=0;$i<$size;$i++) 
	{ 
		$PPrice=$_SESSION['Purchase_Functions'][$i]['PurchasePrice'];
		$PQuantity=$_SESSION['Purchase_Functions'][$i]['PurchaseQuantity'];

		$TotalAmount+=($PPrice * $PQuantity);
	}
	return $TotalAmount;
}

function calculateTotalQuantity()
{
	$TotalQuantity=0;
	$size=count($_SESSION['Purchase_Functions']);
	for($i=0;$i<$size;$i++) 
	{ 
		$PQuantity=$_SESSION['Purchase_Functions'][$i]['PurchaseQuantity'];

		$TotalQuantity+=$PQuantity;
	}
	return $TotalQuantity;
}

function IndexOf($FurnitureID)
{	
	if(!isset($_SESSION['Purchase_Functions'])) 
	{
		return -1;
	}

	$size=count($_SESSION['Purchase_Functions']);

	if ($size < 1) 
	{
		return -1;
	}

	for ($i=0; $i < $size; $i++) 
	{ 
		if ($FurnitureID == $_SESSION['Purchase_Functions'][$i]['FurnitureID']) 
		{
			return $i;
		}
	}
	return -1;
}

?>
<?php  
session_start();
function AddFurniture($FurnitureID, $Price, $BuyQuantity, $AvailQuantity)
{
	include('connect.php');

	$query="SELECT * FROM Furniture
		 	WHERE FurnitureID='$FurnitureID'";
	$ret=mysqli_query($connection,$query);
	$count=mysqli_num_rows($ret);
	$rows=mysqli_fetch_array($ret);

	if($count < 1) 
	{
		echo "<p>No Furniture Information Found!</p>";
		exit();
	}

	if($BuyQuantity < 1) 
	{
		echo "<script>
		window.alert('Please enter correct quantity to purchase!');
		window.location='furnitureDetails.php?FurnitureID=$FurnitureID';
		</script>";
	}

	if(isset($_SESSION['ShoppingCart_Functions']))
	{
		//Condition 2 & 3
		$index = IndexOf($FurnitureID);

		if($index == -1)
		{
			$count = count($_SESSION['ShoppingCart_Functions']);
			$_SESSION['ShoppingCart_Functions'][$count]['FurnitureID'] = $FurnitureID;
			$_SESSION['ShoppingCart_Functions'][$count]['BuyQuantity'] = $BuyQuantity;
			$_SESSION['ShoppingCart_Functions'][$count]['AvailQuantity'] = $AvailQuantity;
			$_SESSION['ShoppingCart_Functions'][$count]['Price'] = $Price;
			$_SESSION['ShoppingCart_Functions'][$count]['FurnitureName'] = $rows['FurnitureName'];
			$_SESSION['ShoppingCart_Functions'][$count]['FurnitureImage1'] = $rows['FurnitureImage1'];
		}
		else
		{
			$_SESSION['ShoppingCart_Functions'][$index]['BuyQuantity'] += $BuyQuantity;
		}
	}
	else
	{
		//Condition 1
		$_SESSION['ShoppingCart_Functions'] = array(); //Create session array
		$_SESSION['ShoppingCart_Functions'][0]['FurnitureID'] = $FurnitureID;
		$_SESSION['ShoppingCart_Functions'][0]['BuyQuantity'] = $BuyQuantity;
		$_SESSION['ShoppingCart_Functions'][0]['AvailQuantity'] = $AvailQuantity;
		$_SESSION['ShoppingCart_Functions'][0]['Price'] = $Price;
		
		$_SESSION['ShoppingCart_Functions'][0]['FurnitureName'] = $rows['FurnitureName'];
		$_SESSION['ShoppingCart_Functions'][0]['FurnitureImage1'] = $rows['FurnitureImage1'];
	}
	echo "<script>window.location='shoppingCart.php'</script>";
}

function RemoveFurniture($FurnitureID)
{
	$index = IndexOf($FurnitureID);
	unset($_SESSION['ShoppingCart_Functions'][$index]);
	$_SESSION['ShoppingCart_Functions'] = array_values($_SESSION['ShoppingCart_Functions']);
	echo "<script>window.location='shoppingCart.php'</script>";
}

function ClearAll()
{
	unset($_SESSION['ShoppingCart_Functions']);
	echo "<script>window.location='shoppingCart.php'</script>";
}

function calculateTotalAmount()
{
	$TotalAmount=0;
	$size=count($_SESSION['ShoppingCart_Functions']);
	for($i=0;$i<$size;$i++) 
	{ 
		$Price=$_SESSION['ShoppingCart_Functions'][$i]['Price'];
		$BQuantity=$_SESSION['ShoppingCart_Functions'][$i]['BuyQuantity'];

		$TotalAmount+=($Price * $BQuantity);
	}
	return $TotalAmount;
}

function CalculateVAT()
{
	$VAT=CalculateTotalAmount() * 0.05;
	return $VAT;
}

function calculateTotalQuantity()
{
	$TotalQuantity=0;
	$size=count($_SESSION['ShoppingCart_Functions']);
	$BQuantity = 0;
	for($i=0;$i<$size;$i++) 
	{ 
		$BQuantity=$_SESSION['ShoppingCart_Functions'][$i]['BuyQuantity'];
		$TotalQuantity+=$BQuantity;
	}
	return $TotalQuantity;
}

function IndexOf($FurnitureID)
{	
	if(!isset($_SESSION['ShoppingCart_Functions'])) 
	{
		return -1;
	}

	$size=count($_SESSION['ShoppingCart_Functions']);

	if ($size < 1) 
	{
		return -1;
	}

	for ($i=0; $i < $size; $i++) 
	{ 
		if ($FurnitureID == $_SESSION['ShoppingCart_Functions'][$i]['FurnitureID']) 
		{
			return $i;
		}
	}
	return -1;
}

?>
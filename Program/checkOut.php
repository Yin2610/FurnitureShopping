<?php 
include('connect.php');
include('shoppingCartFunctions.php');
include('AutoID_Functions.php');
include('customerHeader.php');

if(!isset($_SESSION['CID']))
{
	echo "<script>
	alert('Please log in or register first.');
	window.location='customerLogin.php';
	</script>";
}
if(!isset($_SESSION['ShoppingCart_Functions']))
{
	echo "<script>alert('Your shopping cart is empty. You will be redirected to furniture display page.');
	window.location='furnitureDisplay.php';
	</script>";
}
if(isset($_POST['btnCheckout'])) 
{
	$QueryRun = "YES"; //variable for checking input required, if all required info is typed in, query will be run

	$CustomerID = $_SESSION['CID'];
	$txtOrderID = $_POST['txtOrderID'];
	$txtOrderDate = $_POST['txtOrderDate'];
	$rdoDelivery = $_POST['rdoDelivery'];
	$DeliveryStatus = "NOT DONE";
	$txtDeliveryEstimate = $_POST['txtDeliveryEstimate'];

	//Payment
	$txtPaymentID = $_POST['txtPaymentID'];
	$rdoPayment = $_POST['rdoPayment'];
	$txtPayPhoneNo = "";
	$txtTransactionNo = "";
	$rdoCreditCard = "";
	$txtCredit = "";
	$txtCVC = "";
	$txtExp = "";
	$txtPaymentStatus = "NOT PAID";

	//Total
	$TotalAmount = CalculateTotalAmount();
	$VAT = CalculateVAT();
	$GrandTotal = CalculateTotalAmount() + CalculateVAT() + 1500;
	$TotalQuantity = CalculateTotalQuantity();

	if ($rdoDelivery == "OtherAddress") 
	{
		$txtCustomerName=$_POST['txtReceiverName'];
		$txtCPhone=$_POST['txtRPhone'];
		$txtCEmail = $_POST['txtREmail'];
		$txtCAddress=$_POST['txtRAddress'];
		$txtDeliNotes = $_POST['txtRDeliNotes'];
		if($txtCustomerName == "" || $txtCPhone == "" || $txtCEmail == "" || $txtCAddress == "")
		{
			$QueryRun = "NO";
		}
	}
	else
	{
		$txtCustomerName = $_SESSION['CName'];
		$txtCPhone = $_SESSION['CPhone'];
		$txtCEmail = $_SESSION['CEmail'];
		$txtCAddress = $_SESSION['CAddress'];
		$txtDeliNotes = $_POST['txtSDeliNotes'];
	}	
	if($rdoPayment == "KPAY")
	{
		$txtPayPhoneNo = $_POST['txtKpay'];
		$txtTransactionNo = $_POST['txtKTransNo'];
		$txtPaymentStatus = "PAID";
		if($txtPayPhoneNo == "" || $txtTransactionNo == "")
		{
			$QueryRun = "NO";
		}
	}
	elseif ($rdoPayment == "WAVEPAY") 
	{
		$txtPayPhoneNo = $_POST['txtWavePay'];
		$txtTransactionNo = $_POST['txtWTransNo'];
		$txtPaymentStatus = "PAID";
		if($txtPayPhoneNo == "" || $txtTransactionNo == "")
		{
			$QueryRun = "NO";
		}
	}
	elseif($rdoPayment == "CARD")
	{
		$rdoCreditCard = $_POST['rdoCreditCard'];
		$txtCredit = $_POST['txtCredit'];
		$txtCVC = $_POST['txtCVC'];
		$txtExp = $_POST['txtExp'];
		$txtPaymentStatus = "PAID";
		if($txtCredit == "" || $txtCVC == "" || $txtExp == "")
		{
			$QueryRun = "NO";
		}
	}

	if($QueryRun == "YES")
	{
		// Insert Orders Data (1)
		$InsertO = "INSERT INTO Orders
			VALUES
			('$txtOrderID','$txtOrderDate', '$TotalQuantity', '$GrandTotal', '$VAT', '$CustomerID', '$txtCustomerName', '$txtCPhone', '$txtCEmail', '$txtCAddress', 'PENDING', '$txtDeliveryEstimate', '$DeliveryStatus', '$txtDeliNotes', '$txtPaymentID') 
				";
		$ret=mysqli_query($connection,$InsertO);

		$InsertPay = "INSERT INTO Payment VALUES ('$txtPaymentID', '$rdoPayment', '$rdoCreditCard', '$txtCredit', '$txtCVC', '$txtExp', '$txtPayPhoneNo', '$txtTransactionNo', '$txtPaymentStatus', '$txtOrderID', '$CustomerID')";
		$ret=mysqli_query($connection,$InsertPay);


		// Insert FurnitureOrder Data (*)
		$size=count($_SESSION['ShoppingCart_Functions']);

		for($i=0;$i<$size;$i++) 
		{ 
			$FurnitureID = $_SESSION['ShoppingCart_Functions'][$i]['FurnitureID'];
			$FurnitureName = $_SESSION['ShoppingCart_Functions'][$i]['FurnitureName'];
			$Price = $_SESSION['ShoppingCart_Functions'][$i]['Price'];
			$Quantity = $_SESSION['ShoppingCart_Functions'][$i]['BuyQuantity'];

			$InsertFO = "INSERT INTO FurnitureOrder
					   (OrderID,FurnitureID,OrderSubPrice,OrderSubQuantity)
					   VALUES
					   ('$txtOrderID','$FurnitureID','$Price','$Quantity')";
			$ret = mysqli_query($connection,$InsertFO);

			$UpdateQuantity = "UPDATE Furniture 
						SET Quantity = Quantity - '$Quantity'
						WHERE FurnitureID = '$FurnitureID'";
			$ret=mysqli_query($connection,$UpdateQuantity);
		}

		if($ret) 
		{
			echo "<script>window.alert('Customer order successfully created!')</script>";
			unset($_SESSION['ShoppingCart_Functions']);

			echo "<script>window.location='furnitureDisplay.php'</script>";
		}
		else
		{
			echo "<p>Something went wrong in Orders :" . mysqli_error($connection) . "</p>";
		}
	}
	else
	{
		echo "<script>alert('Please fill in required information before clicking checkout.');</script>";
		echo "<script>location='checkOut.php'</script>";
	}
}
?>
<title>Checkout & Payment</title>
<style type="text/css">
	#Custable, #Othertable
	{
		border: 2px solid #f0f0e9;
		background: #f0f0e9;
	}
	.total-result td
	{
		align-content: right;
	}
	table
	{
		color: #696763; 
	}
	#CardPayment, #Kpay, #Wavepay
	{
		border: 1px solid #E2E2E2;
		padding: 8px;
	}
</style>
<script type="text/javascript">
function SameAddress()
{
	document.getElementById('SameAddress').style.display="block";
	document.getElementById('OtherAddress').style.display="none";
}
function OtherAddress()
{
	document.getElementById('SameAddress').style.display="none";
	document.getElementById('OtherAddress').style.display="block";
}

function COD()
{
	document.getElementById('CardPayment').style.display="none";
	document.getElementById('Kpay').style.display="none";
	document.getElementById('Wavepay').style.display="none";
}

function CardPayment()
{
	document.getElementById('CardPayment').style.display="block";
	document.getElementById('Kpay').style.display="none";
	document.getElementById('Wavepay').style.display="none";
}

function Kpay()
{
	document.getElementById('CardPayment').style.display="none";
	document.getElementById('Kpay').style.display="block";
	document.getElementById('Wavepay').style.display="none";
}

function Wavepay()
{
	document.getElementById('CardPayment').style.display="none";
	document.getElementById('Kpay').style.display="none";
	document.getElementById('Wavepay').style.display="block";
}

function activeTab()
{
	document.getElementById('checkout').classList.add("active");
}
</script>
<form action="checkOut.php" method="POST">
<div class="container">
	<h3>Checkout</h3>
	<hr>
		<div style="margin-bottom: 20px;">
			<table cellpadding="3px">
				<tr>
					<td><h4>Order no</h4></td>
					<td><h4>: <input type="text" name="txtOrderID" value="<?php echo AutoID('orders','OrderID','ORD-',6)?>" ></h4></td>
				</tr>
				<tr>
					<td><h4>Order date</h4></td>
					<td><h4>: <input type="text" name="txtOrderDate" value="<?php echo $date = date('Y-m-d'); ?>"  readonly /> </h4></td>
				</tr>
				<tr>
					<td><h4>Delivery estimate</h4></td>
					<td><h4>: <input type="text" name="txtDeliveryEstimate" value="<?php echo date('Y-m-d', strtotime($date. ' + 15 days')); ?>" readonly></h4></td>
				</tr>
			</table>
		</div>
		<div style="border: 1px solid #E2E2E2;" class="col-sm-6">
			<div class="checkout-options">
				<ul class="nav">
					<li>
						<label><input type="radio" name="rdoDelivery" value="SameAddress" onClick="SameAddress()" checked /> Registered address</label>
					</li>
					<li>
						<label><input type="radio" name="rdoDelivery" value="OtherAddress" onClick="OtherAddress()" /> Other address</label>
					</li>
				</ul>
			</div><!--/checkout-options-->

			<div id="SameAddress" style="margin-left: 20px; margin-top: 10px">
				<div class="shopper-info">
					<p>Shopper Information</p>
					<table cellpadding="5px" class="col-sm-12">
						<tr>
							<td>Name</td>
							<td>: <?php echo $CName = $_SESSION['CName'] ?>
							</td>
						</tr>
						<tr>
							<td>Phone number</td>
							<td>: <?php echo $CPhone = $_SESSION['CPhone']; ?>						
							</td>
						</tr>
						<tr>
							<td>Email</td>
							<td>: <?php echo $CEmail = $_SESSION['CEmail']; ?>
							</td>
						</tr>
						<tr>
							<td>Address</td>
							<td>: <?php echo $CAddress = $_SESSION['CAddress'] ?>
							</td>
						</tr>
					</table>
					<textarea name="txtSDeliNotes" placeholder="Enter notes about your order, for delivery" maxlength="200" rows="4"></textarea>
				</div>
			</div>
			<div class="shopper-informations" style="margin-left: 20px; margin-top: 10px">
				<div id="OtherAddress" style="display: none;">
					<div class="shopper-info">
						<p>Furniture receiver Information</p>
							<input id="Othertable" type="text" name="txtReceiverName" placeholder="Enter receiver's name" style="width: 250px; margin-bottom: 10px;">
							<br>
							<input id="Othertable" type="text" name="txtRPhone" placeholder="Enter receiver's phone" style="width: 250px; margin-bottom: 10px;">
							<br>
							<input id="Othertable" type="email" name="txtREmail" placeholder="Enter receiver's email" style="width: 250px; margin-bottom: 10px;">
							<br>
							<textarea name="txtRAddress" placeholder="Enter home No, floor, street etc..." maxlength="200" rows="4"></textarea>
							<br>
							<br>
							<textarea name="txtRDeliNotes" placeholder="Enter notes about your order, for delivery" maxlength="200" rows="4"></textarea>
						<br><br>
					</div>
				</div>
			</div>
		</div>
	</div>
	<section id="cart_items">
		<div class="container">
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Image</td>
							<td class="description">Furniture name</td>
							<td class="price">Price</td>
							<td class="quantity">Buying quantity</td>
							<td class="total">Sub total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>

					<?php 
						$size=count($_SESSION['ShoppingCart_Functions']);
						for ($i=0;$i<$size;$i++) 
						{ 
							$FurnitureImage1=$_SESSION['ShoppingCart_Functions'][$i]['FurnitureImage1'];
							$FurnitureID=$_SESSION['ShoppingCart_Functions'][$i]['FurnitureID'];
				
							echo "<tr>";
							echo "<td class='cart_product'> 
									<img src='$FurnitureImage1' width='100px' height='120px'/> 
								</td>
								<td class='cart_description'><h4><a>". $_SESSION['ShoppingCart_Functions'][$i]['FurnitureName'] ."</a></h4>
									<p>Furniture ID: ". $_SESSION['ShoppingCart_Functions'][$i]['FurnitureID'] ."</p></td>
								<td class='cart_price'><p>". $_SESSION['ShoppingCart_Functions'][$i]['Price'] ." MMK</p></td>";
							$BuyQuantity = $_SESSION['ShoppingCart_Functions'][$i]['BuyQuantity'];
							$AvailQuantity = $_SESSION['ShoppingCart_Functions'][$i]['AvailQuantity'];
							if($BuyQuantity > $AvailQuantity)
							{
								echo "<script>window.alert('Your buying quantity exceeds available quantity. So, it has been reduced to available quantity.');</script>";
								$_SESSION['ShoppingCart_Functions'][$i]['BuyQuantity'] = $AvailQuantity;
								echo "<td class='cart_price'>
										<p>".$AvailQuantity."</p>
									</td>
									<td class='cart_price' id='subTotal'>
										<p>". $_SESSION['ShoppingCart_Functions'][$i]['Price'] * $AvailQuantity ." MMK</p>
									</td>";
							}
							else
							{
								echo "<td class='cart_price'>
										<p>".$BuyQuantity."</p>
									</td>
									<td class='cart_price' id='subTotal'>
										<p>". $_SESSION['ShoppingCart_Functions'][$i]['Price'] * $BuyQuantity ." MMK</p>
									</td>";
							}
							echo "<td class='cart_delete'>
									<a class='cart_quantity_delete' href='shoppingCart.php?FurnitureID=$FurnitureID&action=remove'><i class='fa fa-times'></i></a>
									</td>";
							echo "</tr>";
						}
						?>
						<tr>
							<td colspan="4" align="right"></td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr align="right">
										<td>Total Quantity</td>
										<td>
											<?php echo CalculateTotalQuantity() ?> pcs
										</td>
									</tr>
									<tr align="right">
										<td>Total Amount</td>
										<td align="right"><?php echo CalculateTotalAmount() ?> MMK</td>
									</tr>
									<tr align="right">
										<td>VAT (5%)</td>
										<td align="right">
											<?php echo CalculateVAT() ?> MMK
										</td>
									</tr>
									<tr class="shipping-cost" align="right">
										<td>Delivery fee</td>
										<td>1500 MMK</td>
									</tr>
									<tr align="right">
										<td>Grand Total</td>
										<td>
											<span><?php echo 1500 +CalculateVAT() + CalculateTotalAmount() ?> MMK</span>
										</td> 
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		</section> <!--/#cart_items-->
		<div class="payment-options">
			<div class="container">
				<div class="col-sm-12">
					<div>Payment ID: <input type="text" name="txtPaymentID" value="<?php echo AutoID('payment','PaymentID','PM-',6)?>"  readonly /></div>
					<span>
						<label><input type="radio" name="rdoPayment" value="COD" onClick="COD()" checked /> Cash on Delivery</label>
					</span>
					<span>
						<label><input type="radio" name="rdoPayment" value="CARD" onClick="CardPayment()" /> Card Payment</label>
					</span>
					<span>
						<label><input type="radio" name="rdoPayment" value="KPAY" onClick="Kpay()" /> K Pay </label>
					</span>
					<span>
						<label><input type="radio" name="rdoPayment" value="WAVEPAY" onClick="Wavepay()" /> Wave Pay</label>
					</span>
				</div>
				<div id="CardPayment" style="display: none;" class="col-sm-6">
					<table cellpadding="3px">
						<tr>
							<td>Credit card type</td>
							<td>: 
								<input type="radio" name="rdoCreditCard" value="MasterCard" checked="checked"> <img src="images/Website/Mastercard-Download-PNG.png" width="70px" height="40px" style="margin-right: 15px">

								<input type="radio" name="rdoCreditCard" value="Visa"> <img src="images/Website/Old-Visa-Logo-e1539377869237.png" width="70px" height="40px" style="margin-right: 15px">

								<input type="radio" name="rdoCreditCard" value="AmericanExpress"> <img src="images/Website/kisspng-american-express-logo-credit-card-payment-seo-for-the-finance-industry-experience-and-solu-5b62e8845e9914.5428316515332087083875.jpg" width="70px" height="40px">
							</td>
						</tr>
						<tr>
							<td>Credit card number</td>
							<td>
								: <input type="tel" name="txtCredit" maxlength="20" pattern="[0-9]{4} [0-9]{4} [0-9]{4} [0-9]{4}" placeholder="1234 1234 1234 1234">
							</td>
						</tr>
						<tr>
							<td>CVC</td>
							<td>
								: <input type="tel" name="txtCVC" maxlength="3" pattern="\d*" placeholder="123">
							</td>
						</tr>
						<tr>
							<td>Expiration date</td>
							<td>
								: <input type="tel" name="txtExp" maxlength="7" pattern="[0-9]{2}/[0-9]{4}" placeholder="mm/yyyy">
							</td>
						</tr>
					</table>
				</div>

				<div id="Kpay" style="display: none;" class="col-sm-6">
					<table cellpadding="3px">
						<tr>
							<td colspan="2">
								Homely Furn's KPay Phone No (09546540334)
								<br/>
								<img src="images/Website/qr-code-1442833538ywX.jpg" width="150px" height="150px" style="padding: 8px;"/>
							</td>
						</tr>
						<tr>
							<td>Enter your KPay phone number </td>
							<td>: <input type="tel" name="txtKpay" maxlength="11" pattern="09[0-9]{9}"></td>
						</tr>
						<tr>
							<td>Enter the transaction no </td>
							<td>: <input type="tel" name="txtKTransNo" pattern="\9*{20}" maxlength="20"></td>
						</tr>
					</table>
				</div>

				<div id="Wavepay" style="display: none;"  class="col-sm-6">
					<table cellpadding="3px">
						<tr>
							<td colspan="2">
								Homely Furn's WavePay Phone No (09546540334)
								<br/>
								<img src="images/Website/mm.com.wavemoney.wavepay.png" width="150px" height="150px" />
							</td>
						</tr>
						<tr>
							<td>Enter your WavePay phone number </td>
							<td>: <input type="tel" name="txtWavePay" maxlength="11" pattern="09[0-9]{9}"></td>
						</tr>
						<tr>
							<td>Enter the transaction no </td>
							<td>: <input type="tel" name="txtWTransNo" pattern="\9*" maxlength="20"></td>
						</tr>
					</table>
				</div>
				<br>
				<div class="col-sm-12">
					<button type="submit" class="btn btn-default check_out" name="btnCheckout">Check out</button>
				</div>
			</div>
		</div>
	</form>
</body>
</html>
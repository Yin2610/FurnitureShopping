<?php 
session_start();
include('connect.php');
include('staffHeader.php');
if(isset($_SESSION['SID']))
{
	$StaffID = $_SESSION['SID'];
	$selectStaff = "SELECT s.*, p.PositionName
					FROM Staff s, StaffPosition p
					WHERE s.StaffID='$StaffID'
					AND s.PositionID = p.PositionID";
	$selectRun = mysqli_query($connection, $selectStaff);
	$selectCount = mysqli_num_rows($selectRun);
	$staffArray = mysqli_fetch_array($selectRun);
	if($selectCount == 0) 
	{
		echo "<script>window.alert('User profile not found!')</script>";
		echo "<script>window.location='staffLogin.php'</script>";
	}
}
else
{
	echo "<script>window.alert('Please login first.')</script>";
	echo "<script>window.location='staffLogin.php'</script>";
}
?>
<style type="text/css">
	span
	{
		color: #106eea;
	}
</style>
<title>Staff home</title>
     <!-- ======= Services Section ======= -->
    <section class="services">
      <div class="container">
      	<p align="right">Welcome. <?php echo $staffArray['PositionName'] ?> <?php echo $staffArray['StaffName'] ?>.</p>
		<h3>Staff Home</h3>

    <?php 
        if($staffArray['PositionName'] == "General manager")
        {
          echo "
            <div>
              <h3><span>Furniture</span></h3>
            </div>
            <div class='row'>
              <div class='col-lg-3 col-md-4  align-items-stretch'>
                <div class='icon-box'>
                  <div class='icon'><i class='bx bx-chair' ></i></div>
                  <h4><a href='registerBrand.php'>Register brand</a></h4>
                  <p>Register furniture brand</p>
                </div>
              </div>
              <div class='col-lg-3 col-md-4  align-items-stretch'>
                <div class='icon-box'>
                  <div class='icon'><i class='bx bx-chair' ></i></div>
                  <h4><a href='registerMaterial.php'>Register material</a></h4>
                  <p>Register furniture material</p>
                </div>
              </div>
              <div class='col-lg-3 col-md-4  align-items-stretch'>
                <div class='icon-box'>
                  <div class='icon'><i class='bx bx-chair' ></i></div>
                  <h4><a href='registerFurnType.php'>Register furniture type</a></h4>
                  <p>Register type of furniture</p>
                </div>
              </div>
              <div class='col-lg-3 col-md-4  align-items-stretch'>
                  <div class='icon-box'>
                    <div class='icon'><i class='bx bx-chair' ></i></div>
                    <h4><a href='registerFurniture.php'>Register furniture</a></h4>
                    <p>Register instock furniture</p>
                </div>
              </div>
              <div class='col-lg-3 col-md-4  align-items-stretch mt-4'>
                <div class='icon-box'>
                  <div class='icon'><i class='bx bx-list-ul'></i></div>
                  <h4><a href='viewFurniture.php'>View furniture list</a></h4>
                  <p>View the registered furniture</p>
                </div>
              </div>
            </div>
              ";
        }
     ?>
        
    <?php 
        if($staffArray['PositionName'] == "Purchasing manager")
        {
          echo "
          <hr>
            <div>
              <h3><span>Suppliers</span></h3>
            </div>

            <div class='row'>
              <div class='col-lg-3 col-md-4  align-items-stretch'>
                <div class='icon-box'>
                  <div class='icon'><i class='bx bx-world' ></i></div>
                  <h4><a href='supplierRegister.php'>Register supplier</a></h4>
                  <p>Register furniture suppliers</p>
                </div>
              </div>
              <div class='col-lg-3 col-md-4  align-items-stretch'>
                <div class='icon-box'>
                  <div class='icon'><i class='bx bx-purchase-tag-alt' ></i></div>
                  <h4><a href='purchaseOrder.php'>Purchase order</a></h4>
                  <p>Record purchasing from suppliers</p>
                </div>
              </div>
              <div class='col-lg-3 col-md-4  align-items-stretch'>
                <div class='icon-box'>
                  <div class='icon'><i class='bx bx-purchase-tag-alt' ></i></div>
                  <h4><a href='purchaseOrderSearch.php'>Purchase order details</a></h4>
                  <p>View Purchase list</p>
                </div>
              </div>
            </div>";
          }
        ?>

    <?php
        if($staffArray['PositionName'] == "Delivery manager")
        {
          echo "
          <hr>
          <div>
            <h3><span>Customers</span></h3>
          </div>
          <div class='row'>
            <div class='col-lg-3 col-md-4 align-items-stretch'>
                <div class='icon-box'>
                  <div class='icon'><i class='bx bx-list-ul'></i></div>
                  <h4><a href='viewCustomer.php'>View customer list</a></h4>
                  <p>View the registered customers</p>
                </div>
            </div>
            <div class='col-lg-3 col-md-4 align-items-stretch'>
                <div class='icon-box'>
                  <div class='icon'><i class='bx bx-list-ul'></i></div>
                  <h4><a href='manageOrder.php'>Manage order</a></h4>
                  <p>Manage orders of customers</p>
                </div>
            </div>
          </div>
          ";
        }
     ?>

    <?php 
        if($staffArray['PositionName'] == "General manager")
        {
          echo "
          <hr>
          <div>
            <h3><span>Staff</span></h3>
          </div>
          <div class='row'>
            <div class='col-lg-3 col-md-4  align-items-stretch'>
              <div class='icon-box'>
                <div class='icon'><i class='bx bx-user-plus'></i></div>
                <h4><a href='registerPosition.php'>Register position</a></h4>
                <p>Register staff position</p>
              </div>
            </div>
            <div class='col-lg-3 col-md-4  align-items-stretch'>
              <div class='icon-box'>
                <div class='icon'><i class='bx bx-user-plus'></i></div>
                <h4><a href='staffRegister.php'>Register staff</a></h4>
                <p>Register new staff</p>
              </div>
            </div>  
            <div class='col-lg-3 col-md-4  align-items-stretch'>
              <div class='icon-box'>
                 <div class='icon'><i class='bx bx-list-ul'></i></div>
                  <h4><a href='viewStaff.php'>View staff list</a></h4>
                  <p>View the registered staff</p>
                </div>
              </div>
            </div>
          ";
        }
       ?>
        
    </section><!-- End Services Section -->

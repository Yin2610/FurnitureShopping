<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="staffAssets/vendor/aos/aos.css" rel="stylesheet">
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="staffAssets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="staffAssets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="staffAssets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="staffAssets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="staffAssets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="staffAssets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: BizLand - v3.3.0
  * Template URL: https://bootstrapmade.com/bizland-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <script type="text/javascript">
    function navToggle()
    {
      document.getElementById('navbar').classList.toggle('navbar-mobile');
      var bi = document.getElementsByClassName('bi');
      bi[0].classList.toggle('bi-list');
      bi[0].classList.toggle('bi-x');
    }
  </script>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="staffHome.php"><span>Homely Furn</span></a></h1>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a id="home" class="nav-link scrollto active" href="staffHome.php">Home</a></li>
          <li><a id="profile" href="staffProfile.php">Profile</a></li>
          <li><a href="staffLogout.php">Logout</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle" onclick="navToggle()"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
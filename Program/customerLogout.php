<?php 
	session_start();
	session_unset();
	session_destroy();
	echo "<script>window.alert('User logout succesful.')</script>";
	echo "<script>window.location='customerLogin.php'</script>";
 ?>
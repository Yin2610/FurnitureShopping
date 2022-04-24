<?php 
	session_start();
	session_unset();
	session_destroy();
	echo "<script>window.alert('Staff logout succesful.')</script>";
	echo "<script>window.location='staffLogin.php'</script>";
 ?>
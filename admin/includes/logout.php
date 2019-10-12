<?php  
include('config.php');
session_start();

	if(isset($_POST['logout'])){

	unset($_SESSION['email']);
	unset($_SESSION['id']);

	session_destroy();

	echo '
		<script>window.location.href="../index.html"</script>
	';

	}
?>
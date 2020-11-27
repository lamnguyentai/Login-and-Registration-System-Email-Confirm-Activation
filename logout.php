<?php include "functions/functions.php"; ?>
<?php include "functions/init.php"; ?> ?>
<?php
session_destroy();

if(isset($_COOKIE['email'])){

	unset($_COOKIE['email']);
	setcookie('email','', time()-60);
}


redirect("index.php");

 ?>
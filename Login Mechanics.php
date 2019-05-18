<?php

$username = $_POST['username'];

$password = $_POST['password'];

if($username == 'meranotan' && $password == 'lis161') {
	
	header("Location: List.php");
	
}

else {
	
	echo "Wrong username or password.";
	
}

?>
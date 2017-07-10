<?php
	ValModUsu3($values['usuario'],"1");
	session_start();
	session_destroy();
	header("location:login.php");
	exit();
?>
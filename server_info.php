<?php
	if(!isset($_SESSION))
	{
		session_start();
	}
	if(!isset($_SESSION['username']) || !isset($_SESSION['password']))
	{
		header('Location: login.php');
	}
	$servername = "localhost";//stardock.cs.virginia.edu
	$username = "root";//aeb3bs
	$pass = "password";//whatever your password is
	$dbname = 'cs4753';
	$conn = new mysqli($servername, $username, $pass, $dbname);
?>
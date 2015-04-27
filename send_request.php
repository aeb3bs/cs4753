<?php
	require "server_info.php";
	$user_id = $_POST['user_id'];
	$task_id = $_POST['task_id'];
	$message = $_POST['message'];
	$sql = "INSERT INTO `requests` (`user_id`, `task_id`, `description`)
	VALUES ('$user_id', '$task_id', '$message')";
	$result = $conn->query($sql);
	header("Location: home.php");
?>
	
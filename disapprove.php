<?php
	$task_id = $_POST['task_id'];
	$user_id = $_POST['user_id'];
	require "server_info.php";
	//need to change filled in tasks table
	$sql = "UPDATE `tasks` SET `filled` = 0 
	WHERE `id` = '$task_id'";
	$result = $conn->query($sql);
	//need to insert into works table
	$sql = "DELETE from `works`
	WHERE `user_id` = '$user_id'
	AND `task_id` = '$task_id'";
	$result = $conn->query($sql);
	//need to change status of all other requests for that task
	$sql = "UPDATE `requests` SET `status` = 0
	WHERE `task_id` = '$task_id'";
	$result = $conn->query($sql);
	$result = $conn->query($sql);
?>
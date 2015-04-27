<?php
	require "server_info.php";
	$task_id = $_POST['id'];
	$sql = "DELETE from `requests`
	WHERE `task_id` = '$task_id'";
	$result = $conn->query($sql);
	$sql = "DELETE from `works`
	WHERE `task_id` = '$task_id'";
	$result = $conn->query($sql);
	$sql = "DELETE from `needs`
	WHERE `task_id` = '$task_id'";
	$result = $conn->query($sql);
	$sql = "DELETE from `tasks`
	WHERE `id` = '$task_id'";
	$result = $conn->query($sql);
	header("Location: mytasks.php");
?>
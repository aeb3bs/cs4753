<?php
	require "server_info.php";
	$task_id = $_POST['task_id'];
	$user_id = $_POST['user_id'];
	$sql = "SELECT * FROM `works`
	WHERE `user_id` = '$user_id'
	AND `task_id` = '$task_id'";
	$result = $conn->query($sql);
	if($result->num_rows>0)
	{
		$sql = "UPDATE `tasks` SET `filled` = 0
		WHERE `id` = '$task_id'";
		$result = $conn->query($sql);
	}
	$sql = "UPDATE `requests` SET `status` = 0
	WHERE `task_id` = 'task_id'";
	$result = $conn->query($sql);
	$sql = "DELETE from `works`
	WHERE `task_id` = '$task_id'
	AND `user_id` = '$user_id'";
	$result = $conn->query($sql);
	$sql = "DELETE from `requests`
	WHERE `task_id` = '$task_id'
	AND `user_id` = '$user_id'";
	$result = $conn->query($sql);
	header("Location: mytasks.php");
?>
<?php
	require "server_info.php";
	$user_id = $_POST['user_id'];
	$sql = "SELECT * from tasks JOIN requests
	WHERE tasks.id = requests.task_id
	AND requests.user_id = '$user_id'";
	$result = $conn->query($sql);
	$array = [];
	while($row = $result->fetch_assoc())
	{
	array_push($array,$row);
	}
	echo json_encode($array);
?>
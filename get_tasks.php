<?php
	session_start();
	require 'server_info.php';
	$sql = "SELECT * from tasks ";
	$array = array();
	if(isset($_POST['words']))
	{
		$words = explode(" ", $_POST['words']);
		$sql = $sql . "WHERE ";
		foreach($words as $value)
		{
			$sql = $sql . "
			`title` LIKE '%" . $value . "%' OR ";
		}
		$sql = $sql . "'1' = '2'";
	}
	$result=mysqli_query($conn,$sql);
	while($row=$result->fetch_assoc())
	{
		$task_id = $row['id'];
		$sql = "SELECT * FROM `needs` NATURAL JOIN
		`users` WHERE `id` = `user_id` AND `task_id` = '$task_id'";
		$temp_result = mysqli_query($conn, $sql);
		$row_temp = $temp_result->fetch_assoc();
		$row['user'] = $row_temp['username'];
		array_push($array, $row);
	}
	echo json_encode($array);
?>

<?php
	session_start();
	require 'server_info.php';
	$username = trim($_SESSION['username']);
	$sql = "SELECT * from tasks JOIN needs JOIN users
	WHERE tasks.id = needs.task_id AND needs.user_id = users.id";// AND users.username <> '$username'";
	if(!isset($_POST['mytasks']))
	{
	$sql = $sql . " AND users.username <> '$username'";
	}
	else
	{
	$sql = $sql . " AND users.username = '$username'";
	}
	$array = [];
	if(isset($_POST['words']))
	{
		$words = explode(" ", $_POST['words']);
		$sql = $sql . "WHERE `filled` = 0 AND ";
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
		array_push($array, $row);
	}
	echo json_encode($array);
?>
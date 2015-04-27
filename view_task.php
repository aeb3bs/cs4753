<?php
	session_start();
	if(!isset($_SESSION['username']) || !isset($_SESSION['password']))
	{
		header('Location: login.php');
	}
	$task_id = $_POST['id'];
	require "server_info.php";
	$sql = "SELECT * from tasks WHERE `id` = '$task_id'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$user_id = $_SESSION['user_id'];
	$sql = "SELECT * from requests WHERE `user_id` = '$user_id'
	AND `task_id` = '$task_id'";
	$result = $conn->query($sql);
	if($result->num_rows>0)
	{
		$temp = $result->fetch_assoc();
		$status = $temp['status'];
	}
	else
	{
		$status=-2;
	}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="homeStyling.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="functions.js"></script>
</head>
<body>
	<div id="page" class = "container-fluid">
		<div id="header">
			<img id = "logo" src="logo.png">


			<nav class="navbar navbar-inverse" id="navbar">
				  <div class="container-fluid">
				    <!-- Brand and toggle get grouped for better mobile display
				    <div class="navbar-header"> 
				    <ul class="nav nav-pills topnav">   
				      <li class="active"><a class="navbar-brand" href="#"><b>Home</b></a></li>
				      </ul>
				    </div>

				    <!-- Collect the nav links, forms, and other content for toggling -->
				    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				      <ul class="nav nav-pills topnav ">
				      	   <li id="bannerButton"><a href="home.php">Home</a></li>
						   <li id="bannerButton"> <a href="add_task.php">Add Task</a> </li>					
				           <li id="bannerButton"> <a href="mytasks.php">My Tasks</a> </li>
						   <li id="bannerButton"> <a href="">Contact Us</a> </li>
						   <li id="bannerButton"> <a href="logout.php">Logout</a> </li>
				    <!--  </ul> -->
					    
					      
	  				    <!--  <ul class="nav navbar-nav"> -->
							   <li>  </li>
							   <h5 align="right" style="color: #3399FF;">Welcome, <?php echo $_SESSION['first_name']; ?></h5>

				      </ul>
				
				    </div><!-- /.navbar-collapse -->
				  </div><!-- /.container-fluid -->
				</nav>



		</div>
		<!--div style="background-color:#D6D7DB;">
		
		</div-->

		<div id="taskContainer" style="padding-left:1%; padding-top:0px;">
			<div id="nearby_tasks" style="width: 100%; padding-top:0px;">
				<table id="taskTable" class="table">
				<tr>
					<td><b>Title:</b></td>
					<td><?php echo $row['title'];?></td>
				</tr>
				<tr>
					<td><b>Address:</b></td>
					<td><?php echo $row['address'];?></td>
				</tr>
				<tr>
					<td><b>Pay:</b></td>
					<td><?php echo $row['pay'];?></td>
				</tr>
				<tr>
					<td><b>Date:</b></td>
					<td><?php echo $row['date'];?></td>
				</tr>
				<tr>
					<td><b>Description:</b></td>
					<td><?php echo $row['description'];?></td>
				</tr>
				</table>
				<div align="center">
				<a href="home.php" class="btn btn-primary">Back</a>
				<br><br>
				<div id="send_request_form" hidden>
				<form action="send_request.php" method="POST">
				<input type="hidden" value="<?php echo $task_id ?>" name="task_id">
				<input type="hidden" value="<?php echo $user_id ?>" name="user_id">
				<textarea name ="message" placeholder="Send a message to the tasker along with your request. You will be notified if your request is approved." style="width: 33.33%; height: 200px; resize: none;" class="form-control"></textarea>
				<br>
				<input type="submit" id="send_request" class="btn btn-primary" value="Send Request">
				</form>
				</div>
				<div id="error1" hidden>
					<h3>Your request has been denied. Please check homepage to request for more tasks!</h3>
				</div>
				<div id="error2" hidden>
					<h3>You already sent a request. Check "My Tasks" for any response.</h3>
				</div>
				<div id="error3" hidden>
					<h3>Your request has been approved. Check "My Tasks" for any details regarding the task.</h3>
				</div>
				</div>
			</div>
		</div>
		
<script>
	var status = <?php echo $status; ?>;
	if(status == -2)
	{
		$("#send_request_form").fadeIn(1500);
	}
	else if(status == -1)
	{
		$("#error1").fadeIn(1500);
	}
	else if(status==0)
	{
		$("#error2").fadeIn(1500);
	}
	else if(status==1)
	{
		$("#error3").fadeIn(1500);
	}
</script>
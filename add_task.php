<?php
	require 'server_info.php';
	if(!isset($_SESSION['username']) || !isset($_SESSION['password']))
	{
		//header('Location: login.php');
	}
	if(isset($_POST['title']) &&
	isset($_POST['location']) &&
	isset($_POST['pay']) &&
	isset($_POST['date']) &&
	isset($_POST['description']))
	{
		$title = $_POST['title'];
		$location = $_POST['location'];
		$pay = $_POST['pay'];
		$date = $_POST['date'];
		$description = $_POST['description'];
		$sql = "INSERT INTO `tasks`(`description`, `address`, `pay`, `date`, `title`) 
		VALUES ('$description',
		'$location',
		'$pay',
		'$date',
		'$title')";
		$result = mysqli_query($conn, $sql);
		$task_id = mysqli_insert_id($conn);
		$user_id = $_SESSION['user_id'];
		$sql = "INSERT INTO `needs`(`user_id`, `task_id`) 
		VALUES ('$user_id','$task_id')";
		$result = mysqli_query($conn, $sql);
		if($result)
			echo "<script>alert('Successfully added your task.');</script>";
		else
			echo "<script>alert('Unable to add your task.');</script>";
	}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="homeStyling.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
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
				<div align="center" style="position: relative; top:10%;">
				<h1>Add Task</h1>
				<form action="add_task.php" method="POST" onsubmit="return checkFields('title', 'location', 'pay' , 'date', 'description')">
					<input id="title" name="title" style="width:200px;" type="text" placeholder="Title" class="form-control"><br>
					<input id="location" name="location" style="width:200px;" type="text" placeholder="Location (address)" class="form-control"><br>
					<input id="pay" name="pay" style="width:200px;" type="number" step="0.01" placeholder="Pay" class="form-control"><br>
					<input id="date" name="date" style="width:200px;" type="datetime-local" placeholder="Date" class="form-control"><br>
					<textarea id="description" name="description" style="width:400px;height:250px;" class="form-control" placeholder="Description"></textarea><br>
					<input type="submit" class="btn btn-primary" value="Submit Task">
				</form>
				</div>
			</div>
		</div>
<script>
	function helloworld()
	{
		alert("helloworld.");
	}
</script>
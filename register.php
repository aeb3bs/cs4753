<?php
	require 'server_info.php';
	session_start();
	if(!isset($_SESSION['username']) || !isset($_SESSION['password']))
	{
		//header('Location: login.php');
	}
	if(isset($_POST['username']) &&
	isset($_POST['password']) &&
	isset($_POST['email']) &&
	isset($_POST['first_name']) &&
	isset($_POST['last_name']))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$sql = "INSERT INTO `users`(`username`, `password`, `email`, `first_name`, `last_name`) 
		VALUES ('$username',
		PASSWORD('$password'),
		'$email',
		'$first_name',
		'$last_name')";
		$result = mysqli_query($conn, $sql);
		if($result)
		{
			echo "<script>alert('Successfully registered you as a user.');</script>";
			setcookie("username", $username, time() + (86400*30), "/");
			setcookie("password", $password, time() + (86400*30), "/");
		}
		else
			echo "<script>alert('Unable to register you as a user.');</script>";
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
				      	   <li id="bannerButton"><a href="login.php">Login</a></li>
				    <!--  </ul> -->
					    
					      
	  				    <!--  <ul class="nav navbar-nav"> -->
							   <li>  </li>

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
				<h1>Register</h1>
				<form action="register.php" method="POST" onsubmit="return checkFields('username', 'password', 'email' , 'first_name', 'last_name')">
					<input id="username" name="username" style="width:200px;" type="text" placeholder="Username" class="form-control"><br>
					<input id="password" name="password" style="width:200px;" type="password" placeholder="Password" class="form-control"><br>
					<input id="email" name="email" style="width:200px;" type="email" step="0.01" placeholder="Email" class="form-control"><br>
					<input id="first_name" name="first_name" style="width:200px;" type="text" placeholder="First Name" class="form-control"><br>
					<input id="last_name" name="last_name" style="width:200px;" type="text" placeholder="Last Name" class="form-control"><br>
					<input type="submit" class="btn btn-primary" value="Register">

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
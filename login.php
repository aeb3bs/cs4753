<html>
	<script src="functions.js"></script>
<head>
<?php	
	require 'server_info.php';
	session_start();
	if(isset($_POST['username']) && isset($_POST['password']))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		$sql = "
		SELECT * from users 
		WHERE `username` = '$username' 
		AND `password` = PASSWORD('$password')
		";
		$result = $conn->query($sql);
		if($result->num_rows>0)
		{
			$_SESSION['username']=$username;
			$_SESSION['password']=$password;
			$row = $result->fetch_assoc();
			$_SESSION['first_name'] = $row['first_name'];
			$_SESSION['last_name'] = $row['last_name'];
			$_SESSION['user_id'] = $row['id'];
			$_COOKIE['username']=$username;
			$_COOKIE['password']=$password;
			header('Location: home.php');
		}
		else
			echo "<script>invalid_password();</script>";
	}
?>
<link rel="stylesheet" type="text/css" href="homeStyling.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

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
				    <!--  </ul> -->
					    
					      <form class="navbar-form navbar-left" role="search" id="navSearch" action='login.php' method='POST'>
					        <div class="form-group">
					          <input id="username" name="username" type="text" class="form-control" placeholder="Username">
					          <input id="password" name="password" type="password" class="form-control" placeholder="Password">
					          <button type="submit" class="btn btn-default">Log In</button>
					        </div>
					        
					      </form>
	  				    <!--  <ul class="nav navbar-nav"> -->
							   <li>  </li>
							   <li > <p class="navbar-text"> <i>	New User? </i></p>	</li>			
					           <li id="bannerButton"> <a href="register.php">Register</a> </li>

				      </ul>
				
				    </div><!-- /.navbar-collapse -->
				  </div><!-- /.container-fluid -->
				</nav>



		</div>

		<div id="main">
			<h2 id="task">Taskers</h2>
			<p>There just isn't enough time in the day...<br><br>
			
			Tasksource is the only place in Hooville that you can hire your fellow peers to help you with your everyday tasks.<br><br>
			Whether it's a delivery request or a high end job, Tasksource will connect you with the right expertise to assist you.
			Here at Tasksource, every task is taken seriously. <br><br>We know that your time in college is valuable, so let us free up your schedule. </p><br>
			<h2>Contractors</h2>
			<p>College can be expensive... <br><br>However, Tasksource is a great way to make money while being a fulltime student. <br><br>Tasksource allows you to find
			work of all types. Work when you have the time, and get good money for the tasks that you want to do.
			Create an account today and see what you can do.</p>


		</div>
		<div id="taskContainer">
			<div id="nearby_tasks">
				<table id="taskTable">
				<caption><img id = "nearby" src=pin.png><b>Nearby Task Requests</b></caption>
				<tr>
					<th><i>Subject</i></th>
					<th><i>Pay</i></th>
				</tr>
				<tr>
					<td>Need somebody to clean my apartment.</td>
					<td>$40</td>
				</tr>
				<tr>
					<td>Need a programmer to build a website.</td>
					<td>$500</td>
				</tr>
				<tr>
					<td>Looking for someone to pick up my groceries.</td>
					<td>$15</td>
				</tr>
				<tr>
					<td>Need a ride to Oakton.</td>
					<td>$30</td>
				</tr>
				
				</table>
			</div>
		</div>
<?php	
	if(isset($_COOKIE['username']) && isset($_COOKIE['password']))
	{
		echo "
		<script>
			console.log('called?');
			var username = document.getElementById('username');
			var password = document.getElementById('password');
			username.value = '" . $_COOKIE['username'] . "';
			password.value = '" . $_COOKIE['password'] . "';
		</script>";
	}
?>

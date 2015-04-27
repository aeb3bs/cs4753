<?php
	session_start();
	if(!isset($_SESSION['username']) || !isset($_SESSION['password']))
	{
		header('Location: login.php');
	}
	$user_id = $_SESSION['user_id'];
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
				           <li id="bannerButton"> <a href="">My Tasks</a> </li>
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
			<div id="nearby_tasks" style="width: 100%; height: auto;">
				<table id="taskTable" hidden>
				<caption><img id = "nearby" src=pin.png><b>My Tasks</b></caption>
				<h1 id="load_screen_tasks" hidden>Loading tasks...</h1>
				<script>
					fadeloop("#load_screen_tasks", 1500, 1500, tasks==null);
					getMyTasks();
				</script>
				<div id="tasks">
				</div>
				</table>
			</div>
			<div id="nearby_tasks" style="width: 100%; padding-top:0px; height:auto;">
				<table id="requestTable" hidden>
				<h3 hidden><b>Requests To Do Your Tasks</b></h3>
				<h1 id="load_screen_requests" hidden>Loading requests...</h1>
				<script>
					fadeloop("#load_screen_requests", 1500, 1500, tasks==null);
					var temp = <?php echo $user_id; ?>;
					getMyRequests(temp);
				</script>
				<div id="requests">
				</div>
				
				</table>
			</div>
		</div>
</body>
</html>
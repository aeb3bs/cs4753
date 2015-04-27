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
			<div id="nearby_tasks" style="width: 100%; padding-top:0px; height:auto;">
				<table id="taskTable" class="table">
				<h3><b>Task Information</b></h3>
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
				<a href="mytasks.php" class="btn btn-primary">Back</a>
				<br><br>
				<div id="send_request_form" hidden>
				<br>
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
			<div id="nearby_tasks" style="width: 100%; padding-top:0px; height:auto;">
			<table id="taskTable" class="table">
			<h3><b>Requests To Do My Task</b></h3>
			<?php
				$sql = "SELECT tasks.id as task_id, users.id as user_id, users.username, requests.description, tasks.filled 
				FROM users JOIN requests JOIN tasks 
				WHERE users.id = requests.user_id 
				AND tasks.id = requests.task_id
				AND tasks.id = '$task_id'";
				$result = $conn->query($sql);
				while($row = $result->fetch_assoc())
				{
					$username = $row['username'];
					$data = $row['description'];
					$filled = $row['filled'];
					$user_id = $row['user_id'];
					$task_id = $row['task_id'];
					$current_taskee = false;
					$sql = "SELECT * FROM works WHERE 
					`user_id` = '$user_id' AND `task_id` = '$task_id'";
					$result2 = $conn->query($sql);
					if($result2->num_rows>0)
						$current_taskee = true;
					echo "
					<tr>
						<td><b>Username:</b></td>
						<td>'$username'";
					if($current_taskee)echo "(approved)";
					echo "</td>
						<td><b>Request Info:</b></td>
						<td>'$data'</td>
						";
						if($filled==0 && $current_taskee == false)
						echo "
						<td><button onclick='approve($user_id, $task_id)' id='approve' class='btn btn-lg btn-success'>Approve</button></td>";	
						else if($current_taskee)
						{
						echo "
						<td><button onclick='disapprove($user_id, $task_id)' id='approve' class='btn btn-lg btn-danger'>Disapprove</button></td>";	
						}
						else
						{
							echo "<td></td>";
						}
					echo "</tr>";
				}
			?>
			<script>
				function approve()
				{
					$.post("approve.php",
					{
						user_id : arguments[0],
						task_id : arguments[1]
					},
					function(result){
						$("#refresh").submit();
					});
				}
				function disapprove()
				{
					$.post("disapprove.php",
					{
						user_id : arguments[0],
						task_id : arguments[1]
					},
					function(result){
						$("#refresh").submit();
					});
				}
			</script>
			</table>
			</div>
		</div>
		<form id="refresh" action="view_mytask.php" method="POST">
		<input name="id" type="hidden" value="<?php echo $task_id; ?>">
		</form>
</body>
</html>
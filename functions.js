var tasks;
var col_headings = "\
<caption><img id = 'nearby' src=pin.png><b>Nearby Tasks</b></caption>\
				<thead><tr>\
					<th><i>User</i></th>\
					<th><i>Subject</i></th>\
					<th><i>Address</i></th>\
					<th><i>Date</i></th>\
					<th><i>Pay</i></th>\
					<th><i>Select</i></th>\
				</tr></thead>\
";
var col_headings_mytasks = "\
<caption><img id = 'nearby' src=pin.png><b>My Tasks</b></caption>\
				<thead><tr>\
					<th><i>Subject</i></th>\
					<th><i>Address</i></th>\
					<th><i>Date</i></th>\
					<th><i>Pay</i></th>\
					<th><i>View</i></th>\
					<th><i>Delete</i></th>\
				</tr></thead>\
";
var col_headings_myrequests = "\
				<thead><tr>\
					<th><i>Subject</i></th>\
					<th><i>Address</i></th>\
					<th><i>Date</i></th>\
					<th><i>Pay</i></th>\
					<th><i>Status</i></th>\
					<th><i>Delete</i></th>\
				</tr></thead>\
";
function invalid_password()
{
	alert("Sorry, the username and password do not match our records.");
}
function checkFields()
{
	for(var i=0; i<arguments.length; i++)
	{
		var element = arguments[i];
		element=document.getElementById(element);
		console.log(element.value=="");
		if(element.value=="")
		{
			alert("Please fill out the fields before submitting the task.");
			return false;
		}
	}
	return true;
}
function fadeloop(el,timeout,timein,loop){
						var $el = $(el),intId,fn = function(){
							 $el.fadeOut(timeout).fadeIn(timein);
						};
						fn();
						if(loop){
							intId = setInterval(fn,timeout+timein+100);
							return intId;
						}
						return false;
					}
function getTasks()
{
	if(window.XMLHttpRequest)
		{
			xmlhttp = new XMLHttpRequest();
		}
	else
	{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
		{
			//console.log(xmlhttp.responseText);
			tasks = JSON.parse(xmlhttp.responseText);
			console.log(tasks);
			var table = document.getElementById("taskTable");
			var html = col_headings;
			var loading_screen = document.getElementById("load_screen_tasks");
			for(var i=0;i<tasks.length;i++)
			{
				html += "\
					<tr><form action='view_task.php' method='POST' id='view_task"+i+"'>\
						<input name='id' type='hidden' value="+tasks[i].task_id+" form='view_task"+i+"'>\
						<td>"+tasks[i].username+"</td>\
						<td>"+tasks[i].title+"</td>\
						<td>"+tasks[i].address+"</td>\
						<td>"+tasks[i].date+"</td>\
						<td>$"+tasks[i].pay+"</td>\
						<td><input type='submit' id='view_task' class='btn btn-primary' value='View' form='view_task"+i+"'></td>\
					</form></tr>";
			}
			table.innerHTML = html;
			$("#taskTable").fadeIn(1500);
			loading_screen.innerHTML = "";
		}
	}
	xmlhttp.open("POST", "get_tasks.php", true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	if(arguments.length > 0)
	{
		var params = "words=" + arguments[0];
		console.log(params);
	}
	if(params==null)
		xmlhttp.send();
	else
		xmlhttp.send(params);
}
function getMyTasks()
{
	if(window.XMLHttpRequest)
		{
			xmlhttp = new XMLHttpRequest();
		}
	else
	{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
		{
			//console.log(xmlhttp.responseText);
			tasks = JSON.parse(xmlhttp.responseText);
			console.log(tasks);
			var table = document.getElementById("taskTable");
			var html = col_headings_mytasks;
			var loading_screen = document.getElementById("load_screen_tasks");
			for(var i=0;i<tasks.length;i++)
			{
				html += "\
					<tr>\
					<form action='delete_task.php' method='POST' id='delete_task"+i+"'></form>\
					<form action='view_mytask.php' method='POST' id='view_mytask"+i+"'></form>\
						<input name='id' type='hidden' value="+tasks[i].task_id+" form='view_mytask"+i+"'>\
						<input name='id' type='hidden' value="+tasks[i].task_id+" form='delete_task"+i+"'>\
						<td>"+tasks[i].title+"</td>\
						<td>"+tasks[i].address+"</td>\
						<td>"+tasks[i].date+"</td>\
						<td>$"+tasks[i].pay+"</td>\
						<td><input type='submit' class='btn btn-primary' value='View' form='view_mytask"+i+"'></td>\
						<td><input type='submit' class='btn btn-danger' value='Delete' form='delete_task"+i+"'></td>\
					</tr>";
			}
			table.innerHTML = html;
			$("#taskTable").fadeIn(1500);
			loading_screen.innerHTML = "";
		}
	}
	xmlhttp.open("POST", "get_tasks.php", true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	if(arguments.length > 0)
	{
		var params = "words=" + arguments[0]+"&mytasks=1";
		console.log(params);
	}
	if(params==null)
	{
		var params = "mytasks=1";
		xmlhttp.send(params);
	}
	else
		xmlhttp.send(params);
}
function getMyRequests(x)
{
	var user_id = arguments[0];
	var html = col_headings_myrequests;
	$.post("get_requests.php",
	{user_id : user_id},
	function(result){
		console.log(JSON.parse(result));
		var array = JSON.parse(result);
		for(var i=0;i<array.length;i++)
		{
			html+="\
			<form action='delete_request.php' method='post' id='delete_request'>\
			<input name='user_id' type='hidden' value='"+user_id+"' form='delete_request'>\
			<input name='task_id' type='hidden' value='"+array[i].task_id+"' form='delete_request'>\
			<tr>\
			<td>"+array[i].title+"</td>\
			<td>"+array[i].address+"</td>\
			<td>"+array[i].date+"</td>\
			<td>"+array[i].pay+"</td>";
			var status = array[i].status;
			if(status == -1)
				html+="<td>Denied</td>";
			else if(status == 1)
				html+="<td>Approved</td>";
			else
				html+="<td>Pending</td>";
			html+="<td><input type='submit' class='btn btn-danger' form='delete_request' value='Delete'></td></tr>";
		}
		var table = document.getElementById("requestTable");
		table.innerHTML = html;
		$("#requestTable").fadeIn(1500);
		$("h3").fadeIn(1500);
		var loading_screen = document.getElementById("load_screen_requests");
		loading_screen.innerHTML = "";
	});
}

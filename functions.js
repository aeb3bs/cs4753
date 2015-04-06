var tasks;
var col_headings = "\
<caption><img id = 'nearby' src=pin.png><b>All Task Requests</b></caption>\
				<tr>\
					<th><i>User</i></th>\
					<th><i>Subject</i></th>\
					<th><i>Address</i></th>\
					<th><i>Date</i></th>\
					<th><i>Pay</i></th>\
				</tr>\
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
							console.log(loop);
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
			console.log(xmlhttp.responseText);
			tasks = JSON.parse(xmlhttp.responseText);
			console.log(tasks);
			var table = document.getElementById("taskTable");
			var html = col_headings;
			var loading_screen = document.getElementById("load_screen");
			for(var i=0;i<tasks.length;i++)
			{
				html += "\
					<tr>\
						<td>"+tasks[i].user+"</td>\
						<td>"+tasks[i].title+"</td>\
						<td>"+tasks[i].address+"</td>\
						<td>"+tasks[i].date+"</td>\
						<td>$"+tasks[i].pay+"</td>\
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
		var params = "words=" + arguments[0];
		console.log(params);
	}
	if(params==null)
		xmlhttp.send();
	else
		xmlhttp.send(params);
}
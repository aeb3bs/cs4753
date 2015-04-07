Albert Borges - aeb3bs@virginia.edu
Chris Grochmal - csg6as@virginia.edu
Shane Matthews - som4sf@virginia.edu
Note that the zipped file is attached to this collab submission. In addition, our website files can be found at:
https://github.com/aeb3bs/cs4753.git and our tag is 1.0

This document describes how to deploy our website on an Ubuntu machine. The files are included in the submitted zip file.
Required Operating System: Ubuntu
Types of files: HTML/PHP/JS
Web Server: Apache
Recommended Browser: Google Chrome
How to Deploy Tasksource
Step 1) 
Run the following command in the directory where you stored the script file:
bash script.sh
You will be prompted several times to validate whether you want to install the software. Respond yes by typing “Y” to every question. Finally, you will be prompted to set a password for your mysql user. Set it to “password”, and by default the username will be “root”, which is  fine. This is important in order for the script file to import the schema with the correct credentials. You will be prompted to repeat the password several times after this.
You will be prompted with several questions after this. Here is how you should respond:
“Enter current password for root (enter for none):” Response: “password”
“Change the root password?” Response: “n”
“Remove anonymous users?” Response: “n”
“Disallow root login remotely?” Response: “n”
“Remove test database and access to it?” Response: “Y”
“Reload privilege tables now?” Response: “Y”


Step 2)
Access the database system by going to the following URL:
localhost/cs4753/login.php
Source Code Files:
login.php-
This file allows a user to login to the task system. You can access the register form from this screen. In addition, the user can login with valid credentials. In order to login, you can either create a new account by clicking register, or use the following credentials:
Account #1:
aeb3bs
password
Account #2:
connor
password
register.php-
This file allows you to create a new user account. Once you submit a new account, the system will store a cookie with your credentials in your browser. You will receive a prompt when your account has been succesfully created.
home.php-
You can view the home page after logging in. Initially, home.php will make an AJAX request that will return all the tasks in the database system. Therefore, initially, the home page will display all the tasks. You can filter the tasks by searching by the subject. Note that the following pages are not functional: "My Tasks" and "Contact Us". In addition, you can't access individual ticket information as of yet.
add_task.php-
This file allows you to submit a new task to the database system. As soon as you submit a new task, you will be able to view it in the home page.
get_tasks.php-
This file is a background file that allows makes a query to the database to retrieve the specified tasks based on the parameters. It will output the tasks in a JSON format.

This document describes how to deploy our website. The files are included in the submitted zip file.
Deployment Operating System: Ubuntu
Types of files: HTML
Web Server: Apache

Step 1) Update your system with the following command:
sudo apt-get update

Step 2) Install apache2 onto your system. This web server will allow us to run our web applications. Run the following command:
sudo apt-get install apache2

Step 3) Extract all the files from the zip file into the web server directory that is located at the following path:
/var/www

Step 4) Open the web browser of your choice and type in the following url to access our webpage:
localhost/home.html

References:
https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu

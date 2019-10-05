<?php

$servername = "server address";
$dbusername = "your db user name";
$dbpassword = "your db password";
$dbname = "database name";

$con = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);	//connect to the database

if (!$con) {//gives error if no connected
  die("Connection failed:".mysqli_connect_error());
}

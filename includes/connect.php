<?php
session_start();
$servername = "localhost";
$server_user = "id18907446_gargledelivery_root";
$server_pass = "9)dfIJNdK^3DE]&{";
$dbname = "id18907446_gargledelivery";
$name = "";
$role = "";
if(isset($_SESSION['name'])){
	$name =$_SESSION['name'];
}
if(isset($_SESSION['role'])){
	$role =$_SESSION['role'];
}
if(isset($_SESSION['user_id'])){
	$user_id=$_SESSION['user_id'];
}

$con = new mysqli($servername, $server_user, $server_pass, $dbname);
?>
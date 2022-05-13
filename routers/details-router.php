<?php
include '../includes/connect.php';
$user_id = $_SESSION['user_id'];
$password_update = '';
$address_update = '';
$name = htmlspecialchars($_POST['name']);
$username = htmlspecialchars($_POST['username']);
if(isset($_POST['password']) && !empty($_POST['password'])){
$password =  htmlspecialchars($_POST['password']);
$password_update = " password='$password',";
}
$address = htmlspecialchars($_POST['address']); 
if(isset($_POST['address_latitude']) && !empty($_POST['address_latitude'])){ 
	$address_latitude = $_POST['address_latitude'];
$address_longitude = $_POST['address_longitude'];
	$address_update = " ,latitude='$address_latitude',longitude='$address_longitude'";
}


$phone = $_POST['phone'];
$email = htmlspecialchars($_POST['email']);
$address = htmlspecialchars($_POST['address']);
$sql = "UPDATE users SET name = '$name', username = '$username',$password_update contact=$phone, email='$email', address='$address' $address_update WHERE id = $user_id;";

if($con->query($sql)==true){
	$_SESSION['name'] = $name;
}
header("location: ../details.php");
?>
<?php
include '../includes/connect.php';

function number($length) {
    $result = '';

    for($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }

    return $result;
}

$username = $_POST['username'];
$password = password_hash($_POST['password'],PASSWORD_BCRYPT);
$name = $_POST['name'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$address = $_POST['address'];
$role = $_POST['role'];
$verified = $_POST['verified'];
$deleted = $_POST['deleted'];
$sql = "INSERT INTO users (username, password, name, email, contact, address, role, verified, deleted) VALUES ('$username', '$password', '$name', '$email', $contact, '$address', '$role', $verified, $deleted)";
if($con->query($sql)==true){
$user_id =  $con->insert_id;

}
header("location: ../users.php");
?>
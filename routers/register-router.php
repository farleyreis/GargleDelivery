<?php 

include '../includes/connect.php';
include '../includes/config.php';
include '../includes/mail.php';

$name = htmlspecialchars($_POST['name']);
$username = htmlspecialchars($_POST['username']);
$password = password_hash($_POST['password'],PASSWORD_BCRYPT);
$email = $_POST['email'];

$phone = $_POST['phone'];
$address = htmlspecialchars($_POST['address']);
$address_latitude = $_POST['address_latitude'];
$address_longitude = $_POST['address_longitude'];


$token = bin2hex(random_bytes(16));
function send_activation_email(string $email, string $activation_code)
{
    // create the activation link
    $activation_link = APP_URL . "/active-account.php?email=$email&token=$activation_code";
    
    // set email subject & body
    $subject = 'Please activate your account';
    $message = "Please click the following link to activate your account: <a href='$activation_link'>$activation_link</a>";
    // email header
    // $header = "From:" . APP_EMAIL;
    // send the email
    // mail($email, $subject, nl2br($message), $header);
    sendMail($email,$subject,nl2br($message));


}
function number($length) {
    $result = '';

    for($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }

    return $result;
}
		$filename = $_FILES["idpic"]["name"];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
		$idpic = time().'.'.$ext;
	    $tempname = $_FILES["idpic"]["tmp_name"];    
	    $folder = "../images/ids/".$idpic;
		move_uploaded_file($tempname, $folder);


// $sql = "INSERT INTO users (name, username, password, contact,image,token) VALUES ('$name', '$username', '$password', $phone,'$filename','$token')";
$sql = "INSERT INTO users (name, username, password, contact, email,image,token,address,latitude,longitude) VALUES ('$name', '$username', '$password', $phone,'$email','$idpic','$token','$address','$address_latitude','$address_longitude')";
if(mysqli_query($con,$sql)){
    send_activation_email($email,$token);
	$user_id =  mysqli_insert_id($con);
}

header("location: ../email-verification.php");
?>
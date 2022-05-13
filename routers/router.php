<?php
include '../includes/connect.php';
$success=false;
$verified = false;
$username = $_POST['username'];
$password = $_POST['password'];

$result = mysqli_query($con, "SELECT * FROM users WHERE username='$username' AND role='Administrator' AND not deleted;");
while($row = mysqli_fetch_array($result))
{
	if (password_verify($password, $row['password'])) {
		$success = true;
		$user_id = $row['id'];
		$name = $row['name'];
		$role= $row['role'];
	} else {
		$success = false;
	}
}
if($success == true)
{	
	
	$_SESSION['admin_sid']=session_id();
	$_SESSION['user_id'] = $user_id;
	$_SESSION['role'] = $role;
	$_SESSION['name'] = $name;

	header("location: ../admin-page.php");
}
else
{
	$result = mysqli_query($con, "SELECT * FROM users WHERE username='$username' AND role='Customer' AND not deleted;");
	while($row = mysqli_fetch_array($result))
	{
		if (password_verify($password, $row['password'])) {
			$success = true;
			$user_id = $row['id'];
			$name = $row['name'];
			$role= $row['role'];
			$email= $row['email'];
			$token= $row['token'];
			$verified = (boolean)$row['verified'];
			
		} else {
			$success = false;
		}
	
	}
	if($success == true)
	{
		
		$_SESSION['customer_sid']=session_id();
		$_SESSION['user_id'] = $user_id;
		$_SESSION['role'] = $role;
		$_SESSION['name'] = $name;	
		$_SESSION['email']= $email;	
		$_SESSION['token'] = $token;	
		$_SESSION['verified'] = $verified;
		
		if(!$verified){
			header("location: ../email-verification.php?email=$email&token=$token");
			die;
		}
		header("location: ../index.php");
	}
	else
	{
		$result = mysqli_query($con, "SELECT * FROM users WHERE username='$username' AND role='Seller' AND not deleted;");
		while($row = mysqli_fetch_array($result))
		{
			if (password_verify($password, $row['password'])) {
				$success = true;
				$user_id = $row['id'];
				$name = $row['name'];
				$role= $row['role'];
				$token= $row['token'];
				$email= $row['email'];

				$verified = (boolean)$row['verified'];

			} else {
				$success = false;
			}
		
		}
		if($success == true)
		{
			
			$_SESSION['seller_sid']=session_id();
			$_SESSION['user_id'] = $user_id;
			$_SESSION['role'] = $role;
			$_SESSION['name'] = $name;	
			$_SESSION['email'] = $email;	
			$_SESSION['token'] = $token;	
			$_SESSION['verified'] = $verified;		
			if(!$verified){
				header("location: ../email-verification.php?email=$email&token=$token");
				die;
			}
			header("location: ../seller-page.php");
		}
		else
		{
			header("location: ../login.php?error=invalid-login");
		}
	}
}
?>
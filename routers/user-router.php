<?php
include '../includes/connect.php';
	foreach ($_POST as $key => $value)
	{
		if(preg_match("/[0-9]+_role/",$key)){
			$key = strtok($key, '_');
			$sql = "UPDATE users SET role = '$value' WHERE id = $key;";
			$con->query($sql);
		}
		if(preg_match("/[0-9]+_verified/",$key)){
			$key = strtok($key, '_');
			$sql = "UPDATE users SET verified = '$value' WHERE id = $key;";
			$con->query($sql);
		}
		if(preg_match("/[0-9]+_deleted/",$key)){
			$key = strtok($key, '_');
			$sql = "UPDATE users SET deleted = '$value' WHERE id = $key;";
			$con->query($sql);
		}		
					
	}
header("location: ../users.php");
?>
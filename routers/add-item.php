<?php
include '../includes/connect.php';

        $filename = $_FILES["itemImage"]["name"];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		$itemImage = time().'.'.$ext;
	    $tempname = $_FILES["itemImage"]["tmp_name"];    
	    $folder = "../images/items/".$itemImage;
		move_uploaded_file($tempname, $folder);

$name = $_POST['name'];
$price = $_POST['price'];
$sql = "INSERT INTO items (name, price,shopid,image) VALUES ('$name', $price,'{$_SESSION['user_id']}','$itemImage')";
$con->query($sql);
header("location: ../seller-page.php");
?>
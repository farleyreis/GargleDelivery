<?php
include '../includes/connect.php';
$status = $_POST['status'];
$id = $_POST['id'];
$sql = "UPDATE orders SET status='$status', deleted=1 WHERE id=$id;";
$con->query($sql);
$sql = mysqli_query($con, "SELECT * FROM orders where id=$id");
while($row1 = mysqli_fetch_array($sql)){
$total = $row1['total'];
}

header("location: ../orders.php");
?>
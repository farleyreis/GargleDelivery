<?php
include '../includes/connect.php';
$status = $_POST['status'];
$ticket_id = $_POST['ticket_id'];
$sql = "UPDATE tickets SET status = '$status' WHERE id = $ticket_id;";
$con->query($sql);
header("location: ../view-ticket-admin.php?id=".$ticket_id);
?>
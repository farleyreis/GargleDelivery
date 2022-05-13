<?php
include '../includes/config.php';

include '../includes/mail.php';

$email = "javedahmad193@gmail.com";
$subject='test';
$message = 'this is a message';

    sendMail($email,$subject,nl2br($message));

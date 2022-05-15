<?php
include 'includes/config.php';

include 'includes/mail.php';

$email = "gargledelivery@gmail.com";
$subject='test';
$message = 'this is a message';

    sendMail($email,$subject,nl2br($message));


<!-- === 
Applied Technology Group Project 

Carolina
Elton
Fabiolla
Farley Reis 2019334


======= -->
<?php  
include 'includes/connect.php';
include 'includes/config.php';
include 'includes/mail.php';

if(isset($_SESSION['admin_sid']) || (isset($_SESSION['verified']) && (boolean)$_SESSION['verified']) )
{
	header("location:index.php");
}
else{
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
  if(isset($_GET['email'])){
    $email = $_GET['email'];
  }
  if(isset($_GET['token'])){
    $token = $_GET['token'];
  }
  if(isset($_GET['resend']) && $_GET['resend']=='1'){
 
    // $user_id = $_GET['customer_sid'];
    if(empty($token)){
      $token = bin2hex(random_bytes(16));
      $sql = "UPDATE users SET token = '$token' WHERE email = '$email';";
      $con->query($sql);
    }
    send_activation_email($email,$token);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <title>Email Verification</title>

  <!-- Favicons-->
  <link rel="icon" href="images/favicon/garglelogo.png" sizes="32x32">
  <!-- Favicons-->
  <link rel="apple-touch-icon-precomposed" href="images/favicon/garglelogo.png">
  <!-- For iPhone -->
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="images/favicon/garglelogo.png">
  <!-- For Windows Phone -->


  <!-- CORE CSS-->
  
  <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- Custome CSS-->    
    <link href="css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/layouts/page-center.css" type="text/css" rel="stylesheet" media="screen,projection">

  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
  
</head>

<body class="cyan">
  <!-- Start Page Loading -->
  <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
  <!-- End Page Loading -->



  <div id="login-page" class="row">
    <div class="col s12 z-depth-4 card-panel">
        <div class="row">
          <div class="input-field col s12 center">
            <h1 class="center">Please check your email to activate your account.</h1>
            <?php if(isset($_SESSION['token'])){ ?>
            <a class="btn" href="?email=<?php echo $email; ?>&token=<?php echo $token; ?>&resend=1">Resend Email</a>
            <?php } ?>
          </div>
        </div>
    </div>
  </div>



  <!-- ================================================
    Scripts
    ================================================ -->

  <!-- jQuery Library -->
  <script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>
  <!--materialize js-->
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <!--scrollbar-->
  <script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

      <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="js/plugins.min.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="js/custom-script.js"></script>

</body>
</html>

<?php
}
?>

<!-- === 
Applied Technology Group Project 

Carolina
Elton
Fabiolla
Farley Reis 2019334


======= -->
<?php  
if(isset($_SESSION['admin_sid']) || isset($_SESSION['customer_sid']) || isset($_SESSION['seller_sid']) )
{
	header("location:index.php");
}
else{
  include 'includes/connect.php';
  if(!isset($_GET['email']) || !isset($_GET['token'])){
    header("location: login.php");
  }
  $email = $_GET['email'];
  $token = $_GET['token'];
  $result = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND not deleted;");
	while($row = mysqli_fetch_array($result))
	{
    if($row['verified']==0){
        if($token==$row['token']){
          $sql = "UPDATE users SET verified='1', token='' WHERE id='".$row['id']."';";
          if(mysqli_query($con, $sql)){
            header("location: login.php?success=account-verified");
          }else{
            $message = 'Database Error';
          }
        }else{
          $message = 'Your Activation Link is incorrect';
        }
    }elseif($row['verified']==1){
      $message = 'Your Account is Already Verified';
    }else{
      $message = '404 ERROR';
    }
  }
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <title>Active Account</title>

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
            <h3 class="center"><?php echo $message; ?></h3>
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
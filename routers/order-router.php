<?php
include '../includes/connect.php';
include '../includes/config.php';
require_once('../stripe/init.php');
\Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);
$token = $_POST['stripeToken'];

$total = 0;
$address = htmlspecialchars($_POST['address']);
$description =  htmlspecialchars(isset($_POST['description'])?$_POST['description']:'');
$payment_type = $_POST['payment_type'];
$delivery_fee = $_POST['delivery_fee'];

$total = $_POST['total'];
$shopid = $_POST['shopid'];

  
	$sql = "INSERT INTO orders (customer_id,shopid, payment_type, delivery_fee, address, total, description) VALUES ($user_id, $shopid, '$payment_type', '$delivery_fee', '$address', $total, '$description')";
	if ($con->query($sql) === TRUE){
		$order_id =  $con->insert_id;
		foreach ($_POST as $key => $value)
		{
			if(is_numeric($key)){
			$result = mysqli_query($con, "SELECT * FROM items WHERE id = $key");
			while($row = mysqli_fetch_array($result))
			{
				$price = $row['price'];
			}
				$price = $value*$price;
			$sql = "INSERT INTO order_details (order_id, item_id, quantity, price) VALUES ($order_id, $key, $value, $price)";
			$con->query($sql) === TRUE;		
			}
		}
		if($_POST['payment_type'] == 'Card'){
			$sql = "Select email from users where id='$user_id'";
			$user_result = mysqli_query($con,$sql);
			$user_row = mysqli_fetch_row($user_result);
			$email = $user_row[0];


			// Create Customer In Stripe
			$customer = \Stripe\Customer::create(array(
				"email" => $email,
				"source" => $token
			));
			
			// Charge Customer
			$charge = \Stripe\Charge::create(array(
				"amount" => 100*(double)$total,
				"currency" => "eur",
				"description" => $description,
				"customer" => $customer->id
			));
		}
		
			header("location: ../orders.php");
	}

?>
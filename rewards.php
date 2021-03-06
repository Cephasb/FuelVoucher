<?php
include('base.php');

$json = file_get_contents('php://input');

$obj = json_decode($json,true);

$email = $obj['id'];

if ($stmt = $conn->prepare("SELECT customer.Customer_CardID, customer.Customer_ID, customer.Customer_Firstname, customer.Customer_Lastname, SUM(customer_purchase.Purchase_Points) AS Points_Sum FROM customer_purchase JOIN customer ON customer_purchase.Customer_ID=customer.Customer_ID WHERE AppUser_UniqueID=? GROUP BY customer.Customer_ID"))
   {
   $stmt->bind_param("s", $email);       
   $stmt->execute();
   $RESULT = get_result($stmt);

	$jsonData = array();

	while ($array = array_shift( $RESULT )) {
		$jsonData[] = $array;
	}

	echo json_encode($jsonData);

   }

mysqli_close($conn);
?>

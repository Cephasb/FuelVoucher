<?php
include('base.php');

$json = file_get_contents('php://input');

$obj = json_decode($json,true);

$email = $obj['id'];
$stat = 1;
/**
if ($stmt = $conn->prepare("SELECT customer.Customer_CardID, customer_purchase.Purchase_Amount, customer_purchase.Purchase_Date FROM customer_purchase JOIN customer ON customer_purchase.Customer_ID=customer.Customer_ID WHERE customer_purchase.AppUser_UniqueID=? ORDER BY customer_purchase.Purchase_ID DESC LIMIT 5"))
**/
if ($stmt = $conn->prepare("SELECT * FROM vouchers WHERE (AppUser_UniqueID=? AND Voucher_Status=?) ORDER BY Date_Used DESC LIMIT 5"))
   {
   $stmt->bind_param("ss", $email, $stat);       
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
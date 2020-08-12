<?php
include('base.php');

$json = file_get_contents('php://input');

$obj = json_decode($json,true);

$email = $obj['custid'];

if ($stmt = $conn->prepare("SELECT SUM(customer_purchase.Purchase_Points) AS Points_Sum 
FROM customer_purchase JOIN customer 
ON customer_purchase.Customer_ID=customer.Customer_ID 
WHERE (customer.Customer_CardID=? OR customer.Customer_Phone=?) 
GROUP BY customer.Customer_ID"))
   {
   $stmt->bind_param("ss", $email, $email);
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

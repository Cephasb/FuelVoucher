<?php
include('base.php');

$json = file_get_contents('php://input');

$obj = json_decode($json,true);

$email = $obj['custid'];

if ($stmt = $conn->prepare("SELECT * FROM customer_purchase WHERE Customer_ID=? ORDER BY Purchase_ID DESC LIMIT 1"))
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

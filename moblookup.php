<?php
include('base.php');

$json = file_get_contents('php://input');

$obj = json_decode($json,true);

$email = $obj['custid'];

if ($stmt = $conn->prepare("SELECT * FROM customer WHERE (Customer_CardID=? OR Customer_Phone=?)"))
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

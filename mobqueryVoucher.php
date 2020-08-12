<?php
include('base.php');

$json = file_get_contents('php://input');

$obj = json_decode($json,true);

$email = $obj['email'];

if ($stmt = $conn->prepare("SELECT * FROM vouchers WHERE Voucher_Serial=?"))
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

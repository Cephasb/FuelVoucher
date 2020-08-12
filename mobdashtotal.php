<?php
include('base.php');

$json = file_get_contents('php://input');

$obj = json_decode($json,true);

$email = $obj['id'];
$stat = 1;
/**
if ($stmt = $conn->prepare("SELECT SUM(Purchase_Amount) AS Amount_Sum FROM customer_purchase WHERE (AppUser_UniqueID=? AND DATE(Purchase_Date) = DATE(NOW()))"))
**/
if ($stmt = $conn->prepare("SELECT SUM(Voucher_Amount) AS Amount_Sum FROM vouchers WHERE (AppUser_UniqueID=? AND Voucher_Status=? AND DATE(Date_Used) = DATE(NOW()))"))
   {
   $stmt->bind_param("si", $email,$stat);
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

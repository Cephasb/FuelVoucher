<?php
include('base.php');

$json = file_get_contents('php://input');

$obj = json_decode($json,true);

$email = $obj['id'];
$stat = 1;

if ($stmt = $conn->prepare("SELECT * FROM vouchers WHERE (AppUser_UniqueID=? AND Voucher_Status=?)"))
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

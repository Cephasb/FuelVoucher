<?php
include('base.php');

$json = file_get_contents('php://input');

$obj = json_decode($json,true);

$today = date("Y-m-d h:i:sa");
$voucherid =  $obj['voucherid'];
$vehicle = $obj['vehiclenumber'];
$amount =  $obj['amount'];
$purchasetype = $obj['fueltype'];
$usertoken = $obj['usertoken'];
$stat = 1;
$SuccessMsg = 'success';

mysqli_query($conn, "UPDATE vouchers SET Voucher_Status='$stat', Date_Used='$today', Fuel_Type='$purchasetype', Vehicle_ID='$vehicle', AppUser_UniqueID='$usertoken' WHERE Voucher_Serial='$voucherid'")or die(mysqli_error());
					
// Converting the message into JSON format.
$SuccessMsgJson = json_encode($SuccessMsg);

// Echo the message.
echo $SuccessMsgJson ;

mysqli_close($conn);

?>

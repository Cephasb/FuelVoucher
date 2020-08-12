<?php
include('base.php');

$json = file_get_contents('php://input');

$obj = json_decode($json,true);

$today = date("Y-m-d h:i:sa");
$customerid =  $obj['customerid'];
$amount =  $obj['amount'];
$purchasetype = $obj['fueltype'];
$usertoken = $obj['usertoken'];
$points = $amount/10;
$SuccessMsg = 'success';

mysqli_query($conn, "INSERT INTO customer_purchase (Purchase_Amount, Purchase_Type, Customer_ID, Purchase_Date, Purchase_Points, AppUser_UniqueID)
					values('$amount', '$purchasetype', '$customerid', '$today', '$points', '$usertoken')") or die(mysqli_error());
					
if($stmt = $conn->prepare("SELECT * FROM customer WHERE Customer_ID=?"))
    {
	$stmt->bind_param("i", $customerid);
	$stmt->execute();  
	$RESULT = get_result($stmt);
    $get = array_shift( $RESULT );
    $firstname = $get['Customer_Firstname'];
    $lastname = $get['Customer_Lastname'];
    $client_name = $firstname." ".$lastname;	
    $str = $get['Customer_Phone'];
    $client_phone = '+233'.substr($str, 1);
    $stmt->close();
    }	
    
if ($stmt = $conn->prepare("SELECT SUM(Purchase_Points) FROM customer_purchase WHERE Customer_ID=? "))
   {
   $stmt->bind_param("i", $customerid);
   $stmt->execute();
   $stmt->bind_result($totalpoints);
   $stmt->fetch();
   }    

$sms = "Hello ".$firstname.", You have just been awarded ".$points." points from PUMA ENERGY for your fuel purchase. TOTAL POINTS:".$totalpoints." Thank you!";

$request = curl_init('https://www.txtconnect.co/v2/app/api/send/sms.json');
curl_setopt($request, CURLOPT_POST, true);
curl_setopt($request, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($request, CURLOPT_POSTFIELDS, array(
    'token' => '268d368d2e9848a1378878cb8bf273c8c107f320',
    'message' => urlencode($sms),
    'sender' => 'PUMA ENERGY',
    'recipients' => $client_phone
));
curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
curl_exec($request);
curl_close($request);


// Converting the message into JSON format.
$SuccessMsgJson = json_encode($SuccessMsg);

// Echo the message.
echo $SuccessMsgJson ;

mysqli_close($conn);

?>

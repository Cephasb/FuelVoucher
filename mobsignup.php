<?php
include('base.php');

$json = file_get_contents('php://input');

$obj = json_decode($json,true);

$today = date("Y-m-d h:i:sa");
$firstname =  $obj['UserFirstname'];
$lastname =  $obj['UserLastname'];
$cardid = $obj['UserCardID'];
$str =  $obj['Phone'];
$Gender =  $obj['Gender'];
$VehicleNumber =  $obj['VehicleNumber'];

$SuccessMsg = 'success';
//Applying User Login query with email and password match.
$Sql_Query = "select * from customer where Customer_Phone = '$str'";

// Executing SQL Query.
$find = mysqli_query($conn,$Sql_Query);

if(mysqli_num_rows($find)>0){

$InvalidMsg = 'A Customer with this Phone Number already exists.';

// Converting the message into JSON format.
$InvalidMsgJson = json_encode($InvalidMsg);

// Echo the message.
 echo $InvalidMsgJson ;

 }else{

// If the email does not exists.
mysqli_query($conn, "INSERT INTO customer (Customer_Firstname, Customer_Lastname, Customer_Phone, Customer_CardID, Customer_VehicleNumber, Customer_Gender, Customer_Joined)
					values('$firstname', '$lastname', '$str', '$cardid', '$VehicleNumber', '$Gender',  '$today')") or die(mysqli_error());

$sms = "Hello ".$firstname.", Thanks for choosing PUMA ENERGY! Earn gift points for each fuel top up with your Card ID:".$cardid;

$phone = '+233'.substr($str, 1);

$request = curl_init('https://www.txtconnect.co/v2/app/api/send/sms.json');
curl_setopt($request, CURLOPT_POST, true);
curl_setopt($request, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($request, CURLOPT_POSTFIELDS, array(
    'token' => '268d368d2e9848a1378878cb8bf273c8c107f320',
    'message' => urlencode($sms),
    'sender' => 'PUMA ENERGY',
    'recipients' => $phone
));
curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
curl_exec($request);
curl_close($request);

// Converting the message into JSON format.
$SuccessMsgJson = json_encode($SuccessMsg);

// Echo the message.
echo $SuccessMsgJson ;

}

mysqli_close($conn);

?>

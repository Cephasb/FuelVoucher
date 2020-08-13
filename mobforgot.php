<?php
include ('base.php');
// Getting the received JSON into $json variable.
$json = file_get_contents('php://input');
 
// decoding the received JSON and store into $obj variable.
$obj = json_decode($json,true);
 
$email = $obj['Email'];

$permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$unique_ID = substr(str_shuffle($permitted_chars), 0, 5);

$regenerateNumber = true;
do {
    $appuserotp      = rand(22000000, 22999999);
    $checkRegNum = "SELECT * FROM application_users WHERE AppUser_OTP = '$appuserotp'";
    $result      = mysqli_query($conn, $checkRegNum);

    if (mysqli_num_rows($result) == 0) {
        $regenerateNumber = false;
    }
} while ($regenerateNumber);
 
//Applying User Login query with email and password match.
$Sql_Query = "select * from application_users where AppUser_Email = '$email'";
 
// Executing SQL Query.
$find = mysqli_query($conn,$Sql_Query);

$findd = mysqli_fetch_array($find);

$firstname = $findd['AppUser_Firstname'];
  
if(mysqli_num_rows($find)>0){

mysqli_query($conn, "UPDATE application_users SET AppUser_OTP='$appuserotp', OTP_Status='0' where AppUser_Email='$email'");	
	
$SuccessMsg = 'success' ;

$subject = "PUMA ENERGY: PASSWORD RESET";
$message='<html>
<body>
  <span><img src="admin/images/logo.png" width="100" height="100"/></span>    
  <p>Hi '.$firstname.',</p>
  <p>Your Puma Energy RESET PASSWORD CODE (OTP) is: <b>'.$appuserotp.'</b></p>
</body>
</html>';
 
$mail->From       = "***********";
$mail->FromName   = "***********";
$mail->Subject    = $subject;
$mail->MsgHTML($message);
$mail->AddAddress($email);
$mail->IsHTML(true); 
$mail->Send(); 
 
// Converting the message into JSON format.
$SuccessMsgJson = json_encode($SuccessMsg);
 
// Echo the message.
 echo $SuccessMsgJson ;
  

 
 }else{

$InvalidMsg = 'An account with this Email DOES NOT EXIST. Please try again.';
 
 // Converting the message into JSON format.
$InvalidMsgJson = json_encode($InvalidMsg);
 
// Echo the message.
 echo $InvalidMsgJson ; 
     
}
 
?>

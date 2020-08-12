<?php
include('base.php');

$json = file_get_contents('php://input');
 
$obj = json_decode($json,true); 

$otp = $obj['OTP'];
$stat = 0;

if ($stmt = $conn->prepare("SELECT * FROM application_users WHERE AppUser_OTP=? and OTP_Status=?")) 
   {
   $stmt->bind_param("ss", $otp, $stat);	
 
   $stmt->execute();  
   
   $RESULT = get_result($stmt);  

   $get = array_shift( $RESULT );  

   $total_num_rows = $stmt->num_rows;   
   }

   if ($total_num_rows > 0){	

  mysqli_query($conn, "UPDATE application_users SET OTP_Status='1' where AppUser_OTP='$otp'");					   
 
 $SuccessLoginMsg = 'Data Matched';
 
 // Converting the message into JSON format.
$SuccessLoginJson = json_encode($SuccessLoginMsg);
 
// Echo the message.
 echo $SuccessLoginJson ; 		

   }else{

$InvalidMSG = 'OTP does not exist. Please check and try again.' ;
 
// Converting the message into JSON format.
$InvalidMSGJSon = json_encode($InvalidMSG);
 
// Echo the message.
 echo $InvalidMSGJSon ;
	   
   }
  
mysqli_close($conn); 												

?>
<?php
include ('base.php');
 
// Getting the received JSON into $json variable.
$json = file_get_contents('php://input');
 
// decoding the received JSON and store into $obj variable.
$obj = json_decode($json,true);

$userid = $obj['userid']; 
$newpassword = $obj['newpassword'];

$save = mysqli_query($conn, "UPDATE application_users SET AppUser_Password='$newpassword' WHERE AppUser_ID='$userid'");

if(isset($save)){
	
$SuccessMsg = 'Change was successful' ;
 
// Converting the message into JSON format.
$SuccessMsgJson = json_encode($SuccessMsg);
 
// Echo the message.
 echo $SuccessMsgJson ;    
 
 }else{
     
$InvalidMsg = 'Error Occured! Password NOT Changed';
 
 // Converting the message into JSON format.
$InvalidMsgJson = json_encode($InvalidMsg);
 
// Echo the message.
 echo $InvalidMsgJson ;      

 }

 mysqli_close($conn);
 
?>
<?php
include ('base.php');

// Getting the received JSON into $json variable.
$json = file_get_contents('php://input');

// decoding the received JSON and store into $obj variable.
$obj = json_decode($json,true);

$appuid = $obj['userid'];
$password = $obj['password'];
$role = $obj['role'];

/* create a prepared statement */
if ($stmt = $conn->prepare("SELECT * FROM application_users WHERE (AppUser_UniqueID=? AND AppUser_Password=? AND AppUser_Role=?)"))
   {
   /* bind parameters for markers */
   $stmt->bind_param("sss", $appuid, $password, $role);

   /* execute query */
   $stmt->execute();

   /* get result and store in variable $result */
   $RESULT = get_result($stmt);

   /* fetch result */
   $get = array_shift( $RESULT );

   /* Do num rows */
   $total_num_rows = $stmt->num_rows;
   }

   if ($total_num_rows > 0 && $get['OTP_Status']==1){

 $SuccessLoginMsg = 'Data Matched';

 // Converting the message into JSON format.
$SuccessLoginJson = json_encode($SuccessLoginMsg);

// Echo the message.
 echo $SuccessLoginJson ;

   }else if ($total_num_rows > 0 && $get['OTP_Status']==0){
       
 $LoginMsg = 'Unconfirmed User';

 // Converting the message into JSON format.
$LoginJson = json_encode($LoginMsg);

// Echo the message.
 echo $LoginJson ;       
       
       }else{

$InvalidMSG = 'Invalid Credentials Please Try Again' ;

// Converting the message into JSON format.
$InvalidMSGJSon = json_encode($InvalidMSG);

// Echo the message.
 echo $InvalidMSGJSon ;

   }

  mysqli_close($conn);
?>

<?php
include("../base.php");
$userid=$_SESSION['id'];	
$oldpass=$conn->real_escape_string($_POST['currentpassword']);
$newpassword=$conn->real_escape_string($_POST['newpassword']);

if ($stmt = $conn->prepare("SELECT * FROM application_users WHERE AppUser_Password=? and AppUser_ID=?")) {	

$stmt->bind_param("si", $oldpass, $userid);	   
$stmt->execute();     
$RESULT = get_result($stmt);     
$get = array_shift( $RESULT );  
   
$total_num_rows = $stmt->num_rows;

if ($total_num_rows > 0){
	
$stmt = $conn->prepare("UPDATE application_users SET AppUser_Password=? WHERE AppUser_ID=?");	
$stmt->bind_param("si", $newpassword, $userid);
$stmt->execute();

echo 1; //success

}else{
	
echo 2; //current password error	
	
}

}	

?>
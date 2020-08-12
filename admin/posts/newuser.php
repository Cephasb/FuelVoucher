<?php
include ('../../base.php');
 
$firstname = $conn->real_escape_string($_POST['firstname']);
$lastname = $conn->real_escape_string($_POST['lastname']);
$phone = $conn->real_escape_string($_POST['phone']);
$email = $conn->real_escape_string($_POST['email']);
$password = $conn->real_escape_string($_POST['password']);
$station = $conn->real_escape_string($_POST['station']);
$role= 2;
$unique_ID = substr($firstname,0,1).substr($lastname,0,1).substr($phone,3,4);

//Applying User Login query with email and password match.
$Sql_Query = "select * from application_users where AppUser_Email = '$email'";
 
// Executing SQL Query.
$find = mysqli_query($conn,$Sql_Query);
  
if(mysqli_num_rows($find)>0){
 
// Echo the message.
 echo 1 ; 
 
 }else{
 
// If the email does not exists. 
$save=mysqli_query($conn, "INSERT INTO application_users (AppUser_Firstname, AppUser_Lastname, AppUser_Phone, AppUser_Email, AppUser_Password, AppUser_UniqueID, AppUser_Role, AppUser_Station)
					values('$firstname','$lastname','$phone', '$email', '$password', '$unique_ID', '$role', $station')") or die(mysqli_error());

echo 2 ; 
 }
 
 mysqli_close($conn);
?>
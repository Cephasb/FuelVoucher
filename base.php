<?php
session_start();
require_once('PHPMailer_v5.1/class.phpmailer.php');

$mail  = new PHPMailer();   
$mail->IsSMTP();                           // Set mailer to use SMTP
$mail->Host = '*********';             // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                     // Enable SMTP authentication
$mail->Username = '******';          // SMTP username
$mail->Password = '******'; // SMTP password
$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
$mail->Port = 26;
/**
$mail->SMTPSecure = 'ssl';                  
$mail->Port = 465; //26 //587
**/
$mail->SMTPDebug  = 1;

$host = "localhost";
$username = "******";
$password = "******";
$dbname = "perlqcod_puma";

$conn = new mysqli($host, $username, $password, $dbname);

if(mysqli_connect_errno())
{
	printf("Connection failed: %s\n", mysqli_connect_error());
	exit();
}

function get_result( $stmt ) {
    $RESULT = array();
    $stmt->store_result();
    for ( $i = 0; $i < $stmt->num_rows; $i++ ) {
        $Metadata = $stmt->result_metadata();
        $PARAMS = array();
        while ( $Field = $Metadata->fetch_field() ) {
            $PARAMS[] = &$RESULT[ $i ][ $Field->name ];
        }
        call_user_func_array( array( $stmt, 'bind_result' ), $PARAMS );
        $stmt->fetch();
    }
    return $RESULT;
}

$ref_url=$_SERVER['REQUEST_URI'];

 if(isset($_POST['admin-login'])){

   $email= $conn->real_escape_string($_POST['email']);
   $password= $conn->real_escape_string($_POST['password']);
   $role= 3;
   
   /* create a prepared statement */
   if ($stmt = $conn->prepare("SELECT * FROM application_users WHERE AppUser_Password=? AND AppUser_Email=? AND AppUser_Role=? ")) 
   {	
   /* bind parameters for markers */
   $stmt->bind_param("sss", $password, $email, $role);	
   
   /* execute query */
   $stmt->execute();  
   
   /* get result and store in variable $result */
   $RESULT = get_result($stmt);  
   
   /* fetch result */
   $get = array_shift( $RESULT );  
   
   /* Do num rows */
   $total_num_rows = $stmt->num_rows;   
   }

   if ($total_num_rows > 0){
   /* Store some values in a SESSION */	
	   $_SESSION['login']=1;
	   
	   $_SESSION['id']=$get['AppUser_ID'];

	   $_SESSION['role']=$get['AppUser_Role'];	

	   header("location:admin/index.php");	
	
   }else{
	/* invalid credentials */	   
	   echo'
<script type="text/javascript">
	alert("INCORRECT CREDENTIALS!\n E-mail or Password wrong");
	window.location.href="'.$ref_url.'";
</script>
';
		}
	}

?>
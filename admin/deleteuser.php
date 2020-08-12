<?php 

include('../include/config.php');

$userid=$_POST['userid'];

$delete=mysqli_query($conn, "delete from users where userid='$userid'");

echo 1;

?>
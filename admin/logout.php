<?php
include("../base.php");
$today = date("Y-m-d H:i:s");
$action="Logout";
$_SESSION['login']=0;
session_start(); //to ensure you are using same session
session_unset(); //to unset all sessions
session_destroy(); //destroy the session
header("location:../index.php"); //go to home  screen 
exit;
?>
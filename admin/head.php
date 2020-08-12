<?php include('../base.php');

if ($_SESSION['login']==0) {
	  header('location:../index.php');
   }

$userid=$_SESSION['id'];
$super='Super'; 
$diesel='Diesel';

function time2string($timeline) {
    $periods = array('day' => 86400, 'hour' => 3600, 'minute' => 60, 'second' => 1);
    foreach($periods AS $name => $seconds){
        $num = floor($timeline / $seconds);
        $timeline -= ($num * $seconds);
        @$ret .= $num.' '.$name.(($num > 1) ? 's' : '').' ';
    }

    return trim($ret);
}

if ($stmt = $conn->prepare("SELECT * FROM application_users WHERE AppUser_Role!=?")) 
{
$stmt->bind_param("i", $_SESSION['role']);	
$stmt->execute();  
$RESULT = get_result($stmt);
$get = array_shift( $RESULT ); 
$total_users = $stmt->num_rows;		
}


if ($stmt = $conn->prepare("SELECT * FROM vouchers WHERE Voucher_Status=1")) 
{	
$stmt->execute();  
$RESULTT = get_result($stmt);
$get = array_shift( $RESULT ); 
$total_customers = $stmt->num_rows;		
}

if ($stmt = $conn->prepare("SELECT *, SUM(Voucher_Amount) AS total 
FROM application_users JOIN vouchers 
ON application_users.AppUser_UniqueID=vouchers.AppUser_UniqueID 
WHERE DATE(Date_Used) = DATE(NOW())
GROUP BY application_users.AppUser_Station
ORDER BY total DESC LIMIT 10"))
{
$stmt->execute();  
$topstation = get_result($stmt); 	
}

if ($stmt = $conn->prepare("SELECT Vehicle_ID, SUM(Voucher_Amount) AS total 
FROM vouchers 
WHERE DATE(Date_Used) = DATE(NOW())
GROUP BY Vehicle_ID
ORDER BY total DESC LIMIT 10"))
{
$stmt->execute();  
$topcustomer = get_result($stmt); 	
}


if ($stmt = $conn->prepare("SELECT SUM(Voucher_Amount) AS total FROM vouchers WHERE (Fuel_Type=? AND DATE(Date_Used) = DATE(NOW()))")) 
{    
$stmt->bind_param("s", $diesel);	
$stmt->execute();  
$GETDIES = get_result($stmt);
$get = array_shift( $GETDIES ); 
$total_diesel = $get['total'];	

if ($total_diesel == '' || $total_diesel==null){
    $total_diesel = 0;
} 
}

if ($stmt = $conn->prepare("SELECT SUM(Voucher_Amount) AS total FROM vouchers WHERE (Fuel_Type=? AND DATE(Date_Used) = DATE(NOW()))")) 
{   
$stmt->bind_param("s", $super);	
$stmt->execute();  
$GETSUP = get_result($stmt);
$get = array_shift( $GETSUP ); 
$total_super = $get['total'];

if ($total_super == '' || $total_super==null){
    $total_super = 0;
}
}

$total_fuel=$total_super+$total_diesel;
$super_pie=($total_super/$total_fuel)*360;
$diesel_pie=($total_diesel/$total_fuel)*360;

if ($stmt = $conn->prepare("SELECT SUM(Voucher_Amount) AS total FROM vouchers WHERE Voucher_Status=1")) 
{
$stmt->execute();  
$TOTCum = get_result($stmt);
$get = array_shift( $TOTCum ); 
$total_cum = $get['total'];	
}

if ($stmt = $conn->prepare("SELECT SUM(Voucher_Amount) AS total FROM vouchers WHERE YEARWEEK(Date_Used) = YEARWEEK(CURRENT_TIMESTAMP)")) 
{
$stmt->execute();  
$TOTW = get_result($stmt);
$get = array_shift( $TOTW ); 
$total_fuelW = $get['total'];	
}

if ($stmt = $conn->prepare("SELECT SUM(Voucher_Amount) AS total 
FROM vouchers WHERE ( Fuel_Type=? AND YEARWEEK(Date_Used) = YEARWEEK(CURRENT_TIMESTAMP) AND DAYNAME(Date_Used) = ? )"))
{
$day = 'Monday';    
$stmt->bind_param("ss", $super,$day);    
$stmt->execute();  
$MONRES = get_result($stmt);  
$get = array_shift( $MONRES ); 
$super_mon = $get['total'];

if ($super_mon == '' || $super_mon==null){
    $super_mon = 0;
}
}

if ($stmt = $conn->prepare("SELECT SUM(Voucher_Amount) AS total 
FROM vouchers WHERE ( Fuel_Type=? AND YEARWEEK(Date_Used) = YEARWEEK(CURRENT_TIMESTAMP) AND DAYNAME(Date_Used) = ? )"))
{
$day = 'Tuesday';    
$stmt->bind_param("ss", $super,$day);    
$stmt->execute();  
$MONRES = get_result($stmt);  
$get = array_shift( $MONRES ); 
$super_tue = $get['total'];

if ($super_tue == '' || $super_tue==null){
    $super_tue = 0;
}
}

if ($stmt = $conn->prepare("SELECT SUM(Voucher_Amount) AS total 
FROM vouchers WHERE ( Fuel_Type=? AND YEARWEEK(Date_Used) = YEARWEEK(CURRENT_TIMESTAMP) AND DAYNAME(Date_Used) = ? )"))
{
$day = 'Wednesday';    
$stmt->bind_param("ss", $super,$day);    
$stmt->execute();  
$MONRES = get_result($stmt);  
$get = array_shift( $MONRES ); 
$super_wed = $get['total'];

if ($super_wed == '' || $super_wed==null){
    $super_wed = 0;
}
}

if ($stmt = $conn->prepare("SELECT SUM(Voucher_Amount) AS total 
FROM vouchers WHERE ( Fuel_Type=? AND YEARWEEK(Date_Used) = YEARWEEK(CURRENT_TIMESTAMP) AND DAYNAME(Date_Used) = ? )"))
{
$day = 'Thursday';    
$stmt->bind_param("ss", $super,$day);    
$stmt->execute();  
$MONRES = get_result($stmt);  
$get = array_shift( $MONRES ); 
$super_thu = $get['total'];

if ($super_thu == '' || $super_thu==null){
    $super_thu = 0;
}
}

if ($stmt = $conn->prepare("SELECT SUM(Voucher_Amount) AS total 
FROM vouchers WHERE ( Fuel_Type=? AND YEARWEEK(Date_Used) = YEARWEEK(CURRENT_TIMESTAMP) AND DAYNAME(Date_Used) = ? )"))
{
$day = 'Friday';    
$stmt->bind_param("ss", $super,$day);    
$stmt->execute();  
$MONRES = get_result($stmt);  
$get = array_shift( $MONRES ); 
$super_fri = $get['total'];

if ($super_fri == '' || $super_fri==null){
    $super_fri = 0;
}
}

if ($stmt = $conn->prepare("SELECT SUM(Voucher_Amount) AS total 
FROM vouchers WHERE ( Fuel_Type=? AND YEARWEEK(Date_Used) = YEARWEEK(CURRENT_TIMESTAMP) AND DAYNAME(Date_Used) = ? )"))
{
$day = 'Saturday';    
$stmt->bind_param("ss", $super,$day);    
$stmt->execute();  
$MONRES = get_result($stmt);  
$get = array_shift( $MONRES ); 
$super_sat = $get['total'];

if ($super_sat == '' || $super_sat==null){
    $super_sat = 0;
}
}

if ($stmt = $conn->prepare("SELECT SUM(Voucher_Amount) AS total 
FROM vouchers WHERE ( Fuel_Type=? AND YEARWEEK(Date_Used) = YEARWEEK(CURRENT_TIMESTAMP) AND DAYNAME(Date_Used) = ? )"))
{
$day = 'Sunday';    
$stmt->bind_param("ss", $super,$day);    
$stmt->execute();  
$MONRES = get_result($stmt);  
$get = array_shift( $MONRES ); 
$super_sun = $get['total'];

if ($super_sun == '' || $super_sun==null){
    $super_sun = 0;
}
}

if ($stmt = $conn->prepare("SELECT SUM(Voucher_Amount) AS total 
FROM vouchers WHERE ( Fuel_Type=? AND YEARWEEK(Date_Used) = YEARWEEK(CURRENT_TIMESTAMP) AND DAYNAME(Date_Used) = ? )"))
{
$day = 'Monday';    
$stmt->bind_param("ss", $diesel,$day);    
$stmt->execute();  
$MONRES = get_result($stmt);  
$get = array_shift( $MONRES ); 
$diesel_mon = $get['total'];

if ($diesel_mon == '' || $diesel_mon==null){
    $diesel_mon = 0;
}
}

if ($stmt = $conn->prepare("SELECT SUM(Voucher_Amount) AS total 
FROM vouchers WHERE ( Fuel_Type=? AND YEARWEEK(Date_Used) = YEARWEEK(CURRENT_TIMESTAMP) AND DAYNAME(Date_Used) = ? )"))
{
$day = 'Tuesday';    
$stmt->bind_param("ss", $diesel,$day);    
$stmt->execute();  
$MONRES = get_result($stmt);  
$get = array_shift( $MONRES ); 
$diesel_tue = $get['total'];

if ($diesel_tue == '' || $diesel_tue==null){
    $diesel_tue = 0;
}
}

if ($stmt = $conn->prepare("SELECT SUM(Voucher_Amount) AS total 
FROM vouchers WHERE ( Fuel_Type=? AND YEARWEEK(Date_Used) = YEARWEEK(CURRENT_TIMESTAMP) AND DAYNAME(Date_Used) = ? )"))
{
$day = 'Wednesday';    
$stmt->bind_param("ss", $diesel,$day);    
$stmt->execute();  
$MONRES = get_result($stmt);  
$get = array_shift( $MONRES ); 
$diesel_wed = $get['total'];

if ($diesel_wed == '' || $diesel_wed==null){
    $diesel_wed = 0;
}
}

if ($stmt = $conn->prepare("SELECT SUM(Voucher_Amount) AS total 
FROM vouchers WHERE ( Fuel_Type=? AND YEARWEEK(Date_Used) = YEARWEEK(CURRENT_TIMESTAMP) AND DAYNAME(Date_Used) = ? )"))
{
$day = 'Thursday';    
$stmt->bind_param("ss", $diesel,$day);    
$stmt->execute();  
$MONRES = get_result($stmt);  
$get = array_shift( $MONRES ); 
$diesel_thu = $get['total'];

if ($diesel_thu == '' || $diesel_thu==null){
    $diesel_thu = 0;
}
}

if ($stmt = $conn->prepare("SELECT SUM(Voucher_Amount) AS total 
FROM vouchers WHERE ( Fuel_Type=? AND YEARWEEK(Date_Used) = YEARWEEK(CURRENT_TIMESTAMP) AND DAYNAME(Date_Used) = ? )"))
{
$day = 'Friday';    
$stmt->bind_param("ss", $diesel,$day);    
$stmt->execute();  
$MONRES = get_result($stmt);  
$get = array_shift( $MONRES ); 
$diesel_fri = $get['total'];

if ($diesel_fri == '' || $diesel_fri==null){
    $diesel_fri = 0;
}
}

if ($stmt = $conn->prepare("SELECT SUM(Voucher_Amount) AS total 
FROM vouchers WHERE ( Fuel_Type=? AND YEARWEEK(Date_Used) = YEARWEEK(CURRENT_TIMESTAMP) AND DAYNAME(Date_Used) = ? )"))
{
$day = 'Saturday';    
$stmt->bind_param("ss", $diesel,$day);    
$stmt->execute();  
$MONRES = get_result($stmt);  
$get = array_shift( $MONRES ); 
$diesel_sat = $get['total'];

if ($diesel_sat == '' || $diesel_sat==null){
    $diesel_sat = 0;
}
}

if ($stmt = $conn->prepare("SELECT SUM(Voucher_Amount) AS total 
FROM vouchers WHERE ( Fuel_Type=? AND YEARWEEK(Date_Used) = YEARWEEK(CURRENT_TIMESTAMP) AND DAYNAME(Date_Used) = ? )"))
{
$day = 'Sunday';    
$stmt->bind_param("ss", $diesel,$day);    
$stmt->execute();  
$MONRES = get_result($stmt);  
$get = array_shift( $MONRES ); 
$diesel_sun = $get['total'];

if ($diesel_sun == '' || $diesel_sun==null){
    $diesel_sun = 0;
}
}

?>
<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
  <title>Admin | PUMA ENERGY APP</title>      
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width">  
  <link rel="stylesheet" href="css/templatemo_main.css">  
  <script src="dist/sweetalert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
  <link rel="stylesheet" type"text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type"text/css" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
</head>
<body>
  <div class="navbar navbar-inverse" role="navigation">
      <div class="navbar-header">
        <div>
		<a class="logo" title="" href="index.php"><img src="images/logo.jpg" alt="" style=" width:100%; max-width:260px"></a>
		</div>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button> 
      </div>   
    </div>
    <div class="template-page-wrapper">
      <div class="navbar-collapse collapse templatemo-sidebar">
        <ul class="templatemo-sidebar-menu">
          <li class="active"><a href="index.php"><i class="fa fa-home"></i>DASHBOARD</a></li>
          <li class="sub">
            <a href="javascript:;">
              <i class="fa fa-users"></i> USERS <div class="pull-right"><span class="caret"></span></div>
            </a>
            <ul class="templatemo-submenu">
			  <li><a href="newuser.php">Create App New User</a></li>
              <li><a href="users.php">User List</a></li>
            </ul>
          </li>
		  <li><a href="reports.php"><i class="fa fa-pencil-square-o"></i>Reports</a></li>
        <li><a href="voucher-report.php"><i class="fa fa-book"></i>Voucher Transactions</a></li>    
          </li>
		  <li><a href="changepassword.php"><i class="fa fa-cog"></i>Change Password</a></li>
          <li class="sub open"><a href="javascript:;" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-sign-out"></i>Sign Out</a></li>
        </ul>
      </div><!--/.navbar-collapse -->
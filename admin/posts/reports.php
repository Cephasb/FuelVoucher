<?php
include ('../../base.php');
$appuser_id= $conn->real_escape_string($_POST['appuser_id']);
$start_date= $conn->real_escape_string($_POST['start_date']);
$end_date= $conn->real_escape_string($_POST['end_date']);

unset($sql);

if ($appuser_id) {
    $sql[] = " vouchers.AppUser_UniqueID = '$appuser_id' ";
}
if ($start_date && $end_date) {
    $sql[] = " DATE(vouchers.Date_Used) BETWEEN '$start_date' AND '$end_date' ";
}


$query = " ";

if (!empty($sql)) {
	
    $query .= 'WHERE ' . implode(' AND ', $sql);
	
}

echo $query;

?>

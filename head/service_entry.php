<?php
session_start();
$role = $_SESSION['role'];
$user = $_SESSION['username'];
if(!isset($_SESSION['username']) || $role!= "chairman"){
    header('location: /fms');
}
include 'head.php';
include 'nav.php';

include ('../conn.php');
$time=date("Y-m-d h:i");

if(isset($_POST['vehicle'])){
    //collecting from inputs using the specific method
    //$state = mysqli_real_escape_string($db, trim($_POST['STATE]));
 $vehicle_name = mysqli_real_escape_string($db,trim($_POST['vehicle_name'])); 
 $vendor= mysqli_real_escape_string($db, trim($_POST['']));
 $odemeter = mysqli_real_escape_string($db, trim($_POST['odemeter'])); 
 $serviced_on = mysqli_real_escape_string($db, trim($_POST['vendor']));
 $comment = mysqli_real_escape_string($db, trim($_POST['comment']));
 $invoice_number = mysqli_real_escape_string($db, trim($_POST['invoice_number']));
 //check for empty field 
 if(!empty($vehicle_name) && !empty($serviced_on) && !empty($odemeter) && !empty($vendor) && !empty($comment) && !empty($invoice_number)){

    //check for duplicate 
    $check= "SELECT COUNT(*) FROM vehicle WHERE vehicle_name = '".$vehicle_name."' && serviced_on = '".$serviced_on.
     "' && odemeter = '".$odemeter."' && vendor = '".$vendor."'&& comment = '".$comment."'&& invoice = '".invoice."'";


     $sql =mysqli_query($db, $check);
     $row =mysqli_fetch_assoc($sql);
     if($row['COUNT(*)'] == 0){
        //insert values
        $query="INSERT INTO vehicle(vehicle_name, vendor,odemeter,comment,date"
}
?>
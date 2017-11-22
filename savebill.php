<?php

include 'connection.php';
session_start();


	 function numberletter() 
{
          $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
          srand((double)microtime()*1000000);
          $i = 0;
          $passii = '' ;
          while ($i <= 8) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $passii = $passii . $tmp;
            $i++;
          }
          return $passii;
}

$idnih = numberletter();


$query = $dbConn->query("SELECT * FROM tbl_lessee where lessee_id = '".$_POST['lessee_id']."' ");
$row = $query->fetch(PDO::FETCH_ASSOC);

$get = $dbConn->query("SELECT * FROM tbl_rates where rate_id = '1' ");
$dis = $get->fetch(PDO::FETCH_ASSOC);

$getrate = $dis['interest_rate'] * $_POST['past_due'];

$cubic_consumed = $_POST['end_water'] - $row['water_reading'];

$cubic = $cubic_consumed * $dis['water_rate'];

$electric_consumed = $_POST['end_electric'] - $row['electric_reading'];

$electric = $electric_consumed * $dis['electric_rate'];

$total = $getrate + $cubic + $electric + $row['rental_fee'] + $_POST['past_due'];

$dbConn->query("INSERT INTO tbl_transactions (property_id,bill_id,lessee_id,start_water,end_water,start_electric,end_electric,past_due,interest_rate,prepare_by,date_printed,cubic_consumed,rental_fee,interest,month_statement,total_amount,electric_consumed,mcwd_rate,veco_rate,water_due,electric_due) VALUES ('".$_POST['property_id']."','".$idnih."','".$_POST['lessee_id']."','".$row['water_reading']."','".$_POST['end_water']."','".$row['electric_reading']."','".$_POST['end_electric']."','".$_POST['past_due']."','".$dis['interest_rate']."','".$_SESSION['fullname']."','".date("Y-m-d")."','".$cubic_consumed."','".$row['rental_fee']."','".$getrate."','".$_POST['month']."','".$total."','".$electric_consumed."','".$dis['water_rate']."','".$dis['electric_rate']."','".$cubic."','".$electric."') ");

$dbConn->query("UPDATE tbl_lessee SET water_reading = '".$_POST['end_water']."',electric_reading = '".$_POST['end_electric']."',last_statement = '".$_POST['month']."' where lessee_id = '".$_POST['lessee_id']."'   ");

header("location:printbill.php?id=".$idnih."");

?>
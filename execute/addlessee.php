<?php

include 'connection.php';
session_start();

if (isset($_POST['submit'])) 
{

	$dbConn->query("INSERT INTO tbl_lessee (firstname,middlename,lastname,contact,unit,rental_fee,water_reading,electric_reading,status,property_name) VALUES ('".$_POST['firstname']."','".$_POST['middlename']."','".$_POST['lastname']."','".$_POST['contact']."','".$_POST['unit']."','".$_POST['fee']."','".$_POST['water']."','".$_POST['electric']."','open','".$_POST['property']."') ");

	$_SESSION['message'] = '<div class="alert alert-success">
										<button class="close" data-dismiss="alert">X</button>
										<strong>Success!</strong> New lessee Added: '.$_POST['firstname'].' '.$_POST['lastname'].'
									</div>';
									header("location:../lessee.php");

}

?>
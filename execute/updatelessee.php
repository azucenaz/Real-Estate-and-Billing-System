<?php
session_start();
include 'connection.php';

if (isset($_POST['submit'])) 
{
	$dbConn->query("UPDATE tbl_lessee SET firstname = '".$_POST['firstname']."',middlename = '".$_POST['middlename']."',lastname = '".$_POST['lastname']."',unit = '".$_POST['unit']."',contact = '".$_POST['contact']."',electric_reading = '".$_POST['electric']."',water_reading = '".$_POST['water']."',rental_fee = '".$_POST['fee']."' where lessee_id = '".$_POST['lessee_id']."'  ");
	$_SESSION['message'] = '<div class="alert alert-success">
										<button class="close" data-dismiss="alert">X</button>
										<strong>Success!</strong> Information has been updated.
									</div>';
	header("location:../lessee.php");
}

?>
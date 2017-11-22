<?php

session_start();
include 'connection.php';

if (isset($_POST['submit'])) 
{
	$check = $dbConn->query("SELECT * FROM tbl_rates");
	if ($check->rowCount() > 0) 
	{	
		$rates = $_POST['rates'] / 100 ;

		$dbConn->query("UPDATE tbl_rates SET water_rate = '".$_POST['water']."',electric_rate = '".$_POST['electric']."',interest_rate = '".$rates."' where rate_id = '1' ");
		$_SESSION['message'] = '<div class="alert alert-success">
										<button class="close" data-dismiss="alert">X</button>
										<strong>Success!</strong> Rates has been saved.
									</div>';
									header("location:../rates.php");
	}
	else
	{
		$dbConn->query("INSERT INTO tbl_rates (water_rate,electric_rate,interest_rate) VALUES ('".$_POST['water']."','".$_POST['electric']."','".$rates."') ");
		$_SESSION['message'] = '<div class="alert alert-success">
										<button class="close" data-dismiss="alert">X</button>
										<strong>Success!</strong> Rates has been saved
									</div>';
									header("location:../rates.php");

	}
}

?>
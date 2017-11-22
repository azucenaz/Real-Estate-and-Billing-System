<?php

include 'connection.php';

$dbConn->query("UPDATE tbl_transactions SET paid = 'paid' where bill_id = '".$_POST['bill_id']."' ");
 $_SESSION['message'] = '<div class="alert alert-success">
										<button class="close" data-dismiss="alert">X</button>
										<strong>Successfully update!</strong> Bill No: '.$_POST['bill_id'].'
									</div>';
									header("location:transactions.php");


?>
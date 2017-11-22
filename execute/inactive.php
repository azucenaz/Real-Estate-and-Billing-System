<?php 

session_start();
include 'connection.php';

$dbConn->query("UPDATE tbl_users SET status = 'inactive' where user_id = '".$_GET['id']."' ");
$_SESSION['message'] = '<div class="alert alert-success">
										<button class="close" data-dismiss="alert">X</button>
										<strong>Success!</strong> The account is now inactive.
									</div>';
									header("location:../users.php");

?>
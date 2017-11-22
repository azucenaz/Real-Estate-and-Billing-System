<?php

session_start();
include 'connection.php';

if (isset($_POST['submit'])) 
{

	if ($_POST['password'] == $_POST['repassword']) 
	{
		$dbConn->query("UPDATE tbl_users SET fullname = '".$_POST['fullname']."' , password = '".$_POST['repassword']."' ,type = '".$_POST['type']."' where user_id = '".$_POST['user_id']."' ");
		$_SESSION['message'] = '<div class="alert alert-success">
										<button class="close" data-dismiss="alert">X</button>
										<strong>Success!</strong> Account Information updated.
									</div>';
									header("location:../users.php");
	}
	else
	{
		$_SESSION['message'] = '<div class="alert alert-danger">
										<button class="close" data-dismiss="alert">X</button>
										<strong>Error!</strong> Password Doesnt Match.
									</div>';
									header("location:../users.php");
	}

}

?>
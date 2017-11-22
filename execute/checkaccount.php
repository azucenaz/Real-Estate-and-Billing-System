<?php
session_start();
include 'connection.php';

if (isset($_POST['submit'])) 
{
	$checkaccount = $dbConn->query("SELECT * FROM tbl_users where username = '".$_POST['username']."' and password = '".$_POST['password']."' ");
	if ($checkaccount->rowCount() > 0) 
	{
		$row = $checkaccount->fetch(PDO::FETCH_ASSOC);
		$_SESSION['username'] = $row['username'];
		$_SESSION['type'] = $row['type'];
		header("location:../index.php");

	}
	else
	{
		$_SESSION['message'] = '';
		header("location:../login.php");
	}
}

?>
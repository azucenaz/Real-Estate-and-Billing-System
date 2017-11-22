<?php

include '../connection.php';
session_start();


if (isset($_POST['submit'])) 
{

	$check = $dbConn->query("SELECT * FROM tbl_properties where property_name = '".$_POST['property_name']."' ");
	if ($check->rowCount() > 0) 
	{
		$_SESSION['message'] = '<div class="alert alert-danger">
										<button class="close" data-dismiss="alert">X</button>
										<strong>Error!</strong> Property name already exist.
									</div>';
									header("location:../properties.php");

	}
	else
	{
		 $photo = $_FILES['photo']['name'];
		 $target = "../images/"; 
   		 $target = $target . basename( $_FILES['photo']['name']); 
     	 $moved = move_uploaded_file($_FILES['photo']['tmp_name'], $target);
     	 $dbConn->query("INSERT INTO tbl_properties (property_name,property_pic) VALUES ('".$_POST['property_name']."','".$photo."') ");
     	 $_SESSION['message'] = '<div class="alert alert-success">
										<button class="close" data-dismiss="alert">X</button>
										<strong>Success!</strong> Property name added.
									</div>';
									header("location:../properties.php");

	}
}


?>
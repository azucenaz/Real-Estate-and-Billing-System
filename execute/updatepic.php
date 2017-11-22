<?php

include '../connection.php';
session_start();


if (isset($_POST['submit'])) 
{

	if (isset($_FILES['photo']['name'])) 
	{
		$check = $dbConn->query("SELECT * FROM tbl_properties where property_name = '".$_POST['property_name']."' AND id != '".$_POST['pic_id']."'  ");
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
	     	 $dbConn->query("UPDATE tbl_properties SET property_name = '".$_POST['property_name']."',property_pic = '".$photo."'  where id = '".$_POST['pic_id']."' ");
	     	 $_SESSION['message'] = '<div class="alert alert-success">
											<button class="close" data-dismiss="alert">X</button>
											<strong>Success!</strong> Property information updated.
										</div>';
										header("location:../properties.php");

		}
	}
	else
	{
		$dbConn->query("UPDATE tbl_properties SET property_name = '".$_POST['property_name']."' where id = '".$_POST['pic_id']."' ");
		 $_SESSION['message'] = '<div class="alert alert-success">
											<button class="close" data-dismiss="alert">X</button>
											<strong>Success!</strong> Property information updated.
										</div>';
										header("location:../properties.php");
	}

	
}


?>
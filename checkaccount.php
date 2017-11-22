<?php
session_start();
include 'connection.php';


if (isset($_POST['submit'])) 
{
	// mag query sa users
	$checkuser = $dbConn->query("SELECT * FROM tbl_users where username = '".$_POST['username']."' and password = '".$_POST['password']."' ");
	// iya e check kung exist iya account
	if($checkuser->rowCount() > 0) 
	{
		
		$getuser = $checkuser->fetch(PDO::FETCH_ASSOC);

		// if active iya account
		if ($getuser['status'] == 'active') 
		{
			// are mag store og sessions
			$_SESSION['username'] = $getuser['username'];
			$_SESSION['fullname'] = $getuser['fullname'];
 			$_SESSION['type']	= $getuser['type'];
 			// kani mo redirect og sa home page or index page
			header("location:index.php");
		}
		// are dli na active iya account
		else
		{
			// mao ni ang message sa error
			$_SESSION['errorlogin'] = '<div class="alert alert-error">
										<button class="close" data-dismiss="alert">X</button>
										<strong>Error!</strong> Youre account isnt active anymore. Please Contact your Administrator.
									</div>';
			// mo redirect sa login page
			header("location:login.php");
		}
		
	}
	// if wala sa database ang account or wrong account or wrong password
	else
	{	
			// mao ni ang message sa error 
			$_SESSION['errorlogin'] = '<div class="alert alert-error">
										<button class="close" data-dismiss="alert">X</button>
										<strong>Error!</strong> Invalid Username or Password.
									</div>';
			// mo redirect sa login page
			header("location:login.php");
	}

}

?>
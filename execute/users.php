 <?php 
session_start();
include 'connection.php';
                                if(isset($_POST['submit2']))
                                {
                                    $lodgers = $dbConn->query("SELECT * FROM tbl_users WHERE username = '".$_POST['username']."' AND password = '".$_POST['password']."'  ");
                                    if($lodgers->rowCount() > 0) 
                                    {
                                        $_SESSION['message'] = '<div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                                Username Already Existed
                            </div>';
                            header("location:../users.php");
                                    }
                                    else
                                    {
                                        if ($_POST['password'] == $_POST['repassword']) 
                                        {
                                            $dbConn->query("INSERT INTO tbl_users (username,password,type,fullname,status) VALUES ('".$_POST['username']."','".$_POST['password']."','".$_POST['type']."','".$_POST['fullname']."','active') ");
                                        $_SESSION['message'] = '<div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                                New Added Users..
                            </div>';
                            header("location:../users.php");
                                        }
                                        else
                                        {
                                            $_SESSION['message'] = '<div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                               Password Doesnt Match!!
                            </div>';
                            header("location:../users.php");
                                        }
                                        
                                    }
                                }


                                if (isset($_POST['update'])) 
                                {
                                
                                    if ($_POST['password'] == $_POST['repassword']) 
                                    {
                                        $dbConn->query("UPDATE tbl_users SET password = '".$_POST['password']."',type ='".$_POST['type']."' where id = '".$_POST['users_id']."'  ");
                                        $_SESSION['message'] = '<div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                               Successfully Updated.
                            </div>';
                            header("location:../users.php");
                                    }
                                     else
                                        {
                                            $_SESSION['message'] = '<div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                               Password Doesnt Match!!
                            </div>';
                            header("location:../users.php");
                                        }

                                     
                                }

                                ?>
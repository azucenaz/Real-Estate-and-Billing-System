  
          <?php 
          session_start();
          include 'connection.php';

                                if(isset($_POST['submit1']))
                                {
                                    $checkroom = $dbConn->query("SELECT * FROM tbl_rooms where room_name = '".$_POST['room_name']."' ");
                                    if($checkroom->rowCount() > 0 )
                                    {
                                        $_SESSION['message'] = '<div class="alert alert-danger alert-dismissable">
                                    
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                Already In the List!!!!
                            </div>';
                            header("location:../roomlist.php");
                                    }
                                    else
                                    {
                                        $dbConn->query("INSERT INTO tbl_rooms (room_name,price,status,description) VALUES ('".$_POST['room_name']."','".$_POST['price']."','".$_POST['status']."','".$_POST['description']."') ");
                                        $_SESSION['message'] = '<div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                New Added Room: '.$_POST['room_name'].'
                            </div>';
                            header("location:../roomlist.php");
                                    }
                                }


                                if (isset($_POST['update'])) 
                                {
                                
                                    $dbConn->query("UPDATE tbl_rooms SET room_name = '".$_POST['room_name']."',price='".$_POST['price']."',status = '".$_POST['status']."',description = '".$_POST['description']."' where id = '".$_POST['room_id']."'  ");
                                     $_SESSION['message'] = '<div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                               Successfully Updated.
                            </div>';
                            header("location:../roomlist.php");
                                }

                                ?>
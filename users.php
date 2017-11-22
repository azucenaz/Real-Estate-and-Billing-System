<?php
session_start();
include 'connection.php';
$_SESSION['page'] = 'users';
?>
<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title>Billing System</title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
        <script src="vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>

        <link href="assets/DT_bootstrap.css" rel="stylesheet" media="screen">
    </head>
    
    <body>
    <?php 
        include 'header.php';
        ?>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span3" id="sidebar">
                     <?php

                 switch ($_SESSION['type']) 
                 {
                     case 'default':
                        include 'admin.php';
                             break;
                     case 'admin':
                        include 'admin.php';
                         break;
                         case 'cashier':
                        include 'cashier.php';
                             break;
                         
                     default:
                         # code...
                         break;
                 }

                    ?>
                </div>
                
                <!--/span-->
                 <div class="span9" id="content">
                     <div class="row-fluid">
                         <?php

                    if($_SESSION['type'] == 'default' )
                    {
                        echo '<div class="alert alert-danger">
                                        <a class="close" data-dismiss="alert" href="#">X</a>
                                        <h4 class="alert-heading">Warning!</h4><br>
                                        Youre account is super admin i will advised to create another admin account . And dont share this super admin account..
                                        For Security purposes.
                                    </div>';
                    }

                ?>
                        <!-- block -->
                        <?php echo 
                        isset($_SESSION['message']) ? $_SESSION['message'] : '';
                        unset($_SESSION['message']);
                         ?>
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Users management</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
                                      <div class="btn-group">
                                         <a class="btn btn-success" data-toggle="modal" href="#addlodgers">Add New <i class="icon-plus icon-white"></i></a>
                                          
                                      </div>
                                    
                                   </div>
                                    
                                    <div id="addlodgers" class="modal hide" aria-hidden="true" >
                                            <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type="button">X</button>
                                                <h3>Add Users</h3>

                                            </div>
                                            <div class="modal-body">
                                           <form method="post" action="execute/users.php">
                                           <p>
                                                           
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="first-name">Username <span class="required">*</span></label>
                                    <div class="col-sm-8"><input type="text" id="first-name" name="username" required="required" class="form-control input-transparent" ></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="last-name">Password <span class="required">*</span></label>
                                    <div class="col-sm-8"><input type="password" id="last-name" name="password" required="required" class="form-control input-transparent" ></div>
                                </div>
                                <div class="form-group">
                                    <label for="middle-name" class="control-label col-sm-4">Repassword</label>
                                    <div class="col-sm-8"><input id="middle-name" class="form-control input-transparent" type="password" name="repassword" value=""></div>
                                </div>
                                 <div class="form-group">
                                    <label for="middle-name" class="control-label col-sm-4">Full Name</label>
                                    <div class="col-sm-8"><input id="middle-name" class="form-control input-transparent" type="text" name="fullname" value=""></div>
                                </div>
                                 <div class="form-group">
                                    <label for="middle-name" class="control-label col-sm-4">Type:</label>
                                    <div class="col-sm-8">  <select class="form-control input-transparent" name="type">
                                       <option value="">Choose</option>
                                       <option value="admin">Admin</option>
                                       <option value="cashier">Cashier</option>
                                      
                                   </select></div>
                                </div>
                                           </p>
                                            
                                   
                                            </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="submit2">ADD</button>
                                       </form>
                                            </div>
                                        </div>

                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Username</th>
                                                <th>Password</th>
                                                <th>Type</th>
                                                <th>Status</th>
                                                <th>Action(s)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $getcustomer = $dbConn->query("SELECT * FROM tbl_users where type != 'default' ");
                                                while($discustomer = $getcustomer->fetch(PDO::FETCH_ASSOC))
                                                {
                                            ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $discustomer['fullname'];?></td>
                                                <td><?php echo $discustomer['username'];?></td>

                                                <td><?php echo $discustomer['password'];?></td>
                                                <td class="center" style="text-transform:uppercase;"><?php echo $discustomer['type'];?></td>

                                                <td class="center"><?php 
                                                if ($discustomer['status'] == 'active' ) 
                                                {
                                                    echo '<span class="label label-success">ACTIVE</span>';
                                                }
                                                else
                                                {
                                                     echo '<span class="label label-important">INACTIVE</span>';
                                                }
                                                ?></td>

                                                <td class="center">

                                                <?php 
                                                if ($discustomer['status'] == 'active') 
                                                {
                                                 ?>   

                                                 <a class="btn btn-danger" href="execute/inactive.php?id=<?php echo $discustomer['user_id'];?>" data-toggle="modal"><label class="icon icon-ban-circle icon-white" title="active account"></label></a>
                                                 <?php 
                                                }
                                                else
                                                {
                                                ?>
                                                <a class="btn btn-success" href="execute/active.php?id=<?php echo $discustomer['user_id'];?>" data-toggle="modal"><label class="icon icon-ok icon-white" title="active account"></label></a>
                                                <?php } ?>


                                                 | <a class="btn btn-primary" href="#<?php echo $discustomer['user_id'];?>" data-toggle="modal"><label class="icon icon-edit icon-white"></label></a></td>
                                            </tr>
                                                    

                                            <!-- active or inactive account -->






                                            <!-- edit account -->

                                                    <div id="<?php echo $discustomer['user_id'];?>" class="modal hide" aria-hidden="true" >
                                            <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type="button">X</button>
                                                <h3>Update users</h3>
                                            </div>
                                            <div class="modal-body">
                                            <form method="post" action="execute/updateusers.php">
                                                <p>
                                                                    
                                    <input type="hidden" name="user_id" value="<?php echo $discustomer['user_id'];?>">

                                    <label class="control-label col-sm-4" for="last-name">Full Name <span class="required">*</span></label>
                                    <div class="col-sm-8"><input type="text" id="last-name" name="fullname" required="required" class="form-control input-transparent" value="<?php echo $discustomer['fullname'];?>"></div>

                                    <label class="control-label col-sm-4" for="first-name">UserName <span class="required">*</span></label>
                                    <div class="col-sm-8"><input type="text" id="first-name" name="username" required="required" class="form-control input-transparent" value="<?php echo $discustomer['username'];?>" readonly></div>

                        
                                    <label class="control-label col-sm-4" for="last-name">Password <span class="required">*</span></label>
                                    <div class="col-sm-8"><input type="password" id="last-name" name="password" required="required" class="form-control input-transparent" value="<?php echo $discustomer['password'];?>"></div>
                           

                                    <label for="middle-name" class="control-label col-sm-4">Repassword</label>
                                    <div class="col-sm-8"><input id="middle-name" class="form-control input-transparent" type="password" name="repassword" value="<?php echo $discustomer['password'];?>"></div>
                   
                                   
                                    <label for="middle-name" class="control-label col-sm-4">Type</label>
                                    <div class="col-sm-8">
                                            <select class="form-control input-transparent" name="type" required>
                                            <option value="">Choose</option>
                                            <option value="admin" <?php if ($discustomer['type'] == 'admin') 
                                            {
                                            echo 'selected';    # code...
                                            }?>>Admin</option>
                                            <option value="cashier" <?php if ($discustomer['type'] == 'cashier') 
                                            {
                                            echo 'selected';    # code...
                                            }?>>Cashier</option>
                                           
                                            </select>
                                                
                                                
                                                
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" class="btn btn-primary" value="UPDATE" name="submit"> 
                                                </form>
                                            </div>
                                        </div>
                                           <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                </div>
            </div>
            <hr>
          
        </div>
        <!--/.fluid-container-->
        <script src="vendors/jquery-1.9.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="vendors/datatables/js/jquery.dataTables.min.js"></script>
        <script src="assets/scripts.js"></script>
        <script src="assets/DT_bootstrap.js"></script>
        <script>
        $(function() {
            
        });
        </script>
    </body>

</html>


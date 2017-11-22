<?php
session_start();
include 'connection.php';
$_SESSION['page'] = 'properties';
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
                                <div class="muted pull-left">Properties management</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
                                      <div class="btn-group">
                                         <a class="btn btn-success" data-toggle="modal" href="#addlodgers">Add New Property <i class="icon-plus icon-white"></i></a>
                                          
                                      </div>
                                    
                                   </div>
                                    
                                    <div id="addlodgers" class="modal hide" aria-hidden="true" >
                                            <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type="button">X</button>
                                                <h3>Add Property</h3>

                                            </div>
                                            <div class="modal-body">
                                           <form method="post" action="execute/addprop.php" enctype="multipart/form-data">
                                           <p>
                                                           
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="property_name">Property Name <span class="required">*</span></label>
                                    <div class="col-sm-8"><input type="text" id="property_name" name="property_name" required="required" class="form-control input-transparent" ></div>
                                </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-4" for="photo">Property picture <span class="required">*</span></label>
                                    <div class="col-sm-8"><input type="file" id="photo" name="photo" required="required" class="form-control input-transparent" ></div>
                                </div>
                               
                                
                              
                            
                                </p>
                                            
                                   
                                            </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger btn-large" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary btn-large" name="submit">ADD</button>
                                       </form>
                                            </div>
                                        </div>

                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
                                        <thead>
                                            <tr>
                                                <th>Property Name</th>
                                                <th>Property Picture</th>
                                                
                                                <th>Action(s)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $getcustomer = $dbConn->query("SELECT * FROM tbl_properties ");
                                                while($discustomer = $getcustomer->fetch(PDO::FETCH_ASSOC))
                                                {
                                            ?>
                                            <tr class="odd gradeX">
                                                 <td class="center"><?php echo $discustomer['property_name'];?></td>
                                                  <td class="center"><img src="images/<?php echo $discustomer['property_pic'];?>" width="300px" height="200px"></td>

                                                <td class="center">
                                           
                                               
                                               <a class="btn btn-success" href="#edit<?php echo $discustomer['id'];?>" data-toggle="modal"><label class="icon icon-edit icon-white"></label></a>
                                              
                                              

                                                </td>
                                            </tr>

                                          

                                            <!-- edit users -->

                                                    <div id="edit<?php echo $discustomer['id'];?>" class="modal hide" aria-hidden="true" >
                                            <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type="button">X</button>
                                                <h3>Update Properties</h3>
                                            </div>
                                            <div class="modal-body">
                                            <form method="post" action="execute/updatepic.php" enctype="multipart/form-data">
                                                <p>
                                                  <input type="hidden" value="<?php echo $discustomer['id'];?>" name="pic_id" >
                                                       <div class="form-group">
                                    <label class="control-label col-sm-4" for="property_name">Property Name <span class="required">*</span></label>
                                    <div class="col-sm-8"><input type="text" id="property_name" name="property_name" value="<?php echo $discustomer['property_name'];?>" required="required" class="form-control input-transparent" ></div>
                                </div>

                                  <div class="form-group">
                                    <label class="control-label col-sm-4" for="photo">Property picture <span class="required">*</span></label>
                                    <input type="hidden" value="<?php echo $discustomer['property_pic']; ?>" name="pic">
                                    <div class="col-sm-8"><input type="file" id="photo" name="photo"   class="form-control input-transparent" ></div>
                                </div>
                               
                                
                              
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" class="btn btn-primary btn-large" value="UPDATE" name="submit"> 
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
        $(document).ready(function()
        {

        })
        </script>
    </body>

</html>


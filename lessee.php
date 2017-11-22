<?php
session_start();
include 'connection.php';
$_SESSION['page'] = 'lessee';
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
                                <div class="muted pull-left">Lessee management</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
                                      <div class="btn-group">
                                         <a class="btn btn-success" data-toggle="modal" href="#addlodgers">Add New Lessee <i class="icon-plus icon-white"></i></a>
                                          
                                      </div>
                                    
                                   </div>
                                    
                                    <div id="addlodgers" class="modal hide" aria-hidden="true" >
                                            <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type="button">X</button>
                                                <h3>Add Lessee</h3>

                                            </div>
                                            <div class="modal-body">
                                           <form method="post" action="execute/addlessee.php">
                                           <p>
                                                           
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="first-name">Firstname <span class="required">*</span></label>
                                    <div class="col-sm-8"><input type="text" id="first-name" name="firstname" required="required" class="form-control input-transparent" ></div>
                                </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-4" for="middlename">Middlename <span class="required">*</span></label>
                                    <div class="col-sm-8"><input type="text" id="middlename" name="middlename"  class="form-control input-transparent" ></div>
                                </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-4" for="lastname">Lastname <span class="required">*</span></label>
                                    <div class="col-sm-8"><input type="text" id="lastname" name="lastname" required="required" class="form-control input-transparent" ></div>
                                </div>
                                 <div class="form-group">
                                    <label class="control-label col-sm-4" for="property">Property Name <span class="required">*</span></label>
                                    <div class="col-sm-8">
                                      <select class="form-control" name="property" required> 
                                        <option value=""></option>
                                        <?php
                                        $info = $dbConn->query("SELECT * FROM tbl_properties");
                                        while($row1 = $info->fetch(PDO::FETCH_ASSOC))
                                        {
                                          echo "<option value='".$row1['id']."'>".$row1['property_name']."</option>";
                                        }
                                        ?>  
                                      </select>
                                    </div>
                                </div>
                                   <div class="form-group">
                                    <label class="control-label col-sm-4" for="unit">Unit <span class="required">*</span></label>
                                    <div class="col-sm-8"><input type="text" id="unit" name="unit" required="required" class="form-control input-transparent" ></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="contact">Contact <span class="required">*</span></label>
                                    <div class="col-sm-8"><input type="text" id="contact" name="contact" required="required" class="form-control input-transparent" ></div>
                                </div>
                                   <div class="form-group">
                                    <label class="control-label col-sm-4" for="water">Current Water Reading <span class="required">*</span></label>
                                    <div class="col-sm-8"><input type="number" min="0" step="0.01"  id="water" name="water" required="required" class="form-control input-transparent" ></div>
                                </div>
                                 <div class="form-group">
                                    <label class="control-label col-sm-4" for="electric">Current Electric Reading <span class="required">*</span></label>
                                    <div class="col-sm-8"><input type="number" min="0" id="electric" step="0.01" name="electric" required="required" class="form-control input-transparent" ></div>
                                </div>
                                 <div class="form-group">
                                    <label class="control-label col-sm-4" for="fee">Rental Fee <span class="required">*</span></label>
                                    <div class="col-sm-8"><input type="number" min="0" id="fee" step="0.01" name="fee" required="required" class="form-control input-transparent" ></div>
                                </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-4" for="status">Status <span class="required">*</span></label>
                                    <div class="col-sm-8">
                                        <select class="form-control" required>
                                          <option value=""></option>
                                          <option value="open">OPEN</option>
                                          <option value="close">CLOSE</option>
                                        </select>
                                    </div>
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
                                                <th>Full Name</th>
                                                <th hidden >Details</th>
                                                <th>Last Statement</th>
                                                <th>Rental Fee</th>
                                                <th>Status</th>
                                                <th>Action(s)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $getcustomer = $dbConn->query("SELECT * FROM tbl_lessee INNER JOIN tbl_properties ON tbl_properties.id = tbl_lessee.property_name");
                                                while($discustomer = $getcustomer->fetch(PDO::FETCH_ASSOC))
                                                {
                                            ?>
                                            <tr class="odd gradeX">
                                                 <td class="center"><?php echo $discustomer['property_name'];?></td>
                                                <td><button class="btn btn-primary" data-toggle="modal" data-target="#info<?php echo $discustomer['lessee_id']?>"><?php echo $discustomer['firstname'].' '.$discustomer['lastname'];?></button></td>
                                                <td hidden>
                                                    <?php echo $discustomer['unit'];?><br>
                                                    <?php echo number_format($discustomer['electric_reading'],2);?><br>
                                                     <?php echo number_format($discustomer['water_reading'],2);?>    <br>
                                                </td>

                                                <td class="center"><?php echo $discustomer['last_statement'];?></td>

                                                <td class="center">Php <?php echo number_format($discustomer['rental_fee'],2);?></td>


                                                <td class="center"><?php if($discustomer['status'] == 'open' ){ echo '<span class="label label-success">OPEN
</span>'; }else{ echo '<span class="label label-important">
CLOSED</span>';}?></td>

                                                <td class="center">
                                                <?php 
                                                if($_SESSION['type'] == 'admin' || $_SESSION['type'] == 'default')
                                                {  ?>
                                               <a class="btn btn-success" href="#<?php echo $discustomer['lessee_id'];?>" data-toggle="modal"><label class="icon icon-edit icon-white"></label></a>
                                              
                                                <?php 
                                                }
                                                ?>
                                               <a class="btn btn-primary" title="Go to Payments" href="#pay<?php echo $discustomer['lessee_id'];?>" data-toggle="modal"><label class="icon icon-print icon-white"></label></a>

                                                </td>
                                            </tr>

                                              <div id="pay<?php echo $discustomer['lessee_id']?>" class="modal hide" aria-hidden="true" style="display: none;">
                                            <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type="button">X</button>
                                                <h3>Statement of Account</h3>
                                                (Make sure you double check your input once you save the data)
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                    <form method="post" action="savebill.php">
                                                     <?php 

                                $query = $dbConn->query("SELECT * FROM tbl_rates where rate_id = '1' ");
                                $row = $query->fetch(PDO::FETCH_ASSOC);

                                ?>                  
                                    <input type="hidden" name="lessee_id" value="<?php echo $discustomer['lessee_id']; ?>">

                                    <input type="hidden" name="property_id" value="<?php echo $discustomer['id']; ?>">
                                                    <h5>Water Reading ---  Rates: Php <?php echo number_format($row['water_rate'],2);?></h5> 
                                                    <b>Start:</b> <span style="margin-left:4em;"><?php echo $discustomer['water_reading'];?></span> <b style="margin-left:1em;">End:</b>    <input style="margin-left:2em;" type="number" step="0.01" min="<?php echo $discustomer['water_reading'];?>" style="width:100px;" name="end_water" required><br>
                                                    <h5>Electric Reading ---  Rates: Php <?php echo number_format($row['electric_rate'],2);?></h5>
                                                    <b>Start:</b> <span style="margin-left:4em;"><?php echo $discustomer['electric_reading'];?></span> <b style="margin-left:1em;">End:</b>    <input style="margin-left:2em;" type="number" step="0.01" min="<?php echo $discustomer['electric_reading'];?>" style="width:100px;" name="end_electric" required><br><br>
                                                      <b>Past Due Amount:</b> <span style="margin-left:4em;"><input type="number" required step="0.01" name="past_due" min="0" value="0"></span> <br><br>
                                                       <b>MONTH OF:</b> <span style="margin-left:4em;"><input type="text" required  name="month" placeholder="Example: APRIL 2016"></span> <br><br>

                                                  <center>  <input type="submit" name="submit" class="btn btn-large btn-primary" value="SAVE & PRINT BILL STATEMENT"> </center>
                                                    </form>
                                                </p>
                                            </div>
                                            <div class="modal-footer">

                                             
                                                <a data-dismiss="modal" class="btn btn-danger" href="#">CLOSE</a>
                                            </div>
                                        </div>

                                            <!-- lessee info -->

                                            <div id="info<?php echo $discustomer['lessee_id']?>" class="modal hide" aria-hidden="true" style="display: none;">
                                            <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type="button">X</button>
                                                <h3><?php echo $discustomer['firstname'].' '.$discustomer['lastname'];?>&nbsp;&nbsp;&nbsp;&nbsp;Unit: <?php echo $discustomer['unit'];?></h3>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                    
                                                    Current Electric Reading: 
                                                    <?php echo number_format($discustomer['electric_reading'],2);?>
                                                    <br>
                                                    <br>
                                                    Current Water Reading: 
                                                    <?php echo number_format($discustomer['water_reading'],2);?>       

                                                </p>
                                            </div>
                                            <div class="modal-footer">

                                                <a class="btn btn-primary" href="summary.php?id=<?php echo $discustomer['lessee_id'];?>">Account Summary</a>
                                                <a data-dismiss="modal" class="btn btn-danger" href="#">CLOSE</a>
                                            </div>
                                        </div>


                                            <!-- edit users -->

                                                    <div id="<?php echo $discustomer['lessee_id'];?>" class="modal hide" aria-hidden="true" >
                                            <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type="button">X</button>
                                                <h3>Update Lessee</h3>
                                            </div>
                                            <div class="modal-body">
                                            <form method="post" action="execute/updatelessee.php">
                                                <p>
                                                       <input type="hidden" value="<?php echo $discustomer['lessee_id'];?>" name="lessee_id">                        
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="first-name">Firstname <span class="required">*</span></label>
                                    <div class="col-sm-8"><input type="text" id="first-name" value="<?php echo $discustomer['firstname'];?>" name="firstname" required="required" class="form-control input-transparent" ></div>
                                </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-4" for="middlename">Middlename <span class="required">*</span></label>
                                    <div class="col-sm-8"><input type="text" id="middlename" value="<?php echo $discustomer['middlename'];?>" name="middlename"  class="form-control input-transparent" ></div>
                                </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-4" for="lastname">Lastname <span class="required">*</span></label>
                                    <div class="col-sm-8"><input type="text" id="lastname" value="<?php echo $discustomer['lastname'];?>" name="lastname" required="required" class="form-control input-transparent" ></div>
                                </div>
                                   <div class="form-group">
                                    <label class="control-label col-sm-4" for="unit">Unit <span class="required">*</span></label>
                                    <div class="col-sm-8"><input type="text" id="unit" value="<?php echo $discustomer['unit'];?>"  name="unit" required="required" class="form-control input-transparent" ></div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-4" for="contact">Contact <span class="required">*</span></label>
                                    <div class="col-sm-8"><input type="text" id="contact" value="<?php echo $discustomer['contact'];?>" name="contact" required="required" class="form-control input-transparent" ></div>
                                </div>
                                   <div class="form-group">
                                    <label class="control-label col-sm-4" for="water">Current Water Reading <span class="required">*</span></label>
                                    <div class="col-sm-8"><input type="number" step="0.01" value="<?php echo $discustomer['water_reading'];?>" min="0" id="water" name="water" required="required" class="form-control input-transparent" ></div>
                                </div>
                                 <div class="form-group">
                                    <label class="control-label col-sm-4" for="electric">Current Electric Reading <span class="required">*</span></label>
                                    <div class="col-sm-8"><input type="number" min="0" step="0.01" id="electric" value="<?php echo $discustomer['electric_reading'];?>" name="electric" required="required" class="form-control input-transparent" ></div>
                                </div>
                                 <div class="form-group">
                                    <label class="control-label col-sm-4" for="fee">Rental Fee <span class="required">*</span></label>
                                    <div class="col-sm-8"><input type="number" min="0" id="fee" value="<?php echo $discustomer['rental_fee'];?>" step="0.01" name="fee" required="required" class="form-control input-transparent" ></div>
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


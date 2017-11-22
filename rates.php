<?php
session_start();
include 'connection.php';
include 'auth.php';
$_SESSION['page'] = 'rates';
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
                <script type="text/javascript" src="canvasjs.min.js"></script>

            

                <!--/span-->
                <div class="span9" id="content">
                    <?php

                    if($_SESSION['type'] == 'default' )
                    {
                        echo '<div class="alert alert-danger">
                                        <a class="close" data-dismiss="alert" href="#">X</a>
                                        <h4 class="alert-heading">Warning!</h4><br>
                                        Youre account is super admin i will advised to create another admin account . And dont share this account..
                                        For Security purposes.
                                    </div>';
                    }

                ?>   <?php echo 
                        isset($_SESSION['message']) ? $_SESSION['message'] : '';
                        unset($_SESSION['message']);
                         ?>
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Rate Settings</div>
                                <?php 

                                $query = $dbConn->query("SELECT * FROM tbl_rates where rate_id = '1' ");
                                $row = $query->fetch(PDO::FETCH_ASSOC);

                                ?>
                            </div>
                            <div class="block-content collapse in">
                            <form method="post" action="execute/settings.php">
                                Water Billing Rates: <input type="number" step="0.01" value="<?php echo $row['water_rate'];?>" required class="form-control" name="water" placeholder="Example: 100.00"><br>
                                 Electric Billing Rates: <input type="number" step="0.01" value="<?php echo $row['electric_rate'];?>" required class="form-control" name="electric" placeholder="Example: 20.70"><br>
                                  Interest Rates: <input type="number" min="0" max="100" required class="form-control" value="<?php echo $row['interest_rate'] * 100;?>" name="rates" placeholder="Example: 10 is equal to 10%">
                                  <br>
                                  <br>
                                  <input type="submit" class="btn btn-primary btn-large" value="SAVE" name="submit">
                            </form>

                                
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
        <script src="vendors/easypiechart/jquery.easy-pie-chart.js"></script>
        <script src="assets/scripts.js"></script>
        <script>
        $(function() {
            // Easy pie charts
            $('.chart').easyPieChart({animate: 1000});
        });
        </script>
    </body>

</html>

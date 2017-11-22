<?php
session_start();
include 'connection.php';
include 'auth.php';
$_SESSION['page'] = 'dashboard';
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

                ?>
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Dashboard</div>
                              
                            </div>
                            <div class="block-content collapse in">
                            <table class="table">
                                      <thead>
                                        <tr>
                                         
                                          <th>Total Lessee</th>
                                          <th>Total Transactions</th>
                                          <th>Total Amount Expected</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                   
                                          <td><?php 
                                          $less = $dbConn->query("SELECT * FROM tbl_lessee");
                                          echo $less->rowCount();
                                          ?></td>
                                          <td><?php 
                                          $less1 = $dbConn->query("SELECT * FROM tbl_transactions");
                                          echo $less1->rowCount();
                                          ?></td>
                                          <td><?php 
                                          $less1 = $dbConn->query("SELECT sum(total_amount) FROM tbl_transactions");
                                          $dis = $less1->fetch(PDO::FETCH_ASSOC);

                                          echo number_format($dis['sum(total_amount)'],2);

                                          ?></td>
                                        </tr>
                                      
                                      </tbody>
                                    </table>

                                
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

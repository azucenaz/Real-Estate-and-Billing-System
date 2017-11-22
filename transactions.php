<?php
session_start();
include 'connection.php';
$_SESSION['page'] = 'transactions';
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
                        <!-- block -->
                        <?php echo 
                        isset($_SESSION['message']) ? $_SESSION['message'] : '';
                        unset($_SESSION['message']);
                         ?>
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Transactions</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                   <div class="table-toolbar">
                                     
                                    
                                   </div>
                                    
                               
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
                                        <thead>
                                            <tr>
                            <th>Bill No</th>                       
                            <th>Lessee Name</th>
                            <th class="hidden-xs">Month Statement</th>
                            <th class="hidden-xs">Amount</th>
                            <th class="hidden-xs">Date Printed</th>
                            <th>Status</th>
                            <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php

                        if (isset($_POST['submit']) && $_POST['submit'] == 'Search') 
                        {
                        $query = $dbConn->query("SELECT * FROM tbl_transactions INNER JOIN tbl_lessee ON tbl_transactions.lessee_id = tbl_lessee.lessee_id where bill_id = '".$_POST['bill_id']."' ");
                        }
                        else
                        {
                        $query = $dbConn->query("SELECT * FROM tbl_transactions INNER JOIN tbl_lessee ON tbl_transactions.lessee_id = tbl_lessee.lessee_id ");
                        }

                        while($row = $query->fetch(PDO::FETCH_ASSOC))
                        {

                        ?>
                        <tr>
                        <td><?php echo $row['bill_id'];?></td>
                        <td><?php echo $row['firstname'].' '.$row['lastname'];?></td>
                        <td><?php echo $row['month_statement'];?></td>
                        
                        <td><?php echo number_format($row['total_amount'],2);?></td>
                        <td><?php echo $row['date_printed'];?></td>
                        <td><?php 
                        if ($row['paid'] == 'paid') 
                        {
                           echo '<span class="label label-success">PAID</span>';
                        }
                        else
                        {
                            echo '<span class="label label-important">NOT PAID</span>';
                        }
                        ?></td>
                        <td><a class="btn btn-primary" title="Print Bill" href="printbill.php?id=<?php echo $row['bill_id'];?>" data-toggle="modal"><label class="icon icon-print icon-white"></label></a>
                        <?PHP 
                        if($row['paid'] != 'paid')
                        {
                        ?>
                        <a class="btn btn-success" title="PAY Bill" href="#pay<?php echo $row['bill_id'];?>" data-toggle="modal"><label class="icon icon-ok icon-white"></label></a><?php } ?></td>
                        </tr>
                        <div id="pay<?php echo $row['bill_id'];?>" class="modal hide" aria-hidden="true" style="display: none;">
                                            <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type="button">X</button>
                                                <h3>Bill no: <?php echo $row['bill_id'];?></h3>

                                                <form method="post" action="updatebill.php">
                                                <input type="hidden" value="<?php echo $row['bill_id']; ?>" name="bill_id">
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure to change this status into "<B>PAID</B>" account?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit"  class="btn btn-primary" name="submit" value="CONFIRM">
                                                </form>
                                                <a data-dismiss="modal" class="btn btn-danger" href="#">Cancel</a>
                                            </div>
                                        </div>
                        <?php
                        }
                        ?>
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


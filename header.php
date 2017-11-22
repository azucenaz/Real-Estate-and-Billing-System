<div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#">Billing System</a>
                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i><?php echo $_SESSION['fullname'];?> <i class="caret"></i>

                                </a>
                                <ul class="dropdown-menu">
                                   
                                    <li>
                                        <a tabindex="-1" href="logout.php">Logout</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav">
                              <li class="dropdown">
                              <?php 
                              $count = $dbConn->query("SELECT * FROM tbl_transactions INNER JOIN tbl_lessee ON tbl_transactions.lessee_id = tbl_lessee.lessee_id where paid != 'paid' ");
                              $counts = $count->rowCount();
                               ?>
                                <a href="#" data-toggle="dropdown" class="dropdown-toggle">Pending Bills (<?php echo isset($counts) ? '<b><font color="red">'.$counts.'</font></b>' : '0' ; ?>) <b class="caret"></b>

                                </a>
                                <ul class="dropdown-menu" id="menu1">
                                    <?php 
                                    if ($counts == 0) 
                                    {
                                        ECHO '<li>
                                        <a href="#">No Pending Bills</a>
                                    </li>';
                                    }
                                    else
                                    {
                                    while ($row = $count->fetch(PDO::FETCH_ASSOC)) 
                                    {
                                        # code...
                                    
                                    ECHO '<li>
                                        <a href="summary.php?id='.$row['lessee_id'].'">'.$row['firstname'].' '.$row['lastname'].' -- Bill No: '.$row['bill_id'].' </a>
                                    </li>';
                                }
                            }
                                   ?>
                                </ul>
                            </li>
                            <li>
                                <form action="transactions.php" method="post">
                                <input type="text" class="form-control" style="margin-bottom:-18px;" placeholder="Enter Bill Number" required name="bill_id">

                            </li>
                            <li>
                                <input type="submit" class="btn btn-primary" style="margin-left:18px;" name="submit" value="Search">
                                </form>
                            </li>
                           
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
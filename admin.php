
 <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
                        <li <?php echo isset($_SESSION['page'])  && $_SESSION['page'] == 'dashboard' ? 'class="active"':'' ?>>
                            <a href="index.php"><i class="icon-chevron-right"></i> Dashboard</a>
                        </li>
                    
                        <li <?php echo isset($_SESSION['page'])  && $_SESSION['page'] == 'users' ? 'class="active"':'' ?>>
                            <a href="users.php"><i class="icon-chevron-right"></i> Users</a>
                        </li>
                          <li <?php echo isset($_SESSION['page'])  && $_SESSION['page'] == 'lessee' ? 'class="active"':'' ?>>
                            <a href="lessee.php"><i class="icon-chevron-right"></i> Lessee</a>
                        </li>
                        
                       
                        <li <?php echo isset($_SESSION['page'])  && $_SESSION['page'] == 'transactions' ? 'class="active"':'' ?>>
                            <a href="transactions.php"><i class="icon-chevron-right"></i> Transactions</a>
                        </li>
                        <li <?php echo isset($_SESSION['page'])  && $_SESSION['page'] == 'properties' ? 'class="active"':'' ?>>
                            <a href="properties.php"><i class="icon-chevron-right"></i> Properties</a>
                        </li>
                        <li <?php echo isset($_SESSION['page'])  && $_SESSION['page'] == 'rates' ? 'class="active"':'' ?>>
                            <a href="rates.php"><i class="icon-chevron-right"></i> Rates</a>
                        </li>
                    </ul>
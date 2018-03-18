<?php
    include('controllers/header_admin_controller.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A CAPSTONE project by Team Paragon of De la Salle-College of Saint Benilde">
    <meta name="author" content="Team Paragon - Mark Castillo, Gian Estera, Josh Manalo - DLS-CSB">
    <meta name="keyword" content="CAPSTONE, CAPSTONE2, ISPROJ, ISPROJ2, De la Salle, DLS-CSB, Team Paragon, Thesis, Aurum, Legal Billing, Time Keeping, Payroll">

    <title><?php echo $pageTitle; ?></title>

    <!-- Local Files -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="assets/js/bootstrap-daterangepicker/daterangepicker.css" />
        
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
</head>
<body>
    <section id="container">
    <!-- TOP BAR CONTENT & NOTIFICATIONS --> 
    <!--header start-->
        <header class="header black-bg">
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
            </div>
            <!--logo start-->
            <a href="index.php" class="logo"><b>Aurum System</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.php">
                            <i class="fa fa-tasks"></i>
                            <span class="badge bg-theme"><?php echo $notifCount; ?></span>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">Notifications</p>
                            </li>
                            <li>
                                <?php 
                                    echo $btnDismiss;
                                    echo $list_notif; 
                                ?>
                            </li>
                        </ul>
                    </li>
                <!--  notification end -->
            </div>
            <div class="top-menu">
                <ul class="nav pull-right top-menu">
                    <li>
                        <a class="logout" href="<?php echo app_path?>controllers/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </header>
        <!--header end-->
        
        MAIN SIDEBAR MENU
      
        <aside>
            <div id="sidebar"  class="nav-collapse">
            <!-- sidebar menu start-->
                <ul class="sidebar-menu" id="nav-accordion">
                    <p class="centered">
                        <a href="account.php">
                            <p class="centered"><a href="account.php"><img src='images/profile/<?php echo getPhoto($accountPhoto); ?>' class="img-circle" width="100"></a></p>
                        </a>
                    </p>
                    <h5 class="centered"><?php echo $displayName; ?></h5>
                    <li class="mt">
                        <a href="index.php">
                            <i class="fa fa-dashboard"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sub-menu dcjq-parent-li">
                        <a class="dcjq-parent" href="javascript:;">
                            <i class="fa fa-desktop"></i>
                            <span>User Management</span>
                        </a>
                        <ul class="sub">
                            <li><a href="<?php echo app_path?>create_user.php" <?php echo $displayCreate; ?>>Create an Account</a></li>
                            <li><a href="<?php echo app_path?>create_client.php">Create Client Data</a></li>
                            <li class="divider">__________________</li>
                            <li><a href="<?php echo app_path?>list_account.php">View Accounts List</a></li>
                            <li><a href="<?php echo app_path?>list_client.php">View Clients List</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu dcjq-parent-li" >
                        <a class="dcjq-parent" href="javascript:;" >
                            <i class="fa fa-cogs"></i>
                            <span>Legal Billing</span>
                        </a>
                        <ul class="sub">                      
                            <li><a href="application_billing.php">Legal Billing Application</a></li>
                            <li><a href="list_reimbursement.php">View Reimbursement Applications</a></li>
                            <li><a href="list_servicefee.php">View Service Fee Applications</a></li>
                            <li class="divider">__________________</li>
                            <li><a href="account_billing.php">My Billing Records</a></li>
                            <li><a href="account_reimbursement.php">My Reimbursement Applications</a></li>
                            <li><a href="account_servicefee.php">My Service Fee Applications</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu dcjq-parent-li">
                        <a class="dcjq-parent" href="javascript:;" >
                            <i class="fa fa-th"></i>
                            <span>Payroll</span>
                        </a>
                        <ul class="sub">
                            <li><a href="account_payroll.php">My Payroll</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu dcjq-parent-li">
                        <a href="javascript:;" >
                            <i class="fa fa-book"></i>
                            <span>Projects</span>
                        </a>
                        <ul class="sub">
                            <li><a href="<?php echo app_path?>create_project.php">Cases</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu dcjq-parent-li" <?php echo $displayAttendance; ?>>
                        <a href="attendance.php">
                            <i class="fa fa-book"></i>
                            <span>Attendance</span>
                        </a>
                    </li>
                    <li class="sub-menu">
                        <a href="javascript:;" ><i class="fa fa-cogs"></i><span>Requests</span></a>
                        <ul class="sub">
                            <li><a href="requestleave.php">Leave Application</a></li>
                            <li><a href="requestto_admin.php">Leave Requests</a></li>
                            <li class="divider">__________________</li>
                            <li><a href="list_requestleave.php">Your Requests</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- sidebar menu end-->
            </div>
        </aside>
    </section>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery-1.8.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/jquery.sparkline.js"></script>

    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="assets/js/sparkline-chart.js"></script>    
    <script src="assets/js/zabuto_calendar.js"></script>

    <?php echo $_SERVER['DOCUMENT_ROOT'];?>
</body>
</html>

<?php

//echo $_SESSION['profile_picture'];
//echo $_SESSION['company_name']
//session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Ruemerc | SMS Gateway</title>
  
  <link rel="icon" type="image/ico" href="../images/favicon.ico"/>
 <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- fullCalendar 2.2.5-->
  <link rel="stylesheet" href="../assets/plugins/fullcalendar/fullcalendar.min.css">
  <link rel="stylesheet" href="../assets/plugins/fullcalendar/fullcalendar.print.css" media="print">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../assets/plugins/iCheck/flat/blue.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  
  <!-- crude -->
  <link rel="stylesheet" type="text/css" href="assests/datatables/datatables.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
  
  <!-- [endif]-->
 <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>  -->
<!-- data tables  //cdn.datatables.net/plug-ins/1.10.13/api/fnReloadAjax.js -->

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">


<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.13/api/fnReloadAjax.js"></script>


<!-- Datatables -->
	

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b><?php echo ucfirst(substr($_SESSION['company_name'],0,1)); ?></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">  
       <b> 
     <?php echo ucfirst($_SESSION['company_name']); ?>
   </b>
   </span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        
        <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger"></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Quick Links</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                
                
                
                
                
                <!--  start manipulating quick link -->
                
          
        
         <!--  this is super admin content -->
       <?php if (strcmp($_SESSION['category'],"Super_Administrator") === 0){ ?> 
                
                 <li><!-- Task item -->
                    <a href=".?action=company_management" >
                      <h3>
                        Company Management
                        <small class="pull-right"></small>
                      </h3>
                      
                    </a>
                  </li>
                  <li><!-- Task item -->
                    <a href=".?action=users" >
                      <h3>
                        Company Administrators
                        <small class="pull-right"></small>
                      </h3>
                      
                    </a>
                  </li>
                   
                  
                  
                   <?php }?>
                   
                   
                    
         <!--  this is  admin content -->
       <?php if (strcmp($_SESSION['category'],"Administrator") === 0){ ?> 
                
                 <li><!-- Task item -->
                    <a href=".?action=send_group_message" >
                      <h3>
                        Group message
                        <small class="pull-right"></small>
                      </h3>
                      
                    </a>
                  </li>
                  <li><!-- Task item -->
                    <a href=".?action=individual_message" >
                      <h3>
                        Individual message
                        <small class="pull-right"></small>
                      </h3>
                      
                    </a>
                  </li>
                   <li><!-- Task item -->
                    <a href=".?action=contact_management" >
                      <h3>
                        Contacts
                        <small class="pull-right"></small>
                      </h3>
                      
                    </a>
                  </li>
                  <li><!-- Task item -->
                    <a href=".?action=create_group">
                      <h3>
                        Create Group
                        <small class="pull-right"></small>
                      </h3>
                      
                    </a>
                  </li>
                  
                  
                   <?php }?>
                
                
                          
         <!--  this is Secretary content -->
       <?php if (strcmp($_SESSION['category'],"Secretary") === 0){ ?> 
                
                 
                  <li><!-- Task item -->
                    <a href=".?action=individual_message" >
                      <h3>
                        Individual message
                        <small class="pull-right"></small>
                      </h3>
                      
                    </a>
                  </li>
                  
                  <li><!-- Task item -->
                    <a href=".?action=send_group_message">
                      <h3>
                        Send Group SMS
                        <small class="pull-right"></small>
                      </h3>
                      
                    </a>
                  </li>
                  
                   <li><!-- Task item -->
                    <a href=".?action=all_messages">
                      <h3>
                        All Messages
                        <small class="pull-right"></small>
                      </h3>
                      
                    </a>
                  </li>
                  
                  
                   <li><!-- Task item -->
                    <a href=".?action=all_scheduled_messages">
                      <h3>
                        Scheduled Messages
                        <small class="pull-right"></small>
                      </h3>
                      
                    </a>
                  </li>
                  
                   <?php }?>
                
          
                
                 <!--  <li>
                    <a href="../../smsgateway/" target="_blank">
                      <h3>
                        Visit Site
                        <small class="pull-right"></small>
                      </h3>
                      
                    </a>
                  </li> -->
                 
                  
                  
                  
                  
                  
                  
                 <!--  End of manipurating quick link -->
                 
                 
                 
                  
                  </ul>
                  </li>
                  </ul>
                  </li>
                  
          
          
          
          
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../<?php echo $_SESSION['profile_picture'];?>" height="20px" width="20px" class="img-circle" alt="<?php echo $_SESSION['username'];?> image">
              <span class="hidden-xs"><?php $username= $_SESSION['username']; echo ucfirst($username);?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../<?php echo $_SESSION['profile_picture'];?>" height="20px" width="20px" class="img-circle" alt="<?php echo $_SESSION['username'];?> image">

                <p>
                  <?php $username= $_SESSION['username']; echo ucfirst($username);?> - <?php $category= $_SESSION['category']; echo ucfirst($category);?>
                  <!--  <small>Member since Nov. 2012</small> -->
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
               <!--<div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div> -->
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href=".?action=profile" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href=".?action=logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
                        <!--         <div class="pull-right">
                  <a href="../message_sender/post_async_sms_individual.php?p_1=%2B254717925741&p_2=%2B254715949519&message=kjbhuj&group_size=2" class="btn btn-default btn-flat">t</a>
                </div> -->
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button 
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../<?php echo $_SESSION['profile_picture'];?>" height="20px" width="20px" class="img-circle" alt="<?php echo $_SESSION['username'];?> image">
        </div>
        <div class="pull-left info">
          <p><?php $username= $_SESSION['username']; echo ucfirst($username);?></p>
          
        </div>
      </div>
      <!-- search form 
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>-->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href=".?action=dashboard">
            <i class="fa fa-th"></i> <span>Dashboard</span>
            
          </a>
        </li>    
        
           
        <!--  start manipulating main navigation -->
        
         <!--  this is super admin content -->
       <?php if (strcmp($_SESSION['category'],"Super_Administrator") === 0){ ?> 
        
          
           <li class="treeview">
          <a href="#">
            <i class="fa fa-plus"></i>
            <span>Companies</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          
            <li><a href=".?action=company_management"><i class="fa fa-plus text-aqua"></i> Create Company</a></li>            
                     
          </ul>
        </li>
          
          
          
          
          
          
          
          
      <!--     
        <li class="treeview">
          <a href="#">
            <i class="fa fa-address-book"></i>
            <span>Contacts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          
            <li><a href=".?action=contact_management"><i class="fa fa-address-book-o text-aqua"></i> manage contacts</a></li>            
                     
          </ul>
        </li> -->
       
        <!-- 
        <li class="treeview">
          <a href="#">
            <i class="fa fa-envelope"></i>
            <span>Messages</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          
            <li><a href=".?action=individual_message"><i class="fa fa-paper-plane text-aqua"></i> SMS To Individuals</a></li>            
                     
          </ul>
          <ul class="treeview-menu">
          
            <li><a href=".?action=send_group_message"><i class="fa fa-paper-plane text-aqua"></i> SMS To Groups</a></li>            
                     
          </ul>
          
           <ul class="treeview-menu">
          
            <li><a href=".?action=all_messages"><i class="fa fa-envelope-open-o text-aqua"></i> All Messages</a></li>            
                     
          </ul>
        
        </li> -->
        
        <!-- 
         <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Groups</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          
            <li><a href=".?action=create_group"><i class="fa fa-address-card text-aqua"></i> Create group</a></li>            
                     
          </ul>
          
         
        </li>
         -->
        
         <li class="treeview">
          <a href="#">
           <i class="fa fa-user-plus"></i> 
       
          
            <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          
            <li><a href=".?action=users"><i class="fa fa-eye text-aqua"></i> Company Admin</a></li>            
                     
          </ul>
          
        </li>
        
        
        
        
        <?php }?>
        
        
        
        <!--  this is company admin content -->
       <?php if (strcmp($_SESSION['category'],"Administrator") === 0){ ?> 
        
          
        <li class="treeview">
          <a href="#">
            <i class="fa fa-address-book"></i>
            <span>Contacts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          
            <li><a href=".?action=contact_management"><i class="fa fa-address-book-o text-aqua"></i> manage contacts</a></li>            
                     
          </ul>
        </li>
       
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-envelope"></i>
            <span>Messages</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          
            <li><a href=".?action=individual_message"><i class="fa fa-paper-plane text-aqua"></i> SMS To Individuals</a></li>            
                     
          </ul>
          <ul class="treeview-menu">
          
            <li><a href=".?action=send_group_message"><i class="fa fa-paper-plane text-aqua"></i> SMS To Groups</a></li>            
                     
          </ul>
          
           <ul class="treeview-menu">
          
            <li><a href=".?action=all_messages"><i class="fa fa-envelope-open-o text-aqua"></i>Messages Outbox</a></li>            
                     
          </ul>
        
        </li>
        
          <li class="treeview">
          <a href="#">
            <i class="fa fa-tasks"></i>
            <span>Schedule SMS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          
            <li><a href=".?action=send_individual_sms_later"><i class="fa fa-paper-plane text-aqua"></i> SMS To Individuals</a></li>            
                     
          </ul>
          <ul class="treeview-menu">
          
            <li><a href=".?action=send_group_message_later"><i class="fa fa-paper-plane text-aqua"></i> SMS To Groups</a></li>            
                     
          </ul>
          
           <ul class="treeview-menu">
          
            <li><a href=".?action=all_scheduled_messages"><i class="fa fa-envelope-open-o text-aqua"></i> All Scheduled SMS</a></li>            
                     
          </ul>
        
        </li>
        
        
        
         <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Groups</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          
            <li><a href=".?action=create_group"><i class="fa fa-address-card text-aqua"></i> Create group</a></li>            
                     
          </ul>
          
         
        </li>
        
        
         <li class="treeview">
          <a href="#">
           <i class="fa fa-user-plus"></i> 
       
          
            <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          
            <li><a href=".?action=users"><i class="fa fa-eye text-aqua"></i> All Users</a></li>            
                     
          </ul>
          
        </li>
        
        
        
        
        <?php }?>
        
        
        
        <!--  this is secretary content -->
       <?php if (strcmp($_SESSION['category'],"Secretary") === 0){ ?> 
        
        
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-envelope"></i>
            <span>Messages</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          
            <li><a href=".?action=individual_message"><i class="fa fa-paper-plane text-aqua"></i> SMS To Individuals</a></li>            
                     
          </ul>
          <ul class="treeview-menu">
          
            <li><a href=".?action=send_group_message"><i class="fa fa-paper-plane text-aqua"></i> SMS To Groups</a></li>            
                     
          </ul>
          
           <ul class="treeview-menu">
          
            <li><a href=".?action=all_messages"><i class="fa fa-envelope-open-o text-aqua"></i>Messages Outbox</a></li>            
                     
          </ul>
        
        </li>
        
        
          <li class="treeview">
          <a href="#">
            <i class="fa fa-tasks"></i>
            <span>Schedule SMS</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          
            <li><a href=".?action=send_individual_sms_later"><i class="fa fa-paper-plane text-aqua"></i> SMS To Individuals</a></li>            
                     
          </ul>
          <ul class="treeview-menu">
          
            <li><a href=".?action=send_group_message_later"><i class="fa fa-paper-plane text-aqua"></i> SMS To Groups</a></li>            
                     
          </ul>
          
           <ul class="treeview-menu">
          
            <li><a href=".?action=all_scheduled_messages"><i class="fa fa-envelope-open-o text-aqua"></i> All Scheduled SMS</a></li>            
                     
          </ul>
        
        </li>
        
        
        
        
        <?php }?>
        
        
        
        
          <!--  End of manipulating main navigation -->
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  
  
  
  
  
  
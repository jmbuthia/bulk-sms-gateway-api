<?php 
require_once('../model/database/database.php');
require_once('../model/database/DbOperations.php');
$company_name=$_SESSION['company_name'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>CRUD SYSTEM</title>

	<!-- bootstrap css -->
	<link rel="stylesheet" type="text/css" href="assests/bootstrap/css/bootstrap.min.css">
	<!-- datatables css -->
	<link rel="stylesheet" type="text/css" href="assests/datatables/datatables.min.css">

</head>
<body>

	<div class="container-fluid">
		
		<!-- Small boxes (Stat box) -->
      <div class="row">
      <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
            <?php
            $dbOperation= new DbOperation();
            $total_users=$dbOperation->getTotalUser($company_name);
            echo "<h3>".$total_users."</h3>"
            ?>
             

              <p>Total Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href=".?action=users" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        
          <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
            <?php
            $dbOperation= new DbOperation();
            $total_users=$dbOperation->getTotalActiveUser($company_name);
            echo "<h3>".$total_users."</h3>"
            ?>
             

              <p>Active Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href=".?action=users" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
            <?php
            $dbOperation= new DbOperation();
            $total_users=$dbOperation->getTotalInactiveUser($company_name);
            echo "<h3>".$total_users."</h3>"
            ?>
             

              <p>Inactive Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href=".?action=users" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        
           <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
            <?php
            $dbOperation= new DbOperation();
            $total_users=$dbOperation->getTotalMessages($company_name);
            echo "<h3>".$total_users."</h3>"
            ?>
             

              <p>Total Outbox</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href=".?action=all_messages" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        
         <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
            <?php
            $dbOperation= new DbOperation();
            $total_users=$dbOperation->getTotalAddressBook($company_name);
            echo "<h3>".$total_users."</h3>"
            ?>
             

              <p>Total Contacts</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href=".?action=contact_management" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        
            <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
            <?php
            $dbOperation= new DbOperation();
            $total_users=$dbOperation->getTotalActiveContacts($company_name);
            echo "<h3>".$total_users."</h3>"
            ?>
             

              <p>Total Active Contacts</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href=".?action=contact_management" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        
           <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
            <?php
            $dbOperation= new DbOperation();
            $total_users=$dbOperation->getTotalInactiveContacts($company_name);
            echo "<h3>".$total_users."</h3>"
            ?>
             

              <p>Total Inactive Contacts</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href=".?action=contact_management" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
            <?php
            $dbOperation= new DbOperation();
            $total_users=$dbOperation->getTotalMessagesToGroups($company_name);
            echo "<h3>".$total_users."</h3>"
            ?>
             

              <p>Total Group Messages</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href=".?action=all_messages" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
            <?php
            $dbOperation= new DbOperation();
            $total_users=$dbOperation->getTotalGroups($company_name);
            echo "<h3>".$total_users."</h3>"
            ?>
             

              <p>Total Groups</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
            <a href=".?action=create_group" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
            <?php
            $dbOperation= new DbOperation();
            $total_users=$dbOperation->getTotalActiveGroups($company_name);
            echo "<h3>".$total_users."</h3>"
            ?>
             

              <p>Active Groups</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
            <a href=".?action=create_group" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
            <?php
            $dbOperation= new DbOperation();
            $total_users=$dbOperation->getTotalInactiveGroups($company_name);
            echo "<h3>".$total_users."</h3>"
            ?>
             

              <p>Inactive Groups</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
            <a href=".?action=create_group" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        
        
        <!-- 
        <div class="col-lg-3 col-xs-6">
     
          <div class="small-box bg-aqua">
            <div class="inner">
             -->
            
            <?php
            //$dbOperation= new DbOperation();
            //$total_users=$dbOperation->getTotalMessagesToIndividual($company_name);
            //echo "<h3>".$total_users."</h3>"
            ?>
             

             <!--  <p>Total Individual Messages</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href=".?action=all_messages" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div> -->
        <!-- ./col -->
       
       
       
       
       
       
          <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
            <?php
            $dbOperation= new DbOperation();
            $total_users=$dbOperation->getTotalScheduledMessages($company_name);
            echo "<h3>".$total_users."</h3>"
            ?>
             

              <p>Total Scheduled Messages</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-alarm"></i>
            </div>
            <a href=".?action=all_scheduled_messages" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
       
      </div>
          <!-- /.row -->
		
       
       
       
       
       
       
       
       
      </div>
          <!-- /.row -->
		
		
		
		
		
	</div>



	
	 
	   <script type="text/javascript" src="assests/jquery/jquery.min.js"></script> 
	  
	<!-- bootstrap js -->
<script type="text/javascript" src="assests/bootstrap/js/bootstrap.min.js"></script> 
	<!-- datatables js -->
	<!-- datatables js -->
	<script type="text/javascript" src="assests/datatables/datatables.min.js"></script>
	<!-- include custom index.js -->
	<script type="text/javascript" src="custom/js/index.js"></script>

</body>
</html>
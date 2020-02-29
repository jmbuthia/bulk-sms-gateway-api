<?php 
require_once('../model/database/database.php');
require_once('../model/database/DbOperations.php');
$company_name=$_SESSION['company_name'];
$username=$_SESSION['username'];
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
      
           <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
            <?php
            $dbOperation= new DbOperation();
            $total_users=$dbOperation->getTotalSecretaryMessages($company_name,$username);
            echo "<h3>".$total_users."</h3>"
            ?>
             

              <p>Total Messages</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href=".?action=all_messages" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        
         
        
          
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
            <?php
            $dbOperation= new DbOperation();
            $total_users=$dbOperation->getTotalSecretaryMessagesToGroups($company_name,$username);
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
        
        
       
        
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
            <?php
            $dbOperation= new DbOperation();
            $total_users=$dbOperation->getTotalSecretaryMessagesToIndividual($company_name,$username);
            echo "<h3>".$total_users."</h3>"
            ?>
             

              <p>Total Individual Messages</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href=".?action=all_messages" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        
        
          <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
            <?php
            $dbOperation= new DbOperation();
            $total_users=$dbOperation->getTotalScheduledMessagesByUser($company_name,$username);
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
<?php 
require_once('../model/database/database.php');
require_once('../model/database/DbOperations.php');
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
            $total_users=$dbOperation->getTotalCompanies();
            echo "<h3>".$total_users."</h3>"
            ?>
             

              <p>Total Companies</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href=".?action=company_management" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        
          <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
            <?php
            $dbOperation= new DbOperation();
            $total_users=$dbOperation->getTotalActiveCompanies();
            echo "<h3>".$total_users."</h3>"
            ?>
             

              <p>Active Companies</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href=".?action=company_management" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
            <?php
            $dbOperation= new DbOperation();
            $total_users=$dbOperation->getTotalInactiveCompanies();
            echo "<h3>".$total_users."</h3>"
            ?>
             

              <p>Inactive Companies</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href=".?action=company_management" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        
          
        
      </div>
          <!-- /.row -->
		
	      
      <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
            <?php
            $dbOperation= new DbOperation();
            $total_users=$dbOperation->getTotalAdmin();
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
        
          <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
            <?php
            $dbOperation= new DbOperation();
            $total_users=$dbOperation->getTotalActiveAdmin();
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
        
        <div class="col-lg-4 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
            <?php
            $dbOperation= new DbOperation();
            $total_users=$dbOperation->getTotalInactiveAdmin();
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
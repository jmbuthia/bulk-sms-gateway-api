<?php

//include '../controllers/session.php';







?>
<?php include '../includes/navigation.php';?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   <!--  <section class="content-header">
      <h1>
        Dashboard
        <small>Home Page</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section> -->

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      
      
      <?php 
                    //error messages   
/*					
                               if(empty($salutation)==true){
                               
                               }else{
                               echo " <div class=\"alert alert-success alert-dismissible\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">X</button>
                <h4><i class=\"icon fa fa-check\"></i> Alert!</h4>
                ".$salutation.".
              </div>";
                               
                               $_SESSION['serverFeedback']="";
                               }
                               */
                               ?>
      
      
      <div class="row">
      <!-- content here -->
	  
	  
	  <?php 

//include '../selectize/examples/send_group_sms_content.php';
include 'send_group_sms_content.php';
?>
      </div>
      <!-- /.row -->

      

      <!-- Main row -->
      <div class="row">
       
       
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include '../includes/footer.php'?>


  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
    <script src="../assets/plugins/jQuery/jquery-2.2.3.min.js"></script>   
  
<!-- Bootstrap 3.3.6 --> 
<!-- <script src="../assets/bootstrap/js/bootstrap.min.js"></script>  -->
<!-- FastClick -->
<script src="../assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/app.min.js"></script>
<!-- Sparkline -->
<script src="../assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="../assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="../assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="../assets/plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../assets/dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../assets/dist/js/demo.js"></script>
 
<!--   <script type="text/javascript" src="assests/bootstrap/js/bootstrap.min.js"></script> -->
  <!-- <script type="text/javascript" src="assests/jquery/jquery.min.js"></script>   -->
	   <script type="text/javascript" src="custom/js/member.js"></script>
<script type="text/javascript" src="assests/datatables/datatables.min.js"></script>
<link rel="stylesheet" type="text/css" href="assests/sol/sol.css">
	<script type="text/javascript" src="assests/sol/sol.js"></script>
</body>
</html>

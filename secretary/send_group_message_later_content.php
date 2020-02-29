<?php

require_once('../model/database/database.php');
require_once('../model/database/DbOperations.php');

$company_name=$_SESSION['company_name'];
$dbOperations=new DbOperation();
$groups=$dbOperations->getAllActiveGroups($company_name);

?>
<!DOCTYPE html>
<html>
<head>
	<title>CRUD SYSTEM</title>

	<!-- bootstrap css -->
	
	<script type="text/javascript" src="assests/jquery/jquery.min.js"></script> 
	<link rel="stylesheet" type="text/css" href="assests/sol/sol.css">
	<script type="text/javascript" src="assests/sol/sol.js"></script>
	
	
	<link rel="stylesheet" type="text/css" href="../date/jquery.datetimepicker.css"/>
	</head>
<body>
	
	
	
	    <div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
			
		<div id="wrapper">
			<div align="center">
			<h1>Compose Message.</h1>
			<?php 
			if  (!empty($errorMessage)) 
				{ 
					echo "<font color=\"$status_color\">".htmlspecialchars($errorMessage)."</font>";
				}
				?>
				</div> 
			<form action=".?action=send_group_sms_later" method="post">
			<div class="demo">
				<!-- <h2>Dynamic Options</h2>
				<p>The options are created straight from an array.</p> -->
				
			<div class="control-group">
					<label for="my-select">Groups:</label>
	  <select id="my-select" placeholder="Pick groups..." name="groupid[]" multiple="multiple" required>
   	<?php foreach ($groups as $group) : ?>
			      	 <?php 
 			      
			      	 echo ' <option value="'.$group['groupid'].'">'.$group['group_name'].'</option>';
		      	
		      	 ?>
			      	
                     
            <?php endforeach; ?>   
</select>

<script type="text/javascript">
    $(function() {
        // initialize sol
        $('#my-select').searchableOptionList();
    });
</script>
</div>
				
				<div class="form-group">
 
					<label for=" message">Message:</label>
 
					<textarea placeholder="Type message here..." id="message" class="form-control" rows="5" required name="message"></textarea>
 
				</div>
				
					<div class="form-group">
 
					<label for="time">Send At:</label>
 
					<input type="text" placeholder="format yyyy-mm-dd hh:mm:ss" id="time" class="form-control"  required name="time"></input>
 
				</div>
			
			
			
			
			<script src="../date/jquery.datetimepicker.full.js"></script>
<script type="text/javascript">

$('#time').datetimepicker({
    format:'Y-m-d H:i:s',
    minDate:'2017-05-05',
    maxDate:'2018-05-05'
});
</script>		
		
			
			</div>
			<input type="submit" value="Send" class="btn btn-lg btn-success">
				</form>
			
		</div>

	</div>
	</div>
	</div>
	
<script type="text/javascript" src="assests/bootstrap/js/bootstrap.min.js"></script> 


</body>
</html>

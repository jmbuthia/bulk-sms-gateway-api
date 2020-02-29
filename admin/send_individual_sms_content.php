<?php

require_once('../model/database/database.php');
require_once('../model/database/DbOperations.php');

$company_name=$_SESSION['company_name'];
$dbOperations=new DbOperation();
$contacts=$dbOperations->getAllActiveContacts($company_name);


?>
<!DOCTYPE html>
<html>
<head>
	<title>CRUD SYSTEM</title>

	<!-- bootstrap css -->
	
	<script type="text/javascript" src="assests/jquery/jquery.min.js"></script> 
	<link rel="stylesheet" type="text/css" href="assests/sol/sol.css">
	<script type="text/javascript" src="assests/sol/sol.js"></script>
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
			<form action=".?action=send_individual_sms" method="post">
			<div class="demo">
				<!-- <h2>Dynamic Options</h2>
				<p>The options are created straight from an array.</p> -->
				
			<div class="control-group">
					<label for="my-select">Contacts:</label>	
	  <select id="my-select" placeholder="Pick contacts..." name="phone[]" multiple="multiple" required>
   	<?php foreach ($contacts as $members) : ?>
			      	 <?php 
 			      
 			      		echo ' <option value="'.$members['phone'].'">'. $members['first_name'].' '.$members['last_name'].' '.$members['phone'].'</option>';
		      	
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

<?php

require_once('../model/database/database.php');
require_once('../model/database/DbOperations.php');


$dbOperations=new DbOperation();
$contacts=$dbOperations->getAllActiveContacts();

?>

<?php 
$contact_list_string="";
foreach ($contacts as $contact) : ?>
	
			      	 <?php $contact_list_string.="{phone: '{$contact['phone']}' ,name: '{$contact['first_name']} {$contact['last_name']} {$contact['phone']}'},";
 			      	   	
 			      
		      	 ?>
			      	
                     
            <?php endforeach; ?>
            <?php $contact_list_string=rtrim($contact_list_string,',');
           // echo $contact_list_string;
            ?>


<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js"><!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<!-- <title>Selectize.js Demo</title>
		<meta name="description" content=""> -->
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
		<!-- <link rel="stylesheet" href="../selectize/examples/css/normalize.css">
		<link rel="stylesheet" href="../selectize/examples/css/stylesheet.css"> -->
		<link rel="stylesheet" type="text/css" href="assests/bootstrap/css/bootstrap.min.css">
		<!--[if IE 8]><script src="js/es5.js"></script><![endif]-->
		<script src="../selectize/examples/js/jquery.min.js"></script>
		<script src="../selectize/dist/js/standalone/selectize.js"></script>
		<script src="../selectize/examples/js/sms.js"></script>
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
					<label for="select-tools">Contacts:</label>
					<select multiple="multiple" id="select-tools" placeholder="Pick contacts..." name="phone[]" required></select>
				</div>
				<div class="form-group">
 
					<label for=" message">Message:</label>
 
					<textarea placeholder="Type message here..." id="message" class="form-control" rows="5" required name="message"></textarea>
 
				</div>
				
				<script>
				// <select id="select-tools"></select>

				$('#select-tools').selectize({
					maxItems: null,
					valueField: 'phone',
					labelField: 'name',
					
					options: [
						<?php echo $contact_list_string;?>
							],
					create: false
				});
				</script>
			</div>
			<input type="submit" value="Send" class="btn btn-lg btn-success">
				</form>
			
		</div>

	</div></div></div>
		 <script type="text/javascript" src="assests/jquery/jquery.min.js"></script> 
	  
	<!-- bootstrap js -->
<script type="text/javascript" src="assests/bootstrap/js/bootstrap.min.js"></script> 
	</body>
</html>

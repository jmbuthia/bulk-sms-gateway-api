<?php

require_once('../../model/database/database.php');
require_once('../../model/database/DbOperations.php'); 


$dbOperations=new DbOperation();
$groups=$dbOperations->getAllActiveGroups();

$v="{id: 1, title: 'Spectrometer'},
						{id: 2, title: 'Star Chart'},
						{id: 3, title: 'Electrical Tape', url: 'http://en.wikipedia.org/wiki/Electrical_tape'},
						{id: 4, title: 'Electrical Tape', url: 'http://en.wikipedia.org/wiki/Electrical_tape'},
						{id: 5, title: 'Electrical Tape', url: 'http://en.wikipedia.org/wiki/Electrical_tape'},
						{id: 6, title: 'Electrical Tape', url: 'http://en.wikipedia.org/wiki/Electrical_tape'},
						{id: 7, title: 'Spectrometer', url: 'http://en.wikipedia.org/wiki/Spectrometers'},
						{id: 8, title: 'Star Chart', url: 'http://en.wikipedia.org/wiki/Star_chart'},
						{id: 9, title: 'Electrical Tape', url: 'http://en.wikipedia.org/wiki/Electrical_tape'},
						{id: 10, title: 'Electrical Tape', url: 'http://en.wikipedia.org/wiki/Electrical_tape'},
						{id: 11, title: 'Electrical Tape', url: 'http://en.wikipedia.org/wiki/Electrical_tape'},
						{id: 12, title: 'Electrical Tape', url: 'http://en.wikipedia.org/wiki/Electrical_tape'},
						{id: 13, title: 'Spectrometer', url: 'http://en.wikipedia.org/wiki/Spectrometers'},
						{id: 23, title: 'Star Chart', url: 'http://en.wikipedia.org/wiki/Star_chart'},
						{id: 24, title: 'Electrical Tape', url: 'http://en.wikipedia.org/wiki/Electrical_tape'},
						{id: 14, title: 'Electrical Tape', url: 'http://en.wikipedia.org/wiki/Electrical_tape'},
						{id: 15, title: 'Electrical Tape', url: 'http://en.wikipedia.org/wiki/Electrical_tape'},
						{id: 16, title: 'Electrical Tape', url: 'http://en.wikipedia.org/wiki/Electrical_tape'},
						{id: 17, title: 'Spectrometer', url: 'http://en.wikipedia.org/wiki/Spectrometers'},
						{id: 18, title: 'Star Chart', url: 'http://en.wikipedia.org/wiki/Star_chart'},
						{id: 19, title: 'Electrical Tape', url: 'http://en.wikipedia.org/wiki/Electrical_tape'},
						{id: 20, title: 'Electrical Tape', url: 'http://en.wikipedia.org/wiki/Electrical_tape'},
						{id: 21, title: 'Electrical Tape', url: 'http://en.wikipedia.org/wiki/Electrical_tape'},
						{id: 22, title: 'Electrical Tape', url: 'http://en.wikipedia.org/wiki/Electrical_tape'}
				";
$v1="{id: 1, group_name: 'Spectrometer'},
{id: 2, group_name: 'Star Chart'}";

?>

<?php 
$group_list_string="";
foreach ($groups as $group) : ?>
	
			      	 <?php $group_list_string.="{id: {$group['groupid']} ,group_name: '{$group['group_name']}'},";
 			      	   	
 			      
		      	 ?>
			      	
                     
            <?php endforeach; ?>
            <?php $group_list_string=rtrim($group_list_string,',');
            //echo $group_list_string;
            ?>


<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js"><!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Selectize.js Demo</title>
		<meta name="description" content="kkk">
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
		<link rel="stylesheet" href="css/normalize.css">
		<link rel="stylesheet" href="css/stylesheet.css">
		<!--[if IE 8]><script src="js/es5.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="../dist/js/standalone/selectize.js"></script>
		<script src="js/index.js"></script>
	</head>
    <body>
		<div id="wrapper">
			<h1>Selectize.js</h1>
			<form action="#" method="get">
			<div class="demo">
				<h2>Dynamic Options</h2>
				<p>The options are created straight from an array.</p>
				
				<div class="control-group">
					<label for="select-tools">Tools:</label>
					<select id="select-tools" placeholder="Pick groups..." name="groupid"></select>
				</div>
				
				<script>
				// <select id="select-tools"></select>

				$('#select-tools').selectize({
					maxItems: null,
					valueField: 'id',
					labelField: 'group_name',
					
					options: [
						<?php echo $group_list_string;?>
							],
					create: false
				});
				</script>
			</div>
			<input type="submit" value="submit" class="btn btn-sm">
				</form>
			
		</div>
	</body>
</html>

<!DOCTYPE html>
<html>
<head>
	<title>CRUD SYSTEM</title>

	<link rel="stylesheet" type="text/css" href="assests/bootstrap/css/bootstrap.min.css">
	
	<link rel="stylesheet" type="text/css" href="assests/datatables/datatables.min.css">
<style >
.table-responsive
{
    overflow-x: auto;
}
.table-responsive td, .table-responsive th 
{ 
white-space:nowrap; 
}
</style>
</head>
<body>

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
<div align="center">
<h1> <?php echo 'All contacts sent message: Message ID '.$_SESSION['messageid'];?>  </h1>
</div>
				

				<div class="removeMessages"></div>

				
<div class="table-responsive">
				<table class="table table-striped" id="manageMemberTable">					
					<thead>
						<tr>
							<th>Contact Id</th>
							<th>First Name</th>
							
							<th>Last Name</th>
							<th>Phone</th>
							<th>Time Sent</th>								
							
							<th>Option</th>
						</tr>
					</thead>
				</table>
				</div>
			</div>
		</div>
	</div>

	<!-- remove modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span> Delete  Member From Message List</h4>
	      </div>
	      <div class="modal-body">
	        <p>Do you really want to Delete ?</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary" id="removeBtn">Save changes</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<!-- /remove modal -->

	
	 
	   <script type="text/javascript" src="assests/jquery/jquery.min.js"></script> 
	  
	
<script type="text/javascript" src="assests/bootstrap/js/bootstrap.min.js"></script> 

	<script type="text/javascript" src="assests/datatables/datatables.min.js"></script>
	
	<script type="text/javascript" src="custom/js/message_member.js"></script>

</body>
</html>
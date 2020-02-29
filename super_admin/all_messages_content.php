<!DOCTYPE html>
<html>
<head>
	<title>CRUD SYSTEM</title>

	<!-- bootstrap css -->
	<link rel="stylesheet" type="text/css" href="assests/bootstrap/css/bootstrap.min.css">
	<!-- datatables css -->
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
<div align="center"> <h1 >All Composed Messages </h1> </div>
				 

				<div class="removeMessages"></div>

 <div class="table-responsive">
				<table class="table table-striped" id="manageMemberTable">					
					<thead>
						<tr>
							<th>Message Id</th>
							<th>Message</th>
							<!-- <th>Middle Name</th> -->
							<th>Time Created</th>
							<!-- <th>Phone</th>								
							<th>Active</th> -->
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
	        <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span> Delete Message</h4>
	      </div>
	      <div class="modal-body">
	        <p>Do you really want to delete ?</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary" id="removeBtn">Save changes</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<!-- /remove modal -->

	<!-- edit modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="editMemberModal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><span class="glyphicon glyphicon-edit"></span> Edit Contact</h4>
	      </div>

		<form class="form-horizontal" action="php_action/update.php" method="POST" id="updateMemberForm">	      

	      <div class="modal-body">
	        	
	        <div class="edit-messages"></div>

			  <div class="form-group"> <!--/here teh addclass has-error will appear -->
			    <label for="editName" class="col-sm-3 control-label">First Name</label>
			    <div class="col-sm-9"> 
			      <input type="text" class="form-control" id="editName" name="editFirstName" placeholder="First Name">
				<!-- here the text will apper  -->
			    </div>
			  </div>
			  <!-- <div class="form-group">
			    <label for="editMiddleName" class="col-sm-3 control-label">Middle Name</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" id="editMiddleName" name="editMiddleName" placeholder="Middle Name">
			    </div>
			  </div> -->
			  <div class="form-group">
			    <label for="editAddress" class="col-sm-3 control-label">Last Name</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" id="editAddress" name="editLastName" placeholder="Last Name">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="editContact" class="col-sm-3 control-label">Phone</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" id="editContact" name="editContact" placeholder="Phone">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="editActive" class="col-sm-3 control-label">Active</label>
			    <div class="col-sm-9">
			      <select class="form-control" name="editActive" id="editActive">
			      	<option value="">~~SELECT~~</option>
			      	<option value="1">Activate</option>
			      	<option value="2">Deactivate</option>
			      </select>
			    </div>
			  </div>	
	      </div>
	      <div class="modal-footer editMemberModal">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save changes</button>
	      </div>
	      </form>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<!-- /edit modal -->

	<!-- jquery plugin -->
	
	 
	   <script type="text/javascript" src="assests/jquery/jquery.min.js"></script> 
	  
	<!-- bootstrap js -->
<script type="text/javascript" src="assests/bootstrap/js/bootstrap.min.js"></script> 
	<!-- datatables js -->
	<!-- datatables js -->
	<script type="text/javascript" src="assests/datatables/datatables.min.js"></script>
	<!-- include custom index.js -->
	<script type="text/javascript" src="custom/js/messages.js"></script>

</body>
</html>
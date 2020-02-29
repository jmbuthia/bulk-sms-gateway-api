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

				<!-- <center><h1 class="page-header">ADMIN CONTACT <small>Management</small> </h1> </center> -->

				<div class="removeMessages"></div>

				<button class="btn btn-default pull pull-right" data-toggle="modal" data-target="#addMember" id="addMemberModalBtn">
					<span class="glyphicon glyphicon-plus-sign"></span>	Add Company
				</button>

				<br /> <br /> <br />
					
				
				
			 <div class="table-responsive">
				<table class="table table-striped" id="manageMemberTable">					
					<thead>
						<tr >
							<th>Company Id</th>
							<th>Company Name</th>
							<!-- <th>Middle Name</th> -->
							<th>Api Username</th>
							<th>Api Key</th>								
							<th>Active</th>
							<th>Option</th>
						</tr>
					</thead>
				</table>
</div> 	
				

			</div>
		</div>
	</div>

	<!-- add modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="addMember">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span>	Add Company</h4>
	      </div>
	      
	      <form class="form-horizontal" action="php_action/create.php" method="POST" id="createMemberForm">

	      <div class="modal-body">
	      	<div class="messages"></div>

			  <div class="form-group"> <!--/here teh addclass has-error will appear -->
			    <label for="name" class="col-sm-3 control-label">Company Name</label>
			    <div class="col-sm-9"> 
			      <input type="text" class="form-control" id="name" name="firstname" placeholder="Company Name">
				<!-- here the text will apper  -->
			    </div>
			  </div>
			
			  <div class="form-group"> <!--/here teh addclass has-error will appear -->
			    <label for="address" class="col-sm-3 control-label">Api Username</label>
			    <div class="col-sm-9"> 
			      <input type="text" class="form-control" id="address" name="lastname" placeholder="Api Username">
				<!-- here the text will apper  -->
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="contact" class="col-sm-3 control-label">Api Key</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" id="contact" name="phone" placeholder="Api Key">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="active" class="col-sm-3 control-label">Active</label>
			    <div class="col-sm-9">
			      <select class="form-control" name="active" id="active">
			      	<option value="">~~SELECT~~</option>
			      	<option value="1">Activate</option>
			      	<option value="2">Deactivate</option>
			      </select>
			    </div>
			  </div>			 		

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save changes</button>
	      </div>
	      </form> 
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<!-- /add modal -->

	<!-- remove modal -->
	<div class="modal fade" tabindex="-1" role="dialog" id="removeMemberModal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span> Remove Company</h4>
	      </div>
	      <div class="modal-body">
	        <p>Do you really want to remove ?</p>
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
	        <h4 class="modal-title"><span class="glyphicon glyphicon-edit"></span> Edit Company</h4>
	      </div>

		<form class="form-horizontal" action="php_action/update.php" method="POST" id="updateMemberForm">	      

	      <div class="modal-body">
	        	
	        <div class="edit-messages"></div>

			  <div class="form-group"> <!--/here teh addclass has-error will appear -->
			    <label for="editName" class="col-sm-3 control-label">Company Name</label>
			    <div class="col-sm-9"> 
			      <input type="text" class="form-control" id="editName" name="editFirstName" placeholder="Company Name">
				<!-- here the text will apper  -->
			    </div>
			  </div>
			 
			  <div class="form-group">
			    <label for="editAddress" class="col-sm-3 control-label">Api Username</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" id="editAddress" name="editLastName" placeholder="Api Username">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="editContact" class="col-sm-3 control-label">Api Key</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" id="editContact" name="editContact" placeholder="Api Key">
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
	<script type="text/javascript" src="custom/js/index.js"></script>

</body>
</html>
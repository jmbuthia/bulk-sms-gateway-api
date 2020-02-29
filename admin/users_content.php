<?php // session_start();?>
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
					<span class="glyphicon glyphicon-plus-sign"></span>	Add User
				</button>

				<br /> <br /> <br />
<div class="table-responsive">
				<table class="table table-striped" id="manageMemberTable">					
					<thead>
						<tr>
							<th>User Name</th>
							<th>First Name</th>
							<!-- <th>Middle Name</th> -->
							<th>Last Name</th>
							<th>Phone</th>	
							<th>Gender</th>
							<th>Date Created</th>							
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
	        <h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span>	Add User</h4>
	      </div>
	      
	      <form class="form-horizontal" action="php_action/create_user.php" method="POST" id="createMemberForm">

	      <div class="modal-body">
	      	<div class="messages"></div>

			  <div class="form-group"> <!--/here teh addclass has-error will appear -->
			    <label for="name" class="col-sm-3 control-label">First Name</label>
			    <div class="col-sm-9"> 
			      <input type="text" class="form-control" id="name" name="firstname" placeholder="First Name">
				<!-- here the text will apper  -->
			    </div>
			  </div>
			<!--   <div class="form-group">
			    <label for="name" class="col-sm-3 control-label">Middle Name</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" id="name" name="middlename" placeholder="Middle Name">
			    </div>
			  </div> -->
			  <div class="form-group"> <!--/here teh addclass has-error will appear -->
			    <label for="address" class="col-sm-3 control-label">Last Name</label>
			    <div class="col-sm-9"> 
			      <input type="text" class="form-control" id="address" name="lastname" placeholder="Last Name">
				<!-- here the text will apper  -->
			    </div>
			  </div>
			  
			  <div class="form-group"> <!--/here teh addclass has-error will appear -->
			    <label for="username" class="col-sm-3 control-label">Username</label>
			    <div class="col-sm-9"> 
			      <input type="text" class="form-control" id="username" name="username" placeholder="Username">
				<!-- here the text will apper  -->
			    </div>
			  </div>
			  
			  <div class="form-group">
			    <label for="contact" class="col-sm-3 control-label">Phone Number</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" id="contact" name="phone" placeholder="Phone Number">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="gender" class="col-sm-3 control-label">Gender</label>
			    <div class="col-sm-9">
			      <select class="form-control" name="gender" id="gender">
			      	<option value="">~~SELECT~~</option>
			      	<option value="Male">Male</option>
			      	<option value="Female">Female</option>
			      </select>
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
	        <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span> Remove User</h4>
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
	        <h4 class="modal-title"><span class="glyphicon glyphicon-edit"></span> Edit Contact</h4>
	      </div>

		<form class="form-horizontal" action="php_action/update_user.php" method="POST" id="updateMemberForm">	      

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
			    <label for="editGender" class="col-sm-3 control-label">Gender</label>
			    <div class="col-sm-9">
			      <select class="form-control" name="editGender" id="editGender">
			      	<option value="">~~SELECT~~</option>
			      	<option value="Male">Male</option>
			      	<option value="Female">Female</option>
			      </select>
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
	<script type="text/javascript" src="custom/js/users.js"></script>

</body>
</html>
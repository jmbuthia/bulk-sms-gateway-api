<!DOCTYPE html>
<html>
<head>
	<title>CRUD SYSTEM</title>

	<!-- bootstrap css -->
	<link rel="stylesheet" type="text/css" href="assests/bootstrap/css/bootstrap.min.css">
	<!-- datatables css -->
	<link rel="stylesheet" type="text/css" href="assests/datatables/datatables.min.css">
	
	<script type="text/javascript" src="assests/jquery/jquery.min.js"></script> 
	<link rel="stylesheet" type="text/css" href="assests/sol/sol.css">
	<script type="text/javascript" src="assests/sol/sol.js"></script>
	
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
  <?php 
//include 'testselect.html';
?>


	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
<div align="center"><h1 > <?php echo ucwords($_SESSION['groupname'].' members');?> <small></small> </h1> </div>
				<!-- <center><h1 class="page-header">ADMIN CONTACT <small>Management</small> </h1> </center> -->

				<div class="removeMessages"></div>

				<button class="btn btn-default pull pull-right" data-toggle="modal" data-target="#addMember" id="addMemberModalBtn">
					<span class="glyphicon glyphicon-plus-sign"></span>	Add Member
				</button>

				<br /> <br /> <br />
<div class="table-responsive">
				<table class="table table-striped" id="manageMemberTable">					
					<thead>
						<tr>
							<th>Contact Id</th>
							<th>First Name</th>
							<!-- <th>Middle Name</th> -->
							<th>Last Name</th>
							<th>Phone</th>
							<th>datejoined</th>								
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
	        <h4 class="modal-title"><span class="glyphicon glyphicon-plus-sign"></span>	Add Member</h4>
	      </div>
	      
	      <form class="form-horizontal" action="php_action/add_member.php" method="POST" id="createMemberForm">

	      <div class="modal-body">
	      	<div class="messages"></div>

			  
			     <div class="form-group">
			    <label for="contactid" class="col-sm-3 control-label"> New Member</label>
			    <div class="col-sm-9">
			    <div id="page-wrapper">
 			    <select id="contactid" name="contactid[]"  multiple="multiple">
     <?php foreach ($_SESSION['members']as $members) : ?>
			      	 <?php 
 			      	$actv=$members['active'];
			      	
 			      	if($actv==1){
 			      		echo ' <option value="'.$members['contactid'].'">'. $members['first_name'].' '.$members['last_name'].' '.$members['phone'].'</option>';
		      	}
		      	 ?>
			      	
                     
            <?php endforeach; ?>
            
              
</select>

<script type="text/javascript">
    $(function() {
        // initialize sol
        $('#contactid').searchableOptionList();
    });
</script>


	
	
			    </div>
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
	        <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span> Remove Member From Group</h4>
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
	        <h4 class="modal-title"><span class="glyphicon glyphicon-edit"></span> Edit Member</h4>
	      </div>

		<form class="form-horizontal" action="php_action/update_member.php" method="POST" id="updateMemberForm">	      

	      <div class="modal-body">
	        	
	        <div class="edit-messages"></div>


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
	<script type="text/javascript" src="custom/js/member.js"></script>
	
	

</body>
</html>
<?php 

	/*EDIT THE ITEMS HERE IN PHP AREA.  HTML IS STANDARD. */
	
	$modal_title = "create new record";
	$modal_button_title = "create record";
	$__CREATE_GENERATEFILE = "GEN_TABLEREAD_CREATE_MODALBODY.php";
	include 'secure/connectstring.php';
	
?>

	<div class = "container centerdiv">
		<div class = "row">
			<BR>
			<button type="button" class="btn btn-success" id="button_call_add_modal" data-toggle="modal" data-target="#modalcreatenew"><span class="glyphicon glyphicon-plus"></span>  |  add new user record </button>
			<BR><BR><BR>
		</div>
	</div>
				
	<!-- Modal Creation -->
	<div class="modal fade in" id="modalcreatenew" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h5 class="modal-title" id="myModalLabel"><?php echo $modal_title ?></h5>
				</div>
						
				<div class="modal-body">
					<?php include $__CREATE_GENERATEFILE ?>							
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
					<button type="button" class="btn btn-success" id="button_create"><?php echo $modal_button_title ?></button>
				</div>
						
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

<?php 

	/*FULLY EDIT THIS FILE TO FORMAT THE INPUT FORM */
	
?>

	<form class="form-horizontal" role="form">
		<div class="form-group">
			<label for="inputname" class="col-sm-3 control-label">User Name</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="inputname" placeholder="Name" autofocus>
			</div>
		</div>
							  
		<div class="form-group">
			<label for="inputstatus" class="col-sm-3 control-label">Status</label>
			<div class="col-sm-9">
				<select class="form-control" id="inputstatus">
					<?php
						/*SOURCING FOR STATUS*/
						$querystatus = "select * from tb_type_status";
						$resultstatus = mysql_query($querystatus) or die (mysql_error());
							
							if (mysql_num_rows($resultstatus) > 0)

							{
								while($rowstatus = mysql_fetch_object($resultstatus))
									{
										echo "<option value='" . $rowstatus->status . "'>" . $rowstatus->status . "</option>";
									}
							}
					?>


				</select>									
			</div>
		</div>
		
		<div class="form-group">
			<label for="inputrole" class="col-sm-3 control-label">Access Type</label>
			<div class="col-sm-9">
				<select class="form-control" id="inputrole">
					<?php
						include 'secure/connectstring.php';

						/*SOURCING FOR ACCESS TYPES */	
						$queryrole = "select * from tb_type_access ORDER BY role_type";
						$resultrole = mysql_query($queryrole) or die (mysql_error());
							
							if (mysql_num_rows($resultrole) > 0)

							{
								while($rowrole = mysql_fetch_object($resultrole))
									{
										echo "<option value='" . $rowrole->role_type . "'>" . $rowrole->role_description . "</option>";
									}
							}						
					?>
				
				</select>									
			</div>
		</div>
									
								
	</form>						

<?php ?>
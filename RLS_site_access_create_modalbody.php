<?php 

	/*FULLY EDIT THIS FILE TO FORMAT THE INPUT FORM */
	
?>

	<form class="form-horizontal" role="form">
		<div class="form-group">
			<label for="inputuseremail" class="col-sm-3 control-label">Email</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="inputuseremail" placeholder="E-mail" autofocus>
			</div>
		</div>

		<div class="form-group">
			<label for="inputuserlastname" class="col-sm-3 control-label">Last Name</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="inputuserlastname" placeholder="Last Name">
			</div>
		</div>

		<div class="form-group">
			<label for="inputuserfirstname" class="col-sm-3 control-label">First Name</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="inputuserfirstname" placeholder="First Name">
			</div>
		</div>
		
		<div class="form-group">
			<label for="inputuseraccesstype" class="col-sm-3 control-label">Access Type</label>
			<div class="col-sm-9">
				<select class="form-control" id="inputuseraccesstype">
					<?php
						/*SOURCING FOR LEVEL*/
						$querylevel = "select * from tb_config_listing WHERE category = 'user_access_type'";
						$resultlevel = mysql_query($querylevel) or die (mysql_error());
							
							if (mysql_num_rows($resultlevel) > 0)

							{
								while($rowlevel = mysql_fetch_object($resultlevel))
									{
										echo "<option value='" . $rowlevel->option . "'>" . $rowlevel->option . "</option>";
									}
							}
					?>
				</select>									
			</div>
		</div>
											
		<div class="form-group">
			<label for="inputuserstatus" class="col-sm-3 control-label">Status</label>
			<div class="col-sm-9">
				<select class="form-control" id="inputuserstatus">
					<?php
						/*SOURCING FOR STATUS*/
						$querystatus = "select * from tb_config_listing WHERE category = 'user_status'";
						$resultstatus = mysql_query($querystatus) or die (mysql_error());
							
							if (mysql_num_rows($resultstatus) > 0)

							{
								while($rowstatus = mysql_fetch_object($resultstatus))
									{
										echo "<option value='" . $rowstatus->option . "'>" . $rowstatus->option . "</option>";
									}
							}
					?>
				</select>									
			</div>
		</div>

		<div class="form-group">
			<label for="inputuserarea" class="col-sm-3 control-label">Area</label>
			<div class="col-sm-9">
				<select class="form-control" id="inputuserarea">
					<?php
						/*SOURCING FOR AREA*/
							/*SOURCING FOR AREA*/
						$queryarea = "Select * FROM tb_config_listing WHERE category = 'user_area'";
						$resultarea = mysql_query($queryarea) or die (mysql_error());
							if (mysql_num_rows($resultarea) > 0)
							{
								while($rowarea = mysql_fetch_object($resultarea))
									{
										echo "<option value='" . $rowarea->option . "'>" . $rowarea->option . "</option>";
										//echo $rowarea->option;
									}
							}
					?>
				</select>									
			</div>
		</div>
		
	</form>						

<?php ?>
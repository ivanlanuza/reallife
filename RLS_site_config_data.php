<?php 

	while ($row = mysql_fetch_object($result))
		{
?>
	
	<DIV class = "container">
		<DIV class="row">
			<div class="col-md-6 col-md-offset-3">
			<TABLE class = 'table table-striped'>
				<TR>
					<TD>
						Spend Year: 
					</TD>
					<TD>
						<a href='#' data-emptytext='---' class = 'a_editable' id='conf_spend_year' data-type='text' data-pk='' data-url='RLS_site_config_process.php' data-title='update spending year'>								
							<?php echo $row->conf_spend_year ?></a>							
					</TD>
				</TR>
				<TR>
					<TD>
						College Allowance: 
					</TD>
					<TD>
						Php <a href='#' data-emptytext='---' class = 'a_editable' id='conf_coll_allow' data-type='text' data-pk='' data-url='RLS_site_config_process.php' data-title='update allowance of college scholars'>								
							<?php echo $row->conf_coll_allow?></a>
						&nbsp; every &nbsp;
						<a href='#' data-emptytext='---' class = 'a_editable' id='conf_coll_freq' data-type='text' data-pk='' data-url='RLS_site_config_process.php' data-title='update frequency of allowance release'>								
							<?php echo $row->conf_coll_freq?></a>
						&nbsp;days
					</TD>
				</TR>
				<TR>
					<TD>
						High School Allowance: 
					</TD>
					<TD>
						Php <a href='#' data-emptytext='---' class = 'a_editable' id='conf_hs_allow' data-type='text' data-pk='' data-url='RLS_site_config_process.php' data-title='update allowance of highschool scholars'>								
							<?php echo $row->conf_hs_allow ?></a>							
						&nbsp; every &nbsp;
						<a href='#' data-emptytext='---' class = 'a_editable' id='conf_hs_freq' data-type='text' data-pk='' data-url='RLS_site_config_process.php' data-title='update frequency of allowance release'>								
							<?php echo $row->conf_hs_freq?></a>
						&nbsp;days
					</TD>
				</TR>
				<TR>
					<TD>
						Vocational School Allowance: 
					</TD>
					<TD>
						Php <a href='#' data-emptytext='---' class = 'a_editable' id='conf_voc_allow' data-type='text' data-pk='' data-url='RLS_site_config_process.php' data-title='update allowance of vocational scholars'>								
							<?php echo $row->conf_voc_allow ?></a>							
						&nbsp; every &nbsp;
						<a href='#' data-emptytext='---' class = 'a_editable' id='conf_voc_freq' data-type='text' data-pk='' data-url='RLS_site_config_process.php' data-title='update frequency of allowance release'>								
							<?php echo $row->conf_voc_freq?></a>
						&nbsp;days
					</TD>
				</TR>
				<TR>
					<TD>
						College Maximum Spend per Spend Year: 
					</TD>
					<TD>
						Php <a href='#' data-emptytext='---' class = 'a_editable' id='conf_coll_max_spend' data-type='text' data-pk='' data-url='RLS_site_config_process.php' data-title='update maximum allowable spend for a year'>								
							<?php echo $row->conf_coll_max_spend ?></a>
				</TR>		
				<TR>
					<TD>
						High School Maximum Spend per Spend Year: 
					</TD>
					<TD>
						Php <a href='#' data-emptytext='---' class = 'a_editable' id='conf_hs_max_spend' data-type='text' data-pk='' data-url='RLS_site_config_process.php' data-title='update maximum allowable spend for a year'>								
							<?php echo $row->conf_hs_max_spend ?></a>
				</TR>		
				<TR>
					<TD>
						Vocational School Maximum Spend per Spend Year: 
					</TD>
					<TD>
						Php <a href='#' data-emptytext='---' class = 'a_editable' id='conf_voc_max_spend' data-type='text' data-pk='' data-url='RLS_site_config_process.php' data-title='update maximum allowable spend for a year'>								
							<?php echo $row->conf_voc_max_spend ?></a>
				</TR>		
				<TR>
					<TD>
						Area Coordinator Allowance: 
					</TD>
					<TD>
						Php <a href='#' data-emptytext='---' class = 'a_editable' id='conf_ac_allow' data-type='text' data-pk='' data-url='RLS_site_config_process.php' data-title='update AC allowance'>								
							<?php echo $row->conf_ac_allow ?></a>
				</TR>		
				<TR>
					<TD>
						College Weeks this School Year: 
					</TD>
					<TD>
						Php <a href='#' data-emptytext='---' class = 'a_editable' id='conf_coll_weeks' data-type='text' data-pk='' data-url='RLS_site_config_process.php' data-title='update school year weeks'>								
							<?php echo $row->conf_coll_weeks ?></a>
				</TR>		
				<TR>
					<TD>
						High School Weeks this School Year: 
					</TD>
					<TD>
						Php <a href='#' data-emptytext='---' class = 'a_editable' id='conf_hs_weeks' data-type='text' data-pk='' data-url='RLS_site_config_process.php' data-title='update school year weeks'>								
							<?php echo $row->conf_hs_weeks ?></a>
				</TR>		
				<TR>
					<TD>
						Vocational Weeks this School Year: 
					</TD>
					<TD>
						Php <a href='#' data-emptytext='---' class = 'a_editable' id='conf_voc_weeks' data-type='text' data-pk='' data-url='RLS_site_config_process.php' data-title='update school year weeks'>								
							<?php echo $row->conf_voc_weeks ?></a>
				</TR>		
			</TABLE>
			</div>
		</div>
	</div>
	
<?php 
	}
?>
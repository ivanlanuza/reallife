<?php include 'secure/passcheck.php'; ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

    <HEAD>
		<?php include 'GEN_func_header.php'; ?>
	</HEAD>
	
    <BODY>
		<?php include 'GEN_func_header_bar_RLS.php'; ?>

		<div class="pagetitle">
			submit finance request
		</div>
		
		<div class="container">
			<form id="frmMain" name="frmMain" action="RLS_request_finance_process.php" method="post" class="form-inline" role="form">
					<div class='row centerdiv'>
						<div class="form-group">
							<label class="column_name" for="fromdate">From Approval Date: </label>
							<input type="date" class="form-control date_width" name="fromdate" value="<?php echo date('Y-m-d'); ?>">
						</div>
						<div class="form-group">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<label class="column_name" for="exampleInputPassword2">To: </label>
							<input type="date" class="form-control date_width" name="todate" value="<?php echo date('Y-m-d'); ?>">
						</div>
					</div>
					
					
					<!--
					<div class='row centerdiv'>
						<BR><BR>
						<div class="checkbox">
							<span class="column_name bold_text">
								Select Inclusions: 
							</span>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<label>
								<input type="checkbox" value="X" checked name="collbox">
								College Allowance
							</label>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<label>
								<input type="checkbox" value="X" checked name="hsbox">
								HighSchool Allowance
							</label>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<label>
								<input type="checkbox" value="X" checked  name="vocbox">
								Vocational Allowance
							</label>
						</div>
						
					</div>
					-->
					<BR><BR><BR>
					<div class='row centerdiv'>
						<button id="btnProcessAll" type="submit" class="btn btn-success">
							Generate File
						</button>
						<ul id="ulError" class="smallital">
						</ul>
						
						<input type=hidden id="hdnvaluepass" name="hdnvaluepass"></input>	    					    			
					</div>						
			</form>
		</div><!-- /.container -->
	
		<?php include 'GEN_func_footer.php'; ?>
	</BODY>
</html>

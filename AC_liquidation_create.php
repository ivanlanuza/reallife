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
		<?php include 'GEN_func_header_bar.php'; ?>

						<!-- ********************************MAIN BODY CONTENT HERE********************************	-->

		<div class="container">
			<div class="pagetitle">
				liquidate my expenses
			</div>
			
			<div class='row' id='maincontentrequest'>
				<form id="frmMain" name="frmMain" action="AC_liquidation_create_process.php" method="post">
					<br /><br />
					<div id="divSource" align = center>
						<table id="tblAppendGrid">
						</table>
					</div>
					<br />
						
					<div class='row centerdiv'>
						<button id="btnSubmit" type="submit" class="btn btn-success">
							Submit liquidation
						</button>
						<ul id="ulError" class="smallital">
						</ul>
						
						<input type=hidden id="hdnvaluepass" name="hdnvaluepass"></input>	    					    			
					</div>		
				</form>
			</div>
		</div><!-- /.container -->
	

	    <!-- PHP DATA GENERATOR -->

	    	<?php
	    		include 'secure/connectstring.php';

	    		$queryPurpose = "SELECT * FROM tb_config_listing where category = 'liquidation_purpose'";
				$resultPurpose = mysql_query($queryPurpose) or die(mysql_error());
				$comma = "";
				$options_Purpose = "0: '{choose purpose}',";
				while ($rowPurpose = mysql_fetch_object($resultPurpose))
					{
						$options_Purpose = $options_Purpose . $comma . $rowPurpose->id . ": '" . $rowPurpose->option . "'";						
						$comma = ", ";
					}												
			?>	

		<!-- JAVA SCRIPTS-->
		    <script id="jsSource" type="text/javascript">
					
			
				$(function () {
		        	// Initialize appendGrid
		        	$('#tblAppendGrid').appendGrid({
		            	initRows: 1,
		            	columns: [
		                	    { name: 'Purpose', display: 'Purpose', type: 'select', ctrlOptions: { <?php echo $options_Purpose;?>}, ctrlCss: { width: '220px', height: '32px', 'font-family': 'Tahoma', 'font-size': '14'}, displayCss: { 'font-family': 'Tahoma', 'font-size': '11' }, ctrlClass: 'valpurpose' },
		                    	{ name: 'Amount', display: 'Amount', type: 'text', ctrlAttr: { maxlength: 10 }, ctrlCss: { width: '100px', height: '32px', 'font-family': 'Tahoma', 'font-size': '14', 'text-align': 'right' }, displayCss: { 'font-family': 'Tahoma', 'font-size': '11' }, ctrlClass: 'valamount' },
		                    	{ name: 'Expense Date', display: 'Expense Date', type: 'ui-datepicker', ctrlAttr: { maxlength: 10 }, uiOption: { dateFormat: 'yy/mm/dd'}, ctrlCss: { width: '140px', height: '32px', 'font-family': 'Tahoma', 'font-size': '14', 'text-align': 'right' }, displayCss: { 'font-family': 'Tahoma', 'font-size': '11' }, ctrlClass: 'valexpdate' },
		                    	{ name: 'Description', display: 'Description', type: 'text', ctrlAttr: { maxlength: 250 }, ctrlCss: { width: '280px', height: '32px', 'font-family': 'Tahoma', 'font-size': '14', 'text-align': 'right' }, displayCss: { 'font-family': 'Tahoma', 'font-size': '11' }, ctrlClass: 'valdescription' },
		                    	{ name: 'RecordId', type: 'hidden', value: 0 }
		                	],
								hideButtons: {
									append: true,
									moveUp: true,
									moveDown: true,
									removeLast: true,
									remove: false,
									insert: false
								},
								customGridButtons: {
									insert: { icons: { primary: 'ui-icon-plus' }, text: false, label: 'Insert!' }
								}						
		        	});
		    		    
				 	$('#btnSubmit').button();
	        			// Add validation of amount
		     			$.validator.addClassRules('valamount', 
		     				{
	            				required: true,
	            				number: true,
	            				min: 1
	        				}, 'Amount Field cannot be blank.');

						// Add validation of date
		     			$.validator.addClassRules('valexpdate', 
		     				{
	            				required: true
	        				}, 'Amount Field cannot be blank.');
	        				
				        // Add validation of Purpose
				        $.validator.addMethod('valpurpose', function (value, element) {
				            return value != 0 ;
				        }, 'Purpose Field cannot be blank.');

	        			$(document.forms[0]).validate
	        				({
	            				errorLabelContainer: '#ulError',
	            				wrapper: 'li',
	            				submitHandler: function () 
	            					{
					        			document.getElementById('hdnvaluepass').value = $(document.forms[0]).serialize();
					        			document.frmMain.submit();
										$('#btnSubmit').attr("disabled", true);
					        		}
	        				});
				});
			</script>						
	
				<!-- ********************************END OF MAIN BODY CONTENT HERE********************************	-->
	
		<?php include 'GEN_func_footer.php'; ?>
	</BODY>
</html>

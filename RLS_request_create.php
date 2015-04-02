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

						<!-- ********************************MAIN BODY CONTENT HERE********************************	-->

		<div class="container">
			<div class="pagetitle">
				create new request
			</div>
			
			<div class='row' id='maincontentrequest'>
				<form id="frmMain" name="frmMain" action="RLS_request_create_process.php" method="post">
					<br /><br />
					<div id="divSource" align = center>
						<table id="tblAppendGrid">
						</table>
					</div>
					<br />
						
					<div class='row centerdiv'>
						<button id="btnSubmit" type="submit" class="btn btn-success">
							Submit Request
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
	    		$currarea = $_SESSION['user_area'];		
	    		$queryScholars = "SELECT scholar_id,scholar_first_name, scholar_last_name FROM tb_scholar_info WHERE scholar_status != 'EXPELLED' AND scholar_status != 'GRADUATED' ORDER BY scholar_last_name, scholar_first_name";
				$resultScholars = mysql_query($queryScholars) or die(mysql_error());
				$comma = "";
				$options_scholar = "0: '{choose scholar}',";
				while ($rowScholars = mysql_fetch_object($resultScholars))
					{
						$options_scholar = $options_scholar . $comma . $rowScholars->scholar_id . ": '" . $rowScholars->scholar_last_name . ", " . $rowScholars->scholar_first_name . "'";						
						$comma = ", ";
						
					}
				
					
				$queryCategory = "SELECT * FROM tb_config_listing_request_category";
				$resultCategory = mysql_query($queryCategory) or die(mysql_error());
				$comma = "";
				$options_category = "0: '{choose category}',";
				while ($rowCategory = mysql_fetch_object($resultCategory))
					{
						$options_category = $options_category . $comma . $rowCategory->id . ": '" . $rowCategory->category . "'";
						$comma = ", ";
						
					}

				$queryDetails = "SELECT * FROM tb_config_listing WHERE category = 'request_type'";
				$resultDetails = mysql_query($queryDetails) or die(mysql_error());
				$comma = "";
				$options_details = "0: '{choose details}',";
				while ($rowDetails = mysql_fetch_object($resultDetails))
					{
						$options_details = $options_details . $comma . $rowDetails->id . ": '" . $rowDetails->option . "'";
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
		                	    { name: 'Scholar', display: 'SCHOLAR NAME', type: 'select', ctrlOptions: { <?php echo $options_scholar;?>}, ctrlCss: { width: '220px', height: '32px', 'font-family': 'Tahoma', 'font-size': '14'}, displayCss: { 'font-family': 'Tahoma', 'font-size': '11' }, ctrlClass: 'valscholar' },
		                    	{ name: 'Category', display: 'CATEGORY', type: 'select', ctrlOptions: { <?php echo $options_category;?>}, ctrlCss: { width: '160px', height: '32px', 'font-family': 'Tahoma', 'font-size': '14'}, displayCss: { 'font-family': 'Tahoma', 'font-size': '11' }, ctrlClass: 'valcategory',
		                    	 	onChange: function (evt, rowIndex) 
		                    	 		{
                 				   			var changerow = rowIndex;
							                //check if the category is allowance or tuition
											var value = $('#tblAppendGrid').appendGrid('getCtrlValue', 'Category', changerow);
							                if (value == 1)
							                	{
									                //update the details to allowance or tuition
									                $('#tblAppendGrid').appendGrid('setCtrlValue', 'Details', changerow, value);
								            	}   
								            else
								            	{
									            	//update the details to choose entry
									            	$('#tblAppendGrid').appendGrid('setCtrlValue', 'Details', changerow, '0');
								            	}
                 				   			
                						}
		                    	},
		                    	{ name: 'Details', display: 'DETAILS', type: 'select', type: 'select', ctrlOptions: { <?php echo $options_details;?> }, ctrlCss: { width: '160px', height: '32px', 'font-family': 'Tahoma', 'font-size': '14'}, displayCss: { 'font-family': 'Tahoma', 'font-size': '11' }, ctrlClass: 'valdetails'},
		                    	{ name: 'Amount', display: 'AMOUNT', type: 'text', ctrlAttr: { maxlength: 10 }, ctrlCss: { width: '100px', height: '32px', 'text-align': 'right' }, displayCss: { 'font-family': 'Helvetica Neue', 'font-size': '14' }, ctrlClass: 'valprice' },
								{ name: 'Comments', display: 'COMMENTS', type: 'text', ctrlAttr: { maxlength: 380 }, ctrlCss: { width: '200px', height: '32px', 'text-align': 'left' }, displayCss: { 'font-family': 'Helvetica Neue', 'font-size': '14' } },
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
	        			// Add validation of price
		     			$.validator.addClassRules('valprice', 
		     				{
	            				required: true,
	            				number: true,
	            				min: 1
	        				}, 'Amount Field cannot be blank.');

				        // Add validation of category
				        $.validator.addMethod('valcategory', function (value, element) {
				            return value != 0 ;
				        }, 'Category Field cannot be blank.');

				        // Add validation of details
				        $.validator.addMethod('valdetails', function (value, element) {
				            	return value != 0 ;
				        }, 'Details Field cannot be blank.');

				        // Add validation of scholar
				        $.validator.addMethod('valscholar', function (value, element) {
				            return value != 0 ;
				        }, 'Scholar Field cannot be blank.');

	        			$(document.forms[0]).validate
	        				({
	            				errorLabelContainer: '#ulError',
	            				wrapper: 'li',
	            				submitHandler: function () 
	            					{
					        			document.getElementById('hdnvaluepass').value = $(document.forms[0]).serialize();
					        			document.frmMain.submit();
					        		}
	        				});
				});
			</script>						
	
				<!-- ********************************END OF MAIN BODY CONTENT HERE********************************	-->
	
		<?php include 'GEN_func_footer.php'; ?>
	</BODY>
</html>

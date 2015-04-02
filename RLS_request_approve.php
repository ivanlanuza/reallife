<?php include 'secure/passcheck.php'; ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

    <HEAD>
		<?php include 'GEN_func_header.php'; ?>
		
		<script type="text/javascript">	
			$(document).ready(function(){				
				
				//FUNCTION TO PROCESS ENTRIES
				$(document).on("click","#btnProcessAll",function(e){		
					e.preventDefault()

					//retrieve number of records to process	
					varRequestCount = $('#txt_request_count').val();
					//retrieve list of request IDs to process
					varRequestList = $('#txt_request_list').val();
					//convert the list into an array for processing
					var varRequestArray = varRequestList.split(':');
					
					//iterate through the array to generate data to be passed to server for processing
					var counter = 0;
					var myjsondata = '';
					var txtReason_name = '';
					var txtAmount_name = '';
					var var_request_id = '';
					var optChoice_name = '';
					/*var prevScholar = '';
					var currentScholar = '';
					var prevScholarCount = 1;
					var repeatScholarIndex = '';
					var approvedScholarCount = 0;
					*/
										
					while (counter < varRequestCount)
						{
							//determine the ids to get values from
							var_request_id = varRequestArray[counter];
							txtAmount_name = "txtAmount_" + varRequestArray[counter];	
							txtReason_name = "txtReason_" + varRequestArray[counter];	
							optChoice_name = "optAction_" + varRequestArray[counter];	
							hdnScholar_name = "hdnScholar_" + varRequestArray[counter];		
							
							//add request id into the output variable
							var myjsondata = myjsondata + "recId_" + counter + ":" + var_request_id + ":";
							
							//retrieve the value of the Scholar Field
							myjsondata = myjsondata + "recScholar_" + counter + ":" + document.getElementById(hdnScholar_name).value + ":";
														
							//retrieve the value of the radio buttons
							var mychoice = document.getElementsByName(optChoice_name);
							for(var i = 0; i < mychoice.length; i++) {
							   if(mychoice[i].checked == true) {
								   selectedoption = mychoice[i].value;
							   }
							 } 
							myjsondata = myjsondata + "recOption_" + counter + ":" + selectedoption + ":";

							//retrieve the value of the Approved Amount Field
							if (selectedoption == "approve")
								{
									integervalueamount = document.getElementById(txtAmount_name).value * 1;
									myjsondata = myjsondata + "recAmount_" + counter + ":" + integervalueamount + ":";
								}
							else
								{
									myjsondata = myjsondata + "recAmount_" + counter + ":" + 0 + ":";								
								}

							
							/*
							//check if current scholar is equal to previous one.  if yes, add one.  if no, write to repeatScholarIndex variable
							//check also for approved line #s
							currentScholar = document.getElementById(hdnScholar_name).value;	
							if (currentScholar == prevScholar)
								{
									prevScholarCount = prevScholarCount + 1;
									prevScholar = currentScholar;
									if (selectedoption == "approve")
										{
											approvedScholarCount = approvedScholarCount + 1;
										}
										
								}
							else
								{
									repeatScholarIndex = repeatScholarIndex + prevScholarCount + "_" + approvedScholarCount + ":";		
									prevScholarCount = 1;
									approvedScholarCount = 0;
									if (selectedoption == "approve")
										{
											approvedScholarCount = approvedScholarCount + 1;
										}									
									prevScholar = currentScholar;
								}
							*/
							
							
							//retrieve the value of the Rejection Reason
							myjsondata = myjsondata + "recReason_" + counter + ":" + document.getElementById(txtReason_name).value + "; ";
							
							//iterate thru the array
							counter = counter + 1;
							
						}
						/*
						myjsondata = "repeatIndex_" + repeatScholarIndex + prevScholarCount + "_" + approvedScholarCount+ ";" + myjsondata;
						*/
						myjsondata = "recCount_" + varRequestCount + ";" + myjsondata;
						$('#msg').val(myjsondata);
						
						
						$.ajax(
							{
								url : 'RLS_request_approve_process.php',
								data: {passdata:myjsondata},
								dataType : 'html',
								async: false,
								type : 'post',
								success : function(data){
									alert ("All selected records have been processed.  Thank you!");
									location.reload();
								}
								
							});
											
				});					
			});
		</script>

	</HEAD>
	
    <BODY>
		<?php include 'GEN_func_header_bar_RLS.php'; ?>

		<!-- ********************************MAIN BODY CONTENT HERE********************************	-->

		
		
		<div class="container">
			<div class="pagetitle">
				approve requests
			</div>
			
			
			<div class='row'>
						
						<?php
							include 'secure/connectstring.php';
						
							//retrieve the max per level
							$query_max = "select * from tb_config_general";						
							$result_max = mysql_query($query_max) or die(mysql_error());
							$row_max = mysql_fetch_object($result_max);
							$max_coll = $row_max->conf_coll_max_spend;
							$max_hs = $row_max->conf_hs_max_spend;
							$max_voc = $row_max->conf_voc_max_spend;

							//retrieve the forecasted allowance of students
							$allow_coll_year = $row_max->conf_coll_allow * ($row_max->conf_coll_weeks/($row_max->conf_coll_freq/7));
							$allow_hs_year = $row_max->conf_hs_allow * ($row_max->conf_hs_weeks/($row_max->conf_hs_freq/7));
							$allow_voc_year = $row_max->conf_voc_allow * ($row_max->conf_voc_weeks/($row_max->conf_voc_freq/7));

						
							//Input fields for request data for the final processing
							$list_of_requests = "";
							$count_of_requests = 0;
										
							$query_requests = "SELECT * FROM tb_request_info, tb_scholar_info, tb_config_listing_request_category, tb_config_listing_request_type 
												WHERE tb_request_info.req_scholar_id = tb_scholar_info.scholar_id
												AND tb_config_listing_request_category.id = tb_request_info.req_cat
												AND tb_request_info.req_type = tb_config_listing_request_type.id
												AND tb_request_info.req_status = 'OPEN'
												ORDER BY scholar_area, scholar_last_name, scholar_first_name, req_scholar_id";
							$result_requests = mysql_query($query_requests) or die(mysql_error());
							$countrows = mysql_num_rows($result_requests);
							//echo $countrows;
							if ($countrows > 0)
								{ 	?>
							
									<TABLE class = 'table table-striped'>
										<THEAD>
											<TR>
												<TD colspan='2' class='td_scholar_15'>
													<span class='column_name'>SCHOLAR DETAILS</span>
												</TD>
												<TD colspan='2' class='td_scholar_25'>
													<span class='column_name'>REQUEST DETAILS</span>
												</TD>
												<TD class='td_scholar_25'>
													<span class='column_name'>APPROVAL DETAILS</span>
												</TD>
												<TD class='td_scholar_15'>
													<span class='column_name'>AVAILABLE ACTIONS</span>
												</TD>
											</TR>
										</THEAD>
										<TBODY>
									<?php
								}
								
							while ($row_requests = mysql_fetch_object($result_requests))
								{
									?>
									<TR>
										<TD>
											<span class='note_text'>name: </span>
											<BR>
											<span class='note_text'>area: </span>
											<BR>
											<span class='note_text'>school level: </span>
											<BR>
											<span class='note_text'>warning level: </span>
											<BR>
											<span class='note_text'>spent to date: </span>
										</TD>
										<TD>
											<span class='bold_text'><?php echo $row_requests->scholar_last_name . ", " . $row_requests->scholar_first_name; ?></span>
											<?php
													echo 
														"<INPUT TYPE=hidden ID='hdnScholar_" . 
														$row_requests->req_id . "-" . $row_requests->req_item_id .
														"' class='form-control' VALUE=" . 
														$row_requests->req_scholar_id . 
														">";
											?>
											
											<BR>
											<span class='note_text'><?php echo $row_requests->scholar_area;?></span>
											<BR>
											<span class='note_text'><?php echo $row_requests->scholar_level;?></span>
											<BR>
											<span class='bold_text'>
												<?php
													if ($row_requests->scholar_level == 'COLLEGE')
														{
															$spend_to_date = $allow_coll_year + $row_requests->scholar_total_spend;
															$spend =  $spend_to_date + $row_requests->req_amount_requested;
															
															$ratio = $spend/$max_coll;
														}
													elseif ($row_requests->scholar_level == 'HIGH SCHOOL')
														{
															$spend_to_date = $allow_hs_year + $row_requests->scholar_total_spend;
															$spend = $spend_to_date + $row_requests->req_amount_requested;
															$ratio = $spend/$max_hs;														
														}
													else 
														{
															$spend_to_date = $allow_voc_year + $row_requests->scholar_total_spend;
															$spend = $spend_to_date + $row_requests->req_amount_requested;
															$ratio = $spend/$max_voc;														
														}
													
													if ($ratio < .8)
														{
															echo "<i class='fa fa-check-circle font_green'></i>";
															$level_mark = 'g'; 
														}
													elseif ($ratio >= .8 && $ratio < 1)
														{
															echo "<i class='fa fa-exclamation-circle font_yellow'></i>";
															$level_mark = 'y';
														}
													else
														{
															echo "<i class='fa fa-times-circle font_red'></i>";
															$level_mark = 'r';
														}
												?>
											</span>
											<BR>
											<span class='note_text'>Php <?php echo number_format($spend_to_date,2,'.',',');?></span>
											
										</TD>
										<TD>
											<span class='note_text'>request #: </span>
											<BR>
											<span class='note_text'>amount: </span>
											<BR>
											<span class='note_text'>category: </span>
											<BR>
											<span class='note_text'>details: </span>
											<BR>
											<span class='note_text'>description: </span>
											<BR>
											<span class='note_text'>attachment: </span>
										</TD>
										<TD>
											<span class='bold_text'><?php echo $row_requests->req_id . "-" . $row_requests->req_item_id ;?></span>
											<BR>
											<span class='note_text'>Php <?php echo $row_requests->req_amount_requested;?></span>
											<BR>
											<span class='note_text'><?php echo $row_requests->category;?></span>
											<BR>
											<span class='note_text'><?php echo $row_requests->type;?></span>
											<BR>
											<div class='note_text note_overflow'><?php echo $row_requests->req_description;?></div>
											
											<span class='note_text'>
											<?php 
												if ($row_requests->req_attachment == '')
													{
														echo "n/a";
													}
												else
													{
														$filename = "pic/attach_req/" . $row_requests->req_id . "-" . $row_requests->req_item_id . ".jpg"; 
														echo "<a href='" . $filename . "' target='_blank'>view attachment</a>";
													}
											?>
											</span>
										</TD>
										<TD>
											<div class='input_approve'>
												<span class='note_text'>enter approved amount: </span>
												<BR>
												<?php
													if ($level_mark == 'r')
														{
															$amount_approve_propose = 0;
														}
													else 
														{
															$amount_approve_propose = $row_requests->req_amount_requested;
														}

												
													echo 
														"<INPUT TYPE=text ID='txtAmount_" . 
														$row_requests->req_id . "-" . $row_requests->req_item_id .
														"' class='form-control input_text_width_60' VALUE=" . 
														$amount_approve_propose . 
														">";
												?>
											</div>
											<div class='input_reject'>
												<span class='note_text'>enter reason for rejection:</span>
												<BR>
												<?php
													echo 
														"<INPUT TYPE=TEXT ID='txtReason_" . 
														$row_requests->req_id . "-" . $row_requests->req_item_id .
														"' class='form-control input_text_width_60'>";
												?>
											</div>
										</TD>
										<TD>
											<?php
												$radio_name = "optAction_" . $row_requests->req_id . "-" . $row_requests->req_item_id;
											?>
											<div class="radio">
											  <label>
												<input type="radio" name="<?php echo $radio_name;?>" id="<?php echo $radio_name . "_a";?>" value="approve"
												<?php
													if ($level_mark != 'r')
														{
															echo "checked";
														}
												?>												
												>
												APPROVE
											  </label>
											</div>
											<div class="radio">
											  <label>
												<input type="radio" name="<?php echo $radio_name;?>" id="<?php echo $radio_name . "_r";?>" value="reject" 
												<?php
													if ($level_mark == 'r')
														{
															echo "checked";
														}
												?>
												>
												REJECT
											  </label>
											</div>
											<div class="radio">
											  <label>
												<input type="radio" name="<?php echo $radio_name;?>" id="<?php echo $radio_name . "_p";?>" value="processlater">
												PROCESS LATER
											  </label>
											</div>
										</TD>
									</TR>
										
									<?php	
										$list_of_requests = $list_of_requests . $row_requests->req_id . "-" . $row_requests->req_item_id . ":";
										$count_of_requests = $count_of_requests + 1;
								}	
								
						?>


						
					</TBODY>
				</TABLE>
			</div>
			
			<?php 
				echo "<input type = hidden id=txt_request_list value=" . $list_of_requests . ">"; 
				echo "<input type = hidden id=txt_request_count value=" . $count_of_requests . ">"; 
				echo "<input type = hidden  id = msg style='width:200px'>";
			?>

			
			<div class='row centerdiv'>
				<BR>
				<?php 
					if ($count_of_requests > 0 )
						{
							echo "<button id='btnProcessAll' type='submit' class='btn btn-success'>Process All</button>";
						}
					else
						{
							echo "No requests to approve. Have a nice day!";
						}
				?>
			</div>
			
			
		</div>
	
				<!-- ********************************END OF MAIN BODY CONTENT HERE********************************	-->
	
		<?php include 'GEN_func_footer.php'; ?>
	</BODY>
</html>

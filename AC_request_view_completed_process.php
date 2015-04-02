<?php session_start(); include "secure/connectstring.php";?>

	
	<DIV id="requesttabcontent" class="tab-content">
		<DIV class="tab-pane fade in" id="open">
			<BR>
			
			<table class = 'table table-hover table-condensed '>
				<THEAD>
					<TR>
						<TD class = 'td_scholar_10 column_name'>
							REQUEST DATE
						</TD>						
						<TD class = 'td_scholar_5 column_name'>
							ID #
						</TD>
						<TD class = 'td_scholar_15 column_name'>
							SCHOLAR
						</TD>
						<TD class = 'td_scholar_10 column_name'>
							CATEGORY
						</TD>
						<TD class = 'td_scholar_20 column_name'>
							DETAILS
						</TD>
						<TD class = 'td_scholar_5 column_name'>
							AMOUNT REQUESTED
						</TD>
						<TD class = 'td_scholar_20 column_name'>
							AMOUNT APPROVED
						</TD>
						<TD class = 'td_scholar_15 column_name'>
							AVAILABLE ACTIONS
						</TD>
						
						
					</TR>
				</THEAD>
				<TBODY>
					<?php
						include 'secure/connectstring.php';
						$curr_user_id = $_SESSION['user_id'];

						$query_open = "Select * FROM tb_request_info, tb_scholar_info, tb_config_listing, tb_config_listing_request_category WHERE tb_request_info.req_cat = tb_config_listing_request_category.id AND tb_request_info.req_type = tb_config_listing.id AND (tb_config_listing.category = 'request_type') AND tb_scholar_info.scholar_id = tb_request_info.req_scholar_id AND req_status = 'COMPLETED' AND req_ac_id = $curr_user_id ORDER BY req_id DESC, req_item_id DESC";
						$result_open = mysql_query($query_open) or die(mysql_error());
						while ($row_open = mysql_fetch_object($result_open))
							{
								$button_value = "h" . $row_open->req_id . "i" . $row_open->req_item_id . "e";
								echo "<TR>";
								echo "<TD>";
									echo $row_open->req_date_requested; 
								echo "</TD>";
								echo "<TD>";
									echo $row_open->req_id; 
									echo "-"; 
									echo $row_open->req_item_id; 
								echo "</TD>";
								echo "<TD>";
									echo $row_open->scholar_first_name; 
									echo " "; 
									echo $row_open->scholar_last_name; 
								echo "</TD>";
								echo "<TD>";
									echo $row_open->category; 
								echo "</TD>";
								echo "<TD>";
									echo "<span class='note_text'>";
										echo $row_open->option; 
									echo "</span>";
												echo "<BR>";		
										if ($row_open->req_description != '')
											{
												echo "<BR>";		
												echo "<span class='note_text'>Extra Comment: ";
												echo $row_open->req_description; 
												echo "</span>";
											}
										if ($row_open->req_rejection_reason != '')
											{
												echo "<BR>";
												echo "<span class='note_text'>Rejection Reason: ";
												echo $row_open->req_rejection_reason; 
												echo "</span>";
											}
								echo "</TD>";
								echo "<TD>";
									echo $row_open->req_amount_requested; 
								echo "</TD>";
								echo "<TD>";
									echo $row_open->req_amount_approved; 
								echo "</TD>";
								echo "<TD>
									<button type='button' id='button_request_action' class='btn btn-warning button_history' value='" . $button_value . "' data-toggle='modal' data-target='#historymodal'>
										view history
									</button>
								</TD>";
								echo "</TR>";
							}
					?>
				</TBODY>
				
			</TABLE>
		</DIV>
		
		
	</DIV>



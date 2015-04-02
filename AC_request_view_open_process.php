<?php session_start(); include "secure/connectstring.php";?>

	<DIV id="requesttabcontent" class="tab-content">
		<DIV class="tab-pane fade in" id="open">
			<BR>
			<table class = 'table table-hover table-condensed '>
				<THEAD>
					<TR>
						<TD class = 'td_scholar_5 column_name'>
							ID #
						</TD>
						<TD class = 'td_scholar_20 column_name'>
							SCHOLAR
						</TD>
						<TD class = 'td_scholar_10 column_name'>
							CATEGORY
						</TD>
						<TD class = 'td_scholar_20 column_name'>
							DETAILS
						</TD>
						<TD class = 'td_scholar_5 column_name'>
							AMOUNT
						</TD>
						<TD class = 'td_scholar_20 column_name'>
							DESCRIPTION
						</TD>
						<TD class = 'td_scholar_10 column_name'>
							DATE REQUESTED
						</TD>						
						<TD class = 'td_scholar_10 column_name'>
							ATTACHMENT
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

						$query_open = "Select * FROM tb_request_info, tb_scholar_info, tb_config_listing, tb_config_listing_request_category WHERE tb_request_info.req_cat = tb_config_listing_request_category.id AND tb_request_info.req_type = tb_config_listing.id AND (tb_config_listing.category = 'request_type') AND tb_scholar_info.scholar_id = tb_request_info.req_scholar_id AND req_status = 'OPEN' AND req_ac_id = $curr_user_id ORDER BY req_date_requested DESC";
						$result_open = mysql_query($query_open) or die(mysql_error());
						while ($row_open = mysql_fetch_object($result_open))
							{
								$button_value = "h" . $row_open->req_id . "i" . $row_open->req_item_id . "e" . $curr_user_id ."u";
								echo "<TR>";
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
									echo $row_open->option; 
								echo "</TD>";
								echo "<TD>";
									echo $row_open->req_amount_requested; 
								echo "</TD>";
								echo "<TD>";
									echo $row_open->req_description; 
								echo "</TD>";
								echo "<TD>";
									echo $row_open->req_date_requested; 
								echo "</TD>";
								echo "<TD>";
									if ($row_open->req_attachment == '')
										{
											echo "n/a";
										}
									else
										{
											$filename = "pic/attach_req/" . $row_open->req_attachment; 
											echo "<a href='" . $filename . "' target='_blank'>view attachment</a>";
										}
								echo "</TD>";
								echo "<TD>
									<button type='button' id='button_request_action' class='btn btn-info button_attach' value='" . $button_value . "'>
										<i class='fa fa-paperclip'></i>
									</button>
									
									
									<button type='button' id='button_request_action' class='btn btn-warning button_delete' value='" . $button_value . "'>
										cancel request
									</button>
								</TD>";
								echo "</TR>";
							}
					?>
				</TBODY>
			</TABLE>
		</DIV>

		<DIV class="tab-pane fade in" id="approved">
			<BR>
			<table class = 'table table-hover table-condensed '>
				<THEAD>
					<TR>
						<TD class = 'td_scholar_5 column_name'>
							ID #
						</TD>
						<TD class = 'td_scholar_20 column_name'>
							SCHOLAR
						</TD>
						<TD class = 'td_scholar_10 column_name'>
							CATEGORY
						</TD>
						<TD class = 'td_scholar_20 column_name'>
							DETAILS
						</TD>
						<TD class = 'td_scholar_5 column_name'>
							AMOUNT
						</TD>
						<TD class = 'td_scholar_20 column_name'>
							DESCRIPTION
						</TD>
						<TD class = 'td_scholar_10 column_name'>
							DATE REQUESTED
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

						$query_rejected = "Select * FROM tb_request_info, tb_scholar_info, tb_config_listing, tb_config_listing_request_category WHERE tb_request_info.req_cat = tb_config_listing_request_category.id AND tb_request_info.req_type = tb_config_listing.id AND (tb_config_listing.category = 'request_type') AND tb_scholar_info.scholar_id = tb_request_info.req_scholar_id AND req_status = 'APPROVED' AND req_ac_id = $curr_user_id ORDER BY req_date_requested DESC";
						$result_rejected = mysql_query($query_rejected) or die(mysql_error());
						
						while ($row_rejected = mysql_fetch_object($result_rejected))
							{
								$button_value = "h" . $row_rejected->req_id . "i" . $row_rejected->req_item_id . "eUNAPPROVEDc" . $curr_user_id . "t";
								echo "<TR>";
								echo "<TD>";
									echo $row_rejected->req_id; 
									echo "-"; 
									echo $row_rejected->req_item_id; 
								echo "</TD>";
								echo "<TD>";
									echo $row_rejected->scholar_first_name; 
									echo " "; 
									echo $row_rejected->scholar_last_name; 
								echo "</TD>";
								echo "<TD>";
									echo $row_rejected->category; 
								echo "</TD>";
								echo "<TD>";
									echo $row_rejected->option; 
								echo "</TD>";
								echo "<TD>";
									echo $row_rejected->req_amount_requested; 
								echo "</TD>";
								echo "<TD>";
									echo $row_rejected->req_description; 
								echo "</TD>";
								echo "<TD>";
									echo $row_rejected->req_date_requested; 
								echo "</TD>";
								echo "<TD class='middlediv'>
									<button type='button' id='button_request_action' class='btn btn-warning button_complete' value='" . $button_value . "'>
										close request
									</button>
								</TD>";
								
							}
					?>
				</TBODY>
			</TABLE>
		</DIV>

		
		
		<DIV class="tab-pane fade in" id="unapproved">
			<BR>
			<table class = 'table table-hover table-condensed '>
				<THEAD>
					<TR>
						<TD class = 'td_scholar_5 column_name'>
							ID #
						</TD>
						<TD class = 'td_scholar_20 column_name'>
							SCHOLAR
						</TD>
						<TD class = 'td_scholar_10 column_name'>
							CATEGORY
						</TD>
						<TD class = 'td_scholar_20 column_name'>
							DETAILS
						</TD>
						<TD class = 'td_scholar_5 column_name'>
							AMOUNT
						</TD>
						<TD class = 'td_scholar_20 column_name'>
							DESCRIPTION
						</TD>
						<TD class = 'td_scholar_10 column_name'>
							DATE REQUESTED
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

						$query_rejected = "Select * FROM tb_request_info, tb_scholar_info, tb_config_listing, tb_config_listing_request_category WHERE tb_request_info.req_cat = tb_config_listing_request_category.id AND tb_request_info.req_type = tb_config_listing.id AND (tb_config_listing.category = 'request_type') AND tb_scholar_info.scholar_id = tb_request_info.req_scholar_id AND req_status = 'REJECTED' AND req_ac_id = $curr_user_id ORDER BY req_scholar_id, req_date_requested DESC";
						$result_rejected = mysql_query($query_rejected) or die(mysql_error());
						
						while ($row_rejected = mysql_fetch_object($result_rejected))
							{
								$button_value = "h" . $row_rejected->req_id . "i" . $row_rejected->req_item_id . "eUNAPPROVEDc" . $curr_user_id . "t";
								echo "<TR>";
								echo "<TD>";
									echo $row_rejected->req_id; 
									echo "-"; 
									echo $row_rejected->req_item_id; 
								echo "</TD>";
								echo "<TD>";
									echo $row_rejected->scholar_first_name; 
									echo " "; 
									echo $row_rejected->scholar_last_name; 
								echo "</TD>";
								echo "<TD>";
									echo $row_rejected->category; 
								echo "</TD>";
								echo "<TD>";
									echo $row_rejected->option; 
								echo "</TD>";
								echo "<TD>";
									echo $row_rejected->req_amount_requested; 
								echo "</TD>";
								echo "<TD>";
									echo $row_rejected->req_description; 
									if ($row_rejected->req_rejection_reason != '')
										{
											echo "<BR>";
											echo "<span class='note_text'>Rejection Reason: ";
											echo $row_rejected->req_rejection_reason; 
											echo "</span></TD>";
										}
								echo "</TD>";
								echo "<TD>";
									echo $row_rejected->req_date_requested; 
								echo "</TD>";
								echo "<TD class='middlediv'>
									<button type='button' id='button_request_action' class='btn btn-warning button_complete' value='" . $button_value . "'>
										close request
									</button>
								</TD>";
								
							}
					?>
				</TBODY>
			</TABLE>
		</DIV>
		
		
		
	</DIV>



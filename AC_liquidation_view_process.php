<?php session_start(); include "secure/connectstring.php";?>

	
	<DIV id="requesttabcontent" class="tab-content">
		<DIV class="tab-pane fade in" id="open">
			<BR>
			
			<table class = 'table table-hover table-condensed '>
				<THEAD>
					<TR>
						<TD class = 'td_scholar_5 column_name'>
							#
						</TD>
						<TD class = 'td_scholar_15 column_name'>
							PURPOSE/DESCRIPTION
						</TD>
						<TD class = 'td_scholar_10 column_name'>
							POSTED
						</TD>
						<TD class = 'td_scholar_10 column_name'>
							EXPENSED
						</TD>
						<TD class = 'td_scholar_10 column_name rightdiv'>
							DEPOSIT
						</TD>
						<TD class = 'td_scholar_10 column_name rightdiv'>
							EXPENSE
						</TD>						
						<TD class = 'td_scholar_15 column_name rightdiv'>
							BALANCE
						</TD>
						<TD class = 'td_scholar_10 column_name'>
							ATTACHMENT
						</TD>
						
						
					</TR>
				</THEAD>
				<TBODY>
					<?php
						include 'secure/connectstring.php';
						$curr_user_id = $_SESSION['user_id'];
						$query_liq = "Select * FROM tb_liquidation_info WHERE liq_user_id = '$curr_user_id' ORDER BY liq_id DESC";
						$result_liq = mysql_query($query_liq) or die(mysql_error());
						$counter = mysql_num_rows($result_liq);
						while ($row_liq = mysql_fetch_object($result_liq))
							{
								$button_value = $row_liq->liq_id;
								echo "<TR>";
								echo "<TD>";
									echo $counter; 
								echo "</TD>";
								echo "<TD>";
									echo $row_liq->liq_purpose; 
									echo "<BR>";
									echo "<span class ='note_text'>" . $row_liq->liq_description . "</span>"; 
								echo "</TD>";
								echo "<TD>";
									echo $row_liq->liq_creation_date;
								echo "</TD>";
								echo "<TD>";
									echo $row_liq->liq_expense_date; 
								echo "</TD>";
								echo "<TD class='rightdiv'>";
									if ($row_liq->liq_expense_or_deposit == 'D')
										{ 
											$number = $row_liq->liq_amount; 
											echo number_format((float)$number, 2, '.', '');											
										}
								echo "</TD>";
								echo "<TD class='rightdiv'>";
									if ($row_liq->liq_expense_or_deposit == 'E')
										{ 
											$number = $row_liq->liq_amount; 
											echo number_format((float)$number, 2, '.', '');
										}
								echo "</TD>";
								echo "<TD class='rightdiv'>";
									$number = $row_liq->liq_rem_balance; 
									echo number_format((float)$number, 2, '.', '');
								echo "</TD>";
								echo "<TD>";								
									echo "
										<button type='button' id='button_request_action' class='btn btn-info button_attach' value='" . $button_value . "'>
											<i class='fa fa-paperclip'></i>
										</button> &nbsp;";

									
										if ($row_liq->liq_attachment == '')
											{
												echo "n/a";
											}
										else
											{
												$filename = "pic/attach_liq/" . $row_liq->liq_attachment; 
												echo "<a href='" . $filename . "' target='_blank'>view</a>";
											}
								echo "</TD>";
								echo "</TR>";
								$counter = $counter - 1;
														
							}						
					?>
				</TBODY>
				
			</TABLE>
		</DIV>
		
		
	</DIV>



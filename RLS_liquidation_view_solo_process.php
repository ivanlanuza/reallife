	
	<DIV id="requesttabcontent" class="tab-content">
			<BR>
			
			<table class = 'table table-hover table-condensed '>
				<THEAD>
					<TR>
						<TD class = 'td_scholar_5 column_name'>
							#
						</TD>
						<TD class = 'td_scholar_25 column_name'>
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
						<TD class = 'td_scholar_10 column_name rightdiv'>
							BALANCE
						</TD>
						<TD class = 'td_scholar_10 column_name centerdiv'>
							ATTACHMENT
						</TD>
						
						
					</TR>
				</THEAD>
				<TBODY>
					<?php
						include 'secure/connectstring.php';
						$query_liq = "Select * FROM tb_liquidation_info WHERE liq_user_id = '$curr_user_id' ORDER BY liq_id DESC";
						$result_liq = mysql_query($query_liq) or die(mysql_error());
						$counter = mysql_num_rows($result_liq);
						while ($row_liq = mysql_fetch_object($result_liq))
							{
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
								echo "<TD class='centerdiv'>";								
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



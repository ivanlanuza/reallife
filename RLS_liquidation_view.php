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
			view AC spending
		</div>
		
		<div class="container">
			<TABLE class='table table-striped'>
				<THEAD>
					<TR>
						<TD class='column_name'>
							Area Coordinator Name
						</TD>
						<TD class='column_name'>
							Area Assigned
						</TD>
						<TD class='column_name'>
							Current Cash Flow Balance
						</TD>
						<TD class='column_name'>
							View Details
						</TD>
					</TR>
				</THEAD>
				
				<TBODY>
					<?php
						include 'secure/connectstring.php';
						$query = "select data.liq_user_id, liq_area, liq_rem_balance from tb_liquidation_info, 
									(SELECT liq_user_id, MAX( liq_creation_date ) as latest_liq_date
									FROM  `tb_liquidation_info` 
									GROUP BY liq_user_id) as data
									WHERE tb_liquidation_info.liq_user_id = data.liq_user_id
									and liq_creation_date = latest_liq_date";
						$result = mysql_query($query) or die(mysql_error());	
						while ($row = mysql_fetch_object($result))
							{
								$curr_sel_id = $row->liq_user_id;
								$query_sel_id = "select user_last_name, user_first_name from tb_user_info WHERE user_id = '$curr_sel_id'";
								$result_sel_id = mysql_query($query_sel_id) or die(mysql_error());
								$row_sel_id = mysql_fetch_object($result_sel_id);
								echo "<TR>";
									echo "<TD>";
										echo $row_sel_id->user_last_name . ", " . $row_sel_id->user_first_name;
									echo "</TD>";
									echo "<TD>";
										echo $row->liq_area;
									echo "</TD>";
									echo "<TD>";
										echo "Php " . $row->liq_rem_balance;
									echo "</TD>";
									echo "<TD>";
										echo "<a href='RLS_liquidation_view_solo.php?id=" . $row->liq_user_id . "' class='btn btn-info'>view details</a>";
									echo "</TD>";
								echo "</TR>";
							}
					?>
				</TBODY>
			</TABLE>
		</div><!-- /.container -->
	
		<?php include 'GEN_func_footer.php'; ?>
	</BODY>
</html>

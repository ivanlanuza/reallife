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

		<div class="pagetitle">
			scholar spending
		</div>
		
		<div class="container">
			<table class = 'table middlediv'>			
				<TBODY>

					<?php
						include 'secure/connectstring.php';
						$curr_user_area = $_SESSION['user_area'];
						
						//retrieve the max per level
						$query_max = "select * from tb_config_general";						
						$result_max = mysql_query($query_max) or die(mysql_error());
						$row_max = mysql_fetch_object($result_max);
						$max_coll = $row_max->conf_coll_max_spend;
						$max_hs = $row_max->conf_hs_max_spend;
						$max_voc = $row_max->conf_voc_max_spend;
						
						/* CODE TO INCLUDE THE FORECASTED ALLOWANCE - DEPRECATED CODE

						//retrieve the forecasted allowance of students
						$allow_coll_year = $row_max->conf_coll_allow * ($row_max->conf_coll_weeks/($row_max->conf_coll_freq/7));
						$allow_hs_year = $row_max->conf_hs_allow * ($row_max->conf_hs_weeks/($row_max->conf_hs_freq/7));
						$allow_voc_year = $row_max->conf_voc_allow * ($row_max->conf_voc_weeks/($row_max->conf_voc_freq/7));
												
						$query_info = "Select tb_scholar_info.*, sum(
										Case
										When req_status = 'OPEN' then req_amount_requested
										When req_status = 'COMPLETED' then req_amount_approved
										End) as sum_spend FROM tb_scholar_info LEFT JOIN tb_request_info ON tb_scholar_info.scholar_id = tb_request_info.req_scholar_id 
										WHERE scholar_area = '$curr_user_area' 
										GROUP BY scholar_id
										ORDER BY scholar_last_name, scholar_first_name";
										
						$result_info = mysql_query($query_info) or die(mysql_error());
						while ($row_info = mysql_fetch_object($result_info))
							{			

								//calculate the % based on level
								if ($row_info->scholar_level == 'COLLEGE')
									{
										$scholar_percent = (($row_info->sum_spend/$max_coll)*100);
										$max_spend = $max_coll;
										
										//allowance forecast
										$scholar_forecast = (($allow_coll_year/$max_coll)*100);
										$total_scholar_percent = $scholar_percent + $scholar_forecast;
										$total_scholar_spend = $allow_coll_year + $row_info->sum_spend;
										$other_spend_amount = $row_info->sum_spend;
										$allowance_amount = $allow_coll_year;
									}
								elseif ($row_info->scholar_level == 'HIGH SCHOOL')
									{
										$scholar_percent = (($row_info->sum_spend/$max_hs)*100);
										$max_spend = $max_hs;
										
										//allowance forecast
										$scholar_forecast = (($allow_hs_year/$max_hs)*100);
										$total_scholar_percent = $scholar_percent + $scholar_forecast;
										$total_scholar_spend = $allow_hs_year + $row_info->sum_spend;
										$other_spend_amount = $row_info->sum_spend;
										$allowance_amount = $allow_hs_year;
									}
								else
									{
										$scholar_percent = (($row_info->sum_spend/$max_voc)*100);
										$max_spend = $max_voc;

										//allowance forecast
										$scholar_forecast = (($allow_voc_year/$max_voc)*100);
										$total_scholar_percent = $scholar_percent + $scholar_forecast;
										$total_scholar_spend = $allow_voc_year + $row_info->sum_spend;
										$other_spend_amount = $row_info->sum_spend;
										$allowance_amount = $allow_voc_year;
									}
									
							*/			
										
						$query_info = "Select tb_scholar_info.*, sum(
										Case
										When req_status = 'OPEN' then req_amount_requested
										When req_status = 'COMPLETED' then req_amount_approved
										End) as sum_spend FROM tb_scholar_info LEFT JOIN tb_request_info ON tb_scholar_info.scholar_id = tb_request_info.req_scholar_id 
										WHERE scholar_area = '$curr_user_area' 
										GROUP BY scholar_id
										ORDER BY scholar_last_name, scholar_first_name";
										
						$result_info = mysql_query($query_info) or die(mysql_error());
						while ($row_info = mysql_fetch_object($result_info))
							{			

								//calculate the % based on level
								if ($row_info->scholar_level == 'COLLEGE')
									{
										$scholar_percent = (($row_info->sum_spend/$max_coll)*100);
										$max_spend = $max_coll;
										
										//allowance forecast
										$total_scholar_percent = $scholar_percent;
										$total_scholar_spend = $row_info->sum_spend;
										$other_spend_amount = $row_info->sum_spend;
									}
								elseif ($row_info->scholar_level == 'HIGH SCHOOL')
									{
										$scholar_percent = (($row_info->sum_spend/$max_hs)*100);
										$max_spend = $max_hs;
										
										//allowance forecast
										$total_scholar_percent = $scholar_percent;
										$total_scholar_spend = $row_info->sum_spend;
										$other_spend_amount = $row_info->sum_spend;
									}
								else
									{
										$scholar_percent = (($row_info->sum_spend/$max_voc)*100);
										$max_spend = $max_voc;
										
										//allowance forecast
										$total_scholar_percent = $scholar_percent;
										$total_scholar_spend = $row_info->sum_spend;
										$other_spend_amount = $row_info->sum_spend;
									}

									
								echo "<TR class=middlediv>";
									echo "<TD rowspan=3 class=td_scholar_10>";
										echo "<img src='" . $row_info->scholar_pic . "' class='img-circle img-scholar_data'>";
									echo "</TD>";
									echo "<TD class=td_scholar_10>";
										echo "<span class='column_name'>Name: </span>";
									echo "</TD>";
									echo "<TD class='td_scholar_20'>";
										echo $row_info->scholar_last_name . ", " . $row_info->scholar_first_name;
									echo "</TD>";						
									echo "<TD class='td_scholar_5'>";
										echo " ";
									echo "</TD>";						
									echo "<TD class=td_scholar_10>";
										echo "<span class='column_name'>Area: </span>";
									echo "</TD>";
									echo "<TD class=td_scholar_15>";
										echo $row_info->scholar_area;
									echo "</TD>";
									echo "<TD class='td_scholar_5'>";
										echo " ";
									echo "</TD>";						
									echo "<TD class=td_scholar_10>";
										echo "<span class='column_name'>Level: </span>";
									echo "</TD>";
									echo "<TD class=td_scholar_15>";
										echo $row_info->scholar_level;
									echo "</TD>";
								echo "</TR>";
								echo "<TR>";
									echo "<TD class=td_scholar_10>";
										echo "<span class='column_name'>Max Spend for Level: </span>";
									echo "</TD>";
									echo "<TD class=td_scholar_20>";
										echo "Php " . $max_spend;
									echo "</TD>";
									echo "<TD class='td_scholar_5'>";
										echo " ";
									echo "</TD>";						
									echo "<TD class='td_scholar_25'>";
										echo "<span class='column_name'>Status: </span>";
									echo "</TD>";
									echo "<TD class='td_scholar_25'>";
										echo $row_info->scholar_status;
									echo "</TD>";
									echo "<TD class='td_scholar_5'>";
										echo " ";
									echo "</TD>";						
									echo "<TD class='td_scholar_10'>";
										echo "<span class='column_name'>Total Spend to Date: </span>";
									echo "</TD>";						
									echo "<TD class='td_scholar_15'>";
										echo "Php " . $total_scholar_spend;
									echo "</TD>";						
								echo "</TR>";
								echo "<TR>";
									echo "<TD class='td_scholar_10'>";
										echo "<span class='column_name'>Remaining Balance: </span>";
									echo "</TD>";
									echo "<TD class='td_scholar_20'>";
										echo "Php " . ($max_spend - $total_scholar_spend);
									echo "</TD>";
									echo "<TD class='td_scholar_5'>";
										echo " ";
									echo "</TD>";						
									echo "<TD colspan = 5>";
										if ($total_scholar_percent >= 80 && $total_scholar_percent < 95)
											{
												/*DEPRECATED TO NOT SHOW ALLOWANCE FORECAST
												echo "
														<div class='progress progress-striped active'>
															<div class='progress-bar progress-bar-warning ' role='progressbar' aria-valuenow='" . $scholar_forecast . "' aria-valuemin='0' aria-valuemax='100' style='width: " . $scholar_forecast . "%;'>
																allowance: Php" . $allowance_amount . "
															</div>
															<div class='progress-bar progress-bar-warning ' role='progressbar' aria-valuenow='" . $scholar_percent . "' aria-valuemin='0' aria-valuemax='100' style='width: " . $scholar_percent . "%;'>
																others: Php" . $other_spend_amount . "
															</div>
														</div>										
												";
												*/

												echo "
														<div class='progress progress-striped active'>
															<div class='progress-bar progress-bar-warning ' role='progressbar' aria-valuenow='" . $scholar_percent . "' aria-valuemin='0' aria-valuemax='100' style='width: " . $scholar_percent . "%;'>
																Php" . $other_spend_amount . "
															</div>
														</div>										
												";												
											}
										elseif ($total_scholar_percent >= 95 && $total_scholar_percent < 100)
											{
												/*DEPRECATED TO NOT SHOW ALLOWANCE FORECAST
												echo "
														<div class='progress progress-striped active'>
															<div class='progress-bar progress-bar-danger ' role='progressbar' aria-valuenow='" . $scholar_forecast . "' aria-valuemin='0' aria-valuemax='100' style='width: " . $scholar_forecast . "%;'>
																allowance: Php" . $allowance_amount . "
															</div>
															<div class='progress-bar progress-bar-danger ' role='progressbar' aria-valuenow='" . $scholar_percent . "' aria-valuemin='0' aria-valuemax='100' style='width: " . $scholar_percent . "%;'>
																others: Php" . $other_spend_amount . "
															</div>
														</div>										
												";
												*/
												echo "
														<div class='progress progress-striped active'>
															<div class='progress-bar progress-bar-danger ' role='progressbar' aria-valuenow='" . $scholar_percent . "' aria-valuemin='0' aria-valuemax='100' style='width: " . $scholar_percent . "%;'>
																Php" . $other_spend_amount . "
															</div>
														</div>										
												";											
											}
										elseif ($total_scholar_percent >= 100)
											{
												$scholar_percent = 100 - $scholar_forecast;
												/*DEPRECATED TO NOT SHOW ALLOWANCE FORECAST
												echo "
														<div class='progress progress-striped active'>
															<div class='progress-bar progress-bar-danger ' role='progressbar' aria-valuenow='" . $scholar_forecast . "' aria-valuemin='0' aria-valuemax='100' style='width: " . $scholar_forecast . "%;'>
																allowance: Php" . $allowance_amount . "
															</div>
															<div class='progress-bar progress-bar-danger ' role='progressbar' aria-valuenow='" . $scholar_percent . "' aria-valuemin='0' aria-valuemax='100' style='width: " . $scholar_percent . "%;'>
																others: Php" . $other_spend_amount . "
															</div>
														</div>										
												";
												*/
												echo "
														<div class='progress progress-striped active'>
															<div class='progress-bar progress-bar-danger ' role='progressbar' aria-valuenow='" . $scholar_percent . "' aria-valuemin='0' aria-valuemax='100' style='width: " . $scholar_percent . "%;'>
																Php" . $other_spend_amount . "
															</div>
														</div>										
												";
											}
										else
											{
												/*DEPRECATED TO NOT SHOW ALLOWANCE FORECAST
												echo "
														<div class='progress progress-striped active'>
															<div class='progress-bar progress-bar-success ' role='progressbar' aria-valuenow='" . $scholar_forecast . "' aria-valuemin='0' aria-valuemax='100' style='width: " . $scholar_forecast . "%;'>
																allowance: Php" . $allowance_amount . "
															</div>
															<div class='progress-bar progress-bar-success ' role='progressbar' aria-valuenow='" . $scholar_percent . "' aria-valuemin='0' aria-valuemax='100' style='width: " . $scholar_percent . "%;'>
																others: Php" . $other_spend_amount . "
															</div>
														</div>										
												";
												*/
												echo "
														<div class='progress progress-striped active'>
															<div class='progress-bar progress-bar-success ' role='progressbar' aria-valuenow='" . $scholar_percent . "' aria-valuemin='0' aria-valuemax='100' style='width: " . $scholar_percent . "%;'>
																Php" . $other_spend_amount . "
															</div>
														</div>										
												";
											}									
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

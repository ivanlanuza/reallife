<?php ?>
	
	<!-- Photo -->
		<TD> 
			<?php
			if (file_exists($row->scholar_pic)) 
				{
					echo "<img src ='" . $row->scholar_pic . "' class = 'img-circle sml-img'>";
				}			
			else
				{
					echo "<span class='glyphicon glyphicon-user'></span>";
				}
			?>
			<BR>
			
		</TD>
	
	<!-- Name (L, F) -->
		<TD>
			<a href='#' data-emptytext='---' class = 'a_editable' data-type='text' 
				id='scholar_last_name' 
				data-pk='<?php echo $row->scholar_id ?>' 
				data-url='RLS_scholar_manage_update.php' 
				data-title='enter last name'> 
				<?php echo $row->scholar_last_name ?> 
			</a>,
			<a href='#' data-emptytext='---' class = 'a_editable' data-type='text' 
				id='scholar_first_name' 
				data-pk='<?php echo $row->scholar_id ?>' 
				data-url='RLS_scholar_manage_update.php' 
				data-title='enter first name'> 
				<?php echo $row->scholar_first_name ?> 
			</a>
		</TD>
	
	
	<!-- Level -->
		<?php	
			$query_SCHOLARLEVEL = "Select * FROM tb_config_listing WHERE category = 'scholar_level'";
			$result_SCHOLARLEVEL = mysql_query($query_SCHOLARLEVEL) or die(mysql_error());
			if (mysql_num_rows($result_SCHOLARLEVEL) > 0)
				{
					$ctr = 0;
					while ($rowresult_SCHOLARLEVEL = mysql_fetch_object($result_SCHOLARLEVEL))
						{
							//code to create the array for value look-up
							$_SCHOLARLEVEL[$rowresult_SCHOLARLEVEL->option] = $rowresult_SCHOLARLEVEL->option; 
								
							//code to create the json array for selection option
							$_SCHOLARLEVELJSON[$ctr]['value'] = $rowresult_SCHOLARLEVEL->option;
							$_SCHOLARLEVELJSON[$ctr]['text'] = $rowresult_SCHOLARLEVEL->option;
							$ctr++;
									
						}
					$_SCHOLARLEVEL_name = $_SCHOLARLEVEL[$row->scholar_level]; //This outputs the initial value to be shown on screen
							
					$_SCHOLARLEVELsource = json_encode($_SCHOLARLEVELJSON);	
					$_SCHOLARLEVELsource = str_replace('"',"'",$_SCHOLARLEVELsource); //This outputs the JSON encoded array for selection option
				}
		?>
		
		<TD>
			<a href="#" class = "a_editable" 
				data-type="select" 
				id="scholar_level" 
				data-pk='<?php echo $row->scholar_id ?>' 
				data-url='RLS_scholar_manage_update.php' 
				data-title='select scholar level' 
				data-value="<?php echo $row->scholar_level;?>"
				data-source="<?php echo $_SCHOLARLEVELsource;?>">
				<?php echo $_SCHOLARLEVEL_name; ?>
			</a>
		</TD>
		
	<!-- Status -->
		<?php	
			$query_SCHOLARSTATUS = "Select * FROM tb_config_listing WHERE category = 'scholar_status'";
			$result_SCHOLARSTATUS = mysql_query($query_SCHOLARSTATUS) or die(mysql_error());
			if (mysql_num_rows($result_SCHOLARSTATUS) > 0)
				{
					$ctr = 0;
					while ($rowresult_SCHOLARSTATUS = mysql_fetch_object($result_SCHOLARSTATUS))
						{
							//code to create the array for value look-up
							$_SCHOLARSTATUS[$rowresult_SCHOLARSTATUS->option] = $rowresult_SCHOLARSTATUS->option; 
								
							//code to create the json array for selection option
							$_SCHOLARSTATUSJSON[$ctr]['value'] = $rowresult_SCHOLARSTATUS->option;
							$_SCHOLARSTATUSJSON[$ctr]['text'] = $rowresult_SCHOLARSTATUS->option;
							$ctr++;
									
						}
					$_SCHOLARSTATUS_name = $_SCHOLARSTATUS[$row->scholar_status]; //This outputs the initial value to be shown on screen
							
					$_SCHOLARSTATUSsource = json_encode($_SCHOLARSTATUSJSON);	
					$_SCHOLARSTATUSsource = str_replace('"',"'",$_SCHOLARSTATUSsource); //This outputs the JSON encoded array for selection option
				}
		?>
		
		<TD>
			<a href="#" class = "a_editable" 
				data-type="select" 
				id="scholar_status" 
				data-pk='<?php echo $row->scholar_id ?>' 
				data-url='RLS_scholar_manage_update.php' 
				data-title='select scholar status' 
				data-value="<?php echo $row->scholar_status;?>"
				data-source="<?php echo $_SCHOLARSTATUSsource;?>">
				<?php echo $_SCHOLARSTATUS_name; ?>
			</a>
		</TD>
	
	
	<!-- Area -->
		<?php	
			$query_SCHOLARAREA = "Select * FROM tb_config_listing WHERE category = 'user_area'";
			$result_SCHOLARAREA = mysql_query($query_SCHOLARAREA) or die(mysql_error());
			if (mysql_num_rows($result_SCHOLARAREA) > 0)
				{
					$ctr = 0;
					while ($rowresult_SCHOLARAREA = mysql_fetch_object($result_SCHOLARAREA))
						{
							//code to create the array for value look-up
							$_SCHOLARAREA[$rowresult_SCHOLARAREA->option] = $rowresult_SCHOLARAREA->option; 
								
							//code to create the json array for selection option
							$_SCHOLARAREAJSON[$ctr]['value'] = $rowresult_SCHOLARAREA->option;
							$_SCHOLARAREAJSON[$ctr]['text'] = $rowresult_SCHOLARAREA->option;
							$ctr++;
									
						}
					$_SCHOLARAREA_name = $_SCHOLARAREA[$row->scholar_area]; //This outputs the initial value to be shown on screen
							
					$_SCHOLARAREAsource = json_encode($_SCHOLARAREAJSON);	
					$_SCHOLARAREAsource = str_replace('"',"'",$_SCHOLARAREAsource); //This outputs the JSON encoded array for selection option
				}
		?>
		
		<TD>
			<a href="#" class = "a_editable" 
				data-type="select" 
				id="scholar_area" 
				data-pk='<?php echo $row->scholar_id ?>' 
				data-url='RLS_scholar_manage_update.php' 
				data-title='select scholar area' 
				data-value="<?php echo $row->scholar_area;?>"
				data-source="<?php echo $_SCHOLARAREAsource;?>">
				<?php echo $_SCHOLARAREA_name; ?>
			</a>
		</TD>
	
	<!-- Delete Button -->
		<TD>
			<button type='button' class='btn btn-danger button_delete' value='<?php echo $row->scholar_id ?>'>delete</button>
		</TD>

<?php ?>


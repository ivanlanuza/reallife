<?php ?>
	
	<!-- Photo -->
		<TD> 
			<?php
			if (file_exists($row->user_pic)) 
				{
					echo "<img src ='" . $row->user_pic . "' class = 'img-circle sml-img'>";
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
				id='user_last_name' 
				data-pk='<?php echo $row->user_id ?>' 
				data-url='RLS_site_access_update.php' 
				data-title='enter last name'> 
				<?php echo $row->user_last_name ?> 
			</a>,
			<a href='#' data-emptytext='---' class = 'a_editable' data-type='text' 
				id='user_first_name' 
				data-pk='<?php echo $row->user_id ?>' 
				data-url='RLS_site_access_update.php' 
				data-title='enter first name'> 
				<?php echo $row->user_first_name ?> 
			</a>
		</TD>
	

	<!-- Email -->
		<TD>
			<a href='#' data-emptytext='---' class = 'a_editable' data-type='text' 
				id='user_email' 
				data-pk='<?php echo $row->user_id ?>' 
				data-url='RLS_site_access_update.php' 
				data-title='enter email'> 
				<?php echo $row->user_email ?> 
			</a>
		</TD>
	
	<!-- Access Type -->
		<?php	
			$query_userLEVEL = "Select * FROM tb_config_listing WHERE category = 'user_access_type'";
			$result_userLEVEL = mysql_query($query_userLEVEL) or die(mysql_error());
			if (mysql_num_rows($result_userLEVEL) > 0)
				{
					$ctr = 0;
					while ($rowresult_userLEVEL = mysql_fetch_object($result_userLEVEL))
						{
							//code to create the array for value look-up
							$_userLEVEL[$rowresult_userLEVEL->option] = $rowresult_userLEVEL->option; 
								
							//code to create the json array for selection option
							$_userLEVELJSON[$ctr]['value'] = $rowresult_userLEVEL->option;
							$_userLEVELJSON[$ctr]['text'] = $rowresult_userLEVEL->option;
							$ctr++;
									
						}
					$_userLEVEL_name = $_userLEVEL[$row->user_access_type]; //This outputs the initial value to be shown on screen
							
					$_userLEVELsource = json_encode($_userLEVELJSON);	
					$_userLEVELsource = str_replace('"',"'",$_userLEVELsource); //This outputs the JSON encoded array for selection option
				}
		?>
		
		<TD>
			<a href="#" class = "a_editable" 
				data-type="select" 
				id="user_access_type" 
				data-pk='<?php echo $row->user_id ?>' 
				data-url='RLS_site_access_update.php' 
				data-title='select user access type' 
				data-value="<?php echo $row->user_access_type;?>"
				data-source="<?php echo $_userLEVELsource;?>">
				<?php echo $_userLEVEL_name; ?>
			</a>
		</TD>
		
	<!-- Status -->
		<?php	
			$query_userSTATUS = "Select * FROM tb_config_listing WHERE category = 'user_status'";
			$result_userSTATUS = mysql_query($query_userSTATUS) or die(mysql_error());
			if (mysql_num_rows($result_userSTATUS) > 0)
				{
					$ctr = 0;
					while ($rowresult_userSTATUS = mysql_fetch_object($result_userSTATUS))
						{
							//code to create the array for value look-up
							$_userSTATUS[$rowresult_userSTATUS->option] = $rowresult_userSTATUS->option; 
								
							//code to create the json array for selection option
							$_userSTATUSJSON[$ctr]['value'] = $rowresult_userSTATUS->option;
							$_userSTATUSJSON[$ctr]['text'] = $rowresult_userSTATUS->option;
							$ctr++;
									
						}
					$_userSTATUS_name = $_userSTATUS[$row->user_status]; //This outputs the initial value to be shown on screen
							
					$_userSTATUSsource = json_encode($_userSTATUSJSON);	
					$_userSTATUSsource = str_replace('"',"'",$_userSTATUSsource); //This outputs the JSON encoded array for selection option
				}
		?>
		
		<TD>
			<a href="#" class = "a_editable" 
				data-type="select" 
				id="user_status" 
				data-pk='<?php echo $row->user_id ?>' 
				data-url='RLS_site_access_update.php' 
				data-title='select user status' 
				data-value="<?php echo $row->user_status;?>"
				data-source="<?php echo $_userSTATUSsource;?>">
				<?php echo $_userSTATUS_name; ?>
			</a>
		</TD>
	
	
	<!-- Area -->
		<?php	
			$query_userAREA = "Select * FROM tb_config_listing WHERE category = 'user_area'";
			$result_userAREA = mysql_query($query_userAREA) or die(mysql_error());
			if (mysql_num_rows($result_userAREA) > 0)
				{
					$ctr = 0;
					while ($rowresult_userAREA = mysql_fetch_object($result_userAREA))
						{
							//code to create the array for value look-up
							$_userAREA[$rowresult_userAREA->option] = $rowresult_userAREA->option; 
								
							//code to create the json array for selection option
							$_userAREAJSON[$ctr]['value'] = $rowresult_userAREA->option;
							$_userAREAJSON[$ctr]['text'] = $rowresult_userAREA->option;
							$ctr++;
									
						}
					$_userAREA_name = $_userAREA[$row->user_area]; //This outputs the initial value to be shown on screen
							
					$_userAREAsource = json_encode($_userAREAJSON);	
					$_userAREAsource = str_replace('"',"'",$_userAREAsource); //This outputs the JSON encoded array for selection option
				}
		?>
		
		<TD>
			<a href="#" class = "a_editable" 
				data-type="select" 
				id="user_area" 
				data-pk='<?php echo $row->user_id ?>' 
				data-url='RLS_site_access_update.php' 
				data-title='select user area' 
				data-value="<?php echo $row->user_area;?>"
				data-source="<?php echo $_userAREAsource;?>">
				<?php echo $_userAREA_name; ?>
			</a>
		</TD>
	
	<!-- Delete Button -->
		<TD>
			<button type='button' class='btn btn-danger button_delete' value='<?php echo $row->user_id ?>'>delete</button>
		</TD>

<?php ?>


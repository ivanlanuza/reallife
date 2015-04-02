<?php ?>
	
	<!-- FULLY EDIT THIS FILE TO FORMAT THE OUTPUT  -->
	
	<!-- CODE FOR CREATING THE SELECTION OPTIONS FOR A PULL DOWN ENTRY FORM  -->
	<?php	
		$query_USERACCESS = "Select * FROM tb_type_access";
		$result_USERACCESS = mysql_query($query_USERACCESS) or die(mysql_error());
		if (mysql_num_rows($result_USERACCESS) > 0)
			{
				$ctr = 0;
				while ($rowresult_USERACCESS = mysql_fetch_object($result_USERACCESS))
					{
						//code to create the array for value look-up
						$_USERACCESS[$rowresult_USERACCESS->role_type] = $rowresult_USERACCESS->role_description; 
							
						//code to create the json array for selection option
						$_USERACCESSJSON[$ctr]['value'] = $rowresult_USERACCESS->role_type;
						$_USERACCESSJSON[$ctr]['text'] = $rowresult_USERACCESS->role_description;
						$ctr++;
								
					}
				$_USERACCESS_name = $_USERACCESS[$row->user_access]; //This outputs the initial value to be shown on screen
						
				$_USERaccessource = json_encode($_USERACCESSJSON);	
				$_USERaccessource = str_replace('"',"'",$_USERaccessource); //This outputs the JSON encoded array for selection option
			}
	?>

	<!-- CODE SAMPLE FOR OUTPUTTING IMAGES -->
	<TD> 
		<?php
		if (file_exists($row->photo_link)) 
			{
				echo "<img src ='" . $row->photo_link . "' class = 'img-circle sml-img-access'>";
			}			
		else
			{
				echo "<span class='glyphicon glyphicon-user'></span>";
			}
		?>
	</TD>
	
	<!-- CODE SAMPLE FOR OUTPUTTING NORMAL TEXT -->
	<TD>
		<a href='#' data-emptytext='---' class = 'a_editable' data-type='text' 
			id='user_name' 
			data-pk='<?php echo $row->user_id ?>' 
			data-url='GEN_TABLEREAD_UPDATE.php' 
			data-title='enter user name'> 
			<?php echo $row->user_name ?> 
		</a>
	</TD>

	<!-- CODE SAMPLE FOR OUTPUTTING SELECTION OPTIONS WITH HARDCODED OPTIONS -->
	<TD>
		<a href='#' data-emptytext='---' class = 'a_editable' data-type='select' 
			id='status' 
			data-pk='<?php echo $row->user_id ?>' 
			data-url='GEN_TABLEREAD_UPDATE.php' 
			data-title='enter status' 
			data-value ='<?php echo $row->status ?>' 
			data-source="[{value: 'ACTIVE', text: 'ACTIVE'},{value: 'INACTIVE', text: 'INACTIVE'}]">
			<?php echo $row->status ?>
		</a>
	</TD>
	
	<!-- CODE SAMPLE FOR OUTPUTTING SELECTION OPTIONS WITH GENERATED OPTIONS.  LINKED TO PHP CODE AT THE TOP. -->
	<TD>
		<a href="#" class = "a_editable" 
			data-type="select" 
			id="user_access" 
			data-pk='<?php echo $row->user_id ?>' 
			data-url='GEN_TABLEREAD_UPDATE.php' 
			data-title='select access type' 
			data-value="<?php echo $row->user_access;?>"
			data-source="<?php echo $_USERaccessource;?>">
			<?php echo $_USERACCESS_name; ?>
		</a>
	</TD>
	
	<!-- CODE SAMPLE FOR TABLE-BASED BUTTON THAT PASSES A VALUE. -->
	<TD>
		<button type='button' class='btn btn-danger button_delete' value='<?php echo $row->user_id ?>'>delete</button>
	</TD>
<?php ?>


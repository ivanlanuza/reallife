<?php
		
		//General DB connection open string
		include 'secure/connectstring.php';
		if(!isset($_SESSION)) 
		{ 
			session_start(); 
		} 

		//$current_userid = $_SESSION['user_id'];
		//$current_userarea = $_SESSION['user_area'];

		//Gets the full passed string
		$message = $_POST['hdnvaluepass'];
		//echo $message . "<BR><BR>";
						
		//Removes unnecessary strings
		$newmessage = str_replace("tblAppendGrid_", "", $message);
		$newmessage = str_replace("&hdnvaluepass=", "", $newmessage);
		$newmessage = str_replace("%2C", ":", $newmessage);
		$newmessage = str_replace("'", "''", $newmessage);
		
		//Calculates the number of records by getting the string after "&rowOrder="
		$arr = explode('&rowOrder=', $newmessage);
		$important = $arr[1];
		//Calculates the number of records by counting the ":" in the resulting string and adding 1 to it
		$count = 1 + substr_count($important, ':');

		//Removes the unnecessary string counter at the end of passed string
		$counter = 1;
		$stringtodelete = "rowOrder=";
		$colon = "";
		While ($counter <= $count)
			{
				$stringtodelete = $stringtodelete . $colon . $counter;
				$counter = $counter + 1;	
				$colon = ":";
			}
		$newmessage = str_replace($stringtodelete, "", $newmessage);
		
		//For debugging purposes				
		/*echo "Number of records: " . $count;
		echo "<BR><BR>";
		echo $newmessage;
		echo "<BR><BR>";*/

							
		//function to parse the string to get the values
		function get_string_between($string, $start, $end)
			{
			    $string = " ".$string;
			    $ini = strpos($string,$start);
			    if ($ini == 0) return "";
			    $ini += strlen($start);
			    $len = strpos($string,$end,$ini) - $ini;
			    return substr($string,$ini,$len);
			}

		//function to determine the new record id to be created
		$query_newid = "SELECT MAX(liq_id) FROM tb_liquidation_info";
		$result_newid = mysql_query($query_newid) or die(mysql_error());
		if (mysql_num_rows($result_newid)>0)
		{
			$row_newid = mysql_fetch_array($result_newid);
			$newliqid = $row_newid[0] + 1;	
		}
		else
		{
			$newliqid = 1;
		}
			
		//function to write to SQL table	
		$counter = 1;
		While ($counter <= $count)
			{
				$startdelimiter = "AreaCoordinator_" . $counter . "=";
				$parsed = get_string_between($newmessage, $startdelimiter, "&");
				$_ac_info = $parsed;

	    		$queryArea = "SELECT user_area FROM tb_user_info where user_id = '$_ac_info'";
				$resultArea = mysql_query($queryArea) or die(mysql_error());
				$rowArea = mysql_fetch_object($resultArea);			
				$current_userarea = $rowArea->user_area;
				
				$startdelimiter = "Purpose_" . $counter . "=";
				$parsed = get_string_between($newmessage, $startdelimiter, "&");
				$_sql_get_options = "select * from tb_config_listing where id = '$parsed' AND category = 'liquidation_purpose'";
				//echo $_sql_get_options
				$_query_get_options = mysql_query($_sql_get_options) or die (mysql_error());
				$_row_options = mysql_fetch_row($_query_get_options);
				$_purpose_info = $_row_options[2];
				
				
				$startdelimiter = "Amount_" . $counter . "=";
				$parsed = get_string_between($newmessage, $startdelimiter, "&");
				$_amount_info = $parsed;
				
				$startdelimiter = "Expense+Date_" . $counter . "=";
				$parsed = get_string_between($newmessage, $startdelimiter, "&");
				$_expensedate_info = $parsed;
				$_expensedate_info = str_replace("%2F", "-", $_expensedate_info);
				
				$startdelimiter = "Description_" . $counter . "=";
				$parsed = get_string_between($newmessage, $startdelimiter, "&");
				$_description_info = urldecode ($parsed);
				
				//Function to assign remaining balance
				
				$_sql_query_rem_bal = "select liq_rem_balance from tb_liquidation_info where liq_id = (select max(liq_id) from tb_liquidation_info where liq_area = '$current_userarea')";
				$_query_rem_bal = mysql_query($_sql_query_rem_bal) or die (mysql_error());

				if (mysql_num_rows($_query_rem_bal)>0)
				{
					 $_row_liq_rem_bal = mysql_fetch_row($_query_rem_bal);
					 $liq_rem_bal = $_row_liq_rem_bal[0] + $_amount_info;
				}
				else
				{
					$liq_rem_bal = $_amount_info;
				}
				
				
				$_sql_query_write = "INSERT INTO tb_liquidation_info VALUES (" . $newliqid . ", '" . $current_userarea . "', CURRENT_TIMESTAMP(), 'D' ,'" . $_description_info . "', '" . $_purpose_info . "', " . $_amount_info . ", " . $liq_rem_bal . ",'" . $_expensedate_info . "', " . $_ac_info . ", '')";				
				mysql_query($_sql_query_write) or die(mysql_error());
				
				$counter = $counter + 1;	
				$newliqid = $newliqid + 1;
				
				//echo "<BR>" . $_sql_query_write;
			}
		
		//function to redirect to display page
		header( 'Location: RLS_liquidation_view.php' );
	?>	
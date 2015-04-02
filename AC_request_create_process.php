<?php
		
		//General DB connection open string
		include 'secure/connectstring.php';
		session_start();
		$current_userid = $_SESSION['user_id'];

		
		//Gets the full passed string
		$message = $_POST['hdnvaluepass'];

		//Removes unnecessary strings
		$newmessage = str_replace("tblAppendGrid_", "", $message);
		$newmessage = str_replace("&hdnvaluepass=", "", $newmessage);
		$newmessage = str_replace("%2C", ":", $newmessage);
		
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
		//echo "Number of records: " . $count;
		//echo "<BR><BR>";
		//echo $newmessage;
		//echo "<BR><BR>";
					
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
		$query_newid = "SELECT MAX(req_id) FROM tb_request_info";
		$result_newid = mysql_query($query_newid) or die(mysql_error());
		if (mysql_num_rows($result_newid)>0)
		{
			$row_newid = mysql_fetch_array($result_newid);
			$newrequestid = $row_newid[0] + 1;	
		}
		else
		{
			$newrequestid = 1;
		}
		
					
		//function to write to SQL table	
		$counter = 1; //normal sequence to check for existing records
		$maxcounter = 1; //actual numbering of records
		
		While ($maxcounter <= $count)
			{
				//check for deleted lines - i.e. not all passed records begin with #1 counter due to deletion
				$checker = "Scholar_" . $counter . "=";
				if (strpos($newmessage,$checker) !== false) 
					{
						$startdelimiter = "Scholar_" . $counter . "=";
						$parsed = get_string_between($newmessage, $startdelimiter, "&");
						$_scholar_info = $parsed; 		

						$_ac_info = $_SESSION['user_id'];
						
						$startdelimiter = "Category_" . $counter . "=";
						$parsed = get_string_between($newmessage, $startdelimiter, "&");
						$_category_info = $parsed;
						
						$startdelimiter = "Details_" . $counter . "=";
						$parsed = get_string_between($newmessage, $startdelimiter, "&");
						$_details_info = $parsed;
						
						$startdelimiter = "Amount_" . $counter . "=";
						$parsed = get_string_between($newmessage, $startdelimiter, "&");
						$_amount_info = $parsed;
						
						$startdelimiter = "Comments_" . $counter . "=";
						$parsed = get_string_between($newmessage, $startdelimiter, "&");
						$_comment_info = str_replace("+", " ", $parsed);

						date_default_timezone_set("Asia/Manila");						
						$curr_date = date("Y-m-d H:i:s");
						$_sql_query_write = "INSERT INTO tb_request_info VALUES (" . $newrequestid . ", " . $maxcounter . ", " . $_category_info . ", " .$_details_info . ", " . $_ac_info . ", " . $_scholar_info . ", 'OPEN' , '" . $_comment_info . "', '' , '', " . $_amount_info . ", '', '', '', '" . $curr_date . "')";
						$_sql_query_write_2 = "INSERT INTO tb_request_history VALUES (" . $newrequestid . ", " . $maxcounter . ", 'OPEN' , '" . $curr_date . "', " . $current_userid . ")"; 
						
						mysql_query($_sql_query_write) or die(mysql_error());
						mysql_query($_sql_query_write_2) or die(mysql_error());
					
						//echo "<BR>" . $_sql_query_write;
						//echo "<BR>" . $_sql_query_write_2;

						$maxcounter = $maxcounter + 1;
					}
				
				$counter = $counter + 1;	
				
			}
		
		//function to redirect to display page
		header( 'Location: AC_request_view_open.php' );
					
	?>	
	
	
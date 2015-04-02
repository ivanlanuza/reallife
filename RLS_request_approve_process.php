<?php

	//get user ID
	if(!isset($_SESSION)) 
		{ 
			session_start(); 
		} 
		$current_userid = $_SESSION['user_id'];

	//retrieve the passed data
		$passdata= $_POST['passdata'];
		//$passdata = "recCount_15;repeatIndex_1_0:6_1:1_1:2_2:6_5;recId_0:14-2:recScholar_0:10000002:recOption_0:approve:recAmount_0:480:recReason_0:; recId_1:11-1:recScholar_1:10000002:recOption_1:reject:recAmount_1:0:recReason_1:this is not what I was expecting; recId_2:7-3:recScholar_2:10000002:recOption_2:reject:recAmount_2:0:recReason_2:; recId_3:7-2:recScholar_3:10000002:recOption_3:reject:recAmount_3:0:recReason_3:; recId_4:16-1:recScholar_4:10000002:recOption_4:reject:recAmount_4:0:recReason_4:; recId_5:7-1:recScholar_5:10000002:recOption_5:reject:recAmount_5:0:recReason_5:; recId_6:19-1:recScholar_6:10000005:recOption_6:approve:recAmount_6:237:recReason_6:; recId_7:17-1:recScholar_7:10000003:recOption_7:approve:recAmount_7:400:recReason_7:; recId_8:13-1:recScholar_8:10000003:recOption_8:approve:recAmount_8:40000:recReason_8:; recId_9:1-1:recScholar_9:10000001:recOption_9:approve:recAmount_9:100:recReason_9:; recId_10:3-1:recScholar_10:10000001:recOption_10:approve:recAmount_10:100:recReason_10:; recId_11:14-1:recScholar_11:10000001:recOption_11:approve:recAmount_11:88:recReason_11:; recId_12:9-1:recScholar_12:10000001:recOption_12:approve:recAmount_12:20000:recReason_12:; recId_13:2-1:recScholar_13:10000001:recOption_13:approve:recAmount_13:854:recReason_13:; recId_14:8-1:recScholar_14:10000001:recOption_14:reject:recAmount_14:0:recReason_14:; ";	
		//$passdata = "recCount_1;recId_0:11-1:recScholar_0:10000002:recOption_0:reject:recAmount_0:0:recReason_0:;";	
		echo $passdata;
		
	//generic function for retrieving string values
		function get_string_between($string, $start, $end)
			{
				$string = " ".$string;
				$ini = strpos($string,$start);
				if ($ini == 0) return "";
				$ini += strlen($start);
				$len = strpos($string,$end,$ini) - $ini;
				return substr($string,$ini,$len);
			}

	//retrieve the number of records to process	
		$startdelimiter = "recCount_";
		$enddelimiter = ";";
		$recordcount = (get_string_between($passdata, $startdelimiter, $enddelimiter))*1;

	//convert passed data into an array
		$records = array();
		$recordscounter = 0;
		
		While ($recordscounter < $recordcount)
			{
				//Get the full record ID
				$startdelimiter = "recId_" . $recordscounter;
				$enddelimiter = "recScholar";
				$recordIDFull = get_string_between($passdata, $startdelimiter, $enddelimiter);

				//Get the record ID
				$startdelimiter = ":";
				$enddelimiter = "-";
				$recordID = get_string_between($recordIDFull, $startdelimiter, $enddelimiter);

				//Get the record item ID	
				$startdelimiter = "-";
				$enddelimiter = ":";
				$recordItemID = get_string_between($recordIDFull, $startdelimiter, $enddelimiter);
				
				//Get the scholar ID
				$startdelimiter = "recScholar_" . $recordscounter . ":";
				$enddelimiter = ":";
				$scholar = get_string_between($passdata, $startdelimiter, $enddelimiter);

				//Get the processing action
				$startdelimiter = "recOption_" . $recordscounter . ":";
				$enddelimiter = ":";
				$option = get_string_between($passdata, $startdelimiter, $enddelimiter);

				//Get the approved amount
				$startdelimiter = "recAmount_" . $recordscounter . ":";
				$enddelimiter = ":";
				$amount = get_string_between($passdata, $startdelimiter, $enddelimiter);
				
				//Get the reason for rejection
				$startdelimiter = "recReason_" . $recordscounter . ":";
				$enddelimiter = ";";
				$reason = get_string_between($passdata, $startdelimiter, $enddelimiter);

				
				//add records into array
				array_push($records, array($recordID, $recordItemID, $scholar, $option, $amount, $reason));
				//echo $records[$recordscounter][0] . " : " . $records[$recordscounter][1] . " : " . $records[$recordscounter][2] . " : " . $records[$recordscounter][3] . " : " . $records[$recordscounter][4] . " : " . $records[$recordscounter][5] . "<BR>"; 
				
				//add to record counter to avoid endless loop
				$recordscounter = $recordscounter + 1;
			}
	
	//do the rounding calculation.  
		//run a function module to round up value to nearest 100
		//group by scholar id - if only one request for a scholar, round that line up
		//if multiple requests for a scholar: 
		//get the total sum of all requested amounts, round up to the nearest 100 by adding the difference to the item with highest amount
		
		//echo "<BR><BR><BR>";
		$biggestscholarrow = 0;
		$biggestscholaramount = 0;
		$scholartotal = 0;
		$recordscounter = 0;
		
		While ($recordscounter < $recordcount)
			{
				if ($records[$recordscounter][3] == "approve")
					{
						$scholartotal = $scholartotal + $records[$recordscounter][4];
						if ($biggestscholaramount < $records[$recordscounter][4])
							{
								$biggestscholaramount = $records[$recordscounter][4];
								$biggestscholarrow = $recordscounter;
							}
					}
				if ($recordscounter < ($recordcount - 1))
					{
						if ($records[$recordscounter][2] != $records[$recordscounter + 1][2])
							{
								$roundscholartotal = ceil( $scholartotal / 100 ) * 100;
								$scholardiff = $roundscholartotal - $scholartotal;
								$records[$biggestscholarrow][4] = $records[$biggestscholarrow][4] + $scholardiff;
								$biggestscholarrow = $recordscounter + 1;
								$biggestscholaramount = 0;
								$scholartotal = 0;
							}
					}
				else 
					{
						$roundscholartotal = ceil( $scholartotal / 100 ) * 100;
						$scholardiff = $roundscholartotal - $scholartotal;
						$records[$biggestscholarrow][4] = $records[$biggestscholarrow][4] + $scholardiff;
						$biggestscholarrow = $recordscounter + 1;
						$biggestscholaramount = 0;
						$scholartotal = 0;					
					}
				$recordscounter = $recordscounter + 1;
			}

		//output write again
		/*$recordscounter = 0;
		
		While ($recordscounter < $recordcount)
			{
				echo $records[$recordscounter][0] . " : " . $records[$recordscounter][1] . " : " . $records[$recordscounter][2] . " : " . $records[$recordscounter][3] . " : " . $records[$recordscounter][4] . " : " . $records[$recordscounter][5] . "<BR>"; 
				
				//add to record counter to avoid endless loop
				$recordscounter = $recordscounter + 1;
			}
		*/
			
	//Write updates into database
		include 'secure/connectstring.php';
		$recordscounter = 0;
		
		While ($recordscounter < $recordcount)
			{
				$current_req_id = $records[$recordscounter][0];
				$current_req_item_id = $records[$recordscounter][1];
				$current_scholar_id = $records[$recordscounter][2];
				$current_amount = $records[$recordscounter][4];
				$current_reason = $records[$recordscounter][5];
				$curr_date = date("Y-m-d");

				if ($records[$recordscounter][3] == "approve")
					{

						$querygettotal = "SELECT scholar_total_spend from tb_scholar_info where scholar_id=$current_scholar_id";
						$resultgettotal = mysql_query($querygettotal) or die(mysql_error());
						$rowgettotal = mysql_fetch_row($resultgettotal);
						$current_total_spend = $rowgettotal[0];
						$new_total_spend = $current_total_spend + $current_amount;
						
						
						//update the req_amount_approved, req_total_spend, req_date_approved, req_status (APPROVED) fields in  tb_request_info
						//array_push($records, array($recordID, $recordItemID, $scholar, $option, $amount, $reason));
							$queryupdate = "UPDATE tb_request_info SET 
								req_status='APPROVED',
								req_amount_approved = $current_amount, 
								req_date_approved = '$curr_date'
								WHERE req_id=$current_req_id AND req_item_id=$current_req_item_id";
							mysql_query($queryupdate) or die(mysql_error());
							echo $queryupdate . "<BR>";
							
							$scholarupdate = "UPDATE tb_scholar_info SET
												scholar_total_spend = $new_total_spend
												WHERE scholar_id=$current_scholar_id";
							mysql_query($scholarupdate) or die(mysql_error());
							echo $scholarupdate . "<BR>";
						
						//create two entries in tb_request_history for status 'APPROVED' and 'COMPLETED'
							$newstatus = "APPROVED";
							date_default_timezone_set("Asia/Manila");						
							$curr_date = date("Y-m-d H:i:s");
							$queryadd = "INSERT INTO tb_request_history (req_id_hist, req_item_id_hist, req_status_hist, req_date_hist, req_user_id_hist) 
								VALUES ('$current_req_id', '$current_req_item_id', '$newstatus', '$curr_date' , '$current_userid')";
							mysql_query($queryadd) or die(mysql_error());
							echo $queryadd . "<BR>";

						//REMOVED CODE AFTER CHANGE REQUEST TO ALLOW ACs to MANUALLY COMPLETE APPROVED REQUESTS
							/*$newstatus = "COMPLETED";
							$curr_date = date("Y-m-d");
							$queryadd = "INSERT INTO tb_request_history (req_id_hist, req_item_id_hist, req_status_hist, req_date_hist, req_user_id_hist) 
								VALUES ('$current_req_id', '$current_req_item_id', '$newstatus', '$curr_date' , '$current_userid')";
							mysql_query($queryadd) or die(mysql_error());
							echo $queryadd . "<BR>";*/

					}
				elseif ($records[$recordscounter][3] == "reject")
					{
						//update the req_rejection_reason, req_status (REJECTED) fields in  tb_request_info
						$curr_date = date("Y-m-d");
						
						//array_push($records, array($recordID, $recordItemID, $scholar, $option, $amount, $reason));
							$queryupdate = "UPDATE tb_request_info SET 
								req_status='REJECTED',
								req_rejection_reason = '$current_reason',
								req_date_approved = '$curr_date'
								WHERE req_id=$current_req_id AND req_item_id=$current_req_item_id";
							mysql_query($queryupdate) or die(mysql_error());
							echo $queryupdate . "<BR>";

						//create one entry in tb_request_history for status 'REJECTED'					
							$newstatus = "REJECTED";
							date_default_timezone_set("Asia/Manila");						
							$curr_date = date("Y-m-d H:i:s");
							$queryadd = "INSERT INTO tb_request_history (req_id_hist, req_item_id_hist, req_status_hist, req_date_hist, req_user_id_hist) 
								VALUES ('$current_req_id', '$current_req_item_id', '$newstatus', '$curr_date' , '$current_userid')";
							mysql_query($queryadd) or die(mysql_error());
							echo $queryadd . "<BR>";

					}
				else
					{
						//do nothing
					}	

				$recordscounter = $recordscounter + 1;
			}
		
	//return the total number of records processed (approved + rejected) by putting the amount in variable $passdata
		$passdata = $recordscounter;
		echo $passdata;
	
?>
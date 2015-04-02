<?php

	$request_id= $_POST['head'];
	$request_item_id = $_POST['item'];
	
	include 'secure/connectstring.php';
	
	//Get the history data and show it
	echo "<span class=smallital>REQUEST ID #:</span><span class=statuscomment> " . $request_id . "</span><BR>";	
	echo "<span class=smallital>REQUEST ITEM ID #:</span><span class=statuscomment> " . $request_item_id . "</span><BR><BR>";	
	
	echo "<table class = 'table table-hover table-condensed'><THEAD><tr class='success'><td class='td_scholar_5'>Seq</td><td class='td_scholar_25'>Status</td><td class='td_scholar_30'>Date</td><td class='td_scholar_25'>Processed By</td></tr></thead>";
	$queryHistory = "SELECT * FROM tb_request_history, tb_user_info where req_user_id_hist = user_id and req_id_hist = $request_id and req_item_id_hist = $request_item_id ORDER BY req_date_hist";
	$resultHistory = mysql_query($queryHistory) or die(mysql_error());
	$counter = 1;
	while ($rowHistory = mysql_fetch_object($resultHistory))
		{
			echo "<TR><TD>" . $counter . "</TD><TD>" . $rowHistory->req_status_hist . "</TD><TD>" . $rowHistory->req_date_hist . "</TD><TD>" . $rowHistory->user_first_name . " " . $rowHistory->user_last_name . "</TD></TR>";						
			$counter = $counter + 1;
		}
	
?>
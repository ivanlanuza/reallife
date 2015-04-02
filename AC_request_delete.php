<?php

	$head= $_POST['head'];
	$item = $_POST['item'];
	$current_userid = $_POST['user'];
	
	include 'secure/connectstring.php';
	
	//Update request_status of tb_requests_item to "DELETED"
	
	$queryupdate = "UPDATE tb_request_info SET req_status='DELETED' WHERE req_id='$head' AND req_item_id='$item'";
	mysql_query($queryupdate) or die(mysql_error());
	
	
	//Add entry in tb_request_history
	$newstatus = "DELETED";
	date_default_timezone_set("Asia/Manila");						
	$curr_date = date("Y-m-d H:i:s");
	$queryadd = "INSERT INTO tb_request_history (req_id_hist, req_item_id_hist, req_status_hist, req_date_hist, req_user_id_hist) 
		VALUES ('$head', '$item', '$newstatus', '$curr_date' , '$current_userid')";
	mysql_query($queryadd);

	//echo $queryadd;	
	include 'AC_request_view_open_process.php';	
?>
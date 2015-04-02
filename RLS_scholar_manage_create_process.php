<?php

	/*EDIT THIS FILE TO UPDATE THE SQL STATEMENTS */
	/*REMEMBER TO UPDATE THE INCLUDE AT THE BOTTOM - THIS IS THE MAIN DISPLAY MODULE */
	
	$reclastname = $_POST['inputlastname'];
	$recfirstname = $_POST['inputfirstname'];
	$recscholarlevel = $_POST['inputscholarlevel'];
	$recscholarstatus = $_POST['inputscholarstatus'];
	$recscholararea = $_POST['inputscholararea'];
	
	include 'secure/connectstring.php';
	
	$querymax = "SELECT MAX(scholar_id) FROM tb_scholar_info";
	$resultmax = mysql_query($querymax) or die(mysql_error());
	$rowmax = mysql_fetch_row($resultmax);
	$newkey = $rowmax[0] + 1;
	$photonew = "pic/scholar/" . $newkey . ".jpg";

	$querynew = "INSERT INTO tb_scholar_info (scholar_id, scholar_last_name, scholar_first_name, scholar_pic, scholar_level, scholar_status, scholar_area, scholar_total_spend) 
									  VALUES ('$newkey', '$reclastname', '$recfirstname', '$photonew' , '$recscholarlevel' , '$recscholarstatus', '$recscholararea', '0')";
	mysql_query($querynew) or die(mysql_error());
	
	include 'RLS_scholar_manage_display.php';
?>


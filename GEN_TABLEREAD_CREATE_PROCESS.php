<?php

	/*EDIT THIS FILE TO UPDATE THE SQL STATEMENTS */
	/*REMEMBER TO UPDATE THE INCLUDE AT THE BOTTOM - THIS IS THE MAIN DISPLAY MODULE */
	
	$recname = $_POST['inputname'];
	$recrole = $_POST['inputrole'];
	$recstatus = $_POST['inputstatus'];
	
	include 'secure/connectstring.php';
	
	$querymax = "SELECT MAX(user_id) FROM tb_user_info";
	$resultmax = mysql_query($querymax) or die(mysql_error());
	$rowmax = mysql_fetch_row($resultmax);
	$newkey = $rowmax[0] + 1;
	$photonew = "pic/" . $newkey . ".jpg";

	$querynew = "INSERT INTO tb_user_info (user_id, user_name, user_access, photo_link, status) VALUES ('$newkey', '$recname', '$recrole', '$photonew' , '$recstatus')";
	mysql_query($querynew) or die(mysql_error());
	
	include 'GEN_TABLEREAD_DISPLAY.php';
?>


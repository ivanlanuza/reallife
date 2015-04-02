<?php

	/*EDIT THIS FILE TO UPDATE THE SQL STATEMENTS */
	/*REMEMBER TO UPDATE THE INCLUDE AT THE BOTTOM - THIS IS THE MAIN DISPLAY MODULE */
	
	$recuserlastname = $_POST['inputuserlastname'];
	$recuserfirstname = $_POST['inputuserfirstname'];
	$recuseraccesstype = $_POST['inputuseraccesstype'];
	$recuseremail = $_POST['inputuseremail'];
	$recuserstatus = $_POST['inputuserstatus'];
	$recuserarea = $_POST['inputuserarea'];
	
	include 'secure/connectstring.php';
	
	$querymax = "SELECT MAX(user_id) FROM tb_user_info";
	$resultmax = mysql_query($querymax) or die(mysql_error());
	$rowmax = mysql_fetch_row($resultmax);
	$newkey = $rowmax[0] + 1;
	$photonew = "pic/user/" . $newkey . ".jpg";

	$querynew = "INSERT INTO tb_user_info (user_id, user_email, user_access_type, user_area, user_pic, user_first_name, user_last_name, user_status) 
									  VALUES ('$newkey', '$recuseremail', '$recuseraccesstype', '$recuserarea', '$photonew', '$recuserfirstname', '$recuserlastname', '$recuserstatus')";
	mysql_query($querynew) or die(mysql_error());
	
	include 'RLS_site_access_display.php';
?>


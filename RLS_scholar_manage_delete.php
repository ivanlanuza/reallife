<?php
	$id = $_POST['inputid'];

	include 'secure/connectstring.php';
	
	$querydelete = "DELETE FROM tb_scholar_info WHERE scholar_id =" . $id;
    mysql_query($querydelete);

	include 'RLS_scholar_manage_display.php';	
?>
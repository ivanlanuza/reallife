<?php
	$id = $_POST['inputid'];

	include 'secure/connectstring.php';
	
	$querydelete = "DELETE FROM tb_user_info WHERE user_id =" . $id;
    mysql_query($querydelete);

	include 'GEN_TABLEREAD_DISPLAY.php';	
?>
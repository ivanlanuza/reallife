<?php

	/*EDIT THIS PART */
	
	$__VIEW_QUERYTABLE = "tb_user_info";
	$__VIEW_QUERYFIELDS = "*";
	$__VIEW_QUERYFILTER = "";
	$__VIEW_QUERYSORT = "order by tb_user_info.user_last_name, tb_user_info.user_first_name";
	$__VIEW_TABLEHEAD = "<THEAD><TR class='column_name'><TD>Photo</TD><TD>User Name</TD><TD>Email</TD><TD>Access Type</TD><TD>Status</TD><TD>Area</TD><TD>Delete</TD></TR></THEAD>";
	$__VIEW_GENERATEFILE = "RLS_site_access_display_contents.php";

	/*DO NOT EDIT BELOW THIS PART */
	/*GENERIC FUNCTION TO GENERATE THE VIEW */
	
		include 'secure/connectstring.php';
		$query = "SELECT $__VIEW_QUERYFIELDS FROM $__VIEW_QUERYTABLE $__VIEW_QUERYFILTER $__VIEW_QUERYSORT";
		$result = mysql_query($query) or die(mysql_error());


		echo "<div class = 'row'>";
		echo "<TABLE class = 'table table-hover'>" . $__VIEW_TABLEHEAD;
		while ($row = mysql_fetch_object($result))
			{
				$i = 0;
				echo "<TR>";
				include $__VIEW_GENERATEFILE;
				echo "</TR>";
			}
		echo "</TABLE>";
		echo "</div>";

?>
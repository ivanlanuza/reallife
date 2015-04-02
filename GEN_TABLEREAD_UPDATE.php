<?php

	/*EDIT THE QUERY BELOW TO MEET THE TABLE NEEDS */
	
	$pk = $_POST['pk'];
    $name = $_POST['name'];
    $value = $_POST['value'];

    if(!empty($value)) {
	
		include 'secure/connectstring.php';
		$queryeditable = "update tb_user_info set " . mysql_escape_string($name) . "='" . mysql_escape_string($value). "' where user_id = '" . mysql_escape_string($pk) . "'";
        mysql_query($queryeditable) or die(mysql_error());
        
        //here, for debug reason we just return dump of $_POST, you will see result in browser console
        print_r($queryeditable);


    } else {
        /* 
        In case of incorrect value or error you should return HTTP status != 200. 
        Response body will be shown as error message in editable form.
        */

        header('HTTP 400 Bad Request', true, 400);
        echo "This field is required!";
    }

?>
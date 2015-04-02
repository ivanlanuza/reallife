<?php
	$allowedExts = array("jpeg", "jpg");
	$temp = explode(".", $_FILES["file"]["name"]);
	$extension = end($temp);
	if ((($_FILES["file"]["type"] == "image/jpeg")
	|| ($_FILES["file"]["type"] == "image/jpg")
	|| ($_FILES["file"]["type"] == "image/pjpeg"))
	&& ($_FILES["file"]["size"] < 2000000)
	&& in_array($extension, $allowedExts))
		{
			if ($_FILES["file"]["error"] > 0)
				{
					//echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
					header( 'Location: AC_request_view_open.php' );
				}
			else
				{
					//echo "Upload: " . $_FILES["file"]["name"] . "<br>";
					//echo "Type: " . $_FILES["file"]["type"] . "<br>";
					//echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
					//echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

	$filenamenew = $_POST["record_id"];
    move_uploaded_file($_FILES["file"]["tmp_name"],
	"pic/attach_liq/" . $filenamenew . ".jpg");
    //echo "Stored in: " . "pic/attach_req/" . $_FILES["file"]["name"];

	//update request table
	include 'secure/connectstring.php';
	$filenamefull = $filenamenew . ".jpg";
	
	$queryupdate = "UPDATE tb_liquidation_info SET 
						liq_attachment= '$filenamefull'
						WHERE liq_id='$filenamenew'";
	mysql_query($queryupdate) or die(mysql_error());
	 
	header( 'Location: AC_liquidation_view.php' );
    }
  }
else
  {
  //echo "Invalid file";
  header( 'Location: AC_liquidation_view.php' );
  }
?>
<?php 

	//retrieve the data from page RLS_request_finance.php
		$from_date = $_POST['fromdate'];
		$to_date = $_POST['todate']; 		
		/*if (isset($_POST['collbox'])) 
			{
				$coll_box = "X";
			} 
		else 
			{
				$coll_box = "";
			}
		if (isset($_POST['hsbox'])) 
			{
				$hs_box = "X";
			} 
		else 
			{
				$hs_box = "";
			}
		if (isset($_POST['vocbox'])) 
			{
				$voc_box = "X";
			} 
		else 
			{
				$voc_box = "";
			}
		*/
		
	//if highschool_checked:
		//go to tb_config_general, retrieve conf_hs_allow_last_run, conf_hs_freq and conf_hs_allow
		//check if current date minus (conf_hs_freq minus 3) is greater than conf_hs_allow_last_run
		//if yes, create entries in tb_request_info and tb_request_history for ALL scholars in highschool level
			//tb_request_info.req_id = find new id
			//tb_request_info.req_item_id = 1
			//tb_request_info.req_cat = 99
			//tb_request_info.req_type = 99
			//tb_request_info.req_ac_id = current user id
			//tb_request_info.req_status = 'COMPLETED'
			//tb_request_info.req_amount_requested = conf_hs_allow
			//tb_request_info.req_amount_approved = conf_hs_allow
			//tb_request_info.req_date_approved = current date
			//tb_request_info.req_date_requested = current date
			
			//update tb_config_general.conf_hs_allow_last_run = current date
	
			//tb_request_history.req_id_hist = same id as above
			//tb_request_history.req_item_id_hist = 1
			//tb_request_history.req_status hist = 'COMPLETED'
			//tb_request_history.req_date_hist = current date
			//tb_request_history.req_user_id_hist = current user id
		//if no, do nothing. proceed with next steps
		
	//if college checked, do the same logic as for highschool.  this time using retrieve 'conf_coll' fields

	//if vocational checked, do the same logic as for highschool.  this time using retrieve 'conf_voc' fields

	
	//query tb_request_info for requests that fall in the indicated	approval date range (tb_request_info.req_date_approved)
		include 'secure/connectstring.php';
		$query = "Select * FROM tb_request_info, tb_scholar_info, tb_config_listing_request_category, tb_config_listing_request_type WHERE tb_config_listing_request_type.id = tb_request_info.req_type AND tb_config_listing_request_category.id = tb_request_info.req_cat AND tb_request_info.req_scholar_id = tb_scholar_info.scholar_id AND req_status = 'APPROVED' AND req_date_approved >= '$from_date' AND req_date_approved <= '$to_date' AND req_amount_approved > 0 ORDER BY req_cat, req_type DESC";
		$result = mysql_query($query) or die(mysql_error());
		$counter = mysql_num_rows($result);
		
	//save the query result in an array
		$records = array();
		$recordscount = 0;
		
		while ($row = mysql_fetch_object($result))
			{
				$id = $row->req_id;
				$item_id = $row->req_item_id;
				$category = $row->category;
				$type = $row->type;
				$scholar_id = $row->scholar_id;
				$last_name = $row->scholar_last_name;
				$first_name = $row->scholar_first_name;
				$description = $row->req_description;
				$amount = $row->req_amount_approved;
				$date = $row->req_date_approved;

				array_push($records, array($id, $item_id, $category, $type, $scholar_id, $last_name, $first_name, $amount, $date, $description));
				$recordscount = $recordscount + 1;	
			}
	
		
	//push the query results from array into excel file format
		/** Error reporting */
		error_reporting(E_ALL);

		/** Include path **/
		ini_set('include_path', ini_get('include_path').';../Classes/');

		/** PHPExcel */
		include 'classes/PHPExcel.php';

		/** PHPExcel_Writer_Excel2007 */
		include 'classes/PHPExcel/Writer/Excel2007.php';

		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();

		// Set properties
		$objPHPExcel->getProperties()->setCreator("Real Life");
		$objPHPExcel->getProperties()->setLastModifiedBy("Real Life");
		$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
		$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
		$objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");

		// Transfer contents of array into excel sheet
			//First write the column names
				$objPHPExcel->setActiveSheetIndex(0);
				$objPHPExcel->getActiveSheet()->setTitle('Finance Submission');
				$objPHPExcel->getActiveSheet()->SetCellValueByColumnAndRow(1, 2, 'Request ID');
				$objPHPExcel->getActiveSheet()->SetCellValueByColumnAndRow(2, 2, 'Request Item ID');
				$objPHPExcel->getActiveSheet()->SetCellValueByColumnAndRow(3, 2, 'Category');
				$objPHPExcel->getActiveSheet()->SetCellValueByColumnAndRow(4, 2, 'Type');
				$objPHPExcel->getActiveSheet()->SetCellValueByColumnAndRow(5, 2, 'Scholar ID');
				$objPHPExcel->getActiveSheet()->SetCellValueByColumnAndRow(6, 2, 'Scholar Last Name');
				$objPHPExcel->getActiveSheet()->SetCellValueByColumnAndRow(7, 2, 'Scholar First Name');
				$objPHPExcel->getActiveSheet()->SetCellValueByColumnAndRow(8, 2, 'Request Amount');
				$objPHPExcel->getActiveSheet()->SetCellValueByColumnAndRow(9, 2, 'Date Approved');
				$objPHPExcel->getActiveSheet()->SetCellValueByColumnAndRow(10, 2, 'Request Description');
			
			//Next, write the column data by iterating thru the array		
				$recordscounter = 0;
				$columncounter = 0;
				$maxcolumn = 10;
				While ($recordscounter < $recordscount)
					{
						$row = $recordscounter + 3;
						$columncounter = 0;
						While ($columncounter < $maxcolumn)
							{
								$value = $records[$recordscounter][$columncounter];
								$col = $columncounter + 1;
								$objPHPExcel->getActiveSheet()->SetCellValueByColumnAndRow($col, $row, $value);		
								$columncounter = $columncounter + 1;
							}
						$recordscounter = $recordscounter + 1;
					}
			
	//excel file should automatically start download
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=\"Real Life.xlsx\"");
		header("Cache-Control: max-age=0");
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
		$objWriter->save("php://output");
		exit;
	
	//redirect back into RLS_request_finance.php once download is complete
		header( 'Location: RLS_request_finance.php' );	
?>
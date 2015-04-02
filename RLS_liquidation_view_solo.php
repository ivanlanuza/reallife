<?php 
	include 'secure/passcheck.php';
	$curr_user_id = $_GET["id"];
	
	include 'secure/connectstring.php';
	$query_user_name = "Select user_last_name, user_first_name FROM tb_user_info WHERE user_id = '$curr_user_id'";
	$result_user_name = mysql_query($query_user_name) or die(mysql_error());
	$counter = mysql_num_rows($result_user_name);
	$row_user_name = mysql_fetch_object($result_user_name);
	
?>


<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

    <HEAD>
		<?php include 'GEN_func_header.php'; ?>
		
		<script type="text/javascript">	
			$(document).ready(function(){				
									
				//FUNCTION TO ACTIVATE THE TABS
				$('#requestsdisplaytab li:eq(0) a').click(function (e) {
					e.preventDefault()
					$(this).tab('show')
				});
				
				$(document).on("click","#button_back",function(e){		
					e.preventDefault()
						
					window.location.assign('RLS_liquidation_view.php');		
				});									
								
			});
		</script>
		
	</HEAD>
	
    <BODY>
		<?php include 'GEN_func_header_bar_RLS.php'; ?>

		<div class="pagetitle">
			AC cash flow
		</div>

		
		<div class="container">
			<div class = "row" id = "requestsdata">
				<ul class="nav nav-tabs" id="requestsdisplaytab">
					<li class="active"><a href="#completed">Expenses & Deposits of <span class='column_name'><?php echo $row_user_name->user_last_name . ", " . $row_user_name->user_first_name; ?></span></a></li>
				</ul>		
			</div>
						
			<div class = "row">
					<?php include 'RLS_liquidation_view_solo_process.php'; ?>
			</div>
			
		</div><!-- /.container -->
		
		<div class = "container centerdiv">
			<div class = "row">
				<BR>
				<button type="button" class="btn btn-success" id="button_back" >Back to Full List </button>
				<BR><BR><BR>
			</div>
		</div>
	
		<?php include 'GEN_func_footer.php'; ?>
	</BODY>
</html>

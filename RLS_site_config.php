<?php 

	session_start(); 

	include 'secure/connectstring.php';
	$query = "SELECT * FROM tb_config_general";
	$result = mysql_query($query) or die(mysql_error());	
?>

<!DOCTYPE html>
	<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]--><!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]--><!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]--><!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

    <HEAD>
		<?php include 'GEN_func_header.php'; ?>

		<script type="text/javascript">	
			$(document).ready(function(){				
			
					//INITIAL CALL OF X-EDITABLE FOR IN-TABLE EDITING
					$.fn.editable.defaults.mode = 'popup';
					$('.a_editable').editable();		
			});
		</script>
		
	</HEAD>
	
    <BODY>
        <!--[if lt IE 7]><p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]-->

			<div id="wrap">
				<?php include 'GEN_func_header_bar_RLS.php'; ?>

				<div class="pagetitle">
					manage site defaults
				</div>
				
				<!-- ********************************MAIN BODY CONTENT HERE********************************	-->
				
				<?php
					include 'RLS_site_config_data.php';				
				?>
				<!-- ********************************END OF MAIN BODY CONTENT HERE********************************	-->
			</div>	
						
			<?php include 'GEN_func_footer.php'; ?>
		
	</BODY>
</HTML>
<?php include 'secure/passcheck.php'; ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

    <HEAD>
		<?php include 'GEN_func_header.php'; ?>
	</HEAD>
	
    <BODY class = homescreen>
		<?php include 'GEN_func_header_bar.php'; ?>

						<!-- ********************************MAIN BODY CONTENT HERE********************************	-->

		
		<BR><BR>
		<div class="container">
			<div class="pagetitle">
				Welcome <?php echo $_SESSION['first_name'];?>!
				<BR>
				<?php echo "<img src='pic/user/" . $_SESSION['user_id'] . ".jpg' class='img-circle profilepic'>";?>
			</div>
			
			<div class='row'>
				<div class = 'centerdiv'>
					<span class = 'note_text bold_text'>tip: click on the menu bar above to get started.</span>
				</div>
			</div>
		</div>
	
				<!-- ********************************END OF MAIN BODY CONTENT HERE********************************	-->
	
		<?php include 'GEN_func_footer.php'; ?>
	</BODY>
</html>

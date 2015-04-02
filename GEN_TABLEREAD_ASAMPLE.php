<?php session_start(); ?>

<!DOCTYPE html>
	<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]--><!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]--><!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]--><!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

    <HEAD>
		<?php include 'GEN_FUNC_headhtml.php'; ?>

		<script type="text/javascript">	
			$(document).ready(function(){				
				// ********************************JQUERY CODE HERE******************************** //

					$.ajax(
						{
							url : 'GEN_TABLEREAD_DISPLAY.php',
							dataType : 'html',
							async: false,
							type : 'post',
							success : function(data){
								$('#pagecontent').html(data);
							}
						});
				
					//INITIAL CALL OF X-EDITABLE FOR IN-TABLE EDITING
					$.fn.editable.defaults.mode = 'popup';
					$('.a_editable').editable();		
					
					$('#button_create').click(function (e) {
						e.preventDefault()
						
						$('#modalcreatenew').modal('hide');
						
						var v_name = $('#inputname').val();
						var v_role = $('#inputrole').val(); 
						var v_status = $('#inputstatus').val();
						$.ajax(
							{
								url : 'GEN_TABLEREAD_CREATE_PROCESS.php',
								data: {inputname: v_name, inputrole: v_role, inputstatus: v_status},
								dataType : 'html',
								async: false,
								type : 'post',
								success : function(data){
									$('#pagecontent').html(data);
								}
							});
							
						$.fn.editable.defaults.mode = 'popup';
						$('.a_editable').editable();
						
					});					

					$(document).on("click",".button_delete",function(e){		
						e.preventDefault()
						
						var v_id = this.value;
						//alert (v_id);

						if (confirm('Are you sure you want to delete this record?')) {
							$.ajax(
								{
									url : 'GEN_TABLEREAD_DELETE.php',
									data: {inputid: v_id},
									dataType : 'html',
									async: false,
									type : 'post',
									success : function(data){
										$('#pagecontent').html(data);
									}
								});
								
							$.fn.editable.defaults.mode = 'popup';
							$('.a_editable').editable();

						} 
						
					});					
					
			});
		</script>
		
	</HEAD>
	
    <BODY id="homeAC">
        <!--[if lt IE 7]><p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]-->

			<div id="wrap">
				<?php include 'GEN_FUNC_headerbar.php'; ?>

				<!-- ********************************MAIN BODY CONTENT HERE********************************	-->

				
				<div id='contentblock'>
					<div class='container' id='pagecontent'>
						<!-- AJAX DATA HERE -->
					</div>
				</div>

				<?php include 'GEN_TABLEREAD_CREATE.php'; ?>
				
				<!-- ********************************END OF MAIN BODY CONTENT HERE********************************	-->
			</div>	
						
			<?php include 'GEN_FUNC_footer_js_google.php'; ?>
		
	</BODY>
</HTML>

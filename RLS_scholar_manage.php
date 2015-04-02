<?php session_start(); ?>

<!DOCTYPE html>
	<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]--><!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]--><!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]--><!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

    <HEAD>
		<?php include 'GEN_func_header.php'; ?>

		<script type="text/javascript">	
			$(document).ready(function(){				
				// ********************************JQUERY CODE HERE******************************** //

					$.ajax(
						{
							url : 'RLS_scholar_manage_display.php',
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
						
						//template code for removal
						//var v_name = $('#inputname').val();
						//var v_role = $('#inputrole').val(); 
						//var v_status = $('#inputstatus').val();
						
						var v_first_name = $('#inputfirstname').val();
						var v_last_name = $('#inputlastname').val();
						var v_scholar_pic = $('#inputscholarpic').val();
						var v_scholar_level = $('#inputscholarlevel').val();
						var v_scholar_status = $('#inputscholarstatus').val();
						var v_scholar_area = $('#inputscholararea').val();
						
						$.ajax(
							{
								url : 'RLS_scholar_manage_create_process.php',
								//template code for removal
								//data: {inputname: v_name, inputrole: v_role, inputstatus: v_status},
								data: {inputfirstname: v_first_name, inputlastname: v_last_name, inputscholarpic: v_scholar_pic, inputscholarlevel: v_scholar_level, inputscholarstatus: v_scholar_status, inputscholararea: v_scholar_area},
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
									url : 'RLS_scholar_manage_delete.php',
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
				<?php include 'GEN_func_header_bar_RLS.php'; ?>

				<!-- ********************************MAIN BODY CONTENT HERE********************************	-->

				<div class="pagetitle">
					manage scholar data
				</div>
				
				<div id='contentblock'>
					<div class='container' id='pagecontent'>
						<!-- AJAX DATA HERE -->
					</div>
				</div>

				<?php include 'RLS_scholar_manage_create.php'; ?>
				
				<!-- ********************************END OF MAIN BODY CONTENT HERE********************************	-->
			</div>	
						
			<?php include 'GEN_func_footer.php'; ?>
		
	</BODY>
</HTML>

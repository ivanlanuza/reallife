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
							url : 'RLS_site_access_display.php',
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
						
						var v_user_pic = $('#inputuserpic').val();
						var v_user_first_name = $('#inputuserfirstname').val();
						var v_user_last_name = $('#inputuserlastname').val();
						var v_user_email = $('#inputuseremail').val();
						var v_user_access_type = $('#inputuseraccesstype').val();
						var v_user_status = $('#inputuserstatus').val();
						var v_user_area = $('#inputuserarea').val();
						
						$.ajax(
							{
								url : 'RLS_site_access_create_process.php',
								//template code for removal
								//data: {inputname: v_name, inputrole: v_role, inputstatus: v_status},
								data: {inputuserfirstname: v_user_first_name, inputuserlastname: v_user_last_name, inputuserpic: v_user_pic, inputuseraccesstype: v_user_access_type, inputuseremail: v_user_email, inputuserstatus: v_user_status, inputuserarea: v_user_area},
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
									url : 'RLS_site_access_delete.php',
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
					manage user login data
				</div>
				
				<div id='contentblock'>
					<div class='container' id='pagecontent'>
						<!-- AJAX DATA HERE -->
					</div>
				</div>

				<?php include 'RLS_site_access_create.php'; ?>
				
				<!-- ********************************END OF MAIN BODY CONTENT HERE********************************	-->
			</div>	
						
			<?php include 'GEN_func_footer.php'; ?>
		
	</BODY>
</HTML>

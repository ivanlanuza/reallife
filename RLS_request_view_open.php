<?php include 'secure/passcheck.php'; ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

    <HEAD>
		<?php include 'GEN_func_header.php'; ?>
		
		
		<script type="text/javascript">	
			$(document).ready(function(){				
				
				//INITIAL LOAD OF TABLE DATA
					$.ajax(
						{
							url : 'RLS_request_view_open_process.php',
							dataType : 'html',
							async: false,
							type : 'post',
							success : function(data){
								$('#pagecontent').html(data);
							}
						});
					
					$('#approved').addClass("in active");
					
				//FUNCTION TO ACTIVATE THE TABS
				$('#requestsdisplaytab li:eq(0) a').click(function (e) {
					e.preventDefault()
					$(this).tab('show')
				})
				$('#requestsdisplaytab li:eq(1) a').click(function (e) {
					e.preventDefault()
					$(this).tab('show')
				})
				
				//FUNCTION TO DELETE ENTRIES
				$(document).on("click",".button_delete",function(e){		
					e.preventDefault()
						
					var v_id = this.value;
					var v_head = v_id.substring(v_id.lastIndexOf("h")+1,v_id.lastIndexOf("i"));
					var v_item = v_id.substring(v_id.lastIndexOf("i")+1,v_id.lastIndexOf("e"));
					var v_user = v_id.substring(v_id.lastIndexOf("e")+1,v_id.lastIndexOf("u"));
					//alert(v_head + v_item);

					if (confirm('Are you sure you want to delete this record?')) 
						{
							$.ajax(
								{
									url : 'AC_request_delete.php',
									data: {head:v_head,item:v_item,user:v_user},
									dataType : 'html',
									async: false,
									type : 'post',
									success : function(data){
										$('#pagecontent').html(data);
									}
								});
							$('#open').addClass("in active");
					}	 						
				});									

				//FUNCTION TO ADD ATTACHMENT
				$(document).on("click",".button_attach",function(e){		
					e.preventDefault()
						
					var v_id = this.value;
					var v_head = v_id.substring(v_id.lastIndexOf("h")+1,v_id.lastIndexOf("i"));
					var v_item = v_id.substring(v_id.lastIndexOf("i")+1,v_id.lastIndexOf("e"));
					var v_user = v_id.substring(v_id.lastIndexOf("e")+1,v_id.lastIndexOf("u"));
					var v_file = v_head + "-" + v_item;
					//alert(v_head + v_item);

					$('#record_id_modal').val(v_file);
					$('#record_id_head').val(v_head);
					$('#record_id_item').val(v_item);

					$('#myModal').modal();
					
				});								
				
				//FUNCTION TO COMPLETE ENTRIES
				$(document).on("click",".button_complete",function(e){		
					e.preventDefault()
						
					var v_id = this.value;
					var v_head = v_id.substring(v_id.lastIndexOf("h")+1,v_id.lastIndexOf("i"));
					var v_item = v_id.substring(v_id.lastIndexOf("i")+1,v_id.lastIndexOf("e"));
					var v_tab = v_id.substring(v_id.lastIndexOf("e")+1,v_id.lastIndexOf("c"));
					var v_user = v_id.substring(v_id.lastIndexOf("c")+1,v_id.lastIndexOf("t"));

					//alert(v_head + v_item);

					
					$.ajax(
							{
									url : 'AC_request_complete.php',
									data: {head:v_head,item:v_item,curruser:v_user},
									dataType : 'html',
									async: false,
									type : 'post',
									success : function(data){
										$('#pagecontent').html(data);
									}
							});		 			
					
					$('#open').removeClass("in active");
					$('#unapproved').addClass("in active");					
				});					
				
			});
		</script>
		
	</HEAD>
	
    <BODY>
		<?php include 'GEN_func_header_bar_RLS.php'; ?>

		<div class="pagetitle">
			all approved requests
		</div>

		
		<div class="container">
			<div class = "row" id = "requestsdata">
				<ul class="nav nav-tabs" id="requestsdisplaytab">
					<li class="active"><a href="#approved">Approved Requests</a></li>
					<li><a href="#unapproved">Unapproved Requests</a></li>
				</ul>		
			</div>
						
			<div class = "row">
				<div id='pagecontent'>
					<DIV id="requesttabcontent">
						<img src="img/loading.gif">  loading data...
					</div>
					<!-- JQUERY AJAX CONTENT GOES HERE -->
				</div>
			</div>
	
			
		</div><!-- /.container -->
	
	
	
		<?php include 'GEN_func_footer.php'; ?>
	</BODY>
</html>

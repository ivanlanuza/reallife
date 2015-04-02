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
							url : 'RLS_request_view_completed_process.php',
							dataType : 'html',
							async: false,
							type : 'post',
							success : function(data){
								$('#pagecontent').html(data);
							}
						});
					
					$('#open').addClass("in active");
					
				//FUNCTION TO ACTIVATE THE TABS
				$('#requestsdisplaytab li:eq(0) a').click(function (e) {
					e.preventDefault()
					$(this).tab('show')
				})
				
				//FUNCTION TO SHOW HISTORY
				$(document).on("click",".button_history",function(e){		
					e.preventDefault()
						
					var v_id = this.value;
					var v_head = v_id.substring(v_id.lastIndexOf("h")+1,v_id.lastIndexOf("i"));
					var v_item = v_id.substring(v_id.lastIndexOf("i")+1,v_id.lastIndexOf("e"));
					//alert(v_head + v_item);
					
					$.ajax(
						{
							url : 'RLS_request_view_complete_modal.php',
							dataType : 'html',
							data: {head:v_head,item:v_item},
							async: false,
							type : 'post',
							success : function(data){
								$('#historycontent').html(data);
							}
						});
						

				});					
				
			});
		</script>
		
	</HEAD>
	
    <BODY>
		<?php include 'GEN_func_header_bar_RLS.php'; ?>

		<div class="pagetitle">
			all completed requests
		</div>

		
		<div class="container">
			<div class = "row" id = "requestsdata">
				<ul class="nav nav-tabs" id="requestsdisplaytab">
					<li class="active"><a href="#completed">Completed Requests</a></li>
				</ul>		
			</div>
						
			<div class = "row">
				<div id="pagecontent">
					<DIV id="requesttabcontent">
						<img src="img/loading.gif">  loading data...
					</div>
					<!-- JQUERY AJAX CONTENT GOES HERE -->
				</div>
			</div>
	
			<!-- Modal to show history view-->
			<div class="modal fade" id="historymodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="myModalLabel">View Request History</h4>
						</div>
						<div class="modal-body">
							<div id=historycontent></div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-success btn" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>	

	
		</div><!-- /.container -->
	
		<?php include 'GEN_func_footer.php'; ?>
	</BODY>
</html>

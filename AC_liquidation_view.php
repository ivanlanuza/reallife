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
							url : 'AC_liquidation_view_process.php',
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
								
				//FUNCTION TO ADD ATTACHMENT
				$(document).on("click",".button_attach",function(e){		
					e.preventDefault()
						
					var v_id = this.value;

					$('#record_id_modal').val(v_id);

					$('#myModal').modal();
					
				});								
			});
		</script>
		
	</HEAD>
	
    <BODY>
		<?php include 'GEN_func_header_bar.php'; ?>

		<div class="pagetitle">
			my cash flow
		</div>

		
		<div class="container">
			<div class = "row" id = "requestsdata">
				<ul class="nav nav-tabs" id="requestsdisplaytab">
					<li class="active"><a href="#completed">Expenses & Deposits</a></li>
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
	
		</div><!-- /.container -->

		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<form action="AC_liquidation_upload.php" method="post" enctype="multipart/form-data">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-text" id="myModalLabel">Upload attachment</h4>
						</div>
						 
						<div class="modal-body">
							<input type="file" class="btnselector" name="file" id="file"><br>
							<span class="smallital">Note: This form only accepts *.JPG or *.JPEG image files.  Maximum file size 2MB.</span>
							<input type="hidden" id="record_id_modal" name="record_id">
						</div>
						
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
							<input type="submit" class="btn btn-primary" name="submit" value="upload">
						</div>
					</form>						
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		
		<?php include 'GEN_func_footer.php'; ?>
	</BODY>
</html>

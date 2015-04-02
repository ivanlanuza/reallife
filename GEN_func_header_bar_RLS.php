		<nav class="navbar navbar_custom navbar-fixed-top" role="navigation">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>      
					
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li class=""><a href="RLS_home.php"><i class="fa fa-home"></i></a></li>
						
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Requests <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="RLS_request_approve.php">Approve Request</a></li>
									<li><a href="RLS_request_view_open.php">View Approved Requests</a></li>
									<li><a href="RLS_request_finance.php">Create Finance Submission</a></li>
									<li><a href="RLS_request_view_completed.php">View Completed Requests</a></li>
									<li class="divider"></li>
									<li><a href="RLS_request_create.php">Create New Request</a></li>
								</ul>
						</li>
						
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Scholars <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="RLS_scholar_manage.php">Manage Scholar Data</a></li>
									<li><a href="RLS_scholar_spend.php">View Scholar Spending</a></li>
								</ul>
						</li>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Staff Tasks <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="RLS_liquidation_view.php">View AC Spending Report</a></li>
									<li><a href="RLS_liquidation_create.php">Deposit to ACs</a></li>
									<li class="divider"></li>
									<li><a href="RLS_site_access.php">Provide Site Access</a></li>
									<li><a href="RLS_site_config.php">Maintain Site Defaults</a></li>
								</ul>
						</li>					
					</ul>

					<ul class="nav navbar-nav navbar-right">
								<?php include 'secure/include_namelogout.php' ?>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>

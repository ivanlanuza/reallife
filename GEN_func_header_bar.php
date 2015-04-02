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
						<li class=""><a href="AC_home.php"><i class="fa fa-home"></i></a></li>
						
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Requests <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="AC_request_create.php">Create New Request</a></li>
									<li><a href="AC_request_view_open.php">View My Active Requests</a></li>
									<li><a href="AC_request_view_completed.php">View My Completed Requests</a></li>
								</ul>
						</li>
						
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Scholars <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="AC_scholar_spend.php">View My Scholar Spending</a></li>
								</ul>
						</li>

						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Liquidation <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="AC_liquidation_create.php">Input My Expenses</a></li>
									<li><a href="AC_liquidation_view.php">View My Spending Report</a></li>
								</ul>
						</li>					
					</ul>

					<ul class="nav navbar-nav navbar-right">
								<?php include 'secure/include_namelogout.php' ?>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>

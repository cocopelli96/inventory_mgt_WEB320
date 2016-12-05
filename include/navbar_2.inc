<?php

echo '
<!-- Navbar Start -->
<div id="nav" class="navbar navbar-default pull-left">
	<div class="container">
		<div class="navbar-header hidden-sm hidden-md hidden-lg">
			<a class="navbar-brand" href="#">Introduction</a>
					
			<button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#navbar-list" aria-expanded="false">
				<span class="sr-only">Toggle Navigation</span>
				<span class="fa fa-bars"></span>
			</button>
		</div>
				
		<div id="navbar-list" class="navbar-collapse collapse navbar-left" aria-expanded="false">
			<ul class="nav navbar-nav list-group">
				<li class="';

if ($page == 'landing-mgt') {
	echo 'active';
}

echo 						'">
					<a href="../index.php">Home</a>
				</li>';
				
if ($login == true)
{
	echo '		<li class="';

	if ($page == 'product') {
		echo 'active';
	}

	echo 					'">
					<a href="products_mgt.php">Products</a>
				</li>
				<li class="';

	if ($page == 'part') {
		echo 'active';
	}

	echo 					'">
					<a href="parts_mgt.php">Parts</a>
				</li>
				<li class="';

	if ($page == 'vendor') {
		echo 'active';
	}

	echo 					'">
					<a href="vendors_mgt.php">Vendors</a>
				</li>
				<li class="';

	if ($page == 'employee') {
		echo 'active';
	}

	echo 					'">
					<a href="employees_mgt.php">Employees</a>
				</li>
				<li class="';

	if ($page == 'order') {
		echo 'active';
	}

	echo 					'">
					<a href="order_mgt.php">Orders</a>
				</li>';
}

echo '		</ul>
		</div>
		
		<div id="navbar-list-login" class="navbar-collapse collapse navbar-right" aria-expanded="false">
			<ul class="nav navbar-nav list-group">';

if ($login == true)
{
	echo '		<li class="';

	if ($page == 'account') {
		echo 'active';
	}

	echo 					'">
					<a href="account.php">Account</a>
				</li>';
}

if ($login == false)
{
	echo '		<li class="';

	if ($page == 'login') {
		echo 'active';
	}

	echo 					'">
					<a href="login.php">Login</a>
				</li>';
}
else
{
	echo '		<li class="';

	if ($page == 'login') {
		echo 'active';
	}

	echo 					'">
					<a href="logout.php">Logout</a>
				</li>';
}
				
echo '		</ul>
		</div>
		
		<!--
		<form class="navbar-form navbar-right hidden-xs">
        	<div class="form-group">
          		<input type="text" class="form-control" placeholder="Search">
        	</div>
        	<button type="submit" class="fa fa-search btn btn-default"></button>
      	</form>
      	-->
	</div>
</div>
<!-- Navbar End -->
';

?>
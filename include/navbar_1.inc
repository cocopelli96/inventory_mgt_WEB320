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
				<li class="active">
					<a href="index.php">Home</a>
				</li>
				<li>
					<a href="./php/products_mgt.php">Products</a>
				</li>
				<li>
					<a href="./php/parts_mgt.php">Parts</a>
				</li>
				<li>
					<a href="./php/vendors_mgt.php">Vendors</a>
				</li>
				<li>
					<a href="./php/employees_mgt.php">Employees</a>
				</li>
			</ul>
		</div>
		
		<div id="navbar-list-login" class="navbar-collapse collapse navbar-right" aria-expanded="false">
			<ul class="nav navbar-nav list-group">
				<li>
					<a href="./php/account.php">Account</a>
				</li>
				<li>
					<a href="./php/login.php">Login</a>
				</li>
			</ul>
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
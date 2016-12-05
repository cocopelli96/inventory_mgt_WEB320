<?php

require '../include/session.inc';

$page = 'login';

$_SESSION['previous_page'] = 'login.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Login</title>';
include '../include/banner.inc';
include '../include/navbar_2.inc';

// Open the database
if (!mysqli_select_db($link, $db5)){
	die('Could not connect: ' . mysqli_error($link));
    exit();
}

$sql = 'select Product.prod_id, prod_name, prod_descript, img_loc, prod_quant, prod_stock, prod_alt_date from Product, ProductInventory where Product.prod_id = ProductInventory.prod_id;';
$results = mysqli_query($link, $sql);
$sql2 = 'select Part.part_id, part_name, vid, part_quant, part_stock, part_alt_date from Part, PartInventory where Part.part_id = PartInventory.part_id;';
$results2 = mysqli_query($link, $sql2);

echo '
<!-- Content Start -->
<div id="content" class="pull-left">';

if (isset($_GET['login']) and $_GET['login'] == "false")
{
	echo '<div class="alert alert-danger" role="alert">User name or password was not valid.</div>';
}

echo '
<form name="login" action="login_auth.php" method="post">
	<table id="login" class="table-mgt">
		<thead>
			<tr>
				<th colspan="2"><h1>Login</h1></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<label for="uname">User Name:</label>
				</td>
				<td>
					<input name="uname" id="uname" size="45" class="form-control" />
				</td>
			</tr>
			<tr>
				<td>
					<label for="pass">Password:</label>
				</td>
				<td>
					<input type="password" name="pass" id="pass" size="45" class="form-control" />
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<button class="btn btn-primary">Login</button>
					<button class="btn btn-default">Cancel</button>
					<button class="btn btn-success">New User</button>
				</td>
			</tr>
		</tbody>
	</table>
</form>

</div>
<!-- Content End -->
';

mysqli_close($link);

include '../include/footer.inc';

?>
<?php

require '../include/session.inc';

$page = 'login';

$_SESSION['previous_page'] = 'login.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Login</title>';
include '../include/banner.inc';
include '../include/navbar_2.inc';

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
					<button type="submit" class="btn btn-primary">Login</button>
					<button type="reset" class="btn btn-default">Cancel</button>
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
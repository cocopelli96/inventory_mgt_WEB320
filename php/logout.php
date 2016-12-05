<?php

$page = 'login';

require '../include/mysql.inc';
require '../include/session.inc';

if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time()-1000);
        setcookie($name, '', time()-1000, '/');
    }
}
session_unset();
session_destroy();
$login = false;

include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Login</title>';
include '../include/banner.inc';
include '../include/navbar_2.inc';

echo '
<!-- Content Start -->
<div id="content" class="pull-left">

	<table id="login" class="table-mgt">
		<thead>
			<tr>
				<th><h1>Logout</h1></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>You have been logged out.</td>
			</tr>
		</tbody>
	</table>

</div>
<!-- Content End -->
';

mysqli_close($link);

include '../include/footer.inc';

?>
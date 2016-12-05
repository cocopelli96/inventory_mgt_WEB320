<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: login.php');
} else {

$page = 'landing-cust';

$_SESSION['previous_page'] = 'landing_cust.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store</title>';
include '../include/banner.inc';
include '../include/navbar_4.inc';

echo '
<!-- Content Start -->
<div id="content" class="pull-left">

	<h1>Customer Landing</h1>
	<p>Sorry for the inconvience the site is currently down for maintance.</p>

</div>
<!-- Content End -->
';

mysqli_close($link);

include '../include/footer.inc';

}

?>
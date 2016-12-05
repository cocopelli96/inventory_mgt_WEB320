<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: ../php/login.php');
} else if ($_SESSION['previous_page'] != 'vendors_mgt.php' and $_SESSION['previous_page'] != 'delete_reps.php') {
	header('Location: ../index.php');
} else {

$page = 'vendor';

$_SESSION['previous_page'] = 'delete_reps.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Vendor Rep Delete</title>';
include '../include/banner.inc';
include '../include/navbar_3.inc';

if (isset($_POST['delete_rep_input']))
{
	// Open the database
	if (!mysqli_select_db($link, $db4)){
		die('Could not connect: ' . mysqli_error($link));
		exit();
	}
	
	$sql1 = 'delete from VendorContact where rep_id = '. $_POST['delete_rep_input'];
	$sql2 = 'delete from VendorRep where rep_id = '. $_POST['delete_rep_input'];
	$sql3 = 'delete from Rep where rep_id = '. $_POST['delete_rep_input'];
	
	$results1 = mysqli_query($link, $sql1);
	$results2 = mysqli_query($link, $sql2);
	$results3 = mysqli_query($link, $sql3);

	echo '
	<!-- Content Start -->
	<div id="content" class="pull-left">
		<h1>Delete Vendor</h1>
		<p>The vendor representative has been deleted.</p>
		<a class="btn btn-default" href="../php/vendors_mgt.php">Return</a>
	</div>
	<!-- Content End -->';
}
else
{
	echo '
	<!-- Content Start -->
	<div id="content" class="pull-left">
		<h1>Delete Vendor</h1>
		<p>There was an issue deleting the vendor representative.</p>
		<a class="btn btn-default" href="../php/vendors_mgt.php">Return</a>
	</div>
	<!-- Content End -->';
}

mysqli_close($link);

include '../include/footer.inc';

}

?>
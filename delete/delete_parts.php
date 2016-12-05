<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: ../php/login.php');
} else if ($_SESSION['previous_page'] != 'parts_mgt.php' and $_SESSION['previous_page'] != 'delete_parts.php') {
	header('Location: ../index.php');
} else {

$page = 'part';

$_SESSION['previous_page'] = 'delete_parts.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Part Delete</title>';
include '../include/banner.inc';
include '../include/navbar_3.inc';

if (isset($_POST['delete_part_input']))
{
	// Open the database
	if (!mysqli_select_db($link, $db5)){
		die('Could not connect: ' . mysqli_error($link));
		exit();
	}

	$sql1 = 'delete from ProductPart where part_id = '. $_POST['delete_part_input'];
	$sql2 = 'delete from PartInventory where part_id = '. $_POST['delete_part_input'];
	$sql3 = 'delete from Part where part_id = '. $_POST['delete_part_input'];

	$results1 = mysqli_query($link, $sql1);
	$results2 = mysqli_query($link, $sql2);
	$results3 = mysqli_query($link, $sql3);

	echo '
	<!-- Content Start -->
	<div id="content" class="pull-left">
		<h1>Delete Part</h1>
		<p>The part has been deleted.</p>
		<a class="btn btn-default" href="../php/parts_mgt.php">Return</a>
	</div>
	<!-- Content End -->';	
}
else
{
	echo '
	<!-- Content Start -->
	<div id="content" class="pull-left">
		<h1>Delete Part</h1>
		<p>There was an issue deleting the part.</p>
		<a class="btn btn-default" href="../php/parts_mgt.php">Return</a>
	</div>
	<!-- Content End -->';
}

mysqli_close($link);

include '../include/footer.inc';

}

?>
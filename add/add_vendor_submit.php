<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: ../php/login.php');
} else if ($_SESSION['previous_page'] != 'add_vendor_form.php' and $_SESSION['previous_page'] != 'add_vendor_submit.php') {
	header('Location: ../index.php');
} else {

$page = 'vendor';

$_SESSION['previous_page'] = 'add_vendor_submit.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Vendor Add</title>';
include '../include/banner.inc';
include '../include/navbar_3.inc';

// Open the database
if (!mysqli_select_db($link, $db4)){
	die('Could not connect: ' . mysqli_error($link));
	exit();
}

$vname = htmlspecialchars(stripslashes($_POST['vname']));

echo '
<!-- Content Start -->
<div id="content" class="pull-left">
	<h1>Confirm Add Vendor</h1>';
	
$updated = false;
$vid = 0;
if (isset($vname))
{
	$sql = 'select Vendor.vid, vname from Vendor;';
	$results = mysqli_query($link, $sql);
	
	while ($row = mysqli_fetch_array($results))
	{
		$vid++;
		if ($vid != $row['vid'])
		{
			break;
		}
	}
	
	if ($vid == mysqli_num_rows($results))
	{
		$vid++;
	}
	
	$update = 'insert into Vendor values('. $vid .',"'. $vname .'");';
	$update_results = mysqli_query($link, $update);
	
	if ($update_results == true)
	{
		echo '<p>Vendor added.</p>';
		$updated = true;
	} else {
		echo '<p>The vendor was not added.</p>';
	}
}

if ($updated == false)
{
	echo '<p>Vendor was not added.</p>';
}

echo '
	<a class="btn btn-default pull-right" href="../php/vendors_mgt.php">Return</a>
</div>
<!-- Content End -->';

mysqli_close($link);

include '../include/footer.inc';

}

?>
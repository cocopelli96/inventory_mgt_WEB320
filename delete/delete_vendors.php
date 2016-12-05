<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: ../php/login.php');
} else if ($_SESSION['previous_page'] != 'vendors_mgt.php' and $_SESSION['previous_page'] != 'delete_vendors.php') {
	header('Location: ../index.php');
} else {

$page = 'vendor';

$_SESSION['previous_page'] = 'delete_vendors.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Vendor Delete</title>';
include '../include/banner.inc';
include '../include/navbar_3.inc';

if (isset($_POST['delete_vendor_input']))
{

	// Open the database
	if (!mysqli_select_db($link, $db5)){
		die('Could not connect: ' . mysqli_error($link));
		exit();
	}
	
	$sql0 = 'select part_id, vid, part_name from Part where vid = '. $_POST['delete_vendor_input'];
	$results0 = mysqli_query($link, $sql0);
	
	$part_count = 0;
	while ($row0 = mysqli_fetch_array($results0))
	{
		if ($row0['vid'] == $_POST['delete_vendor_input'])
		{
			$part_count++;
		}
	}
	
	// Open the database
	if (!mysqli_select_db($link, $db4)){
		die('Could not connect: ' . mysqli_error($link));
		exit();
	}
	
	$sql = 'select vid, rep_id from VendorRep where vid = '. $_POST['delete_vendor_input'];
	$results = mysqli_query($link, $sql);
	
	$count = 0;
	while ($row = mysqli_fetch_array($results))
	{
		if ($row['vid'] == $_POST['delete_vendor_input'])
		{
			$count++;
		}
	}
	
	if ($count == 0 and $part_count == 0)
	{
		$sql1 = 'delete from Vendor where vid = '. $_POST['delete_vendor_input'];
		
		$results1 = mysqli_query($link, $sql1);
	
		echo '
		<!-- Content Start -->
		<div id="content" class="pull-left">
			<h1>Delete Vendor</h1>
			<p>The vendor has been deleted.</p>
			<a class="btn btn-default" href="../php/vendors_mgt.php">Return</a>
		</div>
		<!-- Content End -->';
	}
	else if ($count > 0)
	{
		echo '
		<!-- Content Start -->
		<div id="content" class="pull-left">
			<h1>Delete Vendor</h1>
			<p>You cannot delete this vendor as there are representatives for the vendor.</p>
			<a class="btn btn-default" href="../php/vendors_mgt.php">Return</a>
		</div>
		<!-- Content End -->';
	}
	else if ($part_count > 0)
	{
		echo '
		<!-- Content Start -->
		<div id="content" class="pull-left">
			<h1>Delete Vendor</h1>
			<p>You cannot delete this vendor as there are parts that the vendor supplies.</p>
			<a class="btn btn-default" href="../php/vendors_mgt.php">Return</a>
		</div>
		<!-- Content End -->';
	}
}
else
{
	echo '
	<!-- Content Start -->
	<div id="content" class="pull-left">
		<h1>Delete Vendor</h1>
		<p>There was an issue deleting the vendor.</p>
		<a class="btn btn-default" href="../php/vendors_mgt.php">Return</a>
	</div>
	<!-- Content End -->';
}

mysqli_close($link);

include '../include/footer.inc';

}

?>
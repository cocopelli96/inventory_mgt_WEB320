<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: ../php/login.php');
} else if ($_SESSION['previous_page'] != 'add_rep_form.php' and $_SESSION['previous_page'] != 'add_rep_submit.php') {
	header('Location: ../index.php');
} else {

$page = 'vendor';

$_SESSION['previous_page'] = 'add_rep_submit.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Vendor Rep Add</title>';
include '../include/banner.inc';
include '../include/navbar_3.inc';

// Open the database
if (!mysqli_select_db($link, $db4)){
	die('Could not connect: ' . mysqli_error($link));
	exit();
}

$rep_fn = htmlspecialchars(stripslashes($_POST['rep_fn']));
$rep_ln = htmlspecialchars(stripslashes($_POST['rep_ln']));
$vid = intval(htmlspecialchars(stripslashes($_POST['vid'])));
$rep_cid_11 = htmlspecialchars(stripslashes($_POST['rep_cid_11']));
$rep_cid_22 = htmlspecialchars(stripslashes($_POST['rep_cid_22']));

echo '
<!-- Content Start -->
<div id="content" class="pull-left">
	<h1>Confirm Add Vendor Rep</h1>';
	
$updated = false;
$rep_id = 0;
if (isset($rep_fn) and isset($rep_ln) and isset($vid))
{
	$sql = 'select Rep.rep_id, rep_fn, rep_ln from Rep;';
	$results = mysqli_query($link, $sql);
	
	while ($row = mysqli_fetch_array($results))
	{
		$rep_id++;
		if ($rep_id != $row['rep_id'])
		{
			break;
		}
	}
	
	if ($rep_id == mysqli_num_rows($results))
	{
		$rep_id++;
	}
	
	$update = 'insert into Rep values('. $rep_id .',"'. $rep_fn .'","'. $rep_ln .'");';
	$update2 = 'insert into VendorRep values('. $vid .','. $rep_id .');';
	$update_results = mysqli_query($link, $update);
	$update_results2 = mysqli_query($link, $update2);
	
	if ($update_results == true and $update_results2 == true)
	{
		echo '<p>Vendor Rep added.</p>';
		$updated = true;
	} else {
		echo '<p>The vendor rep was not added.</p>';
	}
}

if (isset($rep_cid_11) and isset($rep_id))
{
	$update = 'insert into VendorContact values('. $rep_id .',11,"'. $rep_cid_11 .'");';
	$update_results = mysqli_query($link, $update);
	
	if ($update_results == true)
	{
		echo '<p>Rep Contact added.</p>';
		$updated = true;
	} else {
		echo '<p>The vendor rep contact was not added.</p>';
	}
}

if (isset($rep_cid_22) and isset($rep_id))
{
	$update = 'insert into VendorContact values('. $rep_id .',22,"'. $rep_cid_22 .'");';
	$update_results = mysqli_query($link, $update);
	
	if ($update_results == true)
	{
		echo '<p>Rep Contact added.</p>';
		$updated = true;
	} else {
		echo '<p>The vendor rep contact was not added.</p>';
	}
}

if ($updated == false)
{
	echo '<p>Vendor Rep was not added.</p>';
}

echo '
	<a class="btn btn-default pull-right" href="../php/vendors_mgt.php">Return</a>
</div>
<!-- Content End -->';

mysqli_close($link);

include '../include/footer.inc';

}

?>
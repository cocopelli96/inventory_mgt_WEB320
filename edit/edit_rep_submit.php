<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: ../php/login.php');
} else if ($_SESSION['previous_page'] != 'edit_rep_form.php' and $_SESSION['previous_page'] != 'edit_rep_submit.php') {
	header('Location: ../index.php');
} else {

$page = 'vendor';

$_SESSION['previous_page'] = 'edit_rep_submit.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Vendor Rep Edit</title>';
include '../include/banner.inc';
include '../include/navbar_3.inc';

// Open the database
if (!mysqli_select_db($link, $db4)){
	die('Could not connect: ' . mysqli_error($link));
	exit();
}

$rep_fn = htmlspecialchars(stripslashes($_POST['rep_fn']));
$rep_ln = htmlspecialchars(stripslashes($_POST['rep_ln']));
$rep_id = intval(htmlspecialchars(stripslashes($_POST['rep_id'])));
$rep_cid_11 = htmlspecialchars(stripslashes($_POST['rep_cid_11']));
$rep_cid_22 = htmlspecialchars(stripslashes($_POST['rep_cid_22']));

echo '
<!-- Content Start -->
<div id="content" class="pull-left">
	<h1>Confirm Edit Vendor Rep</h1>';
	
$updated = false;
if (isset($rep_fn) and isset($rep_id))
{
	$sql = 'select Rep.rep_id, rep_fn, rep_ln from Rep;';
	$results = mysqli_query($link, $sql);
	
	while ($row = mysqli_fetch_array($results))
	{
		if ($row['rep_id'] == $rep_id and $row['rep_fn'] != $rep_fn)
		{
			$update = 'update Rep set rep_fn = "'. $rep_fn .'" where rep_id = '. $rep_id;
			$update_results = mysqli_query($link, $update);
			
			if ($update_results == true)
			{
				echo '<p>Rep First Name updated.</p>';
				$updated = true;
			} else {
				echo '<p>The vendor rep was not updated.</p>';
			}
		}
	}
}

if (isset($rep_ln) and isset($rep_id))
{
	$sql = 'select Rep.rep_id, rep_fn, rep_ln from Rep;';
	$results = mysqli_query($link, $sql);
	
	while ($row = mysqli_fetch_array($results))
	{
		if ($row['rep_id'] == $rep_id and $row['rep_ln'] != $rep_ln)
		{
			$update = 'update Rep set rep_ln = "'. $rep_ln .'" where rep_id = '. $rep_id;
			$update_results = mysqli_query($link, $update);
			
			if ($update_results == true)
			{
				echo '<p>Rep Last Name updated.</p>';
				$updated = true;
			} else {
				echo '<p>The vendor rep was not updated.</p>';
			}
		}
	}
}

if (isset($rep_cid_11) and isset($rep_id))
{
	$sql = 'select VendorContact.rep_id, rep_cid, rep_contact from VendorContact where VendorContact.rep_cid = 11;';
	$results = mysqli_query($link, $sql);
	
	while ($row = mysqli_fetch_array($results))
	{
		if ($row['rep_id'] == $rep_id and $row['rep_contact'] != $rep_cid_11)
		{
			$update = 'update VendorContact set rep_contact = "'. $rep_cid_11 .'" where rep_id = '. $rep_id .' and rep_cid = 11;';
			$update_results = mysqli_query($link, $update);
			
			if ($update_results == true)
			{
				echo '<p>Rep Contact updated.</p>';
				$updated = true;
			} else {
				echo '<p>The vendor rep contact was not updated.</p>';
			}
		}
	}
}

if (isset($rep_cid_22) and isset($rep_id))
{
	$sql = 'select VendorContact.rep_id, rep_cid, rep_contact from VendorContact where VendorContact.rep_cid = 22;';
	$results = mysqli_query($link, $sql);
	
	while ($row = mysqli_fetch_array($results))
	{
		if ($row['rep_id'] == $rep_id and $row['rep_contact'] != $rep_cid_22)
		{
			$update = 'update VendorContact set rep_contact = "'. $rep_cid_22 .'" where rep_id = '. $rep_id .' and rep_cid = 22;';
			$update_results = mysqli_query($link, $update);
			
			if ($update_results == true)
			{
				echo '<p>Rep Contact updated.</p>';
				$updated = true;
			} else {
				echo '<p>The vendor rep contact was not updated.</p>';
			}
		}
	}
}

if ($updated == false)
{
	echo '<p>Vendor Rep was not updated.</p>';
}

echo '
	<a class="btn btn-default pull-right" href="../php/vendors_mgt.php">Return</a>
</div>
<!-- Content End -->';

mysqli_close($link);

include '../include/footer.inc';

}

?>
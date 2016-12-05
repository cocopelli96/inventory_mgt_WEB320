<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: ../php/login.php');
} else if ($_SESSION['previous_page'] != 'add_address_form.php' and $_SESSION['previous_page'] != 'add_address_submit.php') {
	header('Location: ../index.php');
} else {

$page = 'account';

$_SESSION['previous_page'] = 'add_address_submit.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Account Address Add</title>';
include '../include/banner.inc';
include '../include/navbar_3.inc';

// Open the database
if (!mysqli_select_db($link, $db1)){
	die('Could not connect: ' . mysqli_error($link));
	exit();
}

$add_type = intval(htmlspecialchars(stripslashes($_POST['add_type'])));
$uid = intval(htmlspecialchars(stripslashes($_POST['uid'])));
$street = htmlspecialchars(stripslashes($_POST['street']));
$city = htmlspecialchars(stripslashes($_POST['city']));
$state = htmlspecialchars(stripslashes($_POST['state']));
$zip = htmlspecialchars(stripslashes($_POST['zip']));

echo '
<!-- Content Start -->
<div id="content" class="pull-left">
	<h1>Confirm Add Account Address</h1>';
	
$updated = false;
$aid = 0;
if (isset($add_type) and isset($uid) and isset($street) and isset($city) and isset($state) and isset($zip))
{
	$sql = 'select aid, street, city, state, zip from Address;';
	$results = mysqli_query($link, $sql);
	
	while ($row = mysqli_fetch_array($results))
	{
		$aid++;
		if ($aid != $row['aid']) {
			break;
		} else if ($street == $row['street'] and $city == $row['city'] and $state == $row['state'] and $zip == $row['zip']) {
			$aid = $row['aid'];
			break;
		}
	}
	
	if (mysqli_num_rows($results) == $aid)
	{
		$aid++;
	}
	
	$update = 'insert into Address values('. $aid .',"'. $street .'","'. $city .'","'. $zip .'","'. $state .'");';
	$update2 = 'insert into UserAddress values('. $uid .','. $add_type .','. $aid .');';
	$update_results = mysqli_query($link, $update);
	$update_results2 = mysqli_query($link, $update2);
	
	if ($update_results == true and $update_results2 == true)
	{
		echo '<p>Account Address added.</p>';
		$updated = true;
	} else {
		echo '<p>The account address was not added.</p>';
	}
}

if ($updated == false)
{
	echo '<p>Account address was not added.</p>';
}

echo '
	<a class="btn btn-default pull-right" href="../php/account.php">Return</a>
</div>
<!-- Content End -->';

mysqli_close($link);

include '../include/footer.inc';

}

?>
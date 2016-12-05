<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: ../php/login.php');
} else if ($_SESSION['previous_page'] != 'add_contact_form.php' and $_SESSION['previous_page'] != 'add_contact_submit.php') {
	header('Location: ../index.php');
} else {

$page = 'account';

$_SESSION['previous_page'] = 'add_contact_submit.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Account Contact Add</title>';
include '../include/banner.inc';
include '../include/navbar_3.inc';

// Open the database
if (!mysqli_select_db($link, $db1)){
	die('Could not connect: ' . mysqli_error($link));
	exit();
}

$email = htmlspecialchars(stripslashes($_POST['email']));
$cont_id = intval(htmlspecialchars(stripslashes($_POST['cont_id'])));
$uid = intval(htmlspecialchars(stripslashes($_POST['uid'])));
$area_code = intval(htmlspecialchars(stripslashes($_POST['area_code'])));
$mid_num = intval(htmlspecialchars(stripslashes($_POST['mid_num'])));
$end_num = intval(htmlspecialchars(stripslashes($_POST['end_num'])));

echo '
<!-- Content Start -->
<div id="content" class="pull-left">
	<h1>Confirm Add Account Contact</h1>';
	
$updated = false;
if (isset($cont_id) and isset($uid) and isset($email) and ($cont_id == 4 or $cont_id == 5))
{
	$update = 'insert into UserContact values('. $uid .','. $cont_id .');';
	$update2 = 'insert into Email values('. $uid .','. $cont_id .',"'. $email .'");';
	$update_results = mysqli_query($link, $update);
	$update_results2 = mysqli_query($link, $update2);
	
	if ($update_results == true and $update_results2 == true)
	{
		echo '<p>Account Contact Email added.</p>';
		$updated = true;
	} else {
		$delete = 'delete from UserContact where uid = '. $uid .' and cont_id = '. $cont_id;
		$delete_results = mysqli_query($link, $delete);
		echo '<p>The account contact was not added.</p>';
	}
}

if (isset($uid) and isset($cont_id) and isset($area_code) and isset($mid_num) and isset($end_num) and ($cont_id == 1 or $cont_id == 2 or $cont_id == 3))
{
	$update = 'insert into UserContact values('. $uid .','. $cont_id .');';
	$update2 = 'insert into Phone values('. $uid .','. $cont_id .',"'. $area_code .'","'. $mid_num .'","'. $end_num .'");';
	$update_results = mysqli_query($link, $update);
	$update_results2 = mysqli_query($link, $update2);
	
	if ($update_results == true and $update_results2 == true)
	{
		echo '<p>Account Contact Phone Number added.</p>';
		$updated = true;
	} else {
		$delete = 'delete from UserContact where uid = '. $uid .' and cont_id = '. $cont_id;
		$delete_results = mysqli_query($link, $delete);
		echo '<p>The acount contact was not added.</p>';
	}
}

if ($updated == false)
{
	echo '<p>Account contact was not added.</p>';
}

echo '
	<a class="btn btn-default pull-right" href="../php/account.php">Return</a>
</div>
<!-- Content End -->';

mysqli_close($link);

include '../include/footer.inc';

}

?>
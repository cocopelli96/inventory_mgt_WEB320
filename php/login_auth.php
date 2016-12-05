<?php

session_start();
session_regenerate_id(true);

$page = 'login';

require '../include/mysql.inc';

$uname = isset($_POST['uname']) ? $_POST['uname'] : '';
$pass = isset($_POST['pass']) ? $_POST['pass'] : '';

if ($uname != '')
{
	// Open the database
	if (!mysqli_select_db($link, $db1)){
		die('Could not connect: ' . mysqli_error($link));
		exit();
	}

	$sql = 'select uid, uname, upass, Permissions.perm_id, perm_descript from UserAccount, Permissions where Permissions.perm_id = UserAccount.Perm_id;';
	$results = mysqli_query($link, $sql);

	$valid = false;
	while ($row = mysqli_fetch_array($results))
	{
		if ($row['uname'] == $uname and $pass == $row['upass']) {
			$valid = true;
			$uid = $row['uid'];
			$perm_id = $row['perm_id'];
		}
	}
	
	if ($valid == false)
	{
		session_unset();
		session_destroy();
		header('Location: login.php?login=false');
	}
	else
	{	
		$_SESSION['uname'] = $uname;
		$_SESSION['uid'] = $uid;
		$_SESSION['perm_id'] = $perm_id;
		$_SESSION['previous_page'] = 'login_auth.php';
		
		if ($perm_id == 222 or $perm_id == 333 or $perm_id == 444) {
			header('Location: landing_mgt.php');
		} else {
			header('Location: landing_cust.php');
		}
	}
}
else
{
	session_unset();
	session_destroy();
	header('Location: login.php?login=false');
}

mysqli_close($link);

?>
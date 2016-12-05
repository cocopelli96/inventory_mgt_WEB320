<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: ../php/login.php');
} else if ($_SESSION['previous_page'] != 'account.php' and $_SESSION['previous_page'] != 'delete_address.php') {
	header('Location: ../index.php');
} else {

$page = 'account';

$_SESSION['previous_page'] = 'delete_address.php';
		
require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Account Address Delete</title>';
include '../include/banner.inc';
include '../include/navbar_3.inc';

if (isset($_POST['delete_type_input']) and isset($_POST['delete_add_user_input']) and isset($_POST['delete_address_input']))
{

	// Open the database
	if (!mysqli_select_db($link, $db1)){
		die('Could not connect: ' . mysqli_error($link));
		exit();
	}
	
	$sql = 'select uid, add_type_id from UserAddress where UserAddress.uid = '. $_POST['delete_add_user_input'];
	$results = mysqli_query($link, $sql);
	
	$count = 0;
	while ($row = mysqli_fetch_array($results))
	{
		if ($row['uid'] == $_POST['delete_add_user_input'])
		{
			$count++;
		}
	}
	
	if ($count > 1)
	{
		$sql1 = 'delete from UserAddress where uid = '. $_POST['delete_add_user_input'] .' and add_type_id = '. $_POST['delete_type_input'] .' and aid = '. $_POST['delete_address_input'];
			
		$results1 = mysqli_query($link, $sql1);
		
		echo '
		<!-- Content Start -->
		<div id="content" class="pull-left">
			<h1>Delete Address</h1>
			<p>The address has been deleted.</p>
			<a class="btn btn-default" href="../php/account.php">Return</a>
		</div>
		<!-- Content End -->';
	}
	else
	{
		echo '
		<!-- Content Start -->
		<div id="content" class="pull-left">
			<h1>Delete Address</h1>
			<p>The address cannot be deleted because there is no other address for the user.</p>
			<a class="btn btn-default" href="../php/account.php">Return</a>
		</div>
		<!-- Content End -->';
	}	
}
else
{
	echo '
	<!-- Content Start -->
	<div id="content" class="pull-left">
		<h1>Delete Address</h1>
		<p>There was an issue deleting the address.</p>
		<a class="btn btn-default" href="../php/account.php">Return</a>
	</div>
	<!-- Content End -->';
}

mysqli_close($link);

include '../include/footer.inc';

}

?>
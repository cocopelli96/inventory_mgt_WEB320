<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: ../php/login.php');
} else if ($_SESSION['previous_page'] != 'account.php' and $_SESSION['previous_page'] != 'delete_contact.php') {
	header('Location: ../index.php');
} else {

$page = 'account';

$_SESSION['previous_page'] = 'delete_contact.php';
		
require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Account Contact Delete</title>';
include '../include/banner.inc';
include '../include/navbar_3.inc';

if (isset($_POST['delete_cont_input']) and isset($_POST['delete_user_input']))
{
	// Open the database
	if (!mysqli_select_db($link, $db1)){
		die('Could not connect: ' . mysqli_error($link));
		exit();
	}
	
	$sql = 'select uid, cont_id from UserContact where UserContact.uid = '. $_POST['delete_user_input'];
	$results = mysqli_query($link, $sql);
	
	$count = 0;
	while ($row = mysqli_fetch_array($results))
	{
		if ($row['uid'] == $_POST['delete_user_input'])
		{
			$count++;
		}
	}
	
	if ($count > 1)
	{
		$sql1 = 'select uid, cont_id from Email where Email.uid = '. $_POST['delete_user_input'] .' and Email.cont_id = '. $_POST['delete_cont_input'];
		$sql2 = 'select uid, cont_id from Phone where Phone.uid = '. $_POST['delete_user_input'] .' and Phone.cont_id = '. $_POST['delete_cont_input'];
		
		$results1 = mysqli_query($link, $sql1);
		$results2 = mysqli_query($link, $sql2);
		
		if (mysqli_num_rows($results1) == 1)
		{
			$sql3 = 'delete from Email where uid = '. $_POST['delete_user_input'] .' and cont_id = '. $_POST['delete_cont_input'];
			$sql5 = 'delete from UserContact where uid = '. $_POST['delete_user_input'] .' and cont_id = '. $_POST['delete_cont_input'];
			
			$results3 = mysqli_query($link, $sql3);
			$results5 = mysqli_query($link, $sql5);
		}
		
		if (mysqli_num_rows($results2) == 1)
		{
			$sql4 = 'delete from Phone where uid = '. $_POST['delete_user_input'] .' and cont_id = '. $_POST['delete_cont_input'];
			$sql5 = 'delete from UserContact where uid = '. $_POST['delete_user_input'] .' and cont_id = '. $_POST['delete_cont_input'];
			
			$results4 = mysqli_query($link, $sql4);
			$results5 = mysqli_query($link, $sql5);
		}
		
		echo '
		<!-- Content Start -->
		<div id="content" class="pull-left">
			<h1>Delete Contact</h1>
			<p>The contact has been deleted.</p>
			<a class="btn btn-default" href="../php/account.php">Return</a>
		</div>
		<!-- Content End -->';
	}
	else
	{
		echo '
		<!-- Content Start -->
		<div id="content" class="pull-left">
			<h1>Delete Contact</h1>
			<p>The contact cannot be delete because there is no other contact for the user.</p>
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
		<h1>Delete Contact</h1>
		<p>There was an issue deleting the contact.</p>
		<a class="btn btn-default" href="../php/account.php">Return</a>
	</div>
	<!-- Content End -->';
}

mysqli_close($link);

include '../include/footer.inc';

}

?>
<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: ../php/login.php');
} else if ($_SESSION['previous_page'] != 'add_employees_form.php' and $_SESSION['previous_page'] != 'add_employees_submit.php') {
	header('Location: ../index.php');
} else {

$page = 'employee';

$_SESSION['previous_page'] = 'add_employees_submit.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Employee Add</title>';
include '../include/banner.inc';
include '../include/navbar_3.inc';

$ufn = htmlspecialchars(stripslashes($_POST['ufn']));
$uln = htmlspecialchars(stripslashes($_POST['uln']));
$pos_id = intval(htmlspecialchars(stripslashes($_POST['pos_id'])));
$salary = intval(htmlspecialchars(stripslashes($_POST['salary'])));

echo '
<!-- Content Start -->
<div id="content" class="pull-left">
	<h1>Confirm Add Employee</h1>';
	
$updated = false;
$uid = 0;

// Open the database
if (!mysqli_select_db($link, $db1)){
	die('Could not connect: ' . mysqli_error($link));
	exit();
}

if (isset($ufn) and isset($uln))
{
	$sql = 'select User.uid, ufn, uln from User;';
	$results = mysqli_query($link, $sql);
	
	while ($row = mysqli_fetch_array($results))
	{
		$uid++;
		if ($row['uid'] != $uid)
		{
			break;
		}
	}
	
	if (mysqli_num_rows($results) == $uid)
	{
		$uid++;
	}
	
	$update = 'insert into User values('. $uid .',"'. $ufn .'","'. $uln .'")';
	$update_results = mysqli_query($link, $update);
	
	if ($update_results == true)
	{
		echo '<p>User added.</p>';
		$updated = true;
		
		// Open the database
		if (!mysqli_select_db($link, $db2)){
			die('Could not connect: ' . mysqli_error($link));
			exit();
		}
	
		$update2 = 'insert into Employee values('. $uid .',NOW())';
		$update_results2 = mysqli_query($link, $update2);
		
		if ($update_results == true)
		{
			echo '<p>Employee added.</p>';
			$updated = true;
			
			if (isset($pos_id) and isset($salary))
			{
				$update3 = 'insert into EmployeeJob values('. $uid .','. $pos_id .',NOW(),'. $salary .')';
				$update_results3 = mysqli_query($link, $update3);
				
				if ($update_results3 == true)
				{
					echo '<p>Employee Job added.</p>';
					$updated = true;
				} else {
					echo '<p>The employee job was not added.</p>';
				}
			}
		} else {
			echo '<p>The employee was not added.</p>';
		}
	} else {
		echo '<p>The user was not added.</p>';
	}
}

if ($updated == false)
{
	echo '<p>Employee was not added.</p>';
}

echo '
	<a class="btn btn-default pull-right" href="../php/employees_mgt.php">Return</a>
</div>
<!-- Content End -->';

mysqli_close($link);

include '../include/footer.inc';

}

?>
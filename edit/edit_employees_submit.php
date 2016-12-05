<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: ../php/login.php');
} else if ($_SESSION['previous_page'] != 'edit_employees_form.php' and $_SESSION['previous_page'] != 'edit_employees_submit.php') {
	header('Location: ../index.php');
} else {

$page = 'employee';

$_SESSION['previous_page'] = 'edit_employees_submit.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Employee Edit</title>';
include '../include/banner.inc';
include '../include/navbar_3.inc';

$ufn = htmlspecialchars(stripslashes($_POST['ufn']));
$uln = htmlspecialchars(stripslashes($_POST['uln']));
$uid = intval(htmlspecialchars(stripslashes($_POST['uid'])));
$pos_id = intval(htmlspecialchars(stripslashes($_POST['pos_id'])));
$prom_id = intval(htmlspecialchars(stripslashes($_POST['prom_id'])));
$salary = intval(htmlspecialchars(stripslashes($_POST['salary'])));

echo '
<!-- Content Start -->
<div id="content" class="pull-left">
	<h1>Confirm Edit Employee</h1>';
	
$updated = false;

// Open the database
if (!mysqli_select_db($link, $db1)){
	die('Could not connect: ' . mysqli_error($link));
	exit();
}

if (isset($ufn) and isset($uid))
{
	$sql = 'select User.uid, ufn, uln from User;';
	$results = mysqli_query($link, $sql);
	
	while ($row = mysqli_fetch_array($results))
	{
		if ($row['uid'] == $uid and $row['ufn'] != $ufn)
		{
			$update = 'update User set ufn = "'. $ufn .'" where uid = '. $uid;
			$update_results = mysqli_query($link, $update);
			
			if ($update_results == true)
			{
				echo '<p>Employee First Name updated.</p>';
				$updated = true;
			} else {
				echo '<p>The employee was not updated.</p>';
			}
		}
	}
}

if (isset($uln) and isset($uid))
{
	$sql = 'select User.uid, ufn, uln from User;';
	$results = mysqli_query($link, $sql);
	
	while ($row = mysqli_fetch_array($results))
	{
		if ($row['uid'] == $uid and $row['uln'] != $uln)
		{
			$update = 'update User set uln = "'. $uln .'" where uid = '. $uid;
			$update_results = mysqli_query($link, $update);
			
			if ($update_results == true)
			{
				echo '<p>Employee Last Name updated.</p>';
				$updated = true;
			} else {
				echo '<p>The employee was not updated.</p>';
			}
		}
	}
}

// Open the database
if (!mysqli_select_db($link, $db2)){
	die('Could not connect: ' . mysqli_error($link));
	exit();
}

if (isset($pos_id) and isset($uid) and isset($prom_id) and isset($salary))
{
	$sql = 'select EmployeeJob.uid, pos_id, salary, pos_sdate from EmployeeJob where EmployeeJob.uid = '. $uid .' order by pos_sdate desc limit 1;';
	$results = mysqli_query($link, $sql);
	
	while ($row = mysqli_fetch_array($results))
	{
		if ($row['uid'] == $uid and $row['pos_id'] != $pos_id and $row['salary'] != $salary)
		{
			$update = 'insert into EmployeeJobHistory values('. $row['uid'] .','. $row['pos_id'] .',"'. $row['pos_sdate'] .'",NOW(),'. $prom_id .');';
			$update2 = 'insert into EmployeeJob values('. $row['uid'] .','. $pos_id .',NOW(),'. $salary .');';
			$update_results = mysqli_query($link, $update);
			$update_results2 = mysqli_query($link, $update2);
			
			if ($update_results == true and $update_results2 == true)
			{
				echo '<p>Employee Position and Salary updated.</p>';
				$updated = true;
			} else {
				echo '<p>The employee job was not updated.</p>';
			}
		}
		else if ($row['uid'] == $uid and $row['pos_id'] != $pos_id)
		{
			$update = 'insert into EmployeeJobHistory values('. $row['uid'] .','. $row['pos_id'] .',"'. $row['pos_sdate'] .'",NOW(),'. $prom_id .');';
			$update2 = 'insert into EmployeeJob values('. $row['uid'] .','. $pos_id .',NOW(),'. $row['salary'] .');';
			$update_results = mysqli_query($link, $update);
			$update_results2 = mysqli_query($link, $update2);
			
			if ($update_results == true and $update_results2 == true)
			{
				echo '<p>Employee Position updated.</p>';
				$updated = true;
			} else {
				echo '<p>The employee job was not updated.</p>';
			}
		}
		else if ($row['uid'] == $uid and $row['salary'] != $salary)
		{
			$update = 'insert into EmployeeJobHistory values('. $row['uid'] .','. $row['pos_id'] .',"'. $row['pos_sdate'] .'",NOW(),'. $prom_id .');';
			$update2 = 'insert into EmployeeJob values('. $row['uid'] .','. $row['pos_id'] .',NOW(),'. $salary .');';
			$update_results = mysqli_query($link, $update);
			$update_results2 = mysqli_query($link, $update2);
			
			if ($update_results == true and $update_results2 == true)
			{
				echo '<p>Employee Salary updated.</p>';
				$updated = true;
			} else {
				echo '<p>The employee job was not updated.</p>';
			}
		}
	}
}

if ($updated == false)
{
	echo '<p>Employee was not updated.</p>';
}

echo '
	<a class="btn btn-default pull-right" href="../php/employees_mgt.php">Return</a>
</div>
<!-- Content End -->';

mysqli_close($link);

include '../include/footer.inc';

}

?>
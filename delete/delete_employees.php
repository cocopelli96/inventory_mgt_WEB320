<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: ../php/login.php');
} else if ($_SESSION['previous_page'] != 'employees_mgt.php' and $_SESSION['previous_page'] != 'delete_employees.php') {
	header('Location: ../index.php');
} else {

$page = 'employee';

$_SESSION['previous_page'] = 'delete_employees.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Employee Delete</title>';
include '../include/banner.inc';
include '../include/navbar_3.inc';

if (isset($_POST['delete_employee_input']))
{
	// Open the database
	if (!mysqli_select_db($link, $db6)){
		die('Could not connect: ' . mysqli_error($link));
		exit();
	}
	
	$sql = 'select uid, order_id, stat_id, start_date from OrderStatus where uid = '. $_POST['delete_employee_input'];
	$results = mysqli_query($link, $sql);
	
	$count = 0;
	while ($row = mysqli_fetch_array($results))
	{
		if ($row['uid'] == $_POST['delete_employee_input'])
		{
			$count++;
		}
	}
	
	if ($count == 0)
	{
		// Open the database
		if (!mysqli_select_db($link, $db2)){
			die('Could not connect: ' . mysqli_error($link));
			exit();
		}

		$sql1 = 'delete from EmployeeJobHistory where uid = '. $_POST['delete_employee_input'];
		$sql2 = 'delete from EmployeeJob where uid = '. $_POST['delete_employee_input'];
		$sql3 = 'delete from Employee where uid = '. $_POST['delete_employee_input'];

		$results1 = mysqli_query($link, $sql1);
		$results2 = mysqli_query($link, $sql2);
		$results3 = mysqli_query($link, $sql3);

		echo '
		<!-- Content Start -->
		<div id="content" class="pull-left">
			<h1>Delete Employee</h1>
			<p>The employee has been deleted.</p>
			<a class="btn btn-default" href="../php/employees_mgt.php">Return</a>
		</div>
		<!-- Content End -->';
	}
	else
	{
		echo '
		<!-- Content Start -->
		<div id="content" class="pull-left">
			<h1>Delete Employee</h1>
			<p>The employee cannot be delete because it has an order that it worked with.</p>
			<a class="btn btn-default" href="../php/employees_mgt.php">Return</a>
		</div>
		<!-- Content End -->';
	}	
}
else
{
	echo '
	<!-- Content Start -->
	<div id="content" class="pull-left">
		<h1>Delete Part</h1>
		<p>There was an issue deleting the employee.</p>
		<a class="btn btn-default" href="../php/employees_mgt.php">Return</a>
	</div>
	<!-- Content End -->';
}

mysqli_close($link);

include '../include/footer.inc';

}

?>
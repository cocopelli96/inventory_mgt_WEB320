<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: ../php/login.php');
} else if ($_SESSION['previous_page'] != 'employees_mgt.php' and $_SESSION['previous_page'] != 'add_employees_form.php') {
	header('Location: ../index.php');
} else {

$page = 'employee';

$_SESSION['previous_page'] = 'add_employees_form.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Employee Add</title>';
include '../include/banner.inc';
include '../include/navbar_3.inc';

// Open the database
if (!mysqli_select_db($link, $db1)){
	die('Could not connect: ' . mysqli_error($link));
	exit();
}

echo '
<!-- Content Start -->
<div id="content" class="pull-left">
	<form name="add_employee_form" action="add_employees_submit.php" method="post" class="edit_form" onsubmit="return addEmployeeVal();">
		<table class="table-mgt">
			<thead>
				<tr>
					<th colspan="2"><h1>Edit Employee</h1></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<label for="ufn">employee First Name:</label>
					</td>
					<td>
						<input type="text" name="ufn" id="ufn" size="45" class="form-control" value="" />
					</td>
				</tr>
				<tr>
					<td>
						<label for="uln">Employee Last Name:</label>
					</td>
					<td>
						<input type="text" name="uln" id="uln" size="45" class="form-control" value="" />
					</td>
				</tr>';
				
		// Open the database
		if (!mysqli_select_db($link, $db2)){
			die('Could not connect: ' . mysqli_error($link));
			exit();
		}
		
			echo '<tr>
					<td>
						<label for="pos_id">Position:</label>
					</td>
					<td>
						<select name="pos_id" id="pos_id" class="form-control">';
		
			$sql2 = 'select pos_id, pos_title from Position;';
			$results2 = mysqli_query($link, $sql2);
		
			while ($row2 = mysqli_fetch_array($results2))
			{
				echo '<option value="'. $row2['pos_id'] .'"';
				
				if ($row2['pos_id'] == $row1['pos_id'])
				{
					echo 'selected';
				}
				
				echo '>'. $row2['pos_title'] .'</option>';
			}
				
			echo '	</td>
				</tr>
				<tr>
					<td>
						<label for="salary">Salary:</label>
					</td>
					<td>
						<input type="number" name="salary" id="salary" size="45" class="form-control" value="" />
					</td>
				</tr>
				<tr class="edit_form_buttons">
					<td colspan="2">
						<input type="submit" name="submit_edit" value="Submit" class="btn btn-primary" />
						<input type="reset" name="clear_edit" value="Clear" class="btn btn-default" />
					</td>
				</tr>
			</tbody>
		</table>
	</form>
	<a class="btn btn-default pull-right" href="../php/employees_mgt.php">Return</a>
</div>
<!-- Content End -->';

mysqli_close($link);

include '../include/footer.inc';

}

?>
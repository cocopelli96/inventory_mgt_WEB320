<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: login.php');
} else {

$page = 'employee';

$_SESSION['previous_page'] = 'employees_mgt.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Employee Management</title>';
include '../include/banner.inc';
include '../include/navbar_2.inc';

// Open the database
if (!mysqli_select_db($link, $db2)){
	die('Could not connect: ' . mysqli_error($link));
    exit();
}

$sql = 'select Employee.uid, init_sdate, dept_name, pos_title, salary, pos_sdate from Employee, Department, Position, EmployeeJob where Employee.uid = EmployeeJob.uid and Position.pos_id = EmployeeJob.pos_id and Position.did = Department.did order by Employee.uid, pos_sdate desc;';
$results = mysqli_query($link, $sql);

echo '
<!-- Content Start -->
<div id="content" class="pull-left">

	<h1 class="h1-mgt pull-left">Employees</h1>';
	
if ($_SESSION['perm_id'] == 444) {
	echo '<a href="../add/add_employees_form.php" class="btn btn-default fa fa-plus pull-right"></a>';
}

$last_id = '';	
while ($row = mysqli_fetch_array($results))
{
	if ($last_id != $row['uid'])
	{
		echo '
		<table class="table-mgt">
			<thead>
				<tr>
					<th ';
					
		if ($_SESSION['perm_id'] == 444) {
			echo 'colspan="2"';
		} else {
			echo 'colspan="3"';
		}
			
		echo '			>';
				
		// Open the database
		if (!mysqli_select_db($link, $db1)){
			die('Could not connect: ' . mysqli_error($link));
			exit();
		}
	
		$sql2 = 'select ufn, uln from User where User.uid = '. $row['uid'];
		$results2 = mysqli_query($link, $sql2);
			
		while ($row2 = mysqli_fetch_array($results2))
		{
			echo $row2['ufn'] .' '. $row2['uln'];
		}

		echo		'</th>';
		
		if ($_SESSION['perm_id'] == 444) {
			echo '	<th>
						<button class="btn btn-default fa fa-trash pull-right" onclick="$(\'#delete_employee_input\').val(\''. $row['uid'] .'\');$(\'#delete_modal\').modal(\'show\');"></button>
						<form name="edit_form" method="post" action="../edit/edit_employees_form.php">
							<input type="hidden" name="edit_employee_input" value="'. $row['uid'] .'" />
							<button class="btn btn-default fa fa-pencil pull-right"></button>
						</form>
					</th>';
		}
					
		echo '	</tr>
			</thead>
			<tbody>
				<tr>
					<td>Position: '. $row['pos_title'] .'</td>
					<td>Salary: $'. $row['salary'] .'</td>
					<td>Department: '. $row['dept_name'] .'</td>
				</tr>
				<tr>
					<td>Position Start Date: '. $row['pos_sdate'] .'</td>
					<td colspan="2">Initial Start Date: '. $row['init_sdate'] .'</td>
				</tr>
			</tbody>
		</table>';
	}
	$last_id = $row['uid'];
}

echo '<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="delete_modal_Label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	<form name="modal_delete_form" action="../delete/delete_employees.php" method="post">
      <div class="modal-header">
        <button type="button" class="close fa fa-remove fa-lg" data-dismiss="modal" aria-label="Close"></button>
        <h4 class="modal-title" id="delete_modal_Label">Delete</h4>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this employee?
        <input type="hidden" name="delete_employee_input" id="delete_employee_input" />
      </div>
      <div class="modal-footer">
      	<button type="submit" class="btn btn-primary">Delete</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
      	</form>
    </div>
  </div>
</div>';

echo '
</div>
<!-- Content End -->
';

mysqli_close($link);

include '../include/footer.inc';

}

?>
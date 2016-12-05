<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: ../php/login.php');
} else if ($_SESSION['previous_page'] != 'account.php' and $_SESSION['previous_page'] != 'add_contact_form.php') {
	header('Location: ../index.php');
} else {

$page = 'account';

$_SESSION['previous_page'] = 'add_contact_form.php';

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

if ($_POST['add_contact_input'])
{
	echo '
	<!-- Content Start -->
	<div id="content" class="pull-left">
		<form name="add_contact_form" action="add_contact_submit.php" method="post" class="edit_form" onsubmit="return addContactVal();">
			<table class="table-mgt">
				<thead>
					<tr>
						<th colspan="2"><h1>Add Account Contact</h1></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<label for="cont_id">Contact Type:</label>
						</td>
						<td>
							<select name="cont_id" id="cont_id" class="form-control" onchange="changeContId();">
								<option value="NONE">Please choose a contact type</option>';
								
		$sql2 = 'select cont_id, cont_descript from Contact;';
		$results2 = mysqli_query($link, $sql2);
		
		while ($row2 = mysqli_fetch_array($results2))
		{
			$sql3 = 'select cont_id, uid from UserContact where uid = '. $_POST['add_contact_input'] .' and cont_id = '. $row2['cont_id'];
			$results3 = mysqli_query($link, $sql3);
		
			if (mysqli_num_rows($results3) == 0) {
				echo '<option value="'. $row2['cont_id'] .'">'. $row2['cont_descript'] .'</option>';
			}
		}
		
		echo '				</select>
						</td>
					</tr>
					<tr id="row1_hold">
					</tr>
					<tr id="row2_hold">
					</tr>
					<tr id="row3_hold">
					</tr>
					<tr class="edit_form_buttons">
						<td colspan="2">
							<input type="hidden" name="uid" id="uid" value="'. $_POST['add_contact_input'] .'" />
							<input type="submit" name="submit_edit" value="Submit" class="btn btn-primary" />
							<input type="reset" name="clear_edit" value="Clear" class="btn btn-default" />
						</td>
					</tr>
				</tbody>
			</table>
		</form>
		<a class="btn btn-default pull-right" href="../php/account.php">Return</a>
	</div>
	<!-- Content End -->';
}
else
{
	echo '
	<!-- Content Start -->
	<div id="content" class="pull-left">
		<h1>Add Account Contact</h1>
		<p>There was an issue adding the contact.</p>
		<a class="btn btn-default" href="../php/account.php">Return</a>
	</div>
	<!-- Content End -->';
}

mysqli_close($link);

include '../include/footer.inc';

}

?>
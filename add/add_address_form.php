<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: ../php/login.php');
} else if ($_SESSION['previous_page'] != 'account.php' and $_SESSION['previous_page'] != 'add_address_form.php') {
	header('Location: ../index.php');
} else {

$page = 'account';

$_SESSION['previous_page'] = 'add_address_form.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Account Address Add</title>';
include '../include/banner.inc';
include '../include/navbar_3.inc';

// Open the database
if (!mysqli_select_db($link, $db1)){
	die('Could not connect: ' . mysqli_error($link));
	exit();
}

if ($_POST['add_address_input'])
{
	echo '
	<!-- Content Start -->
	<div id="content" class="pull-left">
		<form name="add_address_form" action="add_address_submit.php" method="post" class="edit_form" onsubmit="return addAddressVal();">
			<table class="table-mgt">
				<thead>
					<tr>
						<th colspan="2"><h1>Add Account Address</h1></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<label for="add_type">Address Type:</label>
						</td>
						<td>
							<select name="add_type" id="add_type" class="form-control" >
								<option value="NONE">Please choose an address type</option>';
								
		$sql2 = 'select add_type_id, type_descript from AddressType;';
		$results2 = mysqli_query($link, $sql2);
		
		while ($row2 = mysqli_fetch_array($results2))
		{
			$sql3 = 'select add_type_id, uid, aid from UserAddress where uid = '. $_POST['add_address_input'] .' and add_type_id = '. $row2['add_type_id'];
			$results3 = mysqli_query($link, $sql3);
		
			if (mysqli_num_rows($results3) == 0) {
				echo '<option value="'. $row2['add_type_id'] .'">'. $row2['type_descript'] .'</option>';
			}
		}
		
		echo '				</select>
						</td>
					</tr>
					<tr>
						<td>
							<label for="street">Street:</label>
						</td>
						<td>
							<input name="street" id="street" type="text" class="form-control" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="street">City:</label>
						</td>
						<td>
							<input name="city" id="city" type="text" class="form-control" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="street">State:</label>
						</td>
						<td>
							<input name="state" id="state" type="text" class="form-control" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="street">Zip:</label>
						</td>
						<td>
							<input name="zip" id="zip" type="text" class="form-control" />
						</td>
					</tr>
					<tr class="edit_form_buttons">
						<td colspan="2">
							<input type="hidden" name="uid" id="uid" value="'. $_POST['add_address_input'] .'" />
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
		<h1>Add Account Address</h1>
		<p>There was an issue adding the address.</p>
		<a class="btn btn-default" href="../php/account.php">Return</a>
	</div>
	<!-- Content End -->';
}

mysqli_close($link);

include '../include/footer.inc';

}

?>
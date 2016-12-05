<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: ../php/login.php');
} else if ($_SESSION['previous_page'] != 'vendors_mgt.php' and $_SESSION['previous_page'] != 'add_vendor_form.php') {
	header('Location: ../index.php');
} else {

$page = 'vendor';

$_SESSION['previous_page'] = 'add_vendor_form.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Vendor Add</title>';
include '../include/banner.inc';
include '../include/navbar_3.inc';

// Open the database
if (!mysqli_select_db($link, $db4)){
	die('Could not connect: ' . mysqli_error($link));
	exit();
}

echo '
<!-- Content Start -->
<div id="content" class="pull-left">
	<form name="add_vendor_form" action="add_vendor_submit.php" method="post" class="edit_form" onsubmit="return addVendorVal();">
		<table class="table-mgt">
			<thead>
				<tr>
					<th colspan="2"><h1>Add Vendor</h1></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<label for="vname">Vendor Name:</label>
					</td>
					<td>
						<input type="text" name="vname" id="vname" size="45" class="form-control" value="" />
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
	<a class="btn btn-default pull-right" href="../php/vendors_mgt.php">Return</a>
</div>
<!-- Content End -->';

mysqli_close($link);

include '../include/footer.inc';

}

?>
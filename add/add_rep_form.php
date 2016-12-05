<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: ../php/login.php');
} else if ($_SESSION['previous_page'] != 'vendors_mgt.php' and $_SESSION['previous_page'] != 'add_rep_form.php') {
	header('Location: ../index.php');
} else {

$page = 'vendor';

$_SESSION['previous_page'] = 'add_rep_form.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Vendor Rep Add</title>';
include '../include/banner.inc';
include '../include/navbar_3.inc';

// Open the database
if (!mysqli_select_db($link, $db4)){
	die('Could not connect: ' . mysqli_error($link));
	exit();
}

if ($_POST['add_rep_input'])
{
	echo '
	<!-- Content Start -->
	<div id="content" class="pull-left">
		<form name="add_rep_form" action="add_rep_submit.php" method="post" class="edit_form" onsubmit="return editRepVal();">
			<table class="table-mgt">
				<thead>
					<tr>
						<th colspan="2"><h1>Add Vendor Rep</h1></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<label for="rep_fn">Rep First Name:</label>
						</td>
						<td>
							<input type="text" name="rep_fn" id="rep_fn" size="45" class="form-control" value="" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="rep_ln">Rep Last Name:</label>
						</td>
						<td>
							<input type="text" name="rep_ln" id="rep_ln" size="45" class="form-control" value="" />
						</td>
					</tr>';	
			
			$sql2 = "select rep_cid, rep_con_descript from RepContact;";
			$results2 = mysqli_query($link, $sql2);
		
			while ($row2 = mysqli_fetch_array($results2))
			{
				echo "
					<tr>
						<td>
							<label for='rep_cid_". $row2['rep_cid'] ."'>". $row2['rep_con_descript'] .": </label>
						</td>
						<td>
							<input type='text' name='rep_cid_". $row2['rep_cid'] ."' id='rep_cid_". $row2['rep_cid'] ."' size='45' value='' class='form-control' />
						</td>
					</tr>";
			}
		
			echo '	<tr class="edit_form_buttons">
						<td colspan="2">
							<input type="hidden" name="vid" id="vid" value="'. $_POST['add_rep_input'] .'" />
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
}
else
{
	echo '
	<!-- Content Start -->
	<div id="content" class="pull-left">
		<h1>Add Vendor Rep</h1>
		<p>There was an issue adding the vendor rep.</p>
		<a class="btn btn-default" href="../php/vendors_mgt.php">Return</a>
	</div>
	<!-- Content End -->';
}

mysqli_close($link);

include '../include/footer.inc';

}

?>
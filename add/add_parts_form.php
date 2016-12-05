<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: ../php/login.php');
} else if ($_SESSION['previous_page'] != 'parts_mgt.php' and $_SESSION['previous_page'] != 'add_parts_form.php') {
	header('Location: ../index.php');
} else {

$page = 'part';

$_SESSION['previous_page'] = 'add_parts_form.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Part Add</title>';
include '../include/banner.inc';
include '../include/navbar_3.inc';

// Open the database
if (!mysqli_select_db($link, $db5)){
	die('Could not connect: ' . mysqli_error($link));
	exit();
}

echo '
<!-- Content Start -->
<div id="content" class="pull-left">
	<form name="add_part_form" action="add_parts_submit.php" method="post" class="edit_form" onsubmit="return editPartVal();">
		<table class="table-mgt">
			<thead>
				<tr>
					<th colspan="2"><h1>Add Part</h1></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<label for="prod_name">Part Name:</label>
					</td>
					<td>
						<input type="text" name="part_name" id="part_name" size="45" class="form-control" value="" />
					</td>
				</tr>
				<tr>
					<td>
						<label for="vid">Part Vendor:</label>
					</td>
					<td>
						<select name="vid" id="vid" class="form-control">';
			
// Open the database
if (!mysqli_select_db($link, $db4)){
	die('Could not connect: ' . mysqli_error($link));
	exit();
}		
	
$sql2 = "select vid, vname from Vendor;";
$results2 = mysqli_query($link, $sql2);

while ($row2 = mysqli_fetch_array($results2))
{
	echo "<option value='". $row2['vid'] ."'";
	
	if ($row2['vid'] == $row['vid'])
	{
		echo "selected";
	}
	
	echo ">". $row2['vname'] ."</option>";
}
		
echo '					</select>
					</td>
				</tr>
				<tr>
					<td>
						<label for="part_quant">Quantity:</label>
					</td>
					<td>
						<input type="number" name="part_quant" id="part_quant" size="10" class="form-control" value="" />
					</td>
				</tr>
				<tr>
					<td>
						<label for="part_stock">Restock At:</label>
					</td>
					<td>
						<input type="number" name="part_stock" id="part_stock" size="10" class="form-control" value="" />
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
	<a class="btn btn-default pull-right" href="../php/parts_mgt.php">Return</a>
</div>
<!-- Content End -->';

mysqli_close($link);

include '../include/footer.inc';

}

?>
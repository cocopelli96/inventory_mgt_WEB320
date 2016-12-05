<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: ../php/login.php');
} else if ($_SESSION['previous_page'] != 'parts_mgt.php' and $_SESSION['previous_page'] != 'edit_parts_form.php') {
	header('Location: ../index.php');
} else {

$page = 'part';

$_SESSION['previous_page'] = 'edit_parts_form.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Part Edit</title>';
include '../include/banner.inc';
include '../include/navbar_3.inc';

if (isset($_POST['edit_part_input']))
{

	// Open the database
	if (!mysqli_select_db($link, $db5)){
		die('Could not connect: ' . mysqli_error($link));
		exit();
	}
	
	$sql = 'select Part.part_id, part_name, vid, part_quant, part_stock, part_alt_date from Part, PartInventory where Part.part_id = PartInventory.part_id;';
	$results = mysqli_query($link, $sql);
	
	$found = false;
	while ($row = mysqli_fetch_array($results))
	{
		if ($row['part_id'] == $_POST['edit_part_input'])
		{
			$found = true;
		
			echo '
	<!-- Content Start -->
	<div id="content" class="pull-left">
		<form name="edit_part_form" action="edit_parts_submit.php" method="post" class="edit_form" onsubmit="return editPartVal();">
			<table class="table-mgt">
				<thead>
					<tr>
						<th colspan="2"><h1>Edit Part</h1></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<label for="prod_name">Part Name:</label>
						</td>
						<td>
							<input type="text" name="part_name" id="part_name" size="45" class="form-control" value="'. $row['part_name'] .'" />
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
			
			echo '			</select>
						</td>
					</tr>
					<tr>
						<td>
							<label for="part_quant">Quantity:</label>
						</td>
						<td>
							<input type="number" name="part_quant" id="part_quant" size="10" class="form-control" value="'. $row['part_quant'] .'" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="part_stock">Restock At:</label>
						</td>
						<td>
							<input type="number" name="part_stock" id="part_stock" size="10" class="form-control" value="'. $row['part_stock'] .'" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="part_alt_date">Stock Last Updated:</label>
						</td>
						<td>
							<input type="date" name="part_alt_date" id="part_alt_date" size="45" class="form-control" value="'. $row['part_alt_date'] .'" disabled />
						</td>
					</tr>
					<tr class="edit_form_buttons">
						<td colspan="2">
							<input type="hidden" name="part_id" value="'. $row['part_id'] .'" />
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
	
		}
	}
	
	if ($found == false)
	{
		echo '
		<!-- Content Start -->
		<div id="content" class="pull-left">
			<h1>Edit Part</h1>
			<p>The part was not found.</p>
			<a class="btn btn-default" href="../php/parts_mgt.php">Return</a>
		</div>
		<!-- Content End -->';
	}
}
else
{
	echo '
	<!-- Content Start -->
	<div id="content" class="pull-left">
		<h1>Edit Part</h1>
		<p>There was an issue editing the part.</p>
		<a class="btn btn-default" href="../php/parts_mgt.php">Return</a>
	</div>
	<!-- Content End -->';
}

mysqli_close($link);

include '../include/footer.inc';

}

?>
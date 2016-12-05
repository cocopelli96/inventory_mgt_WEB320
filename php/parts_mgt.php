<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: login.php');
} else {

$page = 'part';

$_SESSION['previous_page'] = 'parts_mgt.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Part Management</title>';
include '../include/banner.inc';
include '../include/navbar_2.inc';

// Open the database
if (!mysqli_select_db($link, $db5)){
	die('Could not connect: ' . mysqli_error($link));
    exit();
}

$sql = 'select Part.part_id, part_name, vid, part_quant, part_stock, part_alt_date from Part, PartInventory where Part.part_id = PartInventory.part_id;';
$results = mysqli_query($link, $sql);

echo '
<!-- Content Start -->
<div id="content" class="pull-left">

	<h1 class="h1-mgt pull-left">Parts</h1>';

if ($_SESSION['perm_id'] >= 333) {
	echo '<a href="../add/add_parts_form.php" class="btn btn-default fa fa-plus pull-right"></a>';
}
		
while ($row = mysqli_fetch_array($results))
{
	echo '
	<table class="table-mgt">
		<thead>
			<tr>
				<th ';
	
	if ($_SESSION['perm_id'] >= 333) {
		echo 'colspan="2"';
	} else {
		echo 'colspan="3"';
	}
		
	echo			'>'. $row['part_name'] .'</th>';
	
	if ($_SESSION['perm_id'] >= 333) {
		echo '	<th>
					<button class="btn btn-default fa fa-trash pull-right" onclick="$(\'#delete_part_input\').val(\''. $row['part_id'] .'\');$(\'#delete_modal\').modal(\'show\');"></button>
					<form name="edit_form" method="post" action="../edit/edit_parts_form.php">
						<input type="hidden" name="edit_part_input" value="'. $row['part_id'] .'" />
						<button class="btn btn-default fa fa-pencil pull-right"></button>
					</form>
				</th>';
	}
	
	echo '	</tr>
		</thead>
		<tbody>
			<tr>
				<td class="col-xs-4">Quantity: '. $row['part_quant'] .'</td>
				<td class="col-xs-4">Restock at: '. $row['part_stock'] .'</td>
				<td class="col-xs-4">Stock Last Updated: '. $row['part_alt_date'] .'</td>
			</tr>
			<tr>
				<td colspan="3">Vendor: ';
	
	// Open the database
	if (!mysqli_select_db($link, $db4)){
		die('Could not connect: ' . mysqli_error($link));
		exit();
	}
	
	$sql2 = 'select vid, vname from Vendor where vid = '. $row['vid'];
	$results2 = mysqli_query($link, $sql2);
			
	while ($row2 = mysqli_fetch_array($results2))
	{
		echo $row2['vname'];
	}
	
	echo '		</td>
			</tr>
		</tbody>
	</table>';
}

echo '<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="delete_modal_Label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	<form name="modal_delete_form" action="../delete/delete_parts.php" method="post">
      <div class="modal-header">
        <button type="button" class="close fa fa-remove fa-lg" data-dismiss="modal" aria-label="Close"></button>
        <h4 class="modal-title" id="delete_modal_Label">Delete</h4>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this part?
        <input type="hidden" name="delete_part_input" id="delete_part_input" />
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
<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: login.php');
} else {

$page = 'vendor';

$_SESSION['previous_page'] = 'vendors_mgt.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Vendor Management</title>';
include '../include/banner.inc';
include '../include/navbar_2.inc';

// Open the database
if (!mysqli_select_db($link, $db4)){
	die('Could not connect: ' . mysqli_error($link));
    exit();
}

$sql = 'select vid, vname from Vendor order by Vendor.vid;';
$results = mysqli_query($link, $sql);

echo '
<!-- Content Start -->
<div id="content" class="pull-left">

	<h1 class="h1-mgt pull-left">Vendors</h1>';

if ($_SESSION['perm_id'] >= 333) {
	echo '<a href="../add/add_vendor_form.php" class="btn btn-default fa fa-plus pull-right"></a>';
}
	
$vendor = '';	
while ($row = mysqli_fetch_array($results))
{
	if ($vendor != $row['vid']) {
		echo '
			</tbody>
		</table>';
	}
	if ($vendor != $row['vid']) {
		$vendor = $row['vid'];
		
		echo '
		<table class="table-mgt">
			<thead>
				<tr class="vendor-row">
					<th ';
		
		if ($_SESSION['perm_id'] >= 333) {
			echo 'colspan="3"';
		} else {
			echo 'colspan="2"';
		}
		
		echo '			>
						<h3 class="h1-mgt">'. $row['vname'] .'</h3>
					</th>';
		
		if ($_SESSION['perm_id'] >= 333) {
			echo '	<th>
						<button class="btn btn-default fa fa-trash pull-right" onclick="$(\'#delete_vendor_input\').val(\''. $row['vid'] .'\');$(\'#delete_modal\').modal(\'show\');"></button>
						<form name="add_form" method="post" action="../add/add_rep_form.php">
							<input type="hidden" name="add_rep_input" value="'. $row['vid'] .'" />
							<button class="btn btn-default fa fa-plus pull-right"></button>
						</form>
					</th>';
		}
					
		echo '	</tr>
				<tr>
					<th>Rep Name</th>
					<th>Rep Contact</th>';
					
		if ($_SESSION['perm_id'] >= 333) {
			echo '	<th>Edit</th>
					<th>Delete</th>';
		}
		
		echo '	</tr>
			</thead>
			<tbody>';
	}
	
	$sql1 = 'select Rep.rep_id, rep_fn, rep_ln from Rep, VendorRep where '. $row['vid'] .' = VendorRep.vid and VendorRep.rep_id = Rep.rep_id;';
	$results1 = mysqli_query($link, $sql1);

	$reps = 0;
	while ($row1 = mysqli_fetch_array($results1))
	{	
		$reps++;
		echo '<tr>
				<td>'. $row1['rep_fn'] .' '. $row1['rep_ln'] .'</td>
				<td>';
			
		$sql2 = 'select VendorContact.rep_id, rep_contact, rep_con_descript, VendorContact.rep_cid from RepContact, VendorContact where VendorContact.rep_cid = RepContact.rep_cid and VendorContact.rep_id = '. $row1['rep_id'];
		$results2 = mysqli_query($link, $sql2);
	
		$count = 0;
		while ($row2 = mysqli_fetch_array($results2))
		{
			if ($count > 0) {
				echo '<br />';
			}
		
			echo $row2['rep_con_descript'] .': '. $row2['rep_contact'];
			$count++;
		}
	
		echo '	</td>';
		
		if ($_SESSION['perm_id'] >= 333) {
			echo '<td>
					<form name="edit_form" method="post" action="../edit/edit_rep_form.php">
						<input type="hidden" name="edit_rep_input" value="'. $row1['rep_id'] .'" />
						<button class="btn btn-default fa fa-pencil"></button>
					</form>
				</td>
				<td>
					<button class="btn btn-default fa fa-trash" onclick="$(\'#delete_rep_input\').val(\''. $row1['rep_id'] .'\');$(\'#delete_rep_modal\').modal(\'show\');"></button>
				</td>';
		}
				
		echo '</tr>';
	}
	
	if ($reps == 0)
	{
		echo '<tr>
			<td colspan="4">There are no representatives for this vendor.</td>
		</tr>';
	}
}

echo '	</tbody>
	</table>';
	
echo '<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="delete_modal_Label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	<form name="modal_delete_form" action="../delete/delete_vendors.php" method="post">
      <div class="modal-header">
        <button type="button" class="close  fa fa-remove fa-lg" data-dismiss="modal" aria-label="Close"></button>
        <h4 class="modal-title" id="delete_modal_Label">Delete</h4>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this vendor?
        <input type="hidden" name="delete_vendor_input" id="delete_vendor_input" />
      </div>
      <div class="modal-footer">
      	<button type="submit" class="btn btn-primary">Delete</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
      	</form>
    </div>
  </div>
</div>';

echo '<div class="modal fade" id="delete_rep_modal" tabindex="-1" role="dialog" aria-labelledby="delete_modal_Label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	<form name="modal_delete_rep_form" action="../delete/delete_reps.php" method="post">
      <div class="modal-header">
        <button type="button" class="close fa fa-remove fa-lg" data-dismiss="modal" aria-label="Close"></button>
        <h4 class="modal-title" id="delete_rep_modal_Label">Delete</h4>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this representative?
        <input type="hidden" name="delete_rep_input" id="delete_rep_input" />
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
<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: login.php');
} else {

$page = 'account';

$_SESSION['previous_page'] = 'account.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Account</title>';
include '../include/banner.inc';
include '../include/navbar_2.inc';

// Open the database
if (!mysqli_select_db($link, $db1)){
	die('Could not connect: ' . mysqli_error($link));
    exit();
}

$sql = 'select User.uid, ufn, uln, upass, uname, perm_descript from User, UserAccount, Permissions where User.uid = UserAccount.uid and Permissions.perm_id = UserAccount.perm_id and User.uid = '. $_SESSION['uid'] .';';
$sql2 = 'select UserAddress.uid, Address.aid, AddressType.add_type_id, type_descript, concat(street, "<br />", city, ", ", state, " ", zip) as "address" from UserAddress, Address, AddressType where UserAddress.add_type_id = AddressType.add_type_id and Address.aid = UserAddress.aid and UserAddress.uid = '. $_SESSION['uid'] .';';
$sql3 = 'select UserContact.cont_id, UserContact.uid, cont_descript, concat(area_code, "-", mid_num, "-", end_num) as "phone" from Phone, Contact, UserContact where UserContact.cont_id = Contact.cont_id and Phone.cont_id = UserContact.cont_id and Phone.uid = UserContact.uid and Phone.uid = '. $_SESSION['uid'] .';';
$sql4 = 'select UserContact.cont_id, UserContact.uid, cont_descript, email from Email, Contact, UserContact where UserContact.cont_id = Contact.cont_id and Email.cont_id = UserContact.cont_id and Email.uid = UserContact.uid and Email.uid = '. $_SESSION['uid'] .';';
$results = mysqli_query($link, $sql);
$results2 = mysqli_query($link, $sql2);
$results3 = mysqli_query($link, $sql3);
$results4 = mysqli_query($link, $sql4);

while ($row = mysqli_fetch_array($results))
{
	echo '	
<!-- Content Start -->
<div id="content" class="pull-left">
	
	<table id="account" class="table-mgt">
		<thead>
			<tr>
				<th colspan="2">Your Account</th>
				<th>
					<form name="edit_form" method="post" action="../edit/edit_account_form.php">
						<input type="hidden" name="edit_account_input" value="'. $row['uid'] .'" />
						<button class="btn btn-default fa fa-pencil pull-right"></button>
					</form>
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>User Full Name:</td>
				<td colspan="2">'. $row['ufn'] .' '. $row['uln'] .'</td>
			</tr>
			<tr>
				<td>User Screen Name:</td>
				<td colspan="2">'. $row['uname'] .'</td>
			</tr>
			<tr>
				<td>Password:</td>
				<td colspan="2">*********</td>
			</tr>
			<tr>
				<td>User Type:</td>
				<td colspan="2">'. $row['perm_descript'] .'</td>
			</tr>';

	while ($row2 = mysqli_fetch_array($results2))
	{
		echo '<tr>
				<td>'. $row2['type_descript'] .'</td>
				<td>'. $row2['address'] .'</td>
				<td>
					<button class="btn btn-default fa fa-trash pull-right"  onclick="$(\'#delete_address_input\').val(\''. $row2['aid'] .'\');$(\'#delete_type_input\').val(\''. $row2['add_type_id'] .'\');$(\'#delete_add_user_input\').val(\''. $row2['uid'] .'\');$(\'#delete_address_modal\').modal(\'show\');"></button>
				</td>
			</tr>';
	}

	while ($row3 = mysqli_fetch_array($results3))
	{
		echo '<tr>
				<td>'. $row3['cont_descript'] .'</td>
				<td>'. $row3['phone'] .'</td>
				<td>
					<button class="btn btn-default fa fa-trash pull-right"  onclick="$(\'#delete_cont_input\').val(\''. $row3['cont_id'] .'\');$(\'#delete_user_input\').val(\''. $row3['uid'] .'\');$(\'#delete_modal\').modal(\'show\');"></button>
				</td>
			</tr>';
	}

	while ($row4 = mysqli_fetch_array($results4))
	{
		echo '<tr>
				<td>'. $row4['cont_descript'] .'</td>
				<td>'. $row4['email'] .'</td>
				<td>
					<button class="btn btn-default fa fa-trash pull-right"  onclick="$(\'#delete_cont_input\').val(\''. $row4['cont_id'] .'\');$(\'#delete_user_input\').val(\''. $row4['uid'] .'\');$(\'#delete_modal\').modal(\'show\');"></button>
				</td>
			</tr>';
	}

	echo '
			<tr>
				<td colspan="3" style="text-align: center;">
					<form name="add_form" method="post" action="../add/add_contact_form.php" class="inline">
						<input type="hidden" name="add_contact_input" value="'. $row['uid'] .'" />
						<button class="btn btn-default">Add Contact</button>
					</form>
					<form name="add_form" method="post" action="../add/add_address_form.php" class="inline">
						<input type="hidden" name="add_address_input" value="'. $row['uid'] .'" />
						<button class="btn btn-default">Add Address</button>
					</form>
				</td>
			</tr>
		</tbody>
	</table>

	<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="delete_modal_Label">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
			<form name="modal_delete_form" action="../delete/delete_contact.php" method="post">
		  <div class="modal-header">
			<button type="button" class="close fa fa-remove fa-lg" data-dismiss="modal" aria-label="Close"></button>
			<h4 class="modal-title" id="delete_modal_Label">Delete</h4>
		  </div>
		  <div class="modal-body">
			Are you sure you want to delete this contact?
			<input type="hidden" name="delete_cont_input" id="delete_cont_input" />
			<input type="hidden" name="delete_user_input" id="delete_user_input" />
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary">Delete</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
			</form>
		</div>
	  </div>
	</div>
	
	<div class="modal fade" id="delete_address_modal" tabindex="-1" role="dialog" aria-labelledby="delete_modal_Label">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
			<form name="modal_delete_form" action="../delete/delete_address.php" method="post">
		  <div class="modal-header">
			<button type="button" class="close fa fa-remove fa-lg" data-dismiss="modal" aria-label="Close"></button>
			<h4 class="modal-title" id="delete_modal_Label">Delete</h4>
		  </div>
		  <div class="modal-body">
			Are you sure you want to delete this address?
			<input type="hidden" name="delete_address_input" id="delete_address_input" />
			<input type="hidden" name="delete_type_input" id="delete_type_input" />
			<input type="hidden" name="delete_add_user_input" id="delete_add_user_input" />
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary">Delete</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
			</form>
		</div>
	  </div>
	</div>

</div>
<!-- Content End -->
';

}

mysqli_close($link);

include '../include/footer.inc';

}

?>
<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: ../php/login.php');
} else if ($_SESSION['previous_page'] != 'account.php' and $_SESSION['previous_page'] != 'edit_account_form.php') {
	header('Location: ../index.php');
} else {

$page = 'account';

$_SESSION['previous_page'] = 'edit_account_form.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Account Edit</title>';
include '../include/banner.inc';
include '../include/navbar_3.inc';

if (isset($_POST['edit_account_input']))
{

	// Open the database
	if (!mysqli_select_db($link, $db1)){
		die('Could not connect: ' . mysqli_error($link));
		exit();
	}
	
	$sql = 'select User.uid, ufn, uln, upass, uname from User, UserAccount where User.uid = UserAccount.uid and User.uid = '. $_SESSION['uid'] .';';
	$sql2 = 'select AddressType.add_type_id, type_descript, street, city, state, zip from UserAddress, Address, AddressType where UserAddress.add_type_id = AddressType.add_type_id and Address.aid = UserAddress.aid and UserAddress.uid = '. $_SESSION['uid'] .';';
	$sql3 = 'select Phone.cont_id, cont_descript, area_code, mid_num, end_num from Phone, Contact, UserContact where UserContact.cont_id = Contact.cont_id and Phone.cont_id = UserContact.cont_id and Phone.uid = UserContact.uid and Phone.uid = '. $_SESSION['uid'] .';';
	$sql4 = 'select Email.cont_id, cont_descript, email from Email, Contact, UserContact where UserContact.cont_id = Contact.cont_id and Email.cont_id = UserContact.cont_id and Email.uid = UserContact.uid and Email.uid = '. $_SESSION['uid'] .';';
	$results = mysqli_query($link, $sql);
	$results2 = mysqli_query($link, $sql2);
	$results3 = mysqli_query($link, $sql3);
	$results4 = mysqli_query($link, $sql4);
	
	$found = false;
	while ($row = mysqli_fetch_array($results))
	{
		if ($row['uid'] == $_POST['edit_account_input'])
		{
			$found = true;
		
			echo '
	<!-- Content Start -->
	<div id="content" class="pull-left">
		<form name="edit_account_form" action="edit_account_submit.php" method="post" class="edit_form" onsubmit="return editAccountVal();">
			<table class="table-mgt">
				<thead>
					<tr>
						<th colspan="2"><h1>Edit Account</h1></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<label for="ufn">User First Name:</label>
						</td>
						<td>
							<input type="text" name="ufn" id="ufn" class="form-control" value="'. $row['ufn'] .'" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="uln">User Last Name:</label>
						</td>
						<td>
							<input type="text" name="uln" id="uln" class="form-control" value="'. $row['uln'] .'" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="uname">User Screen Name:</label>
						</td>
						<td>
							<input type="text" name="uname" id="uname" class="form-control" value="'. $row['uname'] .'" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="upass">Password:</label>
						</td>
						<td>
							<input type="password" name="upass" id="upass"  class="form-control" value="'. $row['upass'] .'" />
						</td>
					</tr>';
			
			while ($row2 = mysqli_fetch_array($results2))
			{	
				echo '<tr>
						<td>
							<label for="'. $row2['add_type_id'] .'_street">'. $row2['type_descript'] .' Street:</label>
						</td>
						<td>
							<input type="text" name="'. $row2['add_type_id'] .'_street" id="'. $row2['add_type_id'] .'_street" class="form-control" value="'. $row2['street'] .'" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="'. $row2['add_type_id'] .'_city">'. $row2['type_descript'] .' City:</label>
						</td>
						<td>
							<input type="text" name="'. $row2['add_type_id'] .'_city" id="'. $row2['add_type_id'] .'_city" class="form-control" value="'. $row2['city'] .'" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="'. $row2['add_type_id'] .'_state">'. $row2['type_descript'] .' State:</label>
						</td>
						<td>
							<input type="text" name="'. $row2['add_type_id'] .'_state" id="'. $row2['add_type_id'] .'_state" class="form-control" value="'. $row2['state'] .'" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="'. $row2['add_type_id'] .'_zip">'. $row2['type_descript'] .' Zip:</label>
						</td>
						<td>
							<input type="text" name="'. $row2['add_type_id'] .'_zip" id="'. $row2['add_type_id'] .'_zip" class="form-control" value="'. $row2['zip'] .'" />
						</td>
					</tr>';
			}
			
			while ($row3 = mysqli_fetch_array($results3))
			{	
				echo '<tr>
						<td>
							<label for="'. $row3['cont_id'] .'_area">'. $row3['cont_descript'] .' Area Code:</label>
						</td>
						<td>
							<input type="text" name="'. $row3['cont_id'] .'_area" id="'. $row3['cont_id'] .'_area" class="form-control" value="'. $row3['area_code'] .'" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="'. $row3['cont_id'] .'_mid">'. $row3['cont_descript'] .' Middle Number:</label>
						</td>
						<td>
							<input type="text" name="'. $row3['cont_id'] .'_mid" id="'. $row3['cont_id'] .'_mid" class="form-control" value="'. $row3['mid_num'] .'" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="'. $row3['cont_id'] .'_end">'. $row3['cont_descript'] .' End Number:</label>
						</td>
						<td>
							<input type="text" name="'. $row3['cont_id'] .'_end" id="'. $row3['cont_id'] .'_end" class="form-control" value="'. $row3['end_num'] .'" />
						</td>
					</tr>';	
			}
			
			while ($row4 = mysqli_fetch_array($results4))
			{
				echo '<tr>
						<td>
							<label for="'. $row4['cont_id'] .'_email">'. $row4['cont_descript'] .':</label>
						</td>
						<td>
							<input type="text" name="'. $row4['cont_id'] .'_email" id="'. $row4['cont_id'] .'_email" class="form-control" value="'. $row4['email'] .'" />
						</td>
					</tr>';	
			}
					
			echo '	<tr class="edit_form_buttons">
						<td colspan="2">
							<input type="hidden" name="uid" value="'. $row['uid'] .'" />
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
	}
	
	if ($found == false)
	{
		echo '
		<!-- Content Start -->
		<div id="content" class="pull-left">
			<h1>Edit Account</h1>
			<p>The account was not found.</p>
			<a class="btn btn-default" href="../php/account.php">Return</a>
		</div>
		<!-- Content End -->';
	}
}
else
{
	echo '
	<!-- Content Start -->
	<div id="content" class="pull-left">
		<h1>Edit Account</h1>
		<p>There was an issue editing the account.</p>
		<a class="btn btn-default" href="../php/account.php">Return</a>
	</div>
	<!-- Content End -->';
}

mysqli_close($link);

include '../include/footer.inc';

}

?>
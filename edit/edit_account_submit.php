<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: ../php/login.php');
} else if ($_SESSION['previous_page'] != 'edit_account_form.php' and $_SESSION['previous_page'] != 'edit_account_submit.php') {
	header('Location: ../index.php');
} else {

$page = 'account';

$_SESSION['previous_page'] = 'edit_account_submit.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Account Edit</title>';
include '../include/banner.inc';
include '../include/navbar_3.inc';

// Open the database
if (!mysqli_select_db($link, $db1)){
	die('Could not connect: ' . mysqli_error($link));
	exit();
}

$uid = intval(htmlspecialchars(stripslashes($_POST['uid'])));
$ufn = htmlspecialchars(stripslashes($_POST['ufn']));
$uln = htmlspecialchars(stripslashes($_POST['uln']));
$uname = htmlspecialchars(stripslashes($_POST['uname']));
$upass = htmlspecialchars(stripslashes($_POST['upass']));

echo '
<!-- Content Start -->
<div id="content" class="pull-left">
	<h1>Confirm Edit Account</h1>';
	
$updated = false;
if (isset($ufn) and isset($uid))
{
	$sql = 'select User.uid, ufn, uln from User;';
	$results = mysqli_query($link, $sql);
	
	while ($row = mysqli_fetch_array($results))
	{
		if ($row['uid'] == $uid and $row['ufn'] != $ufn)
		{
			$update = 'update User set ufn = "'. $ufn .'" where uid = '. $uid;
			$update_results = mysqli_query($link, $update);
			
			if ($update_results == true)
			{
				echo '<p>Your First Name updated.</p>';
				$updated = true;
			} else {
				echo '<p>Your account was not updated.</p>';
			}
		}
	}
}

if (isset($uln) and isset($uid))
{
	$sql = 'select User.uid, ufn, uln from User;';
	$results = mysqli_query($link, $sql);
	
	while ($row = mysqli_fetch_array($results))
	{
		if ($row['uid'] == $uid and $row['uln'] != $uln)
		{
			$update = 'update User set uln = "'. $uln .'" where uid = '. $uid;
			$update_results = mysqli_query($link, $update);
			
			if ($update_results == true)
			{
				echo '<p>Your Last Name updated.</p>';
				$updated = true;
			} else {
				echo '<p>Your account was not updated.</p>';
			}
		}
	}
}

if (isset($uname) and isset($uid))
{
	$sql = 'select UserAccount.uid, uname, upass, perm_id from UserAccount;';
	$results = mysqli_query($link, $sql);
	
	while ($row = mysqli_fetch_array($results))
	{
		if ($row['uid'] == $uid and $row['uname'] != $uname)
		{
			$update = 'update UserAccount set uname = "'. $uname .'" where uid = '. $uid;
			$update_results = mysqli_query($link, $update);
			
			if ($update_results == true)
			{
				echo '<p>Your Screen Name updated.</p>';
				$updated = true;
			} else {
				echo '<p>Your account was not updated.</p>';
			}
		}
	}
}

if (isset($upass) and isset($uid))
{
	$sql = 'select UserAccount.uid, uname, upass, perm_id from UserAccount;';
	$results = mysqli_query($link, $sql);
	
	while ($row = mysqli_fetch_array($results))
	{
		if ($row['uid'] == $uid and $row['upass'] != $upass)
		{
			$update = 'update UserAccount set upass = "'. $upass .'" where uid = '. $uid;
			$update_results = mysqli_query($link, $update);
			
			if ($update_results == true)
			{
				echo '<p>Your Account Password updated.</p>';
				$updated = true;
			} else {
				echo '<p>Your account was not updated.</p>';
			}
		}
	}
}

/*loop now for addresses and contacts*/
$add_array = ['11','22','33'];
$phone_array = ['1','2','3'];
$email_array = ['4','5'];

foreach ($add_array  as $value)
{
	$street = htmlspecialchars(stripslashes($_POST[$value .'_street']));
	$city = htmlspecialchars(stripslashes($_POST[$value .'_city']));
	$state = htmlspecialchars(stripslashes($_POST[$value .'_state']));
	$zip = htmlspecialchars(stripslashes($_POST[$value .'_zip']));
	
	if (isset($street) and isset($city) and isset($state) and isset($zip) and isset($uid))
	{
		$sql = 'select Address.aid, add_type_id, street, city, state, zip from Address, UserAddress where Address.aid = UserAddress.aid and UserAddress.add_type_id = '. $value .' and UserAddress.uid = '. $uid;
		$results = mysqli_query($link, $sql);
	
		while ($row = mysqli_fetch_array($results))
		{
			if ($row['uid'] == $uid and ($row['street'] != $street or $row['city'] != $city or $row['state'] != $state or $row['zip'] != $zip))
			{
				$collect = 'select aid from Address;';
				$result_collect = mysqli_query($collect);
		
				$aid = 0;
				while ($row2 = mysqli_fetch_array($result_collect))
				{
					$aid++;
					if ($aid != $row2['aid'])
					{
						break;
					}
				}
				
				if (mysqli_num_rows($result_collect) == $aid)
				{
					$aid++;
				}
		
				$update = 'insert into Address values('. $aid .',"'. $street .'","'. $city .'","'. $state .'","'. $zip .'");';
				$update2 = 'update UserAddress set aid = '. $aid .' where uid = '. $uid .' and add_type_id = '. $value .' and aid = '. $row['aid'];
				$update_results = mysqli_query($link, $update);
				$update_results2 = mysqli_query($link, $update2);
		
				if ($update_results == true and $update_results2 == true)
				{
					echo '<p>Your Address updated.</p>';
					$updated = true;
				} else {
					echo '<p>The your account address was not updated.</p>';
				}
			}
		}
	}
}

foreach ($phone_array  as $value)
{
	$area = htmlspecialchars(stripslashes($_POST[$value .'_area']));
	$mid = htmlspecialchars(stripslashes($_POST[$value .'_mid']));
	$end = htmlspecialchars(stripslashes($_POST[$value .'_end']));
	
	if (isset($area) and isset($uid))
	{
		$sql = 'select Phone.uid, cont_id, area_code, mid_num, end_num from Phone where Phone.cont_id = '. $value .' and Phone.uid = '. $uid;
		$results = mysqli_query($link, $sql);
		
		while ($row = mysqli_fetch_array($results))
		{	
			if ($row['uid'] == $uid and $row['area_code'] != $area)
			{
				$update = 'update Phone set area_code = "'. $area .'" where uid = '. $uid .' and cont_id = '. $value;
				$update_results = mysqli_query($link, $update);
			
				if ($update_results == true)
				{
					echo '<p>Your Phone Number Area Code updated.</p>';
					$updated = true;
				} else {
					echo '<p>Your account phone number area code was not updated.</p>';
				}
			}
		}
	}
	
	if (isset($mid) and isset($uid))
	{
		$sql = 'select Phone.uid, cont_id, area_code, mid_num, end_num from Phone where Phone.cont_id = '. $value .' and Phone.uid = '. $uid;
		$results = mysqli_query($link, $sql);
		
		while ($row = mysqli_fetch_array($results))
		{	
			if ($row['uid'] == $uid and $row['mid_num'] != $mid)
			{
				$update = 'update Phone set mid_num = "'. $mid .'" where uid = '. $uid .' and cont_id = '. $value;
				$update_results = mysqli_query($link, $update);
			
				if ($update_results == true)
				{
					echo '<p>Your Phone Number Middle Digits updated.</p>';
					$updated = true;
				} else {
					echo '<p>Your account phone number middle digits was not updated.</p>';
				}
			}
		}
	}
	
	if (isset($end) and isset($uid))
	{
		$sql = 'select Phone.uid, cont_id, area_code, mid_num, end_num from Phone where Phone.cont_id = '. $value .' and Phone.uid = '. $uid;
		$results = mysqli_query($link, $sql);
		
		while ($row = mysqli_fetch_array($results))
		{	
			if ($row['uid'] == $uid and $row['end_num'] != $end)
			{
				$update = 'update Phone set end_num = "'. $end .'" where uid = '. $uid .' and cont_id = '. $value;
				$update_results = mysqli_query($link, $update);
			
				if ($update_results == true)
				{
					echo '<p>Your Phone Number Ending Digits updated.</p>';
					$updated = true;
				} else {
					echo '<p>Your account phone number ending digits was not updated.</p>';
				}
			}
		}
	}
}

foreach ($email_array  as $value)
{
	$email = htmlspecialchars(stripslashes($_POST[$value .'_email']));
	
	if (isset($email) and isset($uid))
	{
		$sql = 'select Email.uid, cont_id, email from Email where Email.cont_id = '. $value .' and Email.uid = '. $uid;
		$results = mysqli_query($link, $sql);
		
		while ($row = mysqli_fetch_array($results))
		{	
			if ($row['uid'] == $uid and $row['email'] != $email)
			{
				$update = 'update Email set email = "'. $email .'" where uid = '. $uid .' and cont_id = '. $value;
				$update_results = mysqli_query($link, $update);
			
				if ($update_results == true)
				{
					echo '<p>Your Email updated.</p>';
					$updated = true;
				} else {
					echo '<p>Your account email was not updated.</p>';
				}
			}
		}
	}
}

if ($updated == false)
{
	echo '<p>Your account was not updated.</p>';
}

echo '
	<a class="btn btn-default pull-right" href="../php/account.php">Return</a>
</div>
<!-- Content End -->';

mysqli_close($link);

include '../include/footer.inc';

}

?>
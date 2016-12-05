<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: ../php/login.php');
} else if ($_SESSION['previous_page'] != 'add_parts_form.php' and $_SESSION['previous_page'] != 'add_parts_submit.php') {
	header('Location: ../index.php');
} else {

$page = 'part';

$_SESSION['previous_page'] = 'add_parts_submit.php';

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

$part_name = htmlspecialchars(stripslashes($_POST['part_name']));
$vid = intval(htmlspecialchars(stripslashes($_POST['vid'])));
$part_quant = intval(htmlspecialchars(stripslashes($_POST['part_quant'])));
$part_stock = intval(htmlspecialchars(stripslashes($_POST['part_stock'])));

$part_id = 0;
	
echo '
<!-- Content Start -->
<div id="content" class="pull-left">
	<h1>Confirm Add Part</h1>';
	
$updated = false;
if (isset($part_name) and isset($vid))
{
	$sql = 'select Part.part_id, part_name, vid from Part;';
	$results = mysqli_query($link, $sql);
	
	while ($row = mysqli_fetch_array($results))
	{
		$part_id++;
		if ($part_id != $row['part_id'])
		{
			break;
		}
	}
	
	if (mysqli_num_rows($results) == $part_id)
	{
		$part_id++;
	}
	
	$update = 'insert into Part values('. $part_id .',"'. $part_name .'",'. $vid .')';
	$update_results = mysqli_query($link, $update);
			
	if ($update_results == true)
	{
		echo '<p>Part added.</p>';
		$updated = true;
		
		if (isset($part_quant) and isset($part_stock))
		{
			$update = 'insert into PartInventory values('. $part_id .','. $part_quant .','. $part_stock .',NOW())';
			$update_results = mysqli_query($link, $update);
			
			if ($update_results == true)
			{
				echo '<p>Part Inventory added.</p>';
				$updated = true;
			} else {
				echo '<p>The part inventory was not added.</p>';
			}
		}
	} else {
		echo '<p>The part was not added.</p>';
	}
}

if ($updated == false)
{
	echo '<p>Part was not added.</p>';
}

echo '
	<a class="btn btn-default pull-right" href="../php/parts_mgt.php">Return</a>
</div>
<!-- Content End -->';

mysqli_close($link);

include '../include/footer.inc';

}

?>
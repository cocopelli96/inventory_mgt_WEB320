<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: ../php/login.php');
} else if ($_SESSION['previous_page'] != 'edit_parts_form.php' and $_SESSION['previous_page'] != 'edit_parts_submit.php') {
	header('Location: ../index.php');
} else {

$page = 'part';

$_SESSION['previous_page'] = 'edit_parts_submit.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Part Edit</title>';
include '../include/banner.inc';
include '../include/navbar_3.inc';

// Open the database
if (!mysqli_select_db($link, $db5)){
	die('Could not connect: ' . mysqli_error($link));
	exit();
}

$part_name = htmlspecialchars(stripslashes($_POST['part_name']));
$vid = intval(htmlspecialchars(stripslashes($_POST['vid'])));
$part_id = intval(htmlspecialchars(stripslashes($_POST['part_id'])));
$part_quant = intval(htmlspecialchars(stripslashes($_POST['part_quant'])));
$part_stock = intval(htmlspecialchars(stripslashes($_POST['part_stock'])));

echo '
<!-- Content Start -->
<div id="content" class="pull-left">
	<h1>Confirm Edit Part</h1>';
	
$updated = false;
if (isset($part_name) and isset($part_id))
{
	$sql = 'select Part.part_id, part_name, vid from Part;';
	$results = mysqli_query($link, $sql);
	
	while ($row = mysqli_fetch_array($results))
	{
		if ($row['part_id'] == $part_id and $row['part_name'] != $part_name)
		{
			$update = 'update Part set part_name = "'. $part_name .'" where part_id = '. $part_id;
			$update_results = mysqli_query($link, $update);
			
			if ($update_results == true)
			{
				echo '<p>Part Name updated.</p>';
				$updated = true;
			} else {
				echo '<p>The part was not updated.</p>';
			}
		}
	}
}

if (isset($part_quant) and isset($part_id))
{
	$sql = 'select PartInventory.part_id, part_quant, part_stock, part_alt_date from PartInventory;';
	$results = mysqli_query($link, $sql);
	
	while ($row = mysqli_fetch_array($results))
	{
		if ($row['part_id'] == $part_id and $row['part_quant'] != $part_quant)
		{
			$update = 'update PartInventory set part_quant = '. $part_quant .', part_alt_date = NOW() where part_id = '. $part_id;
			$update_results = mysqli_query($link, $update);
			
			if ($update_results == true)
			{
				echo '<p>Part Quantity updated.</p>';
				$updated = true;
			} else {
				echo '<p>The part inventory was not updated.</p>';
			}
		}
	}
}

if (isset($part_stock) and isset($part_id))
{
	$sql = 'select PartInventory.part_id, part_quant, part_stock, part_alt_date from PartInventory;';
	$results = mysqli_query($link, $sql);
	
	while ($row = mysqli_fetch_array($results))
	{
		if ($row['part_id'] == $part_id and $row['part_stock'] != $part_stock)
		{
			$update = 'update PartInventory set part_stock = '. $part_stock .', part_alt_date = NOW() where part_id = '. $part_id;
			$update_results = mysqli_query($link, $update);
			
			if ($update_results == true)
			{
				echo '<p>Part Restock updated.</p>';
				$updated = true;
			} else {
				echo '<p>The part inventory was not updated.</p>';
			}
		}
	}
}

if (isset($vid) and isset($part_id))
{
	$sql = 'select Part.part_id, part_name, vid from Part;';
	$results = mysqli_query($link, $sql);
	
	while ($row = mysqli_fetch_array($results))
	{
		if ($row['part_id'] == $part_id and $row['vid'] != $vid)
		{
			$update = 'update Part set vid = "'. $vid .'" where part_id = '. $part_id;
			$update_results = mysqli_query($link, $update);
			
			if ($update_results == true)
			{
				echo '<p>Part Vendor updated.</p>';
				$updated = true;
			} else {
				echo '<p>The part was not updated.</p>';
			}
		}
	}
}

if ($updated == false)
{
	echo '<p>Part was not updated.</p>';
}

echo '
	<a class="btn btn-default pull-right" href="../php/parts_mgt.php">Return</a>
</div>
<!-- Content End -->';

mysqli_close($link);

include '../include/footer.inc';

}

?>
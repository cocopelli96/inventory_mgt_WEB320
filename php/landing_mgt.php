<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: login.php');
} else {

$page = 'landing-mgt';

$_SESSION['previous_page'] = 'landing_mgt.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store</title>';
include '../include/banner.inc';
include '../include/navbar_2.inc';

// Open the database
if (!mysqli_select_db($link, $db5)){
	die('Could not connect: ' . mysqli_error($link));
    exit();
}

$sql = 'select Product.prod_id, prod_name, prod_descript, img_loc, prod_quant, prod_stock, prod_alt_date from Product, ProductInventory where Product.prod_id = ProductInventory.prod_id having prod_quant <= prod_stock;';
$results = mysqli_query($link, $sql);
$sql2 = 'select Part.part_id, part_name, vid, part_quant, part_stock, part_alt_date from Part, PartInventory where Part.part_id = PartInventory.part_id having part_quant <= part_stock;';
$results2 = mysqli_query($link, $sql2);

echo '
<!-- Content Start -->
<div id="content" class="pull-left">

	<table class="table-mgt">
		<thead>
			<tr>
				<th colspan="4">Products needing restock</th>
			</tr>
		</thead>
		<tbody>';
		
while ($row = mysqli_fetch_array($results))
{
	echo '<tr>
		<td>Product: '. $row['prod_name'] .'</td>
		<td>Quantity: '. $row['prod_quant'] .'</td>
		<td>Restock at: '. $row['prod_stock'] .'</td>
		<td>Last Updated: '. $row['prod_alt_date'] .'</td>
	</tr>';
}

echo '	</tbody>
	</table>
	
	<table class="table-mgt">
		<thead>
			<tr>
				<th colspan="4">Parts needing restock</th>
			</tr>
		</thead>
		<tbody>';
		
while ($row2 = mysqli_fetch_array($results2))
{
	echo '<tr>
		<td>Part: '. $row2['part_name'] .'</td>
		<td>Quantity: '. $row2['part_quant'] .'</td>
		<td>Restock at: '. $row2['part_stock'] .'</td>
		<td>Last Updated: '. $row2['part_alt_date'] .'</td>
	</tr>';
}

echo '	</tbody>
	</table>

</div>
<!-- Content End -->
';

mysqli_close($link);

include '../include/footer.inc';

}

?>
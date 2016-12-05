<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: login.php');
} else {

$page = 'product';

$_SESSION['previous_page'] = 'products_mgt.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Product Management</title>';
include '../include/banner.inc';
include '../include/navbar_2.inc';

// Open the database
if (!mysqli_select_db($link, $db5)){
	die('Could not connect: ' . mysqli_error($link));
    exit();
}

$sql = 'select Product.prod_id, prod_name, prod_descript, img_loc, prod_quant, prod_stock, prod_alt_date from Product, ProductInventory where Product.prod_id = ProductInventory.prod_id;';
$results = mysqli_query($link, $sql);

echo '
<!-- Content Start -->
<div id="content" class="pull-left">

	<h1 class="h1-mgt pull-left">Products</h1>';
	
if ($_SESSION['perm_id'] >= 333) {
	echo '<a href="../add/add_products_form.php" class="btn btn-default fa fa-plus pull-right"></a>';
}
		
while ($row = mysqli_fetch_array($results))
{
	echo '
	<table class="table-mgt">
		<thead>
			<tr>
				<th ';
	
	if ($_SESSION['perm_id'] >= 333) {
		echo 'colspan="3"';
	} else {
		echo 'colspan="4"';
	}
	
	echo '			>'. $row['prod_name'] .'</th>';
	
	if ($_SESSION['perm_id'] >= 333) {
		echo '	<th>
					<button class="btn btn-default fa fa-trash pull-right"  onclick="$(\'#delete_prod_input\').val(\''. $row['prod_id'] .'\');$(\'#delete_modal\').modal(\'show\');"></button>
					<form name="edit_form" method="post" action="../edit/edit_products_form.php">
						<input type="hidden" name="edit_prod_input" value="'. $row['prod_id'] .'" />
						<button class="btn btn-default fa fa-pencil pull-right"></button>
					</form>
				</th>';
	}
				
	echo '	</tr>
		</thead>
		<tbody>
			<tr>
				<td rowspan="4" class="img-td col-xs-3"><img src="../images/products/'. $row['img_loc'] .'" alt="Image for '. $row['prod_name'] .'" class="prod-img col-xs-12"/></td>
				<td class="col-xs-3">Quantity: '. $row['prod_quant'] .'</td>
				<td class="col-xs-3">Restock at: '. $row['prod_stock'] .'</td>
				<td class="col-xs-3">Stock Last Updated: '. $row['prod_alt_date'] .'</td>
			</tr>
			<tr>
				<td colspan="3">Description: '. $row['prod_descript'] .'</td>
			</tr>
			<tr>';
			
	$sql2 = 'select Price.prod_id, price_sdate, price from Price where Price.prod_id = '. $row['prod_id'] .' order by price_sdate DESC';
	$results2 = mysqli_query($link, $sql2);
			
	$count = 0;
	while ($row2 = mysqli_fetch_array($results2))
	{
		if ($count == 0) {
			echo '<td colspan="3">Price: $'. $row2['price'] .'</td>';
		}
		$count++;
	}
			
	echo '	</tr>
			<tr>
				<td ';
	
	if ($_SESSION['perm_id'] >= 333) {
		echo 'colspan="2"';
	} else {
		echo 'colspan="3"';
	}
	
	echo '			>Parts: ';
	
	$sql3 = 'select part_name from Part, ProductPart where productPart.part_id = Part.part_id and ProductPart.prod_id = '. $row['prod_id'] .';';
	$results3 = mysqli_query($link, $sql3);
	
	$count = 0;
	while ($row3 = mysqli_fetch_array($results3))
	{
		if ($count > 0)
		{
			echo ', ';
		}
		
		echo $row3['part_name'];
		$count++;
	}
	
	if ($count == 0)
	{
		echo 'no parts found';
	}
				
	echo '		</td>';
	
	if ($_SESSION['perm_id'] >= 333) {
		echo '	<td>
					<form name="edit_form" method="post" action="../edit/edit_product_part_form.php">
						<input type="hidden" name="edit_prod_input" value="'. $row['prod_id'] .'" />
						<button class="btn btn-default fa fa-pencil pull-right"></button>
					</form>
				</td>';
	}
				
	echo '	</tr>
		</tbody>
	</table>';
}

echo '<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="delete_modal_Label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    	<form name="modal_delete_form" action="../delete/delete_products.php" method="post">
      <div class="modal-header">
        <button type="button" class="close fa fa-remove fa-lg" data-dismiss="modal" aria-label="Close"></button>
        <h4 class="modal-title" id="delete_modal_Label">Delete</h4>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this product?
        <input type="hidden" name="delete_prod_input" id="delete_prod_input" />
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
<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: ../php/login.php');
} else if ($_SESSION['previous_page'] != 'edit_product_part_form.php' and $_SESSION['previous_page'] != 'add_product_part_form.php') {
	header('Location: ../index.php');
} else {

$page = 'product';

$_SESSION['previous_page'] = 'add_product_part_form.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Product Part Relationship Add</title>';
include '../include/banner.inc';
include '../include/navbar_3.inc';

if (isset($_POST['add_prod_input']))
{

	// Open the database
	if (!mysqli_select_db($link, $db5)){
		die('Could not connect: ' . mysqli_error($link));
		exit();
	}
	
	$sql = 'select Product.prod_id, prod_name, prod_descript, img_loc, prod_quant, prod_stock, prod_alt_date from Product, ProductInventory where Product.prod_id = ProductInventory.prod_id;';
	$results = mysqli_query($link, $sql);
	
	$found = false;
	while ($row = mysqli_fetch_array($results))
	{
		if ($row['prod_id'] == $_POST['add_prod_input'])
		{
			$found = true;
		
			echo '
	<!-- Content Start -->
	<div id="content" class="pull-left">
		<form name="add_product_part_form" action="add_product_part_submit.php" method="post" class="edit_form" onsubmit="return addProductPartVal();">
			<table class="table-mgt">
				<thead>
					<tr>
						<th colspan="2" id="prod_part_h1"><h1>Add Product Part Relationship</h1></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<label for="part_id">Part:</label>
						</td>
						<td>
							<select name="part_id" id="part_id" class="form-control">
								<option value="NONE">Select Part</option>';
				
			$sql2 = 'select Part.part_id, part_name from Part';
			$results2 = mysqli_query($link, $sql2);
			
			while ($row2 = mysqli_fetch_array($results2))
			{		
				echo '<option value="'. $row2['part_id'] .'">'. $row2['part_name'] .'</option>';
			}
					
			echo '			</select>
						</td>
					</tr>
					<tr>
						<td>
							<label for="req_num">Required Number or Parts:</label>
						</td>
						<td>
							<input type="number" name="req_num" id="req_num" value="" class="form-control" />
						</td>
					</tr>
					<tr class="edit_form_buttons">
						<td colspan="2">
							<input type="hidden" name="prod_id" id="prod_id" value="'. $_POST['add_prod_input'] .'" />
							<input type="submit" name="submit_edit" value="Submit" class="btn btn-primary" />
							<input type="reset" name="clear_edit" value="Clear" class="btn btn-default" />
						</td>
					</tr>
				</tbody>
			</table>
		</form>
		<a class="btn btn-default pull-right" href="../php/products_mgt.php">Return</a>
	</div>
	<!-- Content End -->';
	
		}
	}
	
	if ($found == false)
	{
		echo '
		<!-- Content Start -->
		<div id="content" class="pull-left">
			<h1>Add Product Part Relationship</h1>
			<p>The product was not found.</p>
			<a class="btn btn-default" href="../php/products_mgt.php">Return</a>
		</div>
		<!-- Content End -->';
	}
}
else
{
	echo '
	<!-- Content Start -->
	<div id="content" class="pull-left">
		<h1>Add Product Part Relationship</h1>
		<p>There was an issue adding the product part relationship.</p>
		<a class="btn btn-default" href="../php/products_mgt.php">Return</a>
	</div>
	<!-- Content End -->';
}

mysqli_close($link);

include '../include/footer.inc';

}

?>
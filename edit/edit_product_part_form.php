<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: ../php/login.php');
} else if ($_SESSION['previous_page'] != 'products_mgt.php' and $_SESSION['previous_page'] != 'edit_product_part_form.php' and $_SESSION['previous_page'] != 'delete_product_part.php') {
	header('Location: ../index.php');
} else {

$page = 'product';

$_SESSION['previous_page'] = 'edit_product_part_form.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Product Part Relationship Edit</title>';
include '../include/banner.inc';
include '../include/navbar_3.inc';

if (isset($_POST['edit_prod_input']))
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
		if ($row['prod_id'] == $_POST['edit_prod_input'])
		{
			$found = true;
		
			echo '
	<!-- Content Start -->
	<div id="content" class="pull-left">
	
			<table class="table-mgt">
				<thead>
					<tr>
						<th colspan="2" id="prod_part_h1"><h1>Edit Product Part Relationship</h1></th>
					</tr>
					<tr>
						<th>'. $row['prod_name'] .'</th>
						<th>
							<form name="add_form" method="post" action="../add/add_product_part_form.php">
								<input type="hidden" name="add_prod_input" value="'. $row['prod_id'] .'" />
								<button class="btn btn-default fa fa-plus pull-right"></button>
							</form>
						</th>
					</tr>
				</thead>
				<tbody>';
				
			$sql2 = 'select Part.part_id, part_name from ProductPart, Part where Part.part_id = ProductPart.part_id and ProductPart.prod_id = '. $row['prod_id'];
			$results2 = mysqli_query($link, $sql2);
			
			while ($row2 = mysqli_fetch_array($results2))
			{
				echo '<tr>
						<td>
							<label for="part_'. $row2['part_id'] .'">'. $row2['part_name'] .'</label>
						</td>
						<td>
							<button class="btn btn-default fa fa-trash pull-right"  onclick="$(\'#delete_prod_input\').val(\''. $row['prod_id'] .'\');$(\'#delete_part_input\').val(\''. $row2['part_id'] .'\');$(\'#delete_modal\').modal(\'show\');"></button>
						</td>
					</tr>';
			}
					
			echo '
				</tbody>
			</table>
			
		<a class="btn btn-default pull-right" href="../php/products_mgt.php">Return</a>
	</div>
	
	<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="delete_modal_Label">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
			<form name="modal_delete_form" action="../delete/delete_product_part.php" method="post">
		  <div class="modal-header">
			<button type="button" class="close fa fa-remove fa-lg" data-dismiss="modal" aria-label="Close"></button>
			<h4 class="modal-title" id="delete_modal_Label">Delete</h4>
		  </div>
		  <div class="modal-body">
			Are you sure you want to delete this product part relationship?
			<input type="hidden" name="delete_prod_input" id="delete_prod_input" />
			<input type="hidden" name="delete_part_input" id="delete_part_input" />
		  </div>
		  <div class="modal-footer">
			<button type="submit" class="btn btn-primary">Delete</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
			</form>
		</div>
	  </div>
	</div>
	
	<!-- Content End -->';
	
		}
	}
	
	if ($found == false)
	{
		echo '
		<!-- Content Start -->
		<div id="content" class="pull-left">
			<h1>Edit Product Part Relationship</h1>
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
		<h1>Edit Product Part Relationship</h1>
		<p>There was an issue editing the product part relationship.</p>
		<a class="btn btn-default" href="../php/products_mgt.php">Return</a>
	</div>
	<!-- Content End -->';
}

mysqli_close($link);

include '../include/footer.inc';

}

?>
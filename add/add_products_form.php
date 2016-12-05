<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: ../php/login.php');
} else if ($_SESSION['previous_page'] != 'products_mgt.php' and $_SESSION['previous_page'] != 'add_products_form.php') {
	header('Location: ../index.php');
} else {

$page = 'product';

$_SESSION['previous_page'] = 'add_products_form.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Product Edit</title>';
include '../include/banner.inc';
include '../include/navbar_3.inc';

// Open the database
if (!mysqli_select_db($link, $db5)){
	die('Could not connect: ' . mysqli_error($link));
	exit();
}

echo '
<!-- Content Start -->
<div id="content" class="pull-left">
	<form name="add_product_form" action="add_products_submit.php" method="post" class="edit_form" onsubmit="return AddProductVal();" enctype="multipart/form-data">
		<table class="table-mgt">
			<thead>
				<tr>
					<th colspan="2"><h1>Add Product</h1></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<label for="prod_name">Product Name:</label>
					</td>
					<td>
						<input type="text" name="prod_name" id="prod_name" size="45" class="form-control" value="" />
					</td>
				</tr>
				<tr>
					<td>
						<label for="prod_descript">Product Description:</label>
					</td>
					<td>
						<textarea name="prod_descript" id="prod_descript" rows="3" class="form-control" ></textarea>
					</td>
				</tr>
				<tr>
					<td>
						<label for="img_loc">Product Image:</label>
					</td>
					<td>
						<input type="file" name="fileToUpload" id="fileToUpload" class="form-control" />
					</td>
				</tr>
				<tr>
					<td>
						<label for="prod_quant">Quantity:</label>
					</td>
					<td>
						<input type="number" name="prod_quant" id="prod_quant" size="10" class="form-control" value="" />
					</td>
				</tr>
				<tr>
					<td>
						<label for="prod_stock">Restock At:</label>
					</td>
					<td>
						<input type="number" name="prod_stock" id="prod_stock" size="10" class="form-control" value="" />
					</td>
				</tr>
				<tr>
					<td>
						<label for="price">Product Price:</label>
					</td>
					<td>
						<input type="number" name="price" id="price" size="10" class="form-control" value="" />
					</td>
				</tr>
				<tr class="edit_form_buttons">
					<td colspan="2">
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

mysqli_close($link);

include '../include/footer.inc';

}

?>
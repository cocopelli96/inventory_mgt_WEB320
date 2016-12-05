<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: ../php/login.php');
} else if ($_SESSION['previous_page'] != 'products_mgt.php' and $_SESSION['previous_page'] != 'edit_products_form.php') {
	header('Location: ../index.php');
} else {

$page = 'product';

$_SESSION['previous_page'] = 'edit_products_form.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Product Edit</title>';
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
		<form name="edit_product_form" action="edit_products_submit.php" method="post" class="edit_form" onsubmit="return editProductVal();">
			<table class="table-mgt">
				<thead>
					<tr>
						<th colspan="2"><h1>Edit Product</h1></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<label for="prod_name">Product Name:</label>
						</td>
						<td>
							<input type="text" name="prod_name" id="prod_name" size="45" class="form-control" value="'. $row['prod_name'] .'" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="prod_descript">Product Description:</label>
						</td>
						<td>
							<textarea name="prod_descript" id="prod_descript" rows="3" class="form-control" >'. $row['prod_descript'] .'</textarea>
						</td>
					</tr>
					<!-- This is for the image but do I want to have edit image?
					<tr>
						<td>
							<label for="img_loc">Product Image:</label>
						</td>
						<td>
							<input type="file" name="img_loc" id="img_loc" size="45" class="form-control" style="height: inherit;" value="'. $row['img_loc'] .'" />
						</td>
					</tr>
					-->
					<tr>
						<td>
							<label for="prod_quant">Quantity:</label>
						</td>
						<td>
							<input type="number" name="prod_quant" id="prod_quant" size="10" class="form-control" value="'. $row['prod_quant'] .'" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="prod_stock">Restock At:</label>
						</td>
						<td>
							<input type="number" name="prod_stock" id="prod_stock" size="10" class="form-control" value="'. $row['prod_stock'] .'" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="prod_alt_date">Stock Last Updated:</label>
						</td>
						<td>
							<input type="date" name="prod_alt_date" id="prod_alt_date" size="45" class="form-control" value="'. $row['prod_alt_date'] .'" disabled />
						</td>
					</tr>';
					
			$sql2 = 'select Price.prod_id, price_sdate, price from Price where Price.prod_id = '. $row['prod_id'] .' order by price_sdate DESC;';
			$results2 = mysqli_query($link, $sql2);
			
			$count = 0;
			while ($row2 = mysqli_fetch_array($results2))
			{
				if ($count == 0)
				{
					echo '
					<tr>
						<td>
							<label for="price">Product Price:</label>
						</td>
						<td>
							<input type="number" name="price" id="price" size="10" class="form-control" value="'. $row2['price'] .'" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="price_sdate">Price Last Updated:</label>
						</td>
						<td>
							<input type="date" name="price_sdate" id="price_sdate" size="45" class="form-control" value="'. $row2['price_sdate'] .'" disabled />
						</td>
					</tr>';
				}
				$count++;
			}
					
			echo '
					<tr class="edit_form_buttons">
						<td colspan="2">
							<input type="hidden" name="prod_id" value="'. $row['prod_id'] .'" />
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
			<h1>Edit Product</h1>
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
		<h1>Edit Product</h1>
		<p>There was an issue editing the product.</p>
		<a class="btn btn-default" href="../php/products_mgt.php">Return</a>
	</div>
	<!-- Content End -->';
}

mysqli_close($link);

include '../include/footer.inc';

}

?>
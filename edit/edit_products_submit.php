<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: ../php/login.php');
} else if ($_SESSION['previous_page'] != 'edit_products_form.php' and $_SESSION['previous_page'] != 'edit_products_submit.php') {
	header('Location: ../index.php');
} else {

$page = 'product';

$_SESSION['previous_page'] = 'edit_products_submit.php';

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

$prod_name = htmlspecialchars(stripslashes($_POST['prod_name']));
$prod_id = intval(htmlspecialchars(stripslashes($_POST['prod_id'])));
$prod_descript = htmlspecialchars(stripslashes($_POST['prod_descript']));
$prod_quant = intval(htmlspecialchars(stripslashes($_POST['prod_quant'])));
$prod_stock = intval(htmlspecialchars(stripslashes($_POST['prod_stock'])));
$price = intval(htmlspecialchars(stripslashes($_POST['price'])));

echo '
<!-- Content Start -->
<div id="content" class="pull-left">
	<h1>Confirm Edit Product</h1>';
	
$updated = false;
if (isset($prod_name) and isset($prod_id))
{
	$sql = 'select Product.prod_id, prod_name, prod_descript, img_loc from Product;';
	$results = mysqli_query($link, $sql);
	
	while ($row = mysqli_fetch_array($results))
	{
		if ($row['prod_id'] == $prod_id and $row['prod_name'] != $prod_name)
		{
			$update = 'update Product set prod_name = "'. $prod_name .'" where prod_id = '. $prod_id;
			$update_results = mysqli_query($link, $update);
			
			if ($update_results == true)
			{
				echo '<p>Product Name updated.</p>';
				$updated = true;
			} else {
				echo '<p>The product was not updated.</p>';
			}
		}
	}
}

if (isset($prod_descript) and isset($prod_id))
{
	$sql = 'select Product.prod_id, prod_name, prod_descript, img_loc from Product;';
	$results = mysqli_query($link, $sql);
	
	while ($row = mysqli_fetch_array($results))
	{
		if ($row['prod_id'] == $prod_id and $row['prod_descript'] != $prod_descript)
		{
			$update = 'update Product set prod_descript = "'. $prod_descript .'" where prod_id = '. $prod_id;
			$update_results = mysqli_query($link, $update);
			
			if ($update_results == true)
			{
				echo '<p>Product Description updated.</p>';
				$updated = true;
			} else {
				echo '<p>The product was not updated.</p>';
			}
		}
	}
}

if (isset($prod_quant) and isset($prod_id))
{
	$sql = 'select ProductInventory.prod_id, prod_quant, prod_stock, prod_alt_date from ProductInventory;';
	$results = mysqli_query($link, $sql);
	
	while ($row = mysqli_fetch_array($results))
	{
		if ($row['prod_id'] == $prod_id and $row['prod_quant'] != $prod_quant)
		{
			$update = 'update ProductInventory set prod_quant = '. $prod_quant .', prod_alt_date = NOW() where prod_id = '. $prod_id;
			$update_results = mysqli_query($link, $update);
			
			if ($update_results == true)
			{
				echo '<p>Product Quantity updated.</p>';
				$updated = true;
			} else {
				echo '<p>The product inventory was not updated.</p>';
			}
		}
	}
}

if (isset($prod_stock) and isset($prod_id))
{
	$sql = 'select ProductInventory.prod_id, prod_quant, prod_stock, prod_alt_date from ProductInventory;';
	$results = mysqli_query($link, $sql);
	
	while ($row = mysqli_fetch_array($results))
	{
		if ($row['prod_id'] == $prod_id and $row['prod_stock'] != $prod_stock)
		{
			$update = 'update ProductInventory set prod_stock = '. $prod_stock .', prod_alt_date = NOW() where prod_id = '. $prod_id;
			$update_results = mysqli_query($link, $update);
			
			if ($update_results == true)
			{
				echo '<p>Product Restock updated.</p>';
				$updated = true;
			} else {
				echo '<p>The product inventory was not updated.</p>';
			}
		}
	}
}

if (isset($price) and isset($prod_id))
{
	$sql = 'select Price.prod_id, price, price_sdate from Price where Price.prod_id = '. $prod_id .' order by price_sdate desc limit 1;';
	$results = mysqli_query($link, $sql);
	
	while ($row = mysqli_fetch_array($results))
	{
		if ($row['prod_id'] == $prod_id and $row['price'] != $price)
		{
			$update = 'insert into PriceHistory values('. $row['prod_id'] .',"'. $row['price_sdate'] .'",NOW());';
			$update2 = 'insert into Price values('. $row['prod_id'] .',NOW(),'. $price .');';
			$update_results = mysqli_query($link, $update);
			$update_results2 = mysqli_query($link, $update2);
			
			if ($update_results == true and $update_results2 == true)
			{
				echo '<p>Product Price updated.</p>';
				$updated = true;
			} else {
				echo '<p>The product price was not updated.</p>';
			}
		}
	}
}

if ($updated == false)
{
	echo '<p>Product was not updated.</p>';
}

echo '
	<a class="btn btn-default pull-right" href="../php/products_mgt.php">Return</a>
</div>
<!-- Content End -->';

mysqli_close($link);

include '../include/footer.inc';

}

?>
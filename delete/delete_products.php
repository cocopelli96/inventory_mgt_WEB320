<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: ../php/login.php');
} else if ($_SESSION['previous_page'] != 'products_mgt.php' and $_SESSION['previous_page'] != 'delete_products.php') {
	header('Location: ../index.php');
} else {

$page = 'product';

$_SESSION['previous_page'] = 'delete_products.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Product Delete</title>';
include '../include/banner.inc';
include '../include/navbar_3.inc';

if (isset($_POST['delete_prod_input']))
{

	// Open the database
	if (!mysqli_select_db($link, $db6)){
		die('Could not connect: ' . mysqli_error($link));
		exit();
	}
	
	$sql = 'select order_id, prod_id, quant from OrderItem where prod_id = '. $_POST['delete_prod_input'];
	$results = mysqli_query($link, $sql);
	
	$count = 0;
	while ($row = mysqli_fetch_array($results))
	{
		if ($row['prod_id'] == $_POST['delete_prod_input'])
		{
			$count++;
		}
	}
	
	if ($count == 0)
	{
		// Open the database
		if (!mysqli_select_db($link, $db5)){
			die('Could not connect: ' . mysqli_error($link));
			exit();
		}

		$file_sql = 'select img_loc from Product where prod_id = '. $_POST['delete_prod_input'];
		$sql1 = 'delete from PriceHistory where prod_id = '. $_POST['delete_prod_input'];
		$sql2 = 'delete from Price where prod_id = '. $_POST['delete_prod_input'];
		$sql3 = 'delete from ProductPart where prod_id = '. $_POST['delete_prod_input'];
		$sql4 = 'delete from ProductInventory where prod_id = '. $_POST['delete_prod_input'];
		$sql5 = 'delete from Product where prod_id = '. $_POST['delete_prod_input'];

		$file_results = mysqli_query($link, $file_sql);
		$results1 = mysqli_query($link, $sql1);
		$results2 = mysqli_query($link, $sql2);
		$results3 = mysqli_query($link, $sql3);
		$results4 = mysqli_query($link, $sql4);
		$results5 = mysqli_query($link, $sql5);
		
		while ($file_row = mysqli_fetch_array($file_results))
		{
			$target_file = $file_row['img_loc'];
		}
		
		//begin upload code
		//bored upload code setup from w3school.com
		$full_path = "../images/products/".$target_file;
		$uploadOk = 1;
		// Check if file already exists
		if (!file_exists($full_path)) {
			echo "Sorry, file doesn't exist.<br />";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not deleted.<br />";
		// if everything is ok, try to upload file
		} else {
			if (unlink($full_path)) {
				echo "The file ". $target_file . " has been deleted.";
			} else {
				echo "Sorry, there was an error deleting your file.";
			}
		}
	
		echo '
		<!-- Content Start -->
		<div id="content" class="pull-left">
			<h1>Delete Product</h1>
			<p>The product has been deleted.</p>
			<a class="btn btn-default" href="../php/products_mgt.php">Return</a>
		</div>
		<!-- Content End -->';
	}
	else
	{
		echo '
		<!-- Content Start -->
		<div id="content" class="pull-left">
			<h1>Delete Product</h1>
			<p>You cannot delete this product as there are orders that are using it.</p>
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
		<h1>Delete Product</h1>
		<p>There was an issue deleting the product.</p>
		<a class="btn btn-default" href="../php/products_mgt.php">Return</a>
	</div>
	<!-- Content End -->';
}

mysqli_close($link);

include '../include/footer.inc';

}

?>
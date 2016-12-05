<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: ../php/login.php');
} else if ($_SESSION['previous_page'] != 'edit_product_part_form.php' and $_SESSION['previous_page'] != 'delete_product_part.php') {
	header('Location: ../index.php');
} else {

$page = 'product';

$_SESSION['previous_page'] = 'delete_product_part.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Product Part Relationship Delete</title>';
include '../include/banner.inc';
include '../include/navbar_3.inc';

if (isset($_POST['delete_prod_input']) and isset($_POST['delete_part_input']))
{

	// Open the database
	if (!mysqli_select_db($link, $db5)){
		die('Could not connect: ' . mysqli_error($link));
		exit();
	}
	
	$sql = 'select part_id, prod_id from ProductPart where prod_id = '. $_POST['delete_prod_input'] .' and part_id = '. $_POST['delete_part_input'];
	$results = mysqli_query($link, $sql);
	
	$found = false;
	while ($row = mysqli_fetch_array($results))
	{
		if ($row['prod_id'] == $_POST['delete_prod_input'] and $row['part_id'] == $_POST['delete_part_input'])
		{
			$found = true;
		}
	}
	
	if ($found)
	{
		$sql1 = 'delete from ProductPart where prod_id = '. $_POST['delete_prod_input'] .' and part_id = '. $_POST['delete_part_input'];
		
		$results1 = mysqli_query($link, $sql1);
	
		echo '
		<!-- Content Start -->
		<div id="content" class="pull-left">
			<h1>Delete Product Part Relationship</h1>
			<p>The product part relationship has been deleted.</p>
			<form name="edit_form" method="post" action="../edit/edit_product_part_form.php">
				<input type="hidden" name="edit_prod_input" value="'. $_POST['delete_prod_input'] .'" />
				<button class="btn btn-default">Return</button>
			</form>
		</div>
		<!-- Content End -->';
	}
	else
	{
		echo '
		<!-- Content Start -->
		<div id="content" class="pull-left">
			<h1>Delete Product Part Relationship</h1>
			<p>You cannot delete this product part relationship.</p>
			<form name="edit_form" method="post" action="../edit/edit_product_part_form.php">
				<input type="hidden" name="edit_prod_input" value="'. $_POST['delete_prod_input'] .'" />
				<button class="btn btn-default">Return</button>
			</form>
		</div>
		<!-- Content End -->';
	}
}
else
{
	echo '
	<!-- Content Start -->
	<div id="content" class="pull-left">
		<h1>Delete Product Part Relationship</h1>
		<p>There was an issue deleting the product part relationship.</p>
		<a class="btn btn-default" href="../php/products_mgt.php">Return</a>
	</div>
	<!-- Content End -->';
}

mysqli_close($link);

include '../include/footer.inc';

}

?>
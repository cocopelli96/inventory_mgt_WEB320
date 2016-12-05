<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: ../php/login.php');
} else if ($_SESSION['previous_page'] != 'add_product_part_form.php' and $_SESSION['previous_page'] != 'add_product_part_submit.php') {
	header('Location: ../index.php');
} else {

$page = 'product';

$_SESSION['previous_page'] = 'add_product_part_submit.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Product Part Relationship Add</title>';
include '../include/banner.inc';
include '../include/navbar_3.inc';

// Open the database
if (!mysqli_select_db($link, $db5)){
	die('Could not connect: ' . mysqli_error($link));
	exit();
}

$part_id = intval(htmlspecialchars(stripslashes($_POST['part_id'])));
$prod_id = intval(htmlspecialchars(stripslashes($_POST['prod_id'])));
$req_num = intval(htmlspecialchars(stripslashes($_POST['req_num'])));
	
echo '
<!-- Content Start -->
<div id="content" class="pull-left">
	<h1>Confirm Add Product Part Relationship</h1>';
	
$updated = false;
if (isset($part_id) and isset($prod_id) and isset($req_num))
{
	$update = 'insert into ProductPart values('. $prod_id .','. $part_id .','. $req_num .')';
	$update_results = mysqli_query($link, $update);
			
	if ($update_results == true)
	{
		echo '<p>Product Part Relationship added.</p>';
		$updated = true;
	} else {
		echo '<p>The product part relationship was not added.</p>';
	}
}

if ($updated == false)
{
	echo '<p>Product Part Relationship was not added.</p>';
}

echo '
	<a class="btn btn-default pull-right" href="../php/products_mgt.php">Return</a>
</div>
<!-- Content End -->';

mysqli_close($link);

include '../include/footer.inc';

}

?>
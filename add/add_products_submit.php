<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: ../php/login.php');
} else if ($_SESSION['previous_page'] != 'add_products_form.php' and $_SESSION['previous_page'] != 'add_products_submit.php') {
	header('Location: ../index.php');
} else {

$page = 'product';

$_SESSION['previous_page'] = 'add_products_submit.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Product Add</title>';
include '../include/banner.inc';
include '../include/navbar_3.inc';

// Open the database
if (!mysqli_select_db($link, $db5)){
	die('Could not connect: ' . mysqli_error($link));
	exit();
}

$prod_name = htmlspecialchars(stripslashes($_POST['prod_name']));
$img_loc = htmlspecialchars(stripslashes($_POST['img_loc']));
$prod_descript = htmlspecialchars(stripslashes($_POST['prod_descript']));
$prod_quant = intval(htmlspecialchars(stripslashes($_POST['prod_quant'])));
$prod_stock = intval(htmlspecialchars(stripslashes($_POST['prod_stock'])));
$price = intval(htmlspecialchars(stripslashes($_POST['price'])));

echo '
<!-- Content Start -->
<div id="content" class="pull-left">
	<h1>Confirm Add Product</h1>';
	
$updated = false;
$prod_id = 0;
//begin upload code
//bored upload code setup from w3school.com
$target_dir = "../images/products/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$database_file = basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".<br />";
        $uploadOk = 1;
    } else {
        echo "File is not an image.<br />";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.<br />";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000000) {
    echo "Sorry, your file is too large.<br />";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br />";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.<br />";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
	
		if (isset($prod_name) and isset($prod_id) and isset($prod_descript) and isset($prod_quant) and isset($prod_stock) and isset($price))
		{
			$sql = 'select Product.prod_id, prod_name, prod_descript, img_loc from Product;';
			$results = mysqli_query($link, $sql);
	
			while ($row = mysqli_fetch_array($results))
			{
				$prod_id++;
				if ($prod_id != $row['prod_id'])
				{
					break;
				}
			}
			
			if ($prod_id == mysqli_num_rows($results))
			{
				$prod_id++;
			}
			
			$update = 'insert into Product values('. $prod_id .',"'. $prod_name .'","'. $prod_descript .'","'. $database_file .'");';
			$update_results = mysqli_query($link, $update);
	
			if ($update_results == true)
			{
				echo '<p>Product added.</p>';
				$updated = true;
				
				$update2 = 'insert into ProductInventory values('. $prod_id .','. $prod_quant .','. $prod_stock .',NOW());';
				$update_results2 = mysqli_query($link, $update2);
				
				if ($update_results2 == true)
				{
					echo '<p>Product Inventory added.</p>';
					$updated = true;
					
					$update3 = 'insert into Price values('. $prod_id .',NOW(),'. $price .');';
					$update_results3 = mysqli_query($link, $update3);
			
					if ($update_results3 == true)
					{
						echo '<p>Product Price added.</p>';
						$updated = true;
					} else {
						echo '<p>The product price was not added.</p>';
						$updated = false;
					
						$delete = 'delete from Product where prod_id = '. $prod_id .';';
						$delete2 = 'delete from ProductInventory where prod_id = '. $prod_id .';';
						$delete_results = mysqli_query($link, $delete);
						$delete_results2 = mysqli_query($link, $delete2);
					}
				} else {
					echo '<p>The product inventory was not added.</p>';
					$updated = false;
					
					$delete = 'delete from Product where prod_id = '. $prod_id .';';
					$delete_results = mysqli_query($link, $delete);
				}
			} else {
				echo '<p>The product was not added.</p>';
			}
		}
		
    } else {
        echo "Sorry, there was an error uploading the product's image.";
    }
}

if ($updated == false)
{
	echo '<p>Product was not added.</p>';
}

echo '
	<a class="btn btn-default pull-right" href="../php/products_mgt.php">Return</a>
</div>
<!-- Content End -->';

mysqli_close($link);

include '../include/footer.inc';

}

?>
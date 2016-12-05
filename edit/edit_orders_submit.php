<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: ../php/login.php');
} else if ($_SESSION['previous_page'] != 'edit_orders_form.php' and $_SESSION['previous_page'] != 'edit_orders_submit.php') {
	header('Location: ../index.php');
} else {

$page = 'order';

$_SESSION['previous_page'] = 'edit_orders_submit.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Order Edit</title>';
include '../include/banner.inc';
include '../include/navbar_3.inc';

// Open the database
if (!mysqli_select_db($link, $db6)){
	die('Could not connect: ' . mysqli_error($link));
	exit();
}

$order_id = intval(htmlspecialchars(stripslashes($_POST['order_id'])));
$stat_id = intval(htmlspecialchars(stripslashes($_POST['stat_id'])));

echo '
<!-- Content Start -->
<div id="content" class="pull-left">
	<h1>Confirm Edit Order</h1>';
	
$updated = false;
if (isset($stat_id) and isset($order_id))
{
	$sql = 'select OrderStatus.order_id, stat_id, start_date, uid from OrderStatus where OrderStatus.order_id = '. $order_id .' order by start_date desc limit 1;';
	$results = mysqli_query($link, $sql);
	
	while ($row = mysqli_fetch_array($results))
	{
		if ($row['order_id'] == $order_id and $row['stat_id'] != $stat_id)
		{
			$update = 'insert into OrderStatusHistory values('. $row['order_id'] .','. $row['stat_id'] .',"'. $row['start_date'] .'",NOW());';
			$update2 = 'insert into OrderStatus values('. $row['order_id'] .','. $stat_id .',NOW(),'. $_SESSION['uid'] .');';
			$update_results = mysqli_query($link, $update);
			$update_results2 = mysqli_query($link, $update2);
			
			if ($update_results == true and $update_results2 == true)
			{
				echo '<p>Order Status updated.</p>';
				$updated = true;
			} else {
				echo '<p>The order was not updated.</p>';
			}
		}
	}
}

if ($updated == false)
{
	echo '<p>Order was not updated.</p>';
}

echo '
	<a class="btn btn-default pull-right" href="../php/order_mgt.php">Return</a>
</div>
<!-- Content End -->';

mysqli_close($link);

include '../include/footer.inc';

}

?>
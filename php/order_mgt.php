<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: login.php');
} else {

$page = 'order';

$_SESSION['previous_page'] = 'order_mgt.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Order Management</title>';
include '../include/banner.inc';
include '../include/navbar_2.inc';

// Open the database
if (!mysqli_select_db($link, $db6)){
	die('Could not connect: ' . mysqli_error($link));
    exit();
}

$sql = 'select CustomerOrder.order_id, order_date, sales_tax, shipping_cost, uid from CustomerOrder, OrderPayment where CustomerOrder.order_id = OrderPayment.order_id order by CustomerOrder.order_id;';
$results = mysqli_query($link, $sql);

echo '
<!-- Content Start -->
<div id="content" class="pull-left">

	<h1 class="h1-mgt pull-left">Order</h1>
	
		<table class="table-mgt">
			<thead>
				<tr>
					<th>Order ID</th>
					<th>Order date</th>
					<th>Customer</th>
					<th>Status</th>
					<th>Status Date</th>
					<th>Employee</th>
					<th>Update Status</th>
				</tr>
			</thead>
			<tbody>';
	
$orders = 0;
while ($row = mysqli_fetch_array($results))
{		
	$orders++;
	
	echo '<tr>
			<td>'. $row['order_id'] .'</td>
			<td>'. $row['order_date'] .'</td>';
		
	// Open the database
	if (!mysqli_select_db($link, $db1)){
		die('Could not connect: ' . mysqli_error($link));
		exit();
	}
	
	$sql2 = 'select ufn, uln, uid from User where uid = '. $row['uid'];
	$results2 = mysqli_query($link, $sql2);
	
	while ($row2 = mysqli_fetch_array($results2))
	{
		echo '	<td>'. $row2['ufn'] .' '. $row2['uln'] .'</td>';
	}
	
	// Open the database
	if (!mysqli_select_db($link, $db6)){
		die('Could not connect: ' . mysqli_error($link));
		exit();
	}
	
	$sql1 = 'select order_id, OrderStatus.stat_id, start_date, uid, stat_descript from OrderStatus, StatusCode where order_id =  '. $row['order_id'] .' and StatusCode.stat_id = OrderStatus.stat_id order by start_date desc limit 1;';
	$results1 = mysqli_query($link, $sql1);

	$stat = false;
	while ($row1 = mysqli_fetch_array($results1))
	{	
		$stat = true;
		echo '
			<td>'. $row1['stat_descript'] .'</td>
			<td>'. $row1['start_date'] .'</td>
			<td>';
		
		// Open the database
		if (!mysqli_select_db($link, $db1)){
			die('Could not connect: ' . mysqli_error($link));
			exit();
		}
		
		$sql3 = 'select uid, concat(ufn," ",uln) as "name" from User where User.uid = '. $row1['uid'];
		$results3 = mysqli_query($link, $sql3);
		
		while ($row3 = mysqli_fetch_array($results3))
		{
			echo $row3['name'];
		}
		
		echo '</td>';
	}
	
	if ($stat == false)
	{
		echo '<td>Being Fullfilled</td>
			<td>'. $row['order_date'] .'</td>
			<td>N/A</td>';
	}
	
	echo '
			<td>
				<form name="edit_form" method="post" action="../edit/edit_orders_form.php">
					<input type="hidden" name="edit_order_input" value="'. $row['order_id'] .'" />
					<button class="btn btn-default fa fa-pencil"></button>
				</form>
			</td>
		</tr>';
}

if ($orders == 0)
{
	echo '<tr>
			<td colspan="7">There are no orders.</td>
		</tr>';
}

echo '	</tbody>
	</table>';
	
echo '
</div>
<!-- Content End -->
';

mysqli_close($link);

include '../include/footer.inc';

}

?>
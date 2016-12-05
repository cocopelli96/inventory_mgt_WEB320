<?php

require '../include/session.inc';

if ($login == false) {
	header('Location: ../php/login.php');
} else if ($_SESSION['previous_page'] != 'order_mgt.php' and $_SESSION['previous_page'] != 'edit_orders_form.php') {
	header('Location: ../index.php');
} else {

$page = 'order';

$_SESSION['previous_page'] = 'edit_orders_form.php';

require '../include/mysql.inc';
include '../include/header_2.inc';
echo '<title>Camp Champ Survival Store: Order Edit</title>';
include '../include/banner.inc';
include '../include/navbar_3.inc';

if (isset($_POST['edit_order_input']))
{

	// Open the database
	if (!mysqli_select_db($link, $db6)){
		die('Could not connect: ' . mysqli_error($link));
		exit();
	}
	
	$sql = 'select order_id, order_date from CustomerOrder;';
	$results = mysqli_query($link, $sql);
	
	$found = false;
	while ($row = mysqli_fetch_array($results))
	{
		if ($row['order_id'] == $_POST['edit_order_input'])
		{
			$found = true;
		
			echo '
	<!-- Content Start -->
	<div id="content" class="pull-left">
		<form name="edit_order_form" action="edit_orders_submit.php" method="post" class="edit_form" onsubmit="return editOrderVal();">
			<table class="table-mgt">
				<thead>
					<tr>
						<th colspan="2"><h1>Edit Order</h1></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<label for="order">Order:</label>
						</td>
						<td>
							<input type="text" name="order" id="order" class="form-control" value="'. $row['order_id'] .'" disabled />
						</td>
					</tr>
					<tr>
						<td>
							<label for="order_date">Order Date:</label>
						</td>
						<td>
							<input type="datetime" name="order_date" id="order_date"  class="form-control" value="'. $row['order_date'] .'" disabled />
						</td>
					</tr>';
				
			$sql1 = 'select stat_id, order_id from OrderStatus where OrderStatus.order_id = '. $row['order_id'] .' order by start_date desc limit 1;';
			$results1 = mysqli_query($link, $sql1);
	
			while ($row1 = mysqli_fetch_array($results1))
			{
				echo '<tr>
						<td>
							<label for="pos_id">Status:</label>
						</td>
						<td>
							<select name="stat_id" id="stat_id" class="form-control">';
		
				$sql2 = 'select stat_id, stat_descript from StatusCode;';
				$results2 = mysqli_query($link, $sql2);
		
				while ($row2 = mysqli_fetch_array($results2))
				{
					echo '<option value="'. $row2['stat_id'] .'"';
				
					if ($row2['stat_id'] == $row1['stat_id'])
					{
						echo 'selected';
					}
				
					echo '>'. $row2['stat_descript'] .'</option>';
				}
					
				echo '	</td>
					</tr>';
			}
				
			echo '	<tr class="edit_form_buttons">
						<td colspan="2">
							<input type="hidden" name="order_id" id="order_id" class="form-control" value="'. $row['order_id'] .'" />
							<input type="submit" name="submit_edit" value="Submit" class="btn btn-primary" />
							<input type="reset" name="clear_edit" value="Clear" class="btn btn-default" />
						</td>
					</tr>
				</tbody>
			</table>
		</form>
		<a class="btn btn-default pull-right" href="../php/order_mgt.php">Return</a>
	</div>
	<!-- Content End -->';
	
		}
	}
	
	if ($found == false)
	{
		echo '
		<!-- Content Start -->
		<div id="content" class="pull-left">
			<h1>Edit Order</h1>
			<p>The order was not found.</p>
			<a class="btn btn-default" href="../php/order_mgt.php">Return</a>
		</div>
		<!-- Content End -->';
	}
}
else
{
	echo '
	<!-- Content Start -->
	<div id="content" class="pull-left">
		<h1>Edit Order</h1>
		<p>There was an issue editing the order.</p>
		<a class="btn btn-default" href="../php/order_mgt.php">Return</a>
	</div>
	<!-- Content End -->';
}

mysqli_close($link);

include '../include/footer.inc';

}

?>
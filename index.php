<?php

require './include/session.inc';

if ($login == true)
{
	if ($_SESSION['perm_id'] >= 222)
	{
		header('Location: ./php/landing_mgt.php');
	}
	else if ($_SESSION['perm_id'] == 111)
	{
		header('Location: ./php/landing_cust.php');
	}
}
else
{
	header('Location: ./php/login.php');
}


?>
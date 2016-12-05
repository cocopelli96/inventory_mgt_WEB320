<?php

$server = 'localhost';
$user = 'root';
$pass = 'root';
$db1 = 'CampChamp_User';
$db2 = 'CampChamp_Employee';
$db3 = 'CampChamp_Customer';
$db4 = 'CampChamp_Vendor';
$db5 = 'CampChamp_Product';
$db6 = 'CampChamp_Order';

// Log into MySQL
$link = mysqli_connect($server, $user, $pass);
if (!$link){
	die('Could not connect: ' . mysqli_error($link));
	exit();
}
// Set database encoding
if (!mysqli_set_charset($link, 'utf8')){
	die('Could not encode: ' . mysqli_error($link));
    exit();
} 
// Open the database
// if (!mysqli_select_db($link, $db)){
// 	die('Could not connect: ' . mysqli_error($link));
//     exit();
// }

?>
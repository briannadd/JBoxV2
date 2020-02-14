<?php
//eRaider authentication
	require('include.php');
	require('group1.php');
	if(!in_array($_SESSION['eRaiderUsername'], $group1)) {
		echo 'Not authorized.';
		exit;
	}

//Creates connection to SQL database
include 'sql_connect.php';
mysql_select_db(langlab) or die('Cannot select database');

//Grab submitted form data (equipment rental transaction)
$Trans_ID = $_GET['Trans_ID'];
$Description = mysql_real_escape_string($_GET['Description']);
$WithdrawDate = $_GET['WithdrawDate'];
$WithdrawBy = $_GET['WithdrawBy'];
$Instructor = $_GET['Instructor'];
$CheckinDate = $_GET['CheckinDate'];
$CheckinBy = $_GET['CheckinBy'];

//SQL query inserts submitted form data into "transactions" table
$query = "INSERT INTO `transactions` ( `Description` , `WithdrawDate` , `WithdrawBy` , `Instructor` , `CheckinBy`)" .
    "VALUES ('" . $Description . "', '" . $WithdrawDate . "', '" . $WithdrawBy . "', '" . $Instructor . "', '" . $CheckinBy . "');";

//Run the queries
$result = mysql_query($query) or die(mysql_error());


header("Location: outstanding_equipment.php");

?>
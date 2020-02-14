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

//Gets form data from instructor_process.php
$Trans_ID = $_GET['Trans_ID'];
$Description = mysql_real_escape_string($_GET['Description']);
$WithdrawDate = $_GET['WithdrawDate'];
$WithdrawBy = $_GET['WithdrawBy'];
$Instructor = $_GET['Instructor'];
$CheckinDate = $_GET['CheckinDate'];
$CheckinBy = $_GET['CheckinBy'];

//This updates the "transactions" table
$query = "UPDATE langlab.transactions" .
    " SET langlab.transactions.Description = '" . $Description . "'," .
    " langlab.transactions.WithdrawDate = '" . $WithdrawDate . "'," .
    " langlab.transactions.WithdrawBy = '" . $WithdrawBy . "'," .
    " langlab.transactions.Instructor = '" . $Instructor . "'," .
    " langlab.transactions.CheckinDate = '" . $CheckinDate . "' ," .
    " langlab.transactions.CheckinBy = '" . $CheckinBy . "' " .
    " WHERE langlab.transactions.Trans_ID = '" . $Trans_ID . "';";

$result = mysql_query($query) or die(mysql_error());


header("Location: outstanding_equipment.php");

?>
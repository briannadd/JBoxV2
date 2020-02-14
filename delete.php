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

//Gets the equipment transaction ID to delete
$Trans_ID = $_GET['Trans_ID'];

//Deletes equipment transaction from "transactions" table
$query = "DELETE FROM langlab.transactions WHERE Trans_ID = '" . $Trans_ID . "';";

//Run the query
$result = mysql_query($query) or die(mysql_error());

//link variable is equal to the referring page
$link = $_SERVER['HTTP_REFERER'];
//sends a header directly to the browser telling it to redirect the user to the referring page
header("Location: $link");

?>
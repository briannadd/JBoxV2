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

//Gets form data from task_tracker.php
$bulletin = mysql_real_escape_string($_GET['bulletin']);
$UpdatedBy = $_SESSION['eRaiderUsername'];

//This updates the "bulletinboard" table
$query = "UPDATE langlab.bulletinboard" .
    " SET langlab.bulletinboard.bulletin = '" . $bulletin . "'," .
    " langlab.bulletinboard.updatedby = '" . $UpdatedBy . "'" .
	" WHERE type=1; ";

$result = mysql_query($query) or die(mysql_error());


header("Location: task_tracker.php");

?>
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

//Grab submitted form data 
$Task = mysql_real_escape_string($_GET['Task']);
$Comments = mysql_real_escape_string($_GET['Comments']);
$Instructor = mysql_real_escape_string($_GET['Instructor']);
$CreatedBy = mysql_real_escape_string($_GET['CreatedBy']);
$Status = mysql_real_escape_string($_GET['Status']);
$Priority = mysql_real_escape_string($_GET['Priority']);

//SQL query inserts submitted form data into "tasktracker" table
$query = "INSERT INTO `tasktracker` ( `Task` , `Comments` , `Instructor` , `CreatedBy` , `Status`, `Priority`)" .
    "VALUES ('" . $Task . "', '" . $Comments . "', '" . $Instructor . "', '" . $CreatedBy . "', '" . $Status . "', '" . $Priority . "');";

//Run the queries
$result = mysql_query($query) or die(mysql_error());


header("Location: task_tracker.php");

?>
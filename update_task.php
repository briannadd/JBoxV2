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
$Trans_ID = $_GET['Trans_ID'];
$Task = mysql_real_escape_string($_GET['Task']);
$Comments = mysql_real_escape_string($_GET['Comments']);
$Instructor = mysql_real_escape_string($_GET['Instructor']);
$CreatedBy = mysql_real_escape_string($_GET['CreatedBy']);
$Status = mysql_real_escape_string($_GET['Status']);
$Priority = mysql_real_escape_string($_GET['Priority']);
$EndDate = $_GET['EndDate'];
$UpdatedBy = $_SESSION['eRaiderUsername'];

//This updates the "tasktracker" table
$query = "UPDATE langlab.tasktracker" .
    " SET langlab.tasktracker.Task = '" . $Task . "'," .
    " langlab.tasktracker.Comments = '" . $Comments . "'," .
    " langlab.tasktracker.Instructor = '" . $Instructor . "'," .
    " langlab.tasktracker.CreatedBy = '" . $CreatedBy . "'," .
    " langlab.tasktracker.Status = '" . $Status . "' ," .
    " langlab.tasktracker.Priority = '" . $Priority . "' ," .
    " langlab.tasktracker.UpdatedBy = '" . $UpdatedBy . "' ," .
    " langlab.tasktracker.EndDate = '" . $EndDate . "' " .
    " WHERE langlab.tasktracker.Trans_ID = '" . $Trans_ID . "';";

$result = mysql_query($query) or die(mysql_error());


header("Location: task_tracker.php");

?>
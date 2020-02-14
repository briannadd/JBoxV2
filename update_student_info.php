<?php
	require('include.php');
	require('group1.php');
	if(!in_array($_SESSION['eRaiderUsername'], $group1)) {
		echo 'Not authorized.';
		exit;
	}

// Creates connection to SQL database
include 'sql_connect.php';

$RNumber = $_GET['RNumber'];
$LastName = $_GET['LastName'];
$FirstName = $_GET['FirstName'];
$Instructor = $_GET['Instructor'];
$Course = $_GET['Course'];
$CourseNum = $_GET['CourseNum'];
$Section = $_GET['Section'];

// You will need to change the lines below to match the new database/table names
$query = "UPDATE langlab.studentinfo" .
    " SET langlab.studentinfo.RNumber = '" . $RNumber . "'," .
    " langlab.studentinfo.LastName = '" . $LastName . "'," .
    " langlab.studentinfo.FirstName = '" . $FirstName . "'," .
    " langlab.studentinfo.Instructor = '" . $Instructor . "'," .
    " langlab.studentinfo.Course = '" . $Course . "'," .
    " langlab.studentinfo.CourseNum = '" . $CourseNum . "'," .
    " langlab.studentinfo.Section = '" . $Section . "' " .
    " WHERE langlab.studentinfo.RNumber = '" . $RNumber . "';";

//Run the query
$result = mysql_query($query) or die(mysql_error());


header("Location: edit_students.php");

?>
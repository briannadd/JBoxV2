<?php
//eRaider authentication
	require('include.php');
	require('group2.php');
	if(!in_array($_SESSION['eRaiderUsername'], $group2)) {
		echo 'Not authorized.';
		exit;
	}

//Creates connection to SQL database
include 'sql_connect.php';

//Gets form data from student_process.php
$Trans_ID = $_GET['Trans_ID'];
$RNumber = $_GET['RNumber'];
$LastName = $_GET['LastName'];
$FirstName = $_GET['FirstName'];
$Instructor = $_GET['Instructor'];
$Course = $_GET['Course'];
$CourseNum = $_GET['CourseNum'];
$Section = $_GET['Section'];
$Code = mysql_real_escape_string($_GET['Code']);
$Date = $_GET['Date'];
$StartTime = $_GET['StartTime'];
$EndTime = $_GET['EndTime'];
$TotalTime = $_GET['TotalTime'];

//Updates data in the "studenttrans" table
$query = "UPDATE langlab.studenttrans" .
    " SET langlab.studenttrans.RNumber = '" . $RNumber . "'," .
    " langlab.studenttrans.LastName = '" . $LastName . "'," .
    " langlab.studenttrans.FirstName = '" . $FirstName . "'," .
    " langlab.studenttrans.Instructor = '" . $Instructor . "'," .
    " langlab.studenttrans.Course = '" . $Course . "'," .
    " langlab.studenttrans.CourseNum = '" . $CourseNum . "'," .
    " langlab.studenttrans.Section = '" . $Section . "'," .
    " langlab.studenttrans.Code = '" . $Code . "' ," .
    " langlab.studenttrans.Date = '" . $Date . "', " .
    " langlab.studenttrans.StartTime = '" . $StartTime . "', " .
    " langlab.studenttrans.EndTime = '" . $EndTime . "', " .
    " langlab.studenttrans.TotalTime = '" . $TotalTime . "' " .
    " WHERE langlab.studenttrans.Trans_ID = '" . $Trans_ID . "';";

$result = mysql_query($query) or die(mysql_error());

header("Location: student_transactions_admin.php");

?>
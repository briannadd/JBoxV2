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
mysql_select_db(langlab) or die('Cannot select database');

//Grabs submitted form data (student check-in/check-out transaction)
$Trans_ID = $_GET['Trans_ID'];
$RNumber = $_GET['RNumber'];
$LastName = $_GET['LastName'];
$FirstName = $_GET['FirstName'];
$Instructor = $_GET['Instructor'];
$Course = $_GET['Course'];
$CourseNum = $_GET['CourseNum'];
$Section = $_GET['Section'];
$Code = $_GET['Code'];
$Date = $_GET['Date'];
$StartTime = $_GET['StartTime'];
$EndTime = $_GET['EndTime'];


//SQL query inserts submitted form data into "studenttrans" table
$query = "INSERT INTO `studenttrans` ( `RNumber` , `LastName` , `FirstName` , `Instructor` , `Course` , `CourseNum` ,`Section` , `Code` , `Date` , `StartTime`)" .
    "VALUES ('" . $RNumber . "', '" . $LastName . "', '" . $FirstName . "', '" . $Instructor . "', '" . $Course . "', '" . $CourseNum . "', '" . $Section . "', '" . $Code . "', '" . $Date . "', '" . $StartTime . "');";

//Run the queries
$result = mysql_query($query) or die(mysql_error());

//link variable is equal to the referring page
$link = $_SERVER['HTTP_REFERER'];
//sends a header directly to the browser telling it to redirect the user to the referring page
header("Location: student_transactions_admin.php");

?>
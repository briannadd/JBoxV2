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


//Grabs submitted form data (when adding a non-existent student)
$RNumber = $_GET['RNumber'];
$LastName = $_GET['LastName'];
$FirstName = $_GET['FirstName'];
$Instructor = $_GET['Instructor'];
$Course = $_GET['Course'];
$CourseNum = $_GET['CourseNum'];
$Section = $_GET['Section'];


//Checks for zero/blank values when adding a new student
if ($Instructor === '0' OR $Course === '0' OR $LastName === '' OR $FirstName === '' OR $RNumber === '' OR $CourseNum === '' OR $Section === '')
{
    echo'
    <center>
    You left something BLANK!
    <br />
    SHAME ON YOU!!!
    <br />
    <br />
    <img src="images/mutombo.gif">
    <br />
    <br />
    Click <a href="javascript:history.back()">here</a> to go back and try again.
    </center>
    ';
}
//If there are no zero values, then proceed to add new student
else 
{
//Inserts submitted form data into "studentinfo" table
$query = "INSERT INTO `studentinfo` ( `RNumber` , `LastName` , `FirstName` , `Instructor` , `Course` , `CourseNum` ,`Section`)" .
    "VALUES ('" . $RNumber . "', '" . $LastName . "', '" . $FirstName . "', '" . $Instructor . "', '" . $Course . "', '" . $CourseNum . "', '" . $Section . "');";

//Run the queries
$result = mysql_query($query) or die(mysql_error());

//Redirects to Student Transactions page and sends the RNumber of the student you just added, hence the ?RN=" . $RNumber . "
header("Location: student_transactions.php?RN=" . $RNumber . "");
}
?>
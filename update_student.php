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
$EndTime = date('H:i:s');
$strStartTime = strtotime($StartTime);
$strEndTime = strtotime($EndTime);
$Time = $strEndTime - $strStartTime;
$hours = floor($Time / 3600);
$minutes = $Time / 60 % 60;
$seconds = $Time % 60;

$FormattedTotalTimeH = str_pad($hours, 2, '0', STR_PAD_LEFT);
$FormattedTotalTimeM = str_pad($minutes, 2, '0', STR_PAD_LEFT);
$FormattedTotalTimeS = str_pad($seconds, 2, '0', STR_PAD_LEFT);

$resulttime = "$FormattedTotalTimeH:$FormattedTotalTimeM:$FormattedTotalTimeS";

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
    " langlab.studenttrans.TotalTime = '" . $resulttime . "' " .
    " WHERE langlab.studenttrans.Trans_ID = '" . $Trans_ID . "';";

$result = mysql_query($query) or die(mysql_error());

header("Location: student_transactions.php");

?>
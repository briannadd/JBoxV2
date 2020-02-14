<?php
include 'authcheck.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
    <title>Language Learning Lab Employee Portal</title>
	<link rel="shortcut icon" href="favicon.ico" />
    <link href="style.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .auto-style1 {
            font-family: Tahoma;
            font-size: 8pt;
        }

        .auto-style2 {
            font-family: Tahoma;
        }

        .auto-style3 {
            font-size: 8pt;
        }
    </style>
</head>

<body>
<center>
<div class="header">
<?php
include 'links.php';
?>
</div>

<div class="sidebar">
<?php
include 'sidebar.php';
include 'sql_connect.php';
?>
</div>

<div class="content">    
<center>
<br/>
    <br class="auto-style1"/>
<?php
$dailyavg = mysql_query("
SELECT ROUND(AVG(DailyAvg))
FROM (select count(Trans_ID) as 'DailyAvg' FROM langlab.studenttrans GROUP BY Date)
as Avg
");
$avg = mysql_fetch_array($dailyavg);
echo 'Average Transactions Per Day: ';
echo $avg['ROUND(AVG(DailyAvg))'];
?>
<br />
<br />
<a href="reports/equipment_by_instructor_process.php" target="_blank">Outstanding Equipment</a>
<br />
<br />
<a href="reports/usage_by_instructor_process.php" target="_blank">Total Hours (Sorted by Instructor)</a>
<br />
<br />
<a href="reports/usage_by_language_process.php" target="_blank">Total Hours (Sorted by Language)</a>
<br />
<br />
<a href="reports/custom_usage_by_course.php" target="_blank">Custom Reports</a>
<br />
<br />
<a href="reports/custom_usage_by_course_section.php" target="_blank">Custom Reports WITH SECTION</a>
<br />
<br />
<a href="reports/student_usage.php" target="_blank">Student Usage</a>
</center>
</div>
</center>
</body>

</html>

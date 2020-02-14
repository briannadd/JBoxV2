<?php
//eRaider authentication check
if ($d56b699830e77ba53855679cb1d252da == "260ca9dd8a4577fc00b7bd5810298076"){}
else{
	require('include.php');
	require('group2.php');
	if(!in_array($_SESSION['eRaiderUsername'], $group2)) {
		echo 'Not authorized.';
		exit;
	}
}
?>
<!-- Page content here -->
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
		color: #FF0000;
	}
	</style>
	<script type="text/javascript">
		function confirm_student() {
		  return confirm('Are you sure you want to do this?\n' + 
		  'It will delete EVERY STUDENT TRANSACTION in the database.');
		}
		function confirm_studentinfo() {
		  return confirm('Are you sure you want to do this?\n' + 
		  'It will delete EVERY STUDENT\'S INFORMATION in the database.');
		}
		function confirm_equipment() {
		  return confirm('Are you sure you want to do this?\n' + 
		  'It will delete EVERY EQUIPMENT TRANSACTION in the database.');
		}
	</script>
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
?>
</div>
<div class="content">
<br />
<br />
<strong>Admin Control Panel</strong>
<br />
<br />
<table border="1" align="center" cellpadding="5">
<tr>
<td>
<br />
<a href="student_transactions_admin.php">Student Transaction Editor</a>
<br />
<br />
</td>
</tr>
<tr>
<td>
<a onclick="return confirm_student()">Backup and Flush Student Transaction SQL Table</a>
<br />
<br />
Restore Student Transaction SQL Table
</td>
</tr>
<tr>
<td>
<a onclick="return confirm_studentinfo()">Backup and Flush Student Information SQL Table</a>
<br />
<br />
Restore Student Information SQL Table
</td>
</tr>
<tr>
<td>
<a onclick="return confirm_equipment()">Backup and Flush Equipment Tracking SQL Table</a>
<br />
<br />
Restore Equipment Tracking SQL Table
</td>
</tr>
</table>
</div>



</center>
</body>
</html>

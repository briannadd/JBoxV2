<?
include 'authcheck.php';
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
	<script src="wysiwyg/ckeditor.js">
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
Welcome to the TTU Language Learning Laboratory Employee Portal!
<br />
<br />
<?php
//Creates connection to SQL database
    include 'sql_connect.php';
	
	//Bulletin Board
	$bbresult = mysql_query("select * FROM langlab.bulletinboard WHERE type=2");
	$bbdata = mysql_fetch_array($bbresult);
	echo"<form action=\"bulletin_board_2.php\" method=\"post\">
	<textarea name=\"bulletin\" id=\"editor1\" rows=\"20\" cols=\"125\" style=\"font-family: Tahoma; font-size:12pt;\">" . $bbdata['bulletin'] . "</textarea>
	            <script>
                CKEDITOR.replace( 'editor1' );
            </script>
	<br />
	<font size=\"1\">(Last updated by <strong>" . $bbdata['updatedby'] . "</strong>)</font>
	<br />
	<input type=\"submit\" value=\"Update Bulletin Board\" />
	</form>
	";
?>
<br />
<h1>
<a href="files/Spring2014HelpDeskSchedule.pdf" target="_blank">HelpDesk Schedule Spring 2014</a></h1>
</div>



</center>
</body>
</html>

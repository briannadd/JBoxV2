<?
//eRaider authentication
	require('include.php');
	require('group1.php');
	if(!in_array($_SESSION['eRaiderUsername'], $group1)) {
		echo 'Not authorized.';
		exit;
	}
?>
<!-- Page content here -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
	<meta http-equiv="refresh" content="300">
    <title>Language Learning Lab Employee Portal</title>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .auto-style1 {
            font-family: Tahoma;
            font-size: 8pt;
        }

        div.topRight {
            position: absolute;
            top: 1%;
            right: 1%;
        }
    </style>
    <script type="text/javascript">
        function validate(evt) {
            var theEvent = evt || window.event;
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
            var regex = /[0-9]|\./;
            if (!regex.test(key)) {
                theEvent.returnValue = false;
                if (theEvent.preventDefault) theEvent.preventDefault();
            }
        }

        function showStudent(str) {
            if (str == "") {
                document.getElementById("txtHint").innerHTML = "";
                return;
            }
            if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            }
            else {// code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "student_process.php?q=" + str, true);
            xmlhttp.send();
        }
       
		function confirm_delete() {
		  return confirm('Are you sure you want to PERMANENTLY DELETE this record?');
		}
    </script>
</head>
<body>
<center>
<span class="auto-style1">
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

<div class="content">    <br/>
<br/>
<strong>Today's Student Transactions</strong>
<br/>
<br/>
<a href="student_transactions.php">View Today's Transactions</a> - 
<a href="student_transactions_all.php">View ALL Transactions</a> - 
<a href="edit_students.php">Add/Update Students</a>
<br/>
<br/>
<form id="RNumberform">
    Enter student R-Number or swipe their student ID:
    <br/>
    <br/>
    R<input type="text" maxlength="8" onkeypress="validate(event)" class="RNumber" id="RNumberinput"
            onkeyup="showStudent(this.value)" value='<?php $RN = $_GET["RN"]; echo "". $RN . ""; ?>'/>
</form>

<script type="text/javascript">
    RNumberform.RNumberinput.focus();
</script>

<div id="txtHint">
    <br/>
    <br/>
<?php
    //Creates connection to SQL database
    include 'sql_connect.php';
    
    //Displays every student transaction ever made, ordered by Transaction ID - descending
    $result = mysql_query("select * FROM langlab.studenttrans WHERE DATE(Date) = DATE(NOW()) ORDER BY Trans_ID DESC");
    $count = mysql_num_rows($result);

    //Allows user to check out students that are leaving the lab
    echo "<strong>Today's Transactions:</strong>";
    echo "<center><table id=\"tableheader\" border=\"1\" style=\"font-family: Tahoma; font-size: 8pt; border: 1px;\">\n";
    echo "<tr>\n";
    echo "<td><center><strong>ID</strong></center></td>\n";
    echo "<td><center><strong>RNumber</strong></center></td>\n";
    echo "<td><center><strong>Last Name</strong></center></td>\n";
    echo "<td><center><strong>First Name</strong></center></td>\n";
    echo "<td><center><strong>Instructor</strong></center></td>\n";
    echo "<td><center><strong>Course</strong></center></td>\n";
    echo "<td><center><strong>#</strong></center></td>\n";
    echo "<td><center><strong>Section</strong></center></td>\n";
    echo "<td><center><strong>Comments</strong></center></td>\n";
    echo "<td><center><strong>Date</strong></center></td>\n";
    echo "<td><center><strong>Start Time</strong></center></td>\n";
    echo "<td><center><strong>End Time</strong></center></td>\n";
    echo "<td><center><strong>Total Time</strong></center></td>\n";
	echo "<td><center><strong>In</strong> || <strong>Del.</strong></center></td>\n";
    echo "</tr>";
    echo "<tr><td colspan=\"14\" bgcolor=\"33CCEE\" height=\"5px\"></td></tr>";

    if ($count !== 0) {
        while ($data = mysql_fetch_array($result)) {
			echo "<tr>\n";
            echo "<div class=\"addform\"><form name=\"updateForm\" id=\"updateForm\" method=\"get\" action=\"update_student.php\">\n";
            echo "<td><center><input type=\"text\" style=\"width:25px;\" name=\"Trans_ID\" value=\"" . $data['Trans_ID'] . "\" readonly=\"readonly\"/></center></td>\n";
            echo "<td><center><input type=\"text\" size=\"7\" name=\"RNumber\" value=\"" . $data['RNumber'] . "\" readonly=\"readonly\"/></center></td>\n";
            echo "<td><center><input type=\"text\" size=\"8\" name=\"LastName\" value=\"" . $data['LastName'] . "\" readonly=\"readonly\"/></center></td>\n";
            echo "<td><center><input type=\"text\" size=\"8\" name=\"FirstName\" value=\"" . $data['FirstName'] . "\" readonly=\"readonly\"/></center></td>\n";
            echo "<td><center><input type=\"text\" size=\"10\" name=\"Instructor\" value=\"" . $data['Instructor'] . "\" readonly=\"readonly\"/></center></td>\n";
            echo "<td><center><input type=\"text\" size=\"4\" name=\"Course\" value=\"" . $data['Course'] . "\" readonly=\"readonly\"/></center></td>\n";
            echo "<td><center><input type=\"text\" size=\"2\" name=\"CourseNum\" value=\"" . $data['CourseNum'] . "\" readonly=\"readonly\"/></center></td>\n";
            echo "<td><center><input type=\"text\" size=\"2\" name=\"Section\" value=\"" . $data['Section'] . "\" readonly=\"readonly\"/></center></td>\n";
            echo "<td><center><input type=\"text\" size=\"9\" name=\"Code\" value=\"" . $data['Code'] . "\" /></center></td>\n";
            echo "<td><center><input type=\"text\" size=\"7\" name=\"Date\" value=\"" . $data['Date'] . "\" readonly=\"readonly\"/></center></td>\n";
            echo "<td><center><input type=\"text\" size=\"4\" name=\"StartTime\" value=\"" . $data['StartTime'] . "\" readonly=\"readonly\"/></center></td>\n";
            echo "<td><center><input type=\"text\" size=\"4\" name=\"EndTime\" value=\"" . $data['EndTime'] . "\" readonly=\"readonly\" /></center></td>\n";
            echo "<td><center><input type=\"text\" size=\"4\" name=\"TotalTime\" value=\"" . $data['TotalTime'] . "\" readonly=\"readonly\"/></center></td>\n";
            echo "<td><center><input type=\"image\" src=\"images/update.png\" alt=\"Update Record\" class=\"update\" title=\"Update Record\"> || \n";
            echo "<a onclick=\"return confirm_delete()\" href=\"delete_student.php?Trans_ID=" . $data['Trans_ID'] . "\"><img title='Delete Record' alt=\"Delete Record\" class='del' src='images/delete.png'/></a>
</td></form></div></tr><tr><td colspan=\"14\" bgcolor=\"33CCEE\" height=\"5px\"></td></tr>\n\n";
        }
        echo "</table></center><br />\n";
		echo "Total transactions today: " . $count . "";
    } else {
        echo "<br /><br /><center><i>There are not yet any transactions for today.</i></center><br /><br />";
    }

    ?>
</div>
</div>
</span>
</center>
</body>
</html>

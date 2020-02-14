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
            xmlhttp.open("GET", "student_update_process.php?q=" + str, true);
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
<strong>Add/Update Student Information</strong>
<br/>
<br/>
<a href="student_transactions.php">View Today's Transactions</a> - 
<a href="student_transactions.php">View All Transactions</a> - 
<a href="edit_students.php">Add/Update Students</a>
<br/>
<br/>
<br/>
<form id="RNumberform">
    Enter student R-Number or swipe their student ID:
    <br/>
    R<input type="text" maxlength="8" onkeypress="validate(event)" class="RNumber" id="RNumberinput"
            onkeyup="showStudent(this.value)"/>
</form>

<script type="text/javascript">
    RNumberform.RNumberinput.focus();
</script>

<div id="txtHint">
    <br/>

<?php
//Creates connection to SQL database
    include 'sql_connect.php';

//Form to add a new student to the "studentinfo" table using add_student_db.php
    echo "<br /><div style=\"font-family: Tahoma; font-size: 8pt;\"><strong>&nbsp;Add Student:</strong></div>\n";
    echo "<div class=\"addform\"><form method='get' action=\"add_student_db.php\">\n";
    echo "<center><table id=\"tableheader\" border=\"1\" style=\"font-family: Tahoma; font-size: 8pt; border: 1px;\">\n";
    echo "<tr>\n";
    echo "<td><center><strong>RNumber</strong></center></td>\n";
    echo "<td><center><strong>Last Name</strong></center></td>\n";
    echo "<td><center><strong>First Name</strong></center></td>\n";
    echo "<td><center><strong>Instructor</strong></center></td>\n";
    echo "<td><center><strong>Course</strong></center></td>\n";
    echo "<td><center><strong>Course #</strong></center></td>\n";
    echo "<td><center><strong>Section</strong></center></td>\n";
    echo "<td></td>";
    echo "</tr>";
    echo "<tr>\n";
    echo "<td><center><input type=\"text\" size=\"7\" maxlength=\"8\" onkeypress=\"validate(event)\" name=\"RNumber\" value=\"\"/></center></td>\n";
    echo "<td><center><input type=\"text\" size=\"8\" name=\"LastName\" value=\"\"/></center></td>\n";
    echo "<td><center><input type=\"text\" size=\"8\" name=\"FirstName\" value=\"\"/></center></td>\n";
    echo "<td><select name=\"Instructor\" style=\"width: 175px\"><option value='0'>Choose</option>";

    //This populates the drop-down list, based on instructors in the "instructors" table
    $results_inst = mysql_query("SELECT * FROM langlab.instructors ORDER BY Instructors ASC");
    while ($inst = mysql_fetch_array($results_inst)) {
        echo "<option value=\"" . $inst['Instructors'] . "\">" . $inst['Instructors'] . "</option>";
    }
    echo "</select>" .
        "</td>\n";
    echo "<td><center>
    	  <select name=\"Course\">
    	  <option value='0'>Choose</option>
    	  <option value=\"Arabic\">Arabic</option>
		  <option value=\"ApLing\">ApLing</option>
    	  <option value=\"ASL\">ASL</option>
    	  <option value=\"Chinese\">Chinese</option>
    	  <option value=\"Classics\">Classics</option>
		  <option value=\"ESL\">ESL</option>
    	  <option value=\"French\">French</option>
    	  <option value=\"German\">German</option>
    	  <option value=\"Greek\">Greek</option>
    	  <option value=\"Italian\">Italian</option>
    	  <option value=\"Japanese\">Japanese</option>
    	  <option value=\"Latin\">Latin</option>
    	  <option value=\"Portuguese\">Portuguese</option>
    	  <option value=\"Russian\">Russian</option>
		  <option value=\"Slavistics\">Slavistics</option>
    	  <option value=\"Spanish\">Spanish</option>
    	  <option value=\"Vietnamese\">Vietnamese</option>
    	  <option value=\"ADMIN\">ADMIN</option>
    	  </select>
    </center></td>\n";
    echo "<td><center><input type=\"text\" size=\"2\" name=\"CourseNum\" value=\"\"/></center></td>\n";
    echo "<td><center><input type=\"text\" size=\"2\" name=\"Section\" value=\"\"/></center></td>\n";
    echo "<td><input type=\"image\" src=\"images/add.png\" alt=\"Add Student\" class=\"update\" title=\"Add Student\"></td>\n";
    echo "</tr></table></center></form></div>
<br />
<br />";


    // get results
    $result = mysql_query("select * FROM langlab.studentinfo ORDER BY RNumber");

    //Count the number of rows returned
    $count = mysql_num_rows($result);


    //Form to modify existing students in the "studentinfo" table, using update_student_info.php
    echo "<strong>Modify Existing Students:</strong>";
    echo "<center><table id=\"tableheader\" border=\"1\" style=\"font-family: Tahoma; font-size: 8pt; border: 1px;\">\n";
    echo "<tr>\n";
    echo "<td><center><strong>RNumber</strong></center></td>\n";
    echo "<td><center><strong>Last Name</strong></center></td>\n";
    echo "<td><center><strong>First Name</strong></center></td>\n";
    echo "<td><center><strong>Instructor</strong></center></td>\n";
    echo "<td><center><strong>Course</strong></center></td>\n";
    echo "<td><center><strong>Course #</strong></center></td>\n";
    echo "<td><center><strong>Section</strong></center></td>\n";
    echo "<td></td>";
    echo "</tr>";
    echo "<tr><td colspan=\"8\" bgcolor=\"33CCEE\" height=\"5px\"></td></tr>";
    if ($count !== 0) {
        while ($data = mysql_fetch_array($result)) {
            echo "<tr>\n";
            echo "<div class=\"addform\"><form name=\"updateForm\" id=\"updateForm\" method=\"get\" action=\"update_student_info.php\">\n";
            echo "<td><center><input type=\"text\" size=\"7\" name=\"RNumber\" value=\"" . $data['RNumber'] . "\"/></center></td>\n";
            echo "<td><center><input type=\"text\" size=\"8\" name=\"LastName\" value=\"" . $data['LastName'] . "\"/></center></td>\n";
            echo "<td><center><input type=\"text\" size=\"8\" name=\"FirstName\" value=\"" . $data['FirstName'] . "\"/></center></td>\n";
		    echo "<td><select name=\"Instructor\" style=\"width: 175px\"><option value=\"" . $data['Instructor'] . "\">" . $data['Instructor'] . "</option>";
		
    		//This populates the drop-down list, based on instructors in the "instructors" table
		    $results_inst = mysql_query("SELECT * FROM langlab.instructors ORDER BY Instructors ASC");
		    while ($inst = mysql_fetch_array($results_inst)) {
		        echo "<option value=\"" . $inst['Instructors'] . "\">" . $inst['Instructors'] . "</option>";
		    }
		    echo "</select>" .
		        "</td>\n";
		    echo "<td><center>
		    	  <select name=\"Course\">
		    	  <option value=\"" . $data['Course'] . "\">" . $data['Course'] . "</option>
		    	  <option value=\"Arabic\">Arabic</option>
		    	  <option value=\"ApLing\">ApLing</option>
		    	  <option value=\"ASL\">ASL</option>
		    	  <option value=\"Chinese\">Chinese</option>
		    	  <option value=\"Classics\">Classics</option>
				  <option value=\"ESL\">ESL</option>
		    	  <option value=\"French\">French</option>
		    	  <option value=\"German\">German</option>
		    	  <option value=\"Greek\">Greek</option>
		    	  <option value=\"Italian\">Italian</option>
		    	  <option value=\"Japanese\">Japanese</option>
		    	  <option value=\"Latin\">Latin</option>
		    	  <option value=\"Portuguese\">Portuguese</option>
		    	  <option value=\"Russian\">Russian</option>
				  <option value=\"Slavistics\">Slavistics</option>
		    	  <option value=\"Spanish\">Spanish</option>
		    	  <option value=\"Vietnamese\">Vietnamese</option>
		    	  <option value=\"ADMIN\">ADMIN</option>
		    	  </select></center></td>\n";
            echo "<td><center><input type=\"text\" size=\"2\" name=\"CourseNum\" value=\"" . $data['CourseNum'] . "\"/></center></td>\n";
            echo "<td><center><input type=\"text\" size=\"2\" name=\"Section\"value=\"" . $data['Section'] . "\"/></center></td>\n";
            echo "<td><center><input type=\"image\" src=\"images/update.png\" alt=\"Update Record\" class=\"update\" title=\"Update Record\"> || \n";
            echo "<a onclick=\"return confirm_delete()\" href=\"delete_student_info.php?RNumber=" . $data['RNumber'] . "\"><img title='Delete Record' alt=\"Delete Record\" class='del' src='images/delete.png'/></a>
	</td></form></div></tr><tr><td colspan=\"8\" bgcolor=\"33CCEE\" height=\"5px\"></td></tr>\n\n";
        }
        echo "</table></center><br />\n";
    }
    ?>
</div>
</div>
</span>
</center>
</body>

</html>

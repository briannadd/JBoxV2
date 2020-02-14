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
<div class="content">
    <br/>
<br/>

<?php
//Creates connection to SQL database
    include 'sql_connect.php';
    
//Form to add a new instructor to the "instructors" table using add_instructor.php
    echo "<div style=\"font-family: Tahoma; font-size: 8pt;\"><strong>&nbsp;Add Instructor:</strong></div>\n";
    echo "<div class=\"addform\"><form method='get' action=\"add_instructor.php\">\n";
    echo "<center><table id=\"tableheader\" border=\"1\" style=\"font-family: Tahoma; font-size: 8pt; border: 1px;\">\n";
    echo "<tr>\n";
    echo "<td><center><strong>Instructor Name</strong></center></td>\n";
    echo "<td></td>";
    echo "</tr>";
    echo "<tr>\n";
    echo "<td><center><input type=\"text\" size=\"20\" name=\"Instructors\" onfocus=\"if(!this._haschanged){this.value=''};this._haschanged=true;\" value=\"Last Name, First Name\"/></center></td>\n";
    echo "<td><input type=\"image\" src=\"images/add.png\" alt=\"Add Instructor\" class=\"update\" title=\"Add Instructor\"></td>\n";
    echo "</tr></table></center></form></div>
<br />
<br />";


    //Grabs list of instructors from "instructors" table in order to populate the drop-down menu
    $result = mysql_query("select * FROM langlab.instructors ORDER BY Instructors ASC");

    //Count the number of rows returned
    $count = mysql_num_rows($result);


    //Form containing drop-down list of all instructors in the system, allowing user to pick an instructor and remove them from the system
    echo "<strong>Delete Instructor:</strong>";
    echo "<center><table id=\"tableheader\" border=\"1\" style=\"font-family: Tahoma; font-size: 8pt; border: 1px;\">\n";
    echo "<tr>\n";
    echo "<td><center><strong>Instructor</strong></center></td>\n";
    echo "<td></td>";
    echo "</tr>";
    echo "<tr>\n";
    echo "<td><form action=\"delete_instructor_info.php\"><select name=\"Instructors\" style=\"width: 175px\"><option value=\"0\">Choose</option>";
    
    //This is what actually populates the drop-down list, based on instructors in the "instructors" table
    $results_inst = mysql_query("SELECT * FROM langlab.instructors ORDER BY Instructors ASC");
    while ($inst = mysql_fetch_array($results_inst)) {
        echo "<option value=\"" . $inst['Instructors'] . "\">" . $inst['Instructors'] . "</option>";
    }
    echo "</select>" .
        "</td>\n";
    echo "<td><input onclick=\"return confirm_delete()\" type =\"image\" title='Delete Record' alt=\"Delete Record\" class='del' src='images/delete.png'/></a>
</form></td></tr>\n\n";
    echo "</table></center><br />\n";
    ?>
</div>
</span>
</center>
</body>

</html>

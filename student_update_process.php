<?php
include 'authcheck.php';

//This grabs the RNumber that the user has entered, from edit_students.php
$q = $_GET["q"];

//Creates connection to SQL database
include 'sql_connect.php';

//Filters out students whose RNumber does not match the entered RNumber
$sql1 = "SELECT * FROM langlab.studentinfo WHERE (langlab.studentinfo.RNumber = '" . $q . "')";

$result1 = mysql_query($sql1);
$data1 = mysql_fetch_array($result1);

//This form allows the user to add a student to the database
echo "<br /><br /><div style=\"font-family: Tahoma; font-size: 8pt;\"><strong>&nbsp;Add Student:</strong></div>\n";
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
echo "<td><center><input type=\"text\" size=\"7\" name=\"RNumber\" value=\"" . $q . "\"/></center></td>\n";
echo "<td><center><input type=\"text\" size=\"8\" name=\"LastName\" value=\"" . $data1['LastName'] . "\"/></center></td>\n";
echo "<td><center><input type=\"text\" size=\"8\" name=\"FirstName\" value=\"" . $data1['FirstName'] . "\"/></center></td>\n";
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
echo "<td><center><input type=\"text\" size=\"2\" name=\"CourseNum\" value=\"" . $data1['CourseNum'] . "\"/></center></td>\n";
echo "<td><center><input type=\"text\" size=\"2\" name=\"Section\" value=\"" . $data1['Section'] . "\"/></center></td>\n";
echo "<td><input type=\"image\" src=\"images/add.png\" alt=\"Add Record\" class=\"update\" title=\"Add Record\"></td>\n";
echo "</tr></table></center></form></div>
	<br />
	<br />
	";

//This filters out all students whose RNumber does not match the entered RNumber
$sql = "SELECT * FROM langlab.studentinfo WHERE (langlab.studentinfo.RNumber = '" . $q . "')
order by RNumber DESC";

$result = mysql_query($sql);
$count = mysql_num_rows($result);

//This form allows the user to modify information about students that already exist in the database
echo "<center><strong>Modify Existing Students:</strong></center>";
echo "<center><table id=\"tableheader\" border=\"1\" style=\"font-family: Tahoma; font-size: 8pt; border: 1px;\">\n";
echo "<tr>\n";
echo "<td><center><strong>RNumber</strong></center></td>\n";
echo "<td><center><strong>Last Name</strong></center></td>\n";
echo "<td><center><strong>First Name</strong></center></td>\n";
echo "<td><center><strong>Instructor</strong></center></td>\n";
echo "<td><center><strong>Course</strong></center></td>\n";
echo "<td><center><strong>Course #</strong></center></td>\n";
echo "<td><center><strong>Section</strong></center></td><td></td>\n";
echo "</tr>";
echo "<tr><td colspan=\"8\" bgcolor=\"33CCEE\" height=\"5px\"></td></tr>";

if ($count !== 0) {
    while ($data = mysql_fetch_array($result)) {
        echo "<tr>\n";
        echo "<form name=\"updateForm\" id=\"updateForm\" method=\"get\" action=\"update_student_info.php\">\n";
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
        echo "<td><center><input type=\"text\" size=\"2\" name=\"Section\" value=\"" . $data['Section'] . "\"/></center></td>\n";
        echo "<td><center><input type=\"image\" src=\"images/update.png\" alt=\"Update Record\" class=\"update\" title=\"Update Record\"> || \n";
        echo "<a onclick=\"return confirm_delete()\" href=\"delete_student_info.php?RNumber=" . $data['RNumber'] . "\"><img title=\"Delete Record\" alt=\"Delete Record\" class=\"del\" src=\"images/delete.png\"/></a>
</td></form></tr><tr><td colspan=\"8\" bgcolor=\"33CCEE\" height=\"5px\"></td></tr>\n\n";
    }
    echo "</table></center><br />\n";
} else {
    echo "<tr><td colspan=\"8\"><br />\n<b><center><font color='red'>This student is not in the database yet, so please enter their information above.</font></b>
</div></center>
	<br />
	</td>
	</tr>
	</table>
	</center>
	";
}

?>
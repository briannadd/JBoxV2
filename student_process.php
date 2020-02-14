<?php
include 'authcheck.php';

//This grabs the RNumber that the user has entered, from student_transactions.php
$q = $_GET["q"];

//Creates connection to SQL database
include 'sql_connect.php';

//This filters out transactions that do not match the entered RNumber
$sql1 = "SELECT * FROM langlab.studentinfo WHERE (langlab.studentinfo.RNumber = '" . $q . "')";

$result1 = mysql_query($sql1);
$data1 = mysql_fetch_array($result1);

//This form allows the user to create a new transaction, when a student enters the lab
echo "<br /><div style=\"font-family: Tahoma; font-size: 8pt;\"><strong>&nbsp;Add Record:</strong></div>\n";
echo "<center><div class=\"addform\"><form method='get' action=\"add_student.php\">\n";
echo "<table id=\"tableheader\" border=\"1\" style=\"font-family: Tahoma; font-size: 8pt; border: 1px;\">\n";
echo "<tr>\n";
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
echo "<td></td>";
echo "</tr>";
echo "<tr>\n";
echo "<td><center><input type=\"text\" size=\"7\" name=\"RNumber\" value=\"" . $data1['RNumber'] . "\" readonly=\"readonly\"/></center></td>\n";
echo "<td><center><input type=\"text\" size=\"8\" name=\"LastName\" value=\"" . $data1['LastName'] . "\" readonly=\"readonly\"/></center></td>\n";
echo "<td><center><input type=\"text\" size=\"8\" name=\"FirstName\" value=\"" . $data1['FirstName'] . "\" readonly=\"readonly\"/></center></td>\n";
echo "<td><center><input type=\"text\" size=\"10\" name=\"Instructor\" value=\"" . $data1['Instructor'] . "\" readonly=\"readonly\"/></center></td>\n";
echo "<td><center><input type=\"text\" size=\"4\" name=\"Course\" value=\"" . $data1['Course'] . "\" readonly=\"readonly\"/></center></td>\n";
echo "<td><center><input type=\"text\" size=\"2\" name=\"CourseNum\" value=\"" . $data1['CourseNum'] . "\" readonly=\"readonly\"/></center></td>\n";
echo "<td><center><input type=\"text\" size=\"2\" name=\"Section\" value=\"" . $data1['Section'] . "\" readonly=\"readonly\"/></center></td>\n";
echo "<td><center><input type=\"text\" size=\"10\" name=\"Code\" value=\"" . $data1['Code'] . "\"/></center></td>\n";
echo "<td><center><input type=\"text\" size=\"7\" name=\"Date\" value=\"" . date('Y-m-d') . "\" readonly=\"readonly\"/></center></td>\n";
echo "<td><center><input type=\"text\" size=\"4\" name=\"StartTime\" value=\"" . date('H:i:s') . "\" readonly=\"readonly\"/></center></td>\n";
echo "<td><input type=\"image\" src=\"images/add.png\" alt=\"Add Record\" class=\"update\" title=\"Add Record\"></td>\n";
echo "</tr></table></form></div>
	</center>
	<br />
	<br />";

//This filters out transactions that do not match the entered RNumber
$sql = "SELECT * FROM langlab.studenttrans WHERE (langlab.studenttrans.RNumber = '" . $q . "')
order by Trans_ID DESC";

$result = mysql_query($sql);

//Count the number of rows returned
$count = mysql_num_rows($result);

//This will show all the past transactions of a student, based on the RNumber entered above.
//This will also allow the user to check a student out of the lab when they are ready to leave
echo "<br /><center><strong>Modify Existing Records:</strong>";
echo "<table id=\"tableheader\" border=\"1\" style=\"font-family: Tahoma; font-size: 8pt; border: 1px;\">\n";
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
echo "<td><center><strong>Total Time</strong></center></td>\n<td></td>";
echo "</tr>";
echo "<tr><td colspan=\"14\" bgcolor=\"33CCEE\" height=\"5px\"></td></tr>";

if ($count !== 0) {
    while ($data = mysql_fetch_array($result)) {

        echo "<tr>\n";
        echo "<form name=\"updateForm\" id=\"updateForm\" method=\"get\" action=\"update_student.php\">\n";
        echo "<td><center><input type=\"text\" style=\"width:25px;\" name=\"Trans_ID\" value=\"" . $data['Trans_ID'] . "\" readonly=\"readonly\"/></center></td>\n";
        echo "<td><center><input type=\"text\" size=\"7\" name=\"RNumber\" value=\"" . $data['RNumber'] . "\" readonly=\"readonly\"/></center></td>\n";
        echo "<td><center><input type=\"text\" size=\"8\" name=\"LastName\" value=\"" . $data['LastName'] . "\" readonly=\"readonly\"/></center></td>\n";
        echo "<td><center><input type=\"text\" size=\"8\" name=\"FirstName\" value=\"" . $data['FirstName'] . "\" readonly=\"readonly\"/></center></td>\n";
        echo "<td><center><input type=\"text\" size=\"10\" name=\"Instructor\" value=\"" . $data['Instructor'] . "\" readonly=\"readonly\"/></center></td>\n";
        echo "<td><center><input type=\"text\" size=\"4\" name=\"Course\" value=\"" . $data['Course'] . "\" readonly=\"readonly\"/></center></td>\n";
        echo "<td><center><input type=\"text\" size=\"2\" name=\"CourseNum\" value=\"" . $data['CourseNum'] . "\" readonly=\"readonly\"/></center></td>\n";
        echo "<td><center><input type=\"text\" size=\"2\" name=\"Section\" value=\"" . $data['Section'] . "\" readonly=\"readonly\"/></center></td>\n";
        echo "<td><center><input type=\"text\" size=\"9\" name=\"Code\" value=\"" . $data['Code'] . "\"/></center></td>\n";
        echo "<td><center><input type=\"text\" size=\"7\" name=\"Date\" value=\"" . $data['Date'] . "\" readonly=\"readonly\"/></center></td>\n";
        echo "<td><center><input type=\"text\" size=\"4\" name=\"StartTime\" value=\"" . $data['StartTime'] . "\" readonly=\"readonly\"/></center></td>\n";
        echo "<td><center><input type=\"text\" size=\"4\" name=\"EndTime\" value=\"" . $data['EndTime'] . "\" readonly=\"readonly\"/></center></td>\n";
        echo "<td><center><input type=\"text\" size=\"4\" name=\"TotalTime\" value=\"" . $data['TotalTime'] . "\" readonly=\"readonly\"/></center></td>\n";
        echo "<td><center><input type=\"image\" src=\"images/update.png\" alt=\"Update Record\" class=\"update\" title=\"Update Record\"> || \n";
        echo "<a onclick=\"return confirm_delete()\" href=\"delete_student.php?Trans_ID=" . $data['Trans_ID'] . "\"><img title=\"Delete Record\" alt=\"Delete Record\" class=\"del\" src=\"images/delete.png\"/></a>
</td></form></tr><tr><td colspan=\"14\" bgcolor=\"33CCEE\" height=\"5px\"></td></tr>\n\n";
    }
    echo "</table><br />\n";
} else {

	//If a student is not yet in the database, it will prompt the user to enter their information instead of creating a new transaction
    echo "<tr><td colspan=\"14\"><br />\n<b><center><font color='red'>This student is either not in the database or has not had any transactions yet.
<br />
<br />
If their information does not appear above (under 'Add Record'), that means they are <u>NOT</u> in the database,
<br />
so please enter their information below:</font></b><br /><br />\n";
    echo "<div class=\"addform\"><form method='get' action=\"add_student_db.php\">\n";
    echo "<table id=\"tableheader\" border=\"1\" style=\"font-family: Tahoma; font-size: 8pt; border: 1px;\">\n";
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
    echo "<td><center><input type=\"text\" size=\"8\" name=\"LastName\" value=\"\"/></center></td>\n";
    echo "<td><center><input type=\"text\" size=\"8\" name=\"FirstName\" value=\"\"/></center></td>\n";
    echo "<td><select name=\"Instructor\"><option value=\"0\">Choose</option>";

	//This populates the drop-down list, based on instructors in the "instructors" table
    $results_inst = mysql_query("SELECT * FROM langlab.instructors ORDER BY Instructors ASC");
    while ($inst = mysql_fetch_array($results_inst)) {
        echo "<option value=\"" . $inst['Instructors'] . "\">" . $inst['Instructors'] . "</option>";
    }
    echo "</select>" .
        "</td>\n";
    echo "<td><center>
    	  <select name=\"Course\">
    	  <option value=\"0\">Choose</option>
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
    echo "<td><center><input type=\"text\" size=\"2\" name=\"CourseNum\" value=\"\"/></center></td>\n";
    echo "<td><center><input type=\"text\" size=\"2\" name=\"Section\" value=\"\"/></center></td>\n";
    echo "<td><input type=\"image\" src=\"images/add.png\" alt=\"Add Student\" class=\"update\" title=\"Add Student\"></td>\n";
    echo "</tr></table></form></div></center>
	<br />
	</td>
	</tr>
	</table>
	</center>
	";
}

?>
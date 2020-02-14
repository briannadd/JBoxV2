<?php
include 'authcheck.php';
	
//Grabs equipment or instructor name from the textbox at the top of outstanding_equipment.php
$q = $_GET["q"];

//Creates connection to SQL database
include 'sql_connect.php';

//Form that allows user to create an equipment transaction
echo "<br /><div style=\"font-family: Tahoma; font-size: 8pt;\"><strong>&nbsp;Add Record:</strong></div>\n";
echo "<div class=\"addform\"><form method='get' action=\"add.php\">\n";
echo "<center><table border=\"1\" style=\"font-family: Tahoma; font-size: 8pt; border: 1px;\">\n";
echo "<tr>\n";
echo "<td><center><strong>Barcode - Description</strong></center></td>\n";
echo "<td><center><strong>Withdrawal Date</strong></center></td>\n";
echo "<td><center><strong>Checked Out By</strong></center></td>\n";
echo "<td><center><strong>Instructor</strong></center></td>\n";
echo "<td></td></tr>";
echo "	<tr align=\"center\"><td><input type=\"text\" size=\"40\" name=\"Description\"/></td>\n" .
    "	<td><input type=\"text\" size=\"8\" name=\"WithdrawDate\" value =\"" . date('Y-m-d') . "\"/></td>\n" .
    "	<td><input type=\"text\" size=\"8\" name=\"WithdrawBy\" value=\"" . $_SESSION['eRaiderUsername'] . "\" readonly=\"readonly\"/></td>\n" .
    "<td><select name=\"Instructor\"><option value=\"0\">Choose</option>";

//This populates the drop-down list, based on instructors in the "instructors" table
$results_inst = mysql_query("SELECT * FROM langlab.instructors ORDER BY Instructors ASC");
while ($inst = mysql_fetch_array($results_inst)) {
    echo "<option value=\"" . $inst['Instructors'] . "\">" . $inst['Instructors'] . "</option>";
}
echo "</select>" .
    "</td>\n" .
    "	<td><input type=\"image\" src=\"images/add.png\" alt=\"Add Record\" class=\"update\" title=\"Add Record\"></td>\n" .
    "</tr></table></center></form></div>
    <br />
    <br />
    ";

//This runs a query on the "transactions" table and searches for instructor name or equipment name
//based on what the user entered in the textbox at the top of outstanding_equipment.php.
//This only returns transactions for equipment that has NOT been returned.
$sql = "SELECT * FROM langlab.transactions WHERE (langlab.transactions.Instructor LIKE '%" . $q . "%' OR langlab.transactions.Description LIKE '%" . $q . "%')
and (langlab.transactions.CheckinDate IS NULL or langlab.transactions.CheckinDate ='0000-00-00')
order by Trans_ID DESC";

$result = mysql_query($sql);
$count = mysql_num_rows($result);


//This form allows you to check in equipment that has been returned, based on the above query
echo "<strong>Modify Existing Records:</strong>";
echo "<center><table id=\"tableheader\" border=\"1\" style=\"font-family: Tahoma; font-size: 8pt; border: 1px;\">\n";
echo "<tr>\n";
echo "<td><center><strong>ID</strong></center></td>\n";
echo "<td><center><strong>Barcode - Description</strong></center></td>\n";
echo "<td><center><strong>Withdrawal Date</strong></center></td>\n";
echo "<td><center><strong>Checked Out By</strong></center></td>\n";
echo "<td><center><strong>Instructor</strong></center></td>\n";
echo "<td><center><strong>Check In Date</strong></center></td>\n";
echo "<td><center><strong>Checked In By</strong></center></td>\n<td></td>";
echo "</tr>";
echo "<tr><td colspan=\"8\" bgcolor=\"FFFF88\" height=\"5px\"></td></tr>";

if ($count !== 0) {
    while ($data = mysql_fetch_array($result)) {
        echo "<tr>\n";
        echo "<form class=\"updateForm\" name=\"updateForm\" id=\"updateForm\" method=\"get\" action=\"update.php\">\n";
        echo "<td><center><input type=\"text\" style=\"width:25px;\" name=\"Trans_ID\" value=\"" . $data['Trans_ID'] . "\" readonly=\"readonly\"/></center></td>\n";
        echo "<td><center><input type=\"text\" size=\"40\" name=\"Description\" value=\"" . mysql_real_escape_string($data['Description']) . "\"/></center></td>\n";
        echo "<td><center><input type=\"text\" size=\"8\" name=\"WithdrawDate\" value=\"" . $data['WithdrawDate'] . "\"/></center></td>\n";
        echo "<td><center><input type=\"text\" size=\"8\" name=\"WithdrawBy\" value=\"" . $data['WithdrawBy'] . "\" readonly=\"readonly\"/></center></td>\n";
        echo "<td><center><input type=\"text\" name=\"Instructor\" value=\"" . $data['Instructor'] . "\"/></center></td>\n";
        echo "<td><center><input type=\"text\" size=\"8\" name=\"CheckinDate\" value=\"0000-00-00\" onfocus=\"if(!this._haschanged){this.value='" . date('Y-m-d') . "'};this._haschanged=true;\" /></center></td>\n";
        echo "<td><center><input type=\"text\" size=\"8\" name=\"CheckinBy\" value=\"" . $data['CheckinBy'] . "\"  onfocus=\"if(!this._haschanged){this.value='" . $_SESSION['eRaiderUsername'] . "'};this._haschanged=true;\"/></center></td>\n";
        echo "<td><center><input type=\"image\" class=\"updateBtn\" name=\"updateBtn\" id=\"updateBtn\" src=\"images/update.png\" alt=\"Update Record\" title=\"Update Record\"> || \n";
        echo "<a href=\"delete.php?Trans_ID=" . $data['Trans_ID'] . "\"><img title='Delete Record' alt=\"Delete Record\" class='del' src='images/delete.png'/></a>
	</td></form></div></tr><tr><td colspan=\"8\" bgcolor=\"FFFF88\" height=\"5px\"></td></tr>\n\n";
    }
    echo "</table></center><br />\n";
} else {
    echo "<b><center>NO DATA</center></b>\n";
}

?>
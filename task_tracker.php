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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
    <title>Task Tracker</title>
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
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript">
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
<br />
<br />
  <?php
	//Creates connection to SQL database
    include 'sql_connect.php';
	
	//Bulletin Board
	$bbresult = mysql_query("select * FROM langlab.bulletinboard WHERE type=1");
	$bbdata = mysql_fetch_array($bbresult);
	echo"<form action=\"bulletin_board_1.php\">
	<textarea name=\"bulletin\" rows=\"10\" cols=\"150\" style=\"font-family: Tahoma;\">" . $bbdata['bulletin'] . "</textarea>
	<br />
	<font size=\"1\">(Last updated by <strong>" . $bbdata['updatedby'] . "</strong>)</font>
	<br />
	<input type=\"submit\" value=\"Update Bulletin Board\" />
	</form>
	";

	//Form that allows user to create a task
    echo "<br /><strong>&nbsp;Add Task:</strong>\n";
    echo "<div class=\"addform\"><form method='get' id=\"Taskform\" action=\"add_task.php\">\n";
    echo "<center><table border=\"1\" style=\"font-family: Tahoma; font-size: 8pt; border: 1px;\">\n";
    echo "<tr>\n";
    echo "<td><center><strong>Task</strong></center></td>\n";
    echo "<td><center><strong>Comments</strong></center></td>\n";
    echo "<td><center><strong>Instructor/Purpose</strong></center></td>\n";
	echo "<td><center><strong>Priority</strong></center></td>\n";
	echo "<td><center><strong>Status</strong></center></td><td></td>\n";
    echo "</tr>";

    echo "<tr align=\"center\"><td><textarea name=\"Task\" rows=\"3\" cols=\"25\" style=\"font-family: Tahoma; font-size:8pt; \"></textarea></td>\n" .
        "	<td><textarea name=\"Comments\" rows=\"3\" cols=\"30\" style=\"font-family: Tahoma; font-size:8pt; \"></textarea></td>\n" .
        "<td><select name=\"Instructor\"><option value=\"0\">Choose</option>
										<option value=\"General (IT/Admin)\">General (IT/Admin)</option>";

	//This populates the drop-down list, based on instructors in the "instructors" table
    $results_inst = mysql_query("SELECT * FROM langlab.instructors ORDER BY Instructors ASC");
    while ($inst = mysql_fetch_array($results_inst)) {
        echo "<option value=\"" . $inst['Instructors'] . "\">" . $inst['Instructors'] . "</option>";
    }
    echo "</select>" .
        "<input type=\"hidden\" name=\"CreatedBy\" value=\"" . $_SESSION['eRaiderUsername'] . "\" />\n" .
		"<td>
		<select name=\"Priority\">
		<option value=\"Low\">Low</option>
		<option value=\"Medium\">Medium</option>
		<option value=\"HIGH\">HIGH</option>
		</select>
		</td>\n" .
		"<td>
		<select name=\"Status\">
		<option value=\"Not Started\">Not Started</option>
		<option value=\"In Progress\">In Progress</option>
		<option value=\"Complete\">Complete</option>
		</select>
		</td>\n" .
		"</td>\n" .
        "<td><input type=\"image\" src=\"images/add.png\" alt=\"Add Record\" class=\"update\" title=\"Add Record\"></td>\n" .
        "</tr></table></center></form></div>
        <br />
        <br />
        ";

	//This displays all incomplete tasks
    $result = mysql_query("select * FROM langlab.tasktracker
	WHERE Status = 'Not Started' or Status = 'In Progress'
	ORDER BY FIELD(Priority, 'HIGH', 'Medium', 'Low'), FIELD(Status, 'Not Started', 'In Progress'), Trans_ID DESC");
    
    $count = mysql_num_rows($result);

	//This form allows you to modify existing INCOMPLETE tasks
    echo "<strong>Current Tasks:</strong>";
    echo "<center><table id=\"tableheader\" border=\"1\" style=\"font-family: Tahoma; font-size: 8pt; border: 1px;\">\n";
    echo "<tr>\n";
	echo "<td><center><strong>ID</strong></center></td>\n";
    echo "<td><center><strong>Task</strong></center></td>\n";
    echo "<td><center><strong>Comments</strong></center></td>\n";
    echo "<td><center><strong>Instructor/Purpose</strong></center></td>\n";
	echo "<td><center><strong>Created By</strong></center></td>\n";
	echo "<td><center><strong>Priority</strong></center></td>\n";
	echo "<td><center><strong>Status</strong></center></td>\n";
	echo "<td><center><strong>Completed</strong></center></td>\n";
	echo "<td><center><strong>Updated By</strong></center></td><td></td>\n";
    echo "</tr>";
    echo "<tr><td colspan=\"10\" bgcolor=\"000000\" height=\"5px\"></td></tr>";
    if ($count !== 0) {
        while ($data = mysql_fetch_array($result)) {
            echo "<tr>\n";
            echo "<div class=\"addform\"><form name=\"updateForm\" id=\"updateForm\" method=\"get\" action=\"update_task.php\">\n";
            echo "<td><center><input type=\"text\" style=\"width:25px;\" name=\"Trans_ID\" value=\"" . $data['Trans_ID'] . "\" readonly=\"readonly\"/></center></td>\n";
            echo "<td><center><textarea name=\"Task\" rows=\"4\" cols=\"25\" style=\"font-family: Tahoma; font-size:8pt; \" title=\"" . $data['Task'] . "\">" . $data['Task'] . "</textarea> </center></td>\n";
            echo "<td><center><textarea name=\"Comments\" rows=\"4\" cols=\"30\" style=\"font-family: Tahoma; font-size:8pt; \" title=\"" . $data['Comments'] . "\">" . $data['Comments'] . "</textarea></center></td>\n";
            echo "<td><center><input type=\"text\" size=\"15\" name=\"Instructor\" value=\"" . $data['Instructor'] . "\"/></center></td>\n";
            echo "<td><center><input type=\"text\" size=\"5\" name=\"CreatedBy\" value=\"" . $data['CreatedBy'] . "\"/></center></td>\n";
			if ($data['Priority'] == "HIGH"){
			echo "<td bgcolor=\"FF0000\">";
			}
			if ($data['Priority'] == "Medium"){
            echo "<td bgcolor=\"F7941F\">";
			}
			if ($data['Priority'] == "Low"){
            echo "<td bgcolor=\"FFDD00\">";
			}
			echo"
			<center>
			<select name=\"Priority\">
			<option value=\"" . $data['Priority'] . "\">" . $data['Priority'] . "</option>
			<option value=\"Low\">Low</option>
			<option value=\"Medium\">Medium</option>
			<option value=\"HIGH\">HIGH</option>
			</select>
			</center></td>\n";
			echo "<td><center>
			<select name=\"Status\"><option value=\"" . $data['Status'] . "\">" . $data['Status'] . "</option>
			<option value=\"Not Started\">Not Started</option>
			<option value=\"In Progress\">In Progress</option>
			<option value=\"Complete\">Complete</option>
			</select>
			</center></td>\n";
            echo "<td><center><input type=\"text\" size=\"6\" name=\"EndDate\" value=\"" . $data['EndDate'] . "\" onfocus=\"if(!this._haschanged){this.value='" . date('Y-m-d') . "'};this._haschanged=true;\" /></center></td>\n";
            echo "<td><center><input type=\"text\" size=\"5\" name=\"UpdatedBy\" value=\"" . $data['UpdatedBy'] . "\"/></center></td>\n";
            echo "<td><center><input type=\"image\" src=\"images/update.png\" alt=\"Update Record\" class=\"update\" title=\"Update Record\"> || \n";
            echo "<a onclick=\"return confirm_delete()\" href=\"delete_task.php?Trans_ID=" . $data['Trans_ID'] . "\"><img title='Delete Record' alt=\"Delete Record\" class='del' src='images/delete.png'/></a>
	</td></form></div></tr><tr><td colspan=\"10\" bgcolor=\"000000\" height=\"5px\"></td></tr>\n\n";
    }
        echo "</table></center><br />\n";
    } else {
        echo "<b><center>NO DATA</center></b>\n";
    }

	//This displays all completed tasks
    $result2 = mysql_query("select * FROM langlab.tasktracker
	WHERE Status = 'Complete'
	ORDER BY Trans_ID DESC");
    
    $count2 = mysql_num_rows($result2);
	
	//This form allows you to modify existing COMPLETED tasks
    echo "<br /><br /><strong>Completed Tasks:</strong>";
    echo "<center><table id=\"tableheader\" border=\"1\" style=\"font-family: Tahoma; font-size: 8pt; border: 1px;\">\n";
    echo "<tr>\n";
    echo "<td><center><strong>ID</strong></center></td>\n";
    echo "<td><center><strong>Task</strong></center></td>\n";
    echo "<td><center><strong>Comments</strong></center></td>\n";
    echo "<td><center><strong>Instructor/Purpose</strong></center></td>\n";
	echo "<td><center><strong>Created By</strong></center></td>\n";
	echo "<td><center><strong>Priority</strong></center></td>\n";
	echo "<td><center><strong>Status</strong></center></td>\n";
	echo "<td><center><strong>Completed</strong></center></td>\n";
	echo "<td><center><strong>Updated By</strong></center></td><td></td>\n";
    echo "</tr>";
    echo "<tr><td colspan=\"10\" bgcolor=\"000000\" height=\"5px\"></td></tr>";
    if ($count2 !== 0) {
        while ($data2 = mysql_fetch_array($result2)) {
            echo "<tr>\n";
            echo "<div class=\"addform\"><form name=\"updateForm\" id=\"updateForm\" method=\"get\" action=\"update_task.php\">\n";
            echo "<td><center><input type=\"text\" style=\"width:25px;\" name=\"Trans_ID\" value=\"" . $data2['Trans_ID'] . "\" readonly=\"readonly\"/></center></td>\n";
            echo "<td><center><textarea name=\"Task\" rows=\"4\" cols=\"25\" style=\"font-family: Tahoma; font-size:8pt; \" title=\"" . $data2['Task'] . "\">" . $data2['Task'] . "</textarea> </center></td>\n";
            echo "<td><center><textarea name=\"Comments\" rows=\"4\" cols=\"30\" style=\"font-family: Tahoma; font-size:8pt; \" title=\"" . $data2['Comments'] . "\">" . $data2['Comments'] . "</textarea></center></td>\n";
            echo "<td><center><input type=\"text\" size=\"15\" name=\"Instructor\" value=\"" . $data2['Instructor'] . "\"/></center></td>\n";
            echo "<td><center><input type=\"text\" size=\"5\" name=\"CreatedBy\" value=\"" . $data2['CreatedBy'] . "\"/></center></td>\n";
			if ($data2['Priority'] == "HIGH"){
			echo "<td bgcolor=\"FF0000\">";
			}
			if ($data2['Priority'] == "Medium"){
            echo "<td bgcolor=\"F7941F\">";
			}
			if ($data2['Priority'] == "Low"){
            echo "<td bgcolor=\"FFDD00\">";
			}
			echo"<center>
			<select name=\"Priority\">
			<option value=\"" . $data2['Priority'] . "\">" . $data2['Priority'] . "</option>
			<option value=\"Low\">Low</option>
			<option value=\"Medium\">Medium</option>
			<option value=\"HIGH\">HIGH</option>
			</select>
			</center></td>\n";
			echo "<td bgcolor=\"0066FF\"><center>
			<select name=\"Status\"><option value=\"" . $data2['Status'] . "\">" . $data2['Status'] . "</option>
			<option value=\"Not Started\">Not Started</option>
			<option value=\"In Progress\">In Progress</option>
			<option value=\"Complete\">Complete</option>
			</select>
			</center></td>\n";
            echo "<td><center><input type=\"text\" size=\"6\" name=\"EndDate\" value=\"" . $data2['EndDate'] . "\" onfocus=\"if(!this._haschanged){this.value='" . date('Y-m-d') . "'};this._haschanged=true;\" /></center></td>\n";
            echo "<td><center><input type=\"text\" size=\"5\" name=\"UpdatedBy\" value=\"" . $data2['UpdatedBy'] . "\"/></center></td>\n";
            echo "<td><center><input type=\"image\" src=\"images/update.png\" alt=\"Update Record\" class=\"update\" title=\"Update Record\"> || \n";
            echo "<a onclick=\"return confirm_delete()\" href=\"delete_task.php?Trans_ID=" . $data2['Trans_ID'] . "\"><img title='Delete Record' alt=\"Delete Record\" class='del' src='images/delete.png'/></a>
	</td></form></div></tr><tr><td colspan=\"10\" bgcolor=\"000000\" height=\"5px\"></td></tr>\n\n";
    }
        echo "</table></center><br />\n";
    } else {
        echo "<b><center>NO DATA</center></b>\n";
    }
	
    ?>
</div>
</span>
</center>
</body>

</html>

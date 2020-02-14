<?php
include 'authcheck.php';
?>

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
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript">
        function showInstructor(str) {
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
            xmlhttp.open("GET", "instructor_process_all.php?q=" + str, true);
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

<div class="content">
    <br/>
<br/>
<strong>All Transactions</strong>
<br/>
<br/>
<a href="outstanding_equipment.php">View Outstanding Transactions</a> - 
<a href="equipment_tracking_list.php">View All Transactions</a>
<br/>
<br/>

<form id="Instructorform">
    Enter material/equipment name OR instructor's last name:
    <br/>
    <input type="text" id="Instructorinput" onkeyup="showInstructor(this.value)"/>
</form>
<script type="text/javascript">
    Instructorform.Instructorinput.focus();
</script>

<br/>

<div id="txtHint">

<?php
	//Creates connection to SQL database
    include 'sql_connect.php';
    
	//Form that allows user to create an equipment transaction, using add.php
    echo "<div style=\"font-family: Tahoma; font-size: 8pt;\"><strong>&nbsp;Add Record:</strong></div>\n";
    echo "<div class=\"addform\"><form method='get' action=\"add.php\">\n";
    echo "<center><table border=\"1\" style=\"font-family: Tahoma; font-size: 8pt; border: 1px;\">\n";
    echo "<tr>\n";
    echo "<td><center><strong>Barcode - Description</strong></center></td>\n";
    echo "<td><center><strong>Withdrawal Date</strong></center></td>\n";
    echo "<td><center><strong>Checked Out By</strong></center></td>\n";
    echo "<td><center><strong>Instructor</strong></center></td><td></td>\n";
    echo "</tr>";
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


    $result = mysql_query("select * FROM langlab.transactions order by Trans_ID DESC");
    $count = mysql_num_rows($result);


    //This form allows you to check in equipment that is being returned, using update.php
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
            echo "<div class=\"addform\"><form name=\"updateForm\" id=\"updateForm\" method=\"get\" action=\"update.php\">\n";
            echo "<td><center><input type=\"text\" style=\"width:25px;\" name=\"Trans_ID\" value=\"" . $data['Trans_ID'] . "\" readonly=\"readonly\"/></center></td>\n";
            echo "<td><center><input type=\"text\" size=\"40\" name=\"Description\" value=\"" . mysql_real_escape_string($data['Description']) . "\"/></center></td>\n";
            echo "<td><center><input type=\"text\" size=\"8\" name=\"WithdrawDate\" value=\"" . $data['WithdrawDate'] . "\"/></center></td>\n";
            echo "<td><center><input type=\"text\" size=\"8\" name=\"WithdrawBy\" value=\"" . $data['WithdrawBy'] . "\" readonly=\"readonly\"/></center></td>\n";
            echo "<td><center><input type=\"text\" name=\"Instructor\" value=\"" . $data['Instructor'] . "\"/></center></td>\n";
            echo "<td><center><input type=\"text\" size=\"8\" name=\"CheckinDate\" value=\"" . $data['CheckinDate'] . "\" onfocus=\"if(!this._haschanged){this.value='" . date('Y-m-d') . "'};this._haschanged=true;\" /></center></td>\n";
            echo "<td><center><input type=\"text\" size=\"8\" name=\"CheckinBy\" value=\"" . $data['CheckinBy'] . "\"  onfocus=\"if(!this._haschanged){this.value='" . $_SESSION['eRaiderUsername'] . "'};this._haschanged=true;\"/></center></td>\n";
            echo "<td><center><input type=\"image\" src=\"images/update.png\" alt=\"Update Record\" class=\"update\" title=\"Update Record\"> || \n";
            echo "<a onclick=\"return confirm_delete()\" href=\"delete.php?Trans_ID=" . $data['Trans_ID'] . "\"><img title='Delete Record' alt=\"Delete Record\" class='del' src='images/delete.png'/></a>
	</td></form></div></tr><tr><td colspan=\"8\" bgcolor=\"FFFF88\" height=\"5px\"></td></tr>\n\n";
        }
        echo "</table></center><br />\n";
    } else {
        echo "<b><center>NO DATA</center></b>\n";
    }

    ?>

</div>
</div>
</span>
</center>
</body>

</html>

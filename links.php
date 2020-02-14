<!-- This page contains all the links at the top of every page, as long as there is a php include for links.php -->
<ul id="nav">
	<li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li>
	<li><a href="index.php">Home</a></li>
	<li><a href="student_transactions.php">Student Transactions</a></li>
	<li><a href="outstanding_equipment.php">Equipment Tracking</a></li>	
	<li><a href="edit_instructors.php">Update Instructors</a></li>
    <li><a href="tutor_email_form.php">Email Tutors</a></li>
	<li><a href="reports.php">Reports</a></li>
	<li>
	<?
	echo '<a href="https://eraider.ttu.edu/signout.asp?redirect='.urlencode($eRaiderDispatchURL).'">LOG OUT</a>'; 
	?>
	  </li>
</ul>

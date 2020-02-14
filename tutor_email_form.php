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
	h3 {
	font-size: 16px;
	color: #F00;
	}
	</style>
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

<div align="center">
<p><h1><u>Tutor Sign up Form</u></h1>

<h3>This will email the selected tutor with the information.</h3>
</p>
<form name="contactform" method="post" action="send_tutor_form_email.php">

<table width="520px" border="0">
 
  <tr>
 <td width="150" valign="top">
  <label for="email_recip">Name of Tutor: *</label>
 </td>
 <td width="384" valign="top">
	<input type="radio" name="email_recip" value="carlos.alcantara@ttu.edu"> Carlos Alcantara (Spanish)<br />
 	<input type="radio" name="email_recip" value="bryce.berta@ttu.edu"> Bryce Berta (English)<br /> 
 	<input type="radio" name="email_recip" value="jordan.powell@ttu.edu"> Jordan Powell (English)<br /> 
 	<input type="radio" name="email_recip" value="andrea.fraga@ttu.edu"> Andrea Fraga (Spanish)<br />  
        <input type="radio" name="email_recip" value="omar.corral@ttu.edu"> Omar Corral (Spanish)<br />
	<input type="radio" name="email_recip" value="harrison.unthank@ttu.edu"> Michael H. Unthank (Chinese)<br />
	<input type="radio" name="email_recip" value="tiffany.leuthner@ttu.edu"> Tiffany Leuthner (Japanese)<br />
	<input type="radio" name="email_recip" value="anton.antonov@ttu.edu"> Anton Antonov (Russian)<br /> 
	<input type="radio" name="email_recip" value="lyudmila.kise@ttu.edu"> Lyudmila Kise (Russian)<br /> 
	<input type="radio" name="email_recip" value="irina.drigalenko@ttu.edu"> Irina Drigalenko (Russian)<br /> 
	<input type="radio" name="email_recip" value="muna.alabed@ttu.edu"> Muna Alabed (Arabic)<br />
	<input type="radio" name="email_recip" value="rachel.branch@ttu.edu"> Rachel Branch (English)<br />
	<input type="radio" name="email_recip" value="zachary.k.burditt@ttu.edu"> Zachary Burditt (The Man)<br />	
 </td>
</tr>

 <tr><td>&nbsp;</td></tr>
 <tr>
 <td width="200" valign="top">
  <label for="student_name">Name of Student: *</label>
 </td>
 <td width="384" valign="top">
  <input  type="text" name="student_name" maxlength="50" size="30" placeholder="First Last">
 </td>
</tr>

 <tr><td>&nbsp;</td></tr>
 <tr>
 <td width="200" valign="top">
  <label for="student_name">Student Email: *</label>
 </td>
 <td width="384" valign="top">
  <input  type="text" name="student_email" maxlength="50" size="30">
 </td>
</tr>

 <tr><td>&nbsp;</td></tr>
 <tr>
 <td width="200" valign="top">
  <label for="student_name">Student Phone Number: *</label>
 </td>
 <td width="384" valign="top">
  <input  type="text" name="student_number" maxlength="50" size="30">
 </td>
</tr>

 
 <tr><td>&nbsp;</td></tr>
 
 
 <tr>
 <td valign="top">
  <label for="date1">Date 1: *</label>
 </td>
 <td valign="top">
  Month: <select name="T1_Month">
  <option value="--">--</option>
  <option value="Jan">Jan</option>
  <option value="Feb">Feb</option>
  <option value="Mar">Mar</option>
  <option value="Apr">Apr</option>
  <option value="May">May</option>
  <option value="Jun">Jun</option>
  <option value="Jul">Jul</option>
  <option value="Aug">Aug</option>
  <option value="Sep">Sep</option>
  <option value="Oct">Oct</option>
  <option value="Nov">Nov</option>
  <option value="Dec">Dec</option>
</select>

  Day: <select name="T1_Day">
  <option value="--">--</option>
  <option value="01">01</option>
  <option value="02">02</option>
  <option value="03">03</option>
  <option value="04">04</option>
  <option value="05">05</option>
  <option value="06">06</option>
  <option value="07">07</option>
  <option value="08">08</option>
  <option value="09">09</option>
  <option value="10">10</option>
  <option value="11">11</option>
  <option value="12">12</option>
  <option value="13">13</option>
  <option value="14">14</option>
  <option value="15">15</option>
  <option value="16">16</option>
  <option value="17">17</option>
  <option value="18">18</option>
  <option value="19">19</option>
  <option value="20">20</option>
  <option value="21">21</option>
  <option value="22">22</option>
  <option value="23">23</option>
  <option value="24">24</option>
  <option value="25">25</option>
  <option value="26">26</option>
  <option value="27">27</option>
  <option value="28">28</option>
  <option value="29">29</option>
  <option value="30">30</option>
  <option value="31">31</option>
</select>

	Year: <b><?php echo date("Y"); ?></b>


   <br> Time: <select name="T1_Time">
  <option value="--">--</option>
  <option value="01:00">1:00</option>
  <option value="01:30">1:30</option>
  <option value="02:00">2:00</option>
  <option value="02:30">2:30</option>
  <option value="03:00">3:00</option>
  <option value="03:30">3:30</option>
  <option value="04:00">4:00</option>
  <option value="04:30">4:30</option>
  <option value="05:00">5:00</option>
  <option value="05:30">5:30</option>
  <option value="06:00">6:00</option>
  <option value="06:30">6:30</option>
  <option value="07:00">7:00</option>
  <option value="07:30">7:30</option>
  <option value="08:00">8:00</option>
  <option value="08:30">8:30</option>
  <option value="09:00">9:00</option>
  <option value="09:30">9:30</option>
  <option value="10:00">10:00</option>
  <option value="10:30">10:30</option>
  <option value="11:00">11:00</option>
  <option value="11:30">11:30</option>
  <option value="12:00">12:00</option>
  <option value="12:30">12:30</option>
</select>
	<input type="radio" name="T1_AMPM" value="AM">AM
	<input type="radio" name="T1_AMPM" value="PM">PM

 </td>
</tr>

<tr><td>&nbsp;</td></tr>



 <tr>
 <td valign="top">
  <label for="date2">Date 2: </label>
 </td>
 <td valign="top">
  Month: <select name="T2_Month">
  <option value="--">--</option>
  <option value="Jan">Jan</option>
  <option value="Feb">Feb</option>
  <option value="Mar">Mar</option>
  <option value="Apr">Apr</option>
  <option value="May">May</option>
  <option value="Jun">Jun</option>
  <option value="Jul">Jul</option>
  <option value="Aug">Aug</option>
  <option value="Sep">Sep</option>
  <option value="Oct">Oct</option>
  <option value="Nov">Nov</option>
  <option value="Dec">Dec</option>
</select>

  Day: <select name="T2_Day">
  <option value="--">--</option>
  <option value="01">01</option>
  <option value="02">02</option>
  <option value="03">03</option>
  <option value="04">04</option>
  <option value="05">05</option>
  <option value="06">06</option>
  <option value="07">07</option>
  <option value="08">08</option>
  <option value="09">09</option>
  <option value="10">10</option>
  <option value="11">11</option>
  <option value="12">12</option>
  <option value="13">13</option>
  <option value="14">14</option>
  <option value="15">15</option>
  <option value="16">16</option>
  <option value="17">17</option>
  <option value="18">18</option>
  <option value="19">19</option>
  <option value="20">20</option>
  <option value="21">21</option>
  <option value="22">22</option>
  <option value="23">23</option>
  <option value="24">24</option>
  <option value="25">25</option>
  <option value="26">26</option>
  <option value="27">27</option>
  <option value="28">28</option>
  <option value="29">29</option>
  <option value="30">30</option>
  <option value="31">31</option>
</select>

	Year: <b><?php echo date("Y"); ?></b>


   <br> Time: <select name="T2_Time">
  <option value="--">--</option>
  <option value="01:00">1:00</option>
  <option value="01:30">1:30</option>
  <option value="02:00">2:00</option>
  <option value="02:30">2:30</option>
  <option value="03:00">3:00</option>
  <option value="03:30">3:30</option>
  <option value="04:00">4:00</option>
  <option value="04:30">4:30</option>
  <option value="05:00">5:00</option>
  <option value="05:30">5:30</option>
  <option value="06:00">6:00</option>
  <option value="06:30">6:30</option>
  <option value="07:00">7:00</option>
  <option value="07:30">7:30</option>
  <option value="8:00">8:00</option>
  <option value="08:30">8:30</option>
  <option value="09:00">9:00</option>
  <option value="09:30">9:30</option>
  <option value="10:00">10:00</option>
  <option value="10:30">10:30</option>
  <option value="11:00">11:00</option>
  <option value="11:30">11:30</option>
  <option value="12:00">12:00</option>
  <option value="12:30">12:30</option>
</select>
	<input type="radio" name="T2_AMPM" value="AM">AM
	<input type="radio" name="T2_AMPM" value="PM">PM

 </td>
</tr>

<tr><td>&nbsp;</td></tr>

 <tr>
 <td valign="top">
  <label for="date3">Date 3: </label>
 </td>
 <td valign="top">

  Month: <select name="T3_Month">
  <option value="--">--</option>
  <option value="Jan">Jan</option>
  <option value="Feb">Feb</option>
  <option value="Mar">Mar</option>
  <option value="Apr">Apr</option>
  <option value="May">May</option>
  <option value="Jun">Jun</option>
  <option value="Jul">Jul</option>
  <option value="Aug">Aug</option>
  <option value="Sep">Sep</option>
  <option value="Oct">Oct</option>
  <option value="Nov">Nov</option>
  <option value="Dec">Dec</option>
</select>

  Day: <select name="T3_Day">
  <option value="--">--</option>
  <option value="01">01</option>
  <option value="02">02</option>
  <option value="03">03</option>
  <option value="04">04</option>
  <option value="05">05</option>
  <option value="06">06</option>
  <option value="07">07</option>
  <option value="08">08</option>
  <option value="09">09</option>
  <option value="10">10</option>
  <option value="11">11</option>
  <option value="12">12</option>
  <option value="13">13</option>
  <option value="14">14</option>
  <option value="15">15</option>
  <option value="16">16</option>
  <option value="17">17</option>
  <option value="18">18</option>
  <option value="19">19</option>
  <option value="20">20</option>
  <option value="21">21</option>
  <option value="22">22</option>
  <option value="23">23</option>
  <option value="24">24</option>
  <option value="25">25</option>
  <option value="26">26</option>
  <option value="27">27</option>
  <option value="28">28</option>
  <option value="29">29</option>
  <option value="30">30</option>
  <option value="31">31</option>
</select>

	Year: <b><?php echo date("Y"); ?></b>


   <br> Time: <select name="T3_Time">
  <option value="--">--</option>
  <option value="01:00">1:00</option>
  <option value="01:30">1:30</option>
  <option value="02:00">2:00</option>
  <option value="02:30">2:30</option>
  <option value="03:00">3:00</option>
  <option value="03:30">3:30</option>
  <option value="04:00">4:00</option>
  <option value="04:30">4:30</option>
  <option value="05:00">5:00</option>
  <option value="05:30">5:30</option>
  <option value="06:00">6:00</option>
  <option value="06:30">6:30</option>
  <option value="07:00">7:00</option>
  <option value="07:30">7:30</option>
  <option value="8:00">8:00</option>
  <option value="08:30">8:30</option>
  <option value="09:00">9:00</option>
  <option value="09:30">9:30</option>
  <option value="10:00">10:00</option>
  <option value="10:30">10:30</option>
  <option value="11:00">11:00</option>
  <option value="11:30">11:30</option>
  <option value="12:00">12:00</option>
  <option value="12:30">12:30</option>
</select>
	<input type="radio" name="T3_AMPM" value="AM">AM
	<input type="radio" name="T3_AMPM" value="PM">PM

 </td>
</tr>

<tr><td>&nbsp;</td></tr>
 
 
 <tr>
 <td valign="top">
  <label for="notes">Notes: </label>
 </td>
 <td valign="top">
 
 <textarea rows="10" cols="30" name="notes">N/A</textarea>
  </td>
</tr>
 
<tr>
 <td colspan="2" style="text-align:center">
 
  <input type="submit" value="Submit">   
  <input type="reset" value="Reset">
 
 </td>
 
</tr>
 
</table>
 
</form>

</div>
</div>
</center>
</body>

</html>

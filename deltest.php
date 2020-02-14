<?php
$dbhost = 'ttumysql.tosm.ttu.edu';
$dbuser = 'langlab_user';
$dbpass = 'eL1KO2BK';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
$table_name = "test";
$backup_file = "test.sql";
$sql = "SELECT * INTO OUTFILE '$backup_file' FROM $table_name";

mysql_select_db('langlab');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not take data backup: ' . mysql_error());
}
echo "Backed up  data successfully\n";
mysql_close($conn);

?>
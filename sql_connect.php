<?
include_once 'authcheck.php';

// Creates connection to SQL database
// If for some reason the database information (location, credentials, etc.) ever changes, update the information below.
// You will not have to update this information on any other page, as this file is included on every page that requires a SQL connection.

mysql_connect("ttumysql.tosm.ttu.edu", "langlab_user", "eL1KO2BK", "langlab");

          // ("database_location", "username", "password", "database_name");

?>
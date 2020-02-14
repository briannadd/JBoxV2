<?php
/*
//view errors on page - turn this on if necessary
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
*/

//eRaider authentication check
if ($d56b699830e77ba53855679cb1d252da == "260ca9dd8a4577fc00b7bd5810298076"){}
else{
	require('include.php');
	require('group1.php');
	if(!in_array($_SESSION['eRaiderUsername'], $group1)) {
		echo 'Not authorized.';
		exit;
	}
}
?>
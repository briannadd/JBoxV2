<html>
<head>
	<title>Untitled</title>	
</head>

<body onload="countDown()" onScroll="resetCounter()" onMouseover="resetCounter()">
<?PHP
session_start();

// set timeout period in seconds
$session_timeout = 30;

if (!isset($_SESSION['last_visit'])) { $_SESSION['last_visit'] = time(); } // I like brackets!

if((time() - $_SESSION['last_visit']) > $session_timeout) { 
  session_destroy(); 
  header("Location: student_transactions.php"); // think about user feedback, "your session timed out" ... index.php?action=session_timeout
  exit; // <= IMPORTANT !!!
}


$_SESSION['last_visit'] = time();
?>
<img src="http://mist.ist.psu.edu/wp-content/uploads/2011/08/HelloWorld.png">
</body>
</html>   

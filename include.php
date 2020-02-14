<?
//eRaider authentication stuff
        session_start();
        $_SESSION['eRaiderDispatchURL'] = "http://www.depts.ttu.edu/classic_modern/langlab/portal/index.php";
        $_SESSION['eRaiderDBUsername'] = "ESI_CLAS_LANGLABPORTAL";
        $_SESSION['eRaiderDBpassword'] = "ElO2IrEvInUqAsA";
        // $_SESSION['eRaiderFailureURL'] = "<Optional URL goes here in the event of an authentication failure>";
        require_once('/_ttu-template/includes/eraider.php');
?>

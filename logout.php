<?php
// init the session.
session_start();

// Unset all of the session variables.
$_SESSION = array();

// Destroying All Sessions
if(session_destroy()) {
    // Redirecting To Home Page
    header("Location: index.php");
}
?>

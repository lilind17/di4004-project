<?php
// Secures pages. To be used where users need to be logged in to an account to access the page.
if (!isset($_SESSION)) {
    session_start();
}
// If username is not set, i.e. not logged in, get redirected to login page.
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}
?>

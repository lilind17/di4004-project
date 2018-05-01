<?php
// Secures pages. Require this file to redirect non-administrators to login screen.
if (!isset($_SESSION)) {
    session_start();
}
// If username is not set, i.e. not logged in, get redirected to login page.
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

// Check groupid of session, redirect to login page if user is not part of admin group.
$groupid = $_SESSION['groupid'];
if ($groupid != 1) {
    header("Location: login.php");
    exit();
}
?>

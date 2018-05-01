<?php
if (!isset($_SESSION)) {
    session_start();
}

/*
# School Database
$host = "localhost";
$user = "**************";
$pwd = "*************";
$db = "ponhed15_db";
*/
# Local private database
$host = "localhost";
$user = "test";
$pwd = "apa123";
$db = "test";

/* Link to server */
$con = new mysqli($host, $user, $pwd, $db);

// Check connection
if (!$con) {
   die("Connection failed: " . mysqli_connect_error());
}

// Set userid variable in session.
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT userid FROM project_users WHERE username='$username'";
    $result = mysqli_query($con, $query) or die(mysqli_error());
    $getuserid = mysqli_fetch_assoc($result);
    $_SESSION['userid'] = $getuserid['userid'];
}

// Set groupid variable in session.
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT groupid FROM project_users WHERE username='$username'";
    $result = mysqli_query($con, $query) or die(mysqli_error());
    $getgroupid = mysqli_fetch_assoc($result);
    $_SESSION['groupid'] = $getgroupid['groupid'];
}
?>

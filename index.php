<?php
include('navbar.php');
echo $navbar;
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <link rel="stylesheet" href="css/stylesheet.css" />
        <meta charset="utf-8">
        <title>Home</title>
    </head>
    <body>
        <h1>Test outputs:</h1>
        <p>Session variables in session:</p>
        <?php
        // temporary debug option
        if (isset($_SESSION['username'])) {
            echo "userid: {$_SESSION['userid']}</br>";
            echo "groupid: {$_SESSION['groupid']}</br>";
        }
        ?>
    </body>
</html>

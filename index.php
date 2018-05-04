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
        <h1>Welcome</h1>
          <div class="row">
            <div class="col-md-6">
                <div>
                    <p>Hi and welcome to HealthDashboard. This is a website where you will be able to submit different types of health data 
                        that will be presented in the dashborad as graphics. You will be able to see, monitor, and get an 
                        understanding over how your your activity, sleep and temperature has changed over time.< br>
                        To be able to acces and submit your data you will need to log in or create an account first. 
                         </p>
                    </div>
                </div>
              
            </div>
        <?php
        // temporary debug option
        if (isset($_SESSION['username'])) {
            echo "userid: {$_SESSION['userid']}</br>";
            echo "groupid: {$_SESSION['groupid']}</br>";
        }
        ?>
    </body>
</html>

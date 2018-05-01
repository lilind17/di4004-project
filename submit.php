<?php
include('navbar.php');
require('login_auth.php');
include('db.php');

echo $navbar;

// init variables for school server
$dbmessagebad = "";
$dbmessagegood = "";

if (isset($_POST['datepicker'])) {
    $datepicker = stripslashes($_POST['datepicker']);
    $datepicker = mysqli_real_escape_string($con, $datepicker);

    $userid = stripslashes($_SESSION['userid']);
    $userid = mysqli_real_escape_string($con, $userid);

    $timebed = stripslashes($_POST['timebed']);
	$timebed = mysqli_real_escape_string($con, $timebed);

    $timeup = stripslashes($_POST['timeup']);
	$timeup = mysqli_real_escape_string($con, $timeup);

    $nrnaps = stripslashes($_POST['nrnaps']);
    $nrnaps = mysqli_real_escape_string($con, $nrnaps);

    $nrsteps = stripslashes($_POST['nrsteps']);
    $nrsteps = mysqli_real_escape_string($con, $nrsteps);

    $walkdist = stripslashes($_POST['walkdist']);
    $walkdist = mysqli_real_escape_string($con, $walkdist);

    $energyexp = stripslashes($_POST['energyexp']);
    $energyexp = mysqli_real_escape_string($con, $energyexp);

    $outtemp = stripslashes($_POST['outtemp']);
    $outtemp = mysqli_real_escape_string($con, $outtemp);

    $intemp = stripslashes($_POST['intemp']);
    $intemp = mysqli_real_escape_string($con, $intemp);

    $query = "SELECT * FROM `project_userinput` WHERE datepicker='$datepicker'";
    $result = mysqli_query($con, $query) or die(mysql_error());
    $rows = mysqli_num_rows($result);

    if($rows == 0) {
        $query = "INSERT INTO `project_userinput` (userid, datepicker, timebed, timeup, nrnaps, nrsteps, walkdist, energyexp, outtemp, intemp)
                    VALUES ('$userid', '$datepicker', '$timebed', '$timeup', '$nrnaps', '$nrsteps', '$walkdist', '$energyexp', '$outtemp', '$intemp')";
        $result = mysqli_query($con, $query);
        if ($result) {
            // Upon successful registration, send user to login page with message to login.
            $dbmessagegood = "Values have been added to the database, see dashboard for graph.";
        }
    } else {
        $dbmessagebad = "Data has already been submitted for this date, please choose another date.";
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/stylesheet.css">

        <!-- Date picker -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <!-- Time picker -->
        <link rel="stylesheet" href="css/jquery.timepicker.css">
        <script src="js/jquery.timepicker.js"></script>

        <!-- Bootstrap 4 Cards -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

        <title>Metrics</title>
    </head>
    <body>
        <div class="submit_container">
            <form action="submit.php" method="post">
                <div class="submit_row">
                    <div class="submit_column">
                        <div style="text-align:center">
                            <p>Submit values for dashboard</p>
                        </div>
                        <div class="submit_panel">
                            <div>
                                <!-- Pick date -->
                                <p>Date: </br><input type="text" name="datepicker" id="datepicker" required /></p>
                                <script>
                                $( function() {
                                    $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
                                } );
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="submit_column">
                        <div class="submit_panel">
                            <div class="card">
                                <div class="card-header bg-primary text-white"><p class="card_title">Sleep</p></div>
                                <div class="card-body">
                                    <!-- Time of bed -->
                                    <p>Time of bed: <input type="text" name="timebed" class="timepicker" required /></p>
                                    <script>
                                    $(document).ready(function(){
                                        $('input.timepicker').timepicker({ timeFormat: 'HH:mm:ss' });
                                    });
                                    </script>
                                    <!-- Time of getting up -->
                                    <p>Time of getting up: <input type="text" name="timeup" class="timepicker" required/></p>
                                    <script>
                                    $(document).ready(function(){
                                        $('input.timepicker').timepicker({ timeFormat: 'HH:mm:ss' });
                                    });
                                    </script>
                                    <!-- Number of naps -->
                                    <p>Number of naps:
                                    <select name="nrnaps" required/>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="submit_column">
                        <div class="submit_panel">
                            <div class="card">
                                <div class="card-header bg-warning text-white"><p class="card_title">Activity</p></div>
                                <div class="card-body">
                                    <!-- Number steps -->
                                    <p>Number of Steps: </br><input type="number" name="nrsteps" min="0" required /></p>
                                    <!-- Walked distance -->
                                    <p>Walked Distance(m): </br><input type="number" name="walkdist" min="0" required /></p>
                                    <!-- Energy expended -->
                                    <p>Energy Expenditure(kcal): </br><input type="number" name="energyexp" min="0" required /></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="submit_column">
                        <div class="submit_panel">
                            <div class="card">
                                <div class="card-header bg-success text-white"><p class="card_title">Environment</p></div>
                                <div class="card-body">
                                    <!-- Outdoor temperature -->
                                    <p>Outdoor Temperature(C): </br><input type="number" name="outtemp" step="1"/ required /></p>
                                    <!-- Indoor temperatuer -->
                                    <p>Indoor Temperature(C): </br><input type="number" name="intemp" step="1"/ required /></p>
                                    <!-- Submit and reset -->
                                    <div>
                                        <div style="float: left; width: 45%">
                                            <button class="cancel-button" type="reset" value="Reset">Reset</button>
                                        </div>
                                        <div style="float: right; width: 45%">
                                            <input type="submit" value="Submit">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </br><p style="color: green;" ><?php echo $dbmessagegood; ?></p>
                    <p style="color: red;" ><?php echo $dbmessagebad; ?></p>
                </div>
            </form>
        </div>
    </body>
</html>

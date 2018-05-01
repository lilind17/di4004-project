<?php
include('navbar.php');
echo $navbar;

if (isset($_POST['email'])) {

    // Server email
    $email_to = "voidfordev@gmail.com";
    $email_subject = "Contact@HealthDashboard";

    // Error code message
    function died($error) {
        echo "Oops! Message could not be sent, for the following reasons: <br />";
        echo $error."<br /><br />";
        $revisit = <<<END
        <a href="contact.php">Send a message<a/><br />
END;
        echo "Please try again.$revisit";
        die();
    }

    // Validate that data exists
    if (!isset($_POST['fname']) && !isset($_POST['lname']) &&
        !isset($_POST['email']) &&
        !isset($_POST['message']))
    {
        died('Insufficient information.');
    }

    $fname               = htmlspecialchars($_POST["fname"]);
    $lname               = htmlspecialchars($_POST["lname"]);
    $email               = htmlspecialchars($_POST["email"]);
    $message             = htmlspecialchars($_POST["message"]);

    // Regex for valid email input.
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    if(!preg_match($email_exp,$email)) {
      $error_message .= 'Provided Email Adress is not valid.<br />';
    }

    // Regex for valid first and last name.
    $string_exp = "/^[A-Za-z .'-]+$/";
    if(!preg_match($string_exp,$fname)) {
    $error_message .= 'Provided First Name is not valid.<br />';
    }
    if(!preg_match($string_exp,$lname)) {
    $error_message .= 'Provided Last Name is not valid.<br />';
    }

    // Message check
    if(strlen($message) < 10) {
    $error_message .= 'Provided Message is too short.<br />';
    }

    // Any error found -> termination
    if(strlen($error_message) > 0) {
    died($error_message);
    }

    // Composing strings for message
    $email_message = "Form details below.\n\n";
    function clean_string($string) {
        $bad = array("content-type","bcc:","to:","cc:","href");
        return str_replace($bad,"",$string);
    }
    $email_message .= "First Name: ".clean_string($fname)."\n";
    $email_message .= "Last Name: ".clean_string($lname)."\n";
    $email_message .= "Email: ".clean_string($email)."\n";
    $email_message .= "Message: ".clean_string($message)."\n";

    // create email headers
    $headers = 'From: '.$email."\r\n".
    'Reply-To: '.$email."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    mail($email_to, $email_subject, $email_message, $headers);
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Contact Us</title>
    </head>
    <body>
        <div class="contact_container">
            <div style="text-align:center">
                <h2>Contact Us</h2>
                <p>Visit us, or leave us a message:</p>
            </div>
            <div class="contact_row">
                <div class="contact_column">
                    <div id="map" style="width:100%;height:500px"></div>
                </div>
                <div class="contact_column">
                    <form action="contact.php" method="post">
                        <label for="firstname">First Name *</label>
                        <input type="text" name="fname" id="firstname" placeholder="Your name.." required>
                        <label for="lastname">Last Name *</label>
                        <input type="text" name="lname" id="lastname" placeholder="Your last name.." required>
                        <label for="email">Email Address *</label>
                        <input type="text" name="email" id="email" placeholder="Your email address.." required>
                        <label for="message">Your Message: *</label>
                        <textarea name="message" id="message" placeholder="Write something.." style="height:170px" required></textarea>
                        <input type="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>
        <!-- Initialize Google Maps -->
        <script>
            function myMap() {
                var myCenter = new google.maps.LatLng(56.6649059,12.8778526);
                var mapCanvas = document.getElementById("map");
                var mapOptions = {center: myCenter, zoom: 12};
                var map = new google.maps.Map(mapCanvas, mapOptions);
                var marker = new google.maps.Marker({position:myCenter});
                marker.setMap(map);
            }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_UHA1mfLToM58n2J9DviAgQXyC7pp9Vg&callback=myMap"></script>
    </body>
</html>

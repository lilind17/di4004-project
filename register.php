<?php
include('navbar.php');

echo $navbar;


// init, for school server
$taken = "";

// If form submitted, insert values into the database.
if (isset($_POST['username']) and isset($_POST['password']) and isset($_POST['email'])) {
    $username = stripslashes($_POST['username']);
    $username = mysqli_real_escape_string($con, $username);

    $email = stripslashes($_POST['email']);
	$email = mysqli_real_escape_string($con, $email);

    $password = stripslashes($_POST['password']);
	$password = mysqli_real_escape_string($con, $password);

    $create_date = date("Y-m-d H:i:s");

    $query = "SELECT * FROM `project_users` WHERE username = '$username'";
    $result = mysqli_query($con, $query) or die(mysql_error());
    $rows = mysqli_num_rows($result);

    if($rows == 0) {
        $query = "INSERT INTO `project_users` (username, password, email, create_date, sign_date, groupid)
                    VALUES ('$username', '".md5($password)."', '$email', '$create_date', '$create_date', 0)";
        $result = mysqli_query($con, $query);
        if ($result) {
            // Upon successful registration, send user to login page with message to login.
            header("Location: login.php?sr");
        }
    } else {
        $taken = "Username exists!";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
        <title>Registration</title>
        <link rel="stylesheet" href="css/stylesheet.css" />
    </head>
    <body>
        <div class="register_container">
            <div style="text-align:center">
                <h2>Sign Up</h2>
                <!-- Error message if username exists -->
                <div style="color: red;"><?php echo $taken?></div>
            </div>
            <div class="register_row">
                <div class="register_column">
                    <form action="register.php" method="post">
                        <input type="email" name="email" placeholder="Email" required />
                        <input type="text" name="username" placeholder="Username" required />
                        <input type="password" name="password" placeholder="Password" required />
                        <input type="submit" value="Sign Up">
                        <p>Already have an account? <a href='login.php'>Sign In</a></p>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

<?php
include('navbar.php');
require('db.php');
echo $navbar;

//init, for school server
$wrongcred = "";

if (isset($_POST['username']) and isset($_POST['password'])) {
    // removes backslashes
	$username = stripslashes($_POST['username']);
    // escapes special characters in a string
	$username = mysqli_real_escape_string($con,$username);

    $password = stripslashes($_POST['password']);
	$password = mysqli_real_escape_string($con,$password);

    // Checking for user in database
    $query = "SELECT * FROM `project_users` WHERE username='$username' and password='".md5($password)."'";
	$result = mysqli_query($con, $query) or die(mysql_error());
	$rows = mysqli_num_rows($result);
    if ($rows == 1) {
		// Successful login.

		// Kill old session start a new one.

		// Unset all of the session variables.
		$_SESSION = array();

		// Destory old session & start new session.
		session_destroy();
		session_start();

		// Set username in session, see db.php for further session variables.
		$_SESSION['username'] = $username;

		// Register time of login.
		$sign_date = date("Y-m-d H:i:s");
		$query = "UPDATE `project_users` SET sign_date='$sign_date' WHERE username='$username'";
		$result = mysqli_query($con, $query);

        // Redirect user to dashboard.php
        header("Location: dashboard.php");
     } else {
	        $wrongcred = "<p>Username/password is incorrect.</p>";
	}
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Sign In</title>
        <link rel="stylesheet" href="css/stylesheet.css" />
    </head>
    <body>
		<div class="login_container">
			<div style="text-align:center">
				<h2>Sign In</h2>
				<div style="color: red;"><?php echo $wrongcred ?></div>
				<?php
				if (isset($_GET['sr'])) {
					echo "You have successfully registered. Proceed to login.";
				}
				?>
			</div>
			<div class="login_row">
				<div class="login_column">
		            <form action="login.php" method="post">
						<input type="text" name="username" placeholder="username" required />
						<input type="password" name="password" placeholder="password" required />
		                <input type="submit" value="Sign in">
		                <p>Not registered yet? <a href='register.php'>Register Here</a></p>
		            </form>
				</div>
			</div>
		</div>
    </body>
</html>

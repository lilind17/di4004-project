<?php
include('db.php');

if (!isset($_SESSION)) {
    session_start();
}

// Show link to admin page if user is admin.
    // Odd roundabout way because the school server complains of unset variable, local server does not?
if (isset($_SESSION['groupid'])) {
    $groupid = $_SESSION['groupid'];
} else {
    $groupid = 0;
}

if ($groupid == 1) {
    $navbar = <<<END
        <nav>
            <div class="topnav">
                <div id="nav-left">
                    <a href="index.php">HealthDashboard</a>
                    <div class="nav_dropdown">
                        <button class="dropbtn">@ $username
                            <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="nav_dropdown-content">
                            <a href="dashboard.php">Dashboard</a>
                            <a href="submit.php">Submit</a>
                            <a style="color: red;" href="admin.php">Admin Panel</a>
                            <a href="logout.php">Logout</a>
                        </div>
                    </div>
                </div>
END;
} elseif (isset($_SESSION['username'])) {
    $navbar = <<<END
        <nav>
            <div class="topnav">
                <div id="nav-left">
                    <a href="index.php">HealthDashboard</a>
                    <div class="nav_dropdown">
                        <button class="dropbtn">@ $username
                            <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="nav_dropdown-content">
                            <a href="dashboard.php">Dashboard</a>
                            <a href="submit.php">Submit</a>
                            <a href="logout.php">Logout</a>
                        </div>
                    </div>
                </div>
END;
} else {
    $navbar = <<<END
        <nav>
            <div class="topnav">
                <div id="nav-left">
                    <a href="index.php">HealthDashboard</a>
                </div>
END;
}

if (isset($_SESSION['username'])) {
    $navbar .= <<<END
            <div id="nav-right">
                <a href="contact.php">Contact Us</a>
            </div>
        </div>
END;

} else {
    $navbar .= <<<END
            <div id="nav-right">
                <a href="contact.php">Contact Us</a>
                <a href="register.php">Sign Up</a>
                <a href="login.php">Log In</a>
            </div>
        </div>
END;
}

$navbar .= "</nav>"
?>

<link rel="stylesheet" href="css/stylesheet.css" />

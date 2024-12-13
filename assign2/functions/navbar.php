<?php
function renderNavbar() {
    // Start session if not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Render the navbar
    echo('<nav><ul>');
    echo('<li><a href="index.php">Home</a></li>');
    echo('<li><a href="about.php">About</a></li>');
    // Check if the user is logged in and display the appropriate links
    if (isset($_SESSION['id'])) {
        echo('<li><a href="friendlist.php">Friend List</a></li>');
        echo('<li><a href="friendadd.php">Add Friends</a></li>');
        echo('<li><a href="logout.php">Logout</a></li>');
    } else {
        echo('<li><a href="login.php">Login</a></li>');
        echo('<li><a href="signup.php">Sign-Up</a></li>');
    }
    echo('</ul></nav>');
}
?>
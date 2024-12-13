<?php
    session_start(); // start the session
    if (!isset ($_SESSION["number"])) { // check if session variable exists
        $_SESSION["number"] = rand(10,20); // create the session variable
        $_SESSION["attemptsLeft"] = 5; // create the session variable
    }
    $num = $_SESSION["number"];
    $attemptsLeft = $_SESSION["attemptsLeft"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="description" content="Web application development" />
<meta name="keywords" content="PHP" />
<meta name="author" content="Name - ID">
<title>TITLE</title>
</head>
<body>
    <h1>Web Programming - Lab09 - Guessing Game</h1>

    <?php
        echo "<p>The number was $num</p>";
        session_destroy();
    ?>

    <p><a href="startover.php">Start Over</a></p>
</body>
</html>
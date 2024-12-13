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
    <p>Guess a number between 10 and 20</p>

    <form action="#" method="POST">
        <input type="number" name="number" id="number">
        <button type="submit">Guess</button>
    </form>

    <?php
        if (isset($_POST["number"])) {
            $guess = $_POST["number"];
            if ($guess < 10 || $guess > 20) {
                echo "<p>Please enter a number between 10 and 20.</p>";
            } else {
                if ($guess == $num) {
                    echo "<p>Correct! The number was $num</p>";
                    session_destroy();
                } else {
                    echo "<p>Incorrect! Try again</p>";
                    $attemptsLeft--;
                    if ($attemptsLeft == 0) {
                        echo "<p>Out of attempts! The number was $num</p>";
                        session_destroy();
                    }
                }
            }
        }
        echo "<p>Attempts left: $attemptsLeft</p>";
    ?>
    <p><a href="giveup.php">Give Up</a></p>
    <p><a href="startover.php">Start Over</a></p>
</body>
</html>
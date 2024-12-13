<!-- Name - ID (31/07/2024) -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="author" content="Name - ID">
    <title>Lab 01 - First PHP Page - Functions</title>
</head>
<body>
    <?php
        /* Use of abs() and pow() built-in functions, and echo statement. */
        echo "<p>Absolute value of -9 is: ", abs (-9),".</p>";
        echo "<p>2 to the power of 5 is : ", pow(2,5),".</p>";
    ?>
    <?php
        /* Use of decbin() and bindec() functions. */
        echo "<p>Decimal equivalent of 1101 is: ", bindec(1101),".</p>";
        echo "<p>Binary equivalent of 14 is: ", decbin(14),".</p>";
    ?>
    <ul>
        <li><a href="index.php">index.php</a></li>
        <li><a href="functions.php">functions.php</a></li>
        <li><a href="cdrates.php">cdrates.php</a></li>
    </ul>
</body>
</html>
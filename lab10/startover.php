<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Name - ID">
    <title>Lab10</title>
</head>
<body>
    <h1>Web Programming - Lab 10</h1>
    <ul>
        <li><a href="index.php">Index</a></li>
        <li><a href="countvisits.php">Count Visits</a></li>
    </ul>
    <?php
        require_once 'hitcounter.php';
        include('config.php');

        // Assuming HitCounter class is defined in hitcounter.php
        $hitCounter = new HitCounter($host, $user, $pswd, $dbnm, 'hitcounter');
        $hitCounter->startOver();
        echo 'Counter reset to 0';
        $hitCounter->closeConnection();
    ?>
</body>
</html>
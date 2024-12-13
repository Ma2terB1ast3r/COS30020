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
        <li><a href="startover.php">Start Over</a></li>
    </ul>
    <?php
        require_once 'hitcounter.php';
        // require_once 'mykeys.inc.php'; // or use code to read mykeys.txt file
        include('config.php');

        // Instantiate an object of the HitCounter class
        $Counter = new HitCounter($host, $user, $pswd, $dbnm, 'hitcounter');

        // Call the getHits() method
        $currentHits = $Counter->getHits();
        echo "Current Hits: " . $currentHits . "<br>";

        // Increment the hit counter
        $Counter->setHits();

        // Call the closeConnection() method to terminate the server connection
        $Counter->closeConnection();
    ?>
</body>
</html>
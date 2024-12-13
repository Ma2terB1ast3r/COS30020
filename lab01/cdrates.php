<!-- Name - ID (31/07/2024) -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="author" content="Name - ID">
    <title>Lab 01 - First PHP Page - Credit Union</title>
</head>
<body>
    <h1>Forest Credit Union</h1>
    <h2>CD Rates</h2>
    <ul>
        <?php
            echo "<li>4.35% (36-Month Term CD)</li><li>3.85% (12-Month Term CD)</li><li>2.65% (6-Month Term CD)</li>";
        ?>
    </ul>
    <?php
        echo "<p>$1,000 minimum deposit</p>"
    ?>
    <ul>
        <li><a href="index.php">index.php</a></li>
        <li><a href="functions.php">functions.php</a></li>
        <li><a href="cdrates.php">cdrates.php</a></li>
    </ul>
</body>
</html>
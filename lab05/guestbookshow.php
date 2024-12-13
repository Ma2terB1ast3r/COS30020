<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Name - ID">
    <title>lab05</title>
</head>
<body>
    <h1>Web Programming - Lab 5</h1>
    <?php
        $filename = "../../data/lab05/guestbook.txt"; // assumes php file is inside lab05
        // $filename = "guestbook.txt";
        if (!file_exists($filename)) {
            echo "<p>Guestbook is empty</p>";
            return;
        }
        echo "<pre>";
        readfile($filename);
        echo "</pre>";
    ?>
</body>
</html>
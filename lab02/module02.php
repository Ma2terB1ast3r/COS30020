<!-- Name - ID (31/07/2024) -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Web, Web Programming">
    <meta name="author" content="Name - ID">
    <meta name="author" content="Name - ID">
    <title>Lab 02 - Arrays and Variables</title>
</head>
<body>
    <?php
        $marks = array (85, 90, 95); // define array
        $marks[1] = 90; // modify 2nd element
        $avg = ($marks[0] + $marks[1] + $marks[2]) / 3; // compute average
        ($avg >= 50) // check status
                ? $status = "PASSED"
                : $status = "FAILED";
        echo "<p>The average score is $avg. You $status</p>"
    ?>
</body>
</html>
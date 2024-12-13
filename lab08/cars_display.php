<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="description" content="Web application development" />
<meta name="keywords" content="PHP" />
<meta name="author" content="Name - ID">
<title>Wk8 - Cars Display</title>
</head>
<body>
    <h1>Web Programming - Lab08 - Car Display</h1>
    <?php
        require_once ("settings.php");
        // complete your answer based on Lecture 8 slides 26 and 44
        $conn = @mysqli_connect($host, $user, $pswd, $dbnm);

        // Query and display all cars
        if (!$conn) {
            echo "<p>Database connection failure</p>";
        } else {
            $query = 'SELECT car_id, make, model, price FROM cars';
            $result = mysqli_query($conn, $query);
            echo "<table border=\"1\">\n";
            echo "<tr>\n "
                . "<th scope=\"col\">Car ID</th>\n "
                . "<th scope=\"col\">Make</th>\n "
                . "<th scope=\"col\">Model</th>\n "
                . "<th scope=\"col\">Price</th>\n "
                . "</tr>\n ";
            while ($row = mysqli_fetch_row($result)) {
                echo "<tr>\n ";
                echo "<td>", $row[0], "</td>\n ";
                echo "<td>", $row[1], "</td>\n ";
                echo "<td>", $row[2], "</td>\n ";
                echo "<td>", $row[3], "</td>\n ";
                echo "</tr>\n ";
            }
            mysqli_free_result($result);
            mysqli_close($conn);
        }
    ?>
</body>
</html>
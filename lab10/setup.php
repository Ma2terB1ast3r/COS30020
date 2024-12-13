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
        $host = 'feenix-mariadb.swin.edu.au'; // DB address
        $user = 'sXXXXXXXXX'; // DB Username
        $pswd = 'XXXXXX'; // DB Password
        $dbnm = 'sXXXXXXXXX_db'; // DB Name

        $conn = new mysqli($host, $user, $pswd, $dbnm);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "CREATE TABLE IF NOT EXISTS hitcounter (
            id SMALLINT NOT NULL PRIMARY KEY,
            hits SMALLINT NOT NULL
        )";

        if ($conn->query($sql) === TRUE) {
            echo "Table 'hitcounter' created successfully";

            $sql = "INSERT INTO hitcounter (id, hits) VALUES (1, 0)";
            if ($conn->query($sql) === TRUE) {
                echo "Initial record inserted successfully";
            } else {
                echo "Error inserting record: " . $conn->error;
            }
        } else {
            echo "Error creating table: " . $conn->error;
        }

        $conn->close();
    ?>
</body>
</html>
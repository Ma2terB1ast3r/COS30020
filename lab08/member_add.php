<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="description" content="Web application development" />
<meta name="keywords" content="PHP" />
<meta name="author" content="Name - ID">
<title>Wk8 - VIP Members</title>
</head>
<body>
    <h1>Web Programming - Lab08 - VIP Members Page</h1>
    <?php
        require_once("settings.php");
        $conn = @mysqli_connect($host, $user, $pswd, $dbnm);
        if (!$conn) {
            echo "<p>Database connection failure</p>";
        } else {
            // Check if the table exists
            $tableExistsQuery = "SHOW TABLES LIKE 'vipmembers'";
            $result = mysqli_query($conn, $tableExistsQuery);

            // If the table does not exist, create it
            if (mysqli_num_rows($result) != 1) {
                echo "<p>The table 'vipmembers' does not exist.</p>";
                $createTableQuery = "CREATE TABLE vipmembers (
                                        member_id INT NOT NULL AUTO_INCREMENT,
                                        fname VARCHAR(40),
                                        lname VARCHAR(40),
                                        gender VARCHAR(1),
                                        email VARCHAR(40),
                                        phone VARCHAR(20),
                                        PRIMARY KEY (member_id))";
                $result = mysqli_query($conn, $createTableQuery);
                if ($result) {
                    echo "<p>The table 'vipmembers' has been created.</p>";
                } else {
                    echo "<p>The table 'vipmembers' could not be created.</p>";
                }
            }

            // Insert the new member into the table
            $fname = $_POST["fname"];
            $lname = $_POST["lname"];
            $gender = $_POST["gender"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $insertQuery = "INSERT INTO vipmembers (fname, lname, gender, email, phone) VALUES ('$fname', '$lname', '$gender', '$email', '$phone')";
            $result = mysqli_query($conn, $insertQuery);
            if ($result) {
                echo "<p>The new member has been added to the table.</p>";
            } else {
                echo "<p>The new member could not be added to the table.</p>";
            }
        }
    ?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Name - ID">
    <link rel="stylesheet" href="style.css">
    <title>Assignment 2</title>
</head>
<body>
    <main>
        <!-- Navbar -->
        <header>
            <?php
                require_once("functions/navbar.php");
                renderNavbar();
            ?>
        </header>

        <!-- Main content -->
        <h1>My Friend System</h1>
        <h2>Assignment Home Page</h2>
        <p>Name: Name</p>
        <p>Email: <a href="mailto:XXXXXXXXX@student.swin.edu.au">XXXXXXXXX@student.swin.edu.au</a></p>
        <p>I declare that this assignment is my individual work. I have not worked collaboratively nor have I copied from any other student’s work or from any other source.</p>
        <?php
            // Function to generate a random date for the test data
            function randomDate() {
                $start = strtotime("2020-01-01");
                $end = strtotime("2024-01-01");
                $randomDate = date("Y-m-d", mt_rand($start, $end));
                return $randomDate;
            }

            // Create tables and insert test data if needed
            require_once("config.php");
            $conn = new mysqli($host, $user, $pswd, $dbnm);
            if (!$conn) {
                echo("<p class='errorMsg'>Database connection failure</p>");
            } else {
                // Check if the friends table exists
                $friendTableStmnt = "SHOW TABLES LIKE 'friends'";
                $friendTableResult = $conn->query($friendTableStmnt);
                // Check if the myfriends table exists
                $myFriendsTableStmnt = "SHOW TABLES LIKE 'myfriends'";
                $myFriendsTableResult = $conn->query($myFriendsTableStmnt);


                // Create friends table if it doesn't exist
                $stmt = "CREATE TABLE IF NOT EXISTS friends (
                friend_id INT NOT NULL AUTO_INCREMENT,
                friend_email VARCHAR(50) NOT NULL,
                password VARCHAR(20) NOT NULL,
                profile_name VARCHAR(30) NOT NULL,
                date_started DATE NOT NULL,
                num_of_friends INT UNSIGNED,
                PRIMARY KEY (friend_id)
                );";
                $result = $conn->query($stmt);

                if ($result) {
                    echo("<p class='successMsg'>The table 'friends' has been created or already exists.</p>");

                    // If table was created, create a template users
                    if ($friendTableResult->num_rows == 0) {
                        // Insert the template user into the table
                        // Names were randomly generated
                        $stmt = "INSERT INTO friends (friend_email, password, profile_name, date_started, num_of_friends) VALUES
                        ('john.doe@example.com', 'password1', 'John Doe', '" . randomDate() . "', 4),
                        ('jane.smith@example.com', 'password2', 'Jane Smith', '" . randomDate() . "', 4),
                        ('michael.johnson@example.com', 'password3', 'Michael Johnson', '" . randomDate() . "', 4),
                        ('emily.davis@example.com', 'password4', 'Emily Davis', '" . randomDate() . "', 4),
                        ('william.brown@example.com', 'password5', 'William Brown', '" . randomDate() . "', 4),
                        ('olivia.jones@example.com', 'password6', 'Olivia Jones', '" . randomDate() . "', 4),
                        ('james.garcia@example.com', 'password7', 'James Garcia', '" . randomDate() . "', 4),
                        ('isabella.martinez@example.com', 'password8', 'Isabella Martinez', '" . randomDate() . "', 4),
                        ('benjamin.rodriguez@example.com', 'password9', 'Benjamin Rodriguez', '" . randomDate() . "', 4),
                        ('sophia.hernandez@example.com', 'password10', 'Sophia Hernandez', '" . randomDate() . "', 4);";
                        $result = $conn->query($stmt);

                        // Display result
                        if ($result) {
                            echo("<p class='successMsg'>The template users has been added to the table.</p>");
                        } else {
                            echo("<p class='errorMsg'>The template users could not be added to the table.</p>");
                        }
                    }
                } else {
                    echo("<p class='errorMsg'>The table 'friends' could not be created.</p>");
                }

                // Create myfriends table if it doesn't exist
                $stmt2 = "CREATE TABLE IF NOT EXISTS myfriends (
                    friend_id1 INT NOT NULL,
                    friend_id2 INT NOT NULL,
                    PRIMARY KEY (friend_id1, friend_id2)
                );";
                $result = $conn->query($stmt2);

                if ($result) {
                    echo("<p class='successMsg'>The table 'myfriends' has been created or already exists.</p>");

                    // If table was created, create test data
                    if ($myFriendsTableResult->num_rows == 0) {
                        // Insert test data into myfriends table
                        $stmt2 = "INSERT INTO myfriends (friend_id1, friend_id2) VALUES
                        (1, 2),
                        (1, 3),
                        (2, 3),
                        (2, 4),
                        (3, 4),
                        (3, 5),
                        (4, 5),
                        (4, 6),
                        (5, 6),
                        (5, 7),
                        (6, 7),
                        (6, 8),
                        (7, 8),
                        (7, 9),
                        (8, 9),
                        (8, 10),
                        (9, 10),
                        (9, 1),
                        (10, 1),
                        (10, 2);";
                        $result = $conn->query($stmt2);

                        // Display result
                        if ($result) {
                            echo("<p class='successMsg'>Test data has been added to the 'myfriends' table.</p>");
                        } else {
                            echo("<p class='errorMsg'>Test data could not be added to the 'myfriends' table.</p>");
                        }
                    }
                } else {
                    echo("<p class='errorMsg'>The table 'myfriends' could not be created.</p>");
                }
            }
        ?>
    </main>
</body>
</html>
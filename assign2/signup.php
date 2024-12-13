<?php
    session_start();
?>
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
        <h1>Signup</h1>
        <form action="signup.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
            <label for="profilename">Profile Name:</label>
            <input type="text" id="profilename" name="profilename">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <label for="confirm">Confirm Password:</label>
            <input type="password" id="confirm" name="confirm">
            <input type="submit" value="Submit">
            <input type="reset" value="Reset">
        </form>
        <?php
            require_once("config.php");
            // Check if the form was submitted properly
            if (isset($_POST['email']) && isset($_POST['profilename']) && isset($_POST['password']) && isset($_POST['confirm'])) {
                $conn = new mysqli($host, $user, $pswd, $dbnm);
                if (!$conn) {
                        echo("<p>Database connection failure</p>");
                } else {
                    $errorMsg = ""; // Init error message

                    // Ensure email is unique
                    $email = $_POST['email'];
                    $stmt = $conn->prepare("SELECT friend_email FROM friends WHERE friend_email = ?");
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $stmt->store_result();
                    if ($stmt->num_rows > 0) {
                        $errorMsg .= "<li>Email already exists</li>";
                    }
                    $stmt->close();

                    // Validate form inputs
                    if (!filter_var($email, FILTER_SANITIZE_EMAIL)) {
                        $errorMsg .= "<li>Email is invalid</li>";
                    }
                    $profilename = $_POST['profilename'];
                    if (!preg_match("/^[a-zA-Z0-9]*$/", $profilename) && !empty($profilename)) {
                        $errorMsg .= "<li>Profile Name is invalid</li>";
                    }
                    $password = $_POST['password'];
                    if (!preg_match("/^[a-zA-Z0-9]*$/", $password) && !empty($password)) {
                        $errorMsg .= "<li>Password is invalid</li>";
                        echo("<p>Password: $password</p>");
                    }
                    $confirm = $_POST['confirm'];
                    if ($confirm != $password) {
                        $errorMsg .= "<li>Confirm password is not the same as the password</li>";
                        echo("<p>Confirm: $confirm</p>");
                    }

                    // If no errors, insert new user
                    if ($errorMsg == "") {
                        $date = date("Y-m-d"); // Get today's date
                        $stmt = $conn->prepare("INSERT INTO friends (friend_email, profile_name, password, date_started, num_of_friends) VALUES (?, ?, ?, ?, 0)");
                        if ($stmt === false) { //TODO: tidy this up
                            echo("Error: " . $conn->error);
                        } else {
                            $stmt->bind_param("ssss", $email, $profilename, $password, $date);
                            if ($stmt->execute()) {
                                echo("<p style='color: green;'>New record created successfully</p>");
                            } else {
                                echo("Error: " . $stmt->error);
                            }
                        }
                        $stmt->close();
                        $conn->close();

                        // Automatically sign in the new user and redirect to friendlist
                        $conn = @mysqli_connect($host, $user, $pswd, $dbnm);
                        if ($conn) {
                            $email = mysqli_real_escape_string($conn, $email);
                            $password = mysqli_real_escape_string($conn, $password);
                            $query = "SELECT friend_id FROM friends WHERE friend_email = '$email' AND password = '$password'";
                            $result = mysqli_query($conn, $query);

                            // If the query returns a single row, the user is authenticated
                            if (mysqli_num_rows($result) == 1) {
                                $row = mysqli_fetch_assoc($result);
                                $id = $row['friend_id'];
                                // Setup session variables
                                $_SESSION['id'] = $id;
                                header("Location: friendlist.php");
                            } else { // Display error message if authentication failed
                                echo("<p style='color: red;'>Invalid email or password</p>");
                            }
                            mysqli_free_result($result);
                            mysqli_close($conn);
                        } else {
                            // Display error message if database connection failed
                            echo("<p style='color: red;'>Database connection failed</p>");
                        }
                    } else {
                        // Display error message
                        echo("<p>The following errors were found: </p>\n<ul style='color: red;'>$errorMsg</ul>");
                    }
                }
            }
        ?>
    </main>
</body>
</html>